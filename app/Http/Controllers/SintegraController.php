<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CurlUtils;
use App\TextUtils;
use App\Usuario;
use App\Sintegra;
use DB;

class SintegraController extends Controller {
	const SINTEGRA_URL = 'http://www.sintegra.es.gov.br/resultado.php';
	const SINTEGRA_RESULTADO_REGEX = '#<table.*class="resultado">.*</table>#sm';
	const SINTEGRA_VALORES_REGEX = '#<td.*class="valor".*>(&nbsp;(.*)|(.*))<\/td>#m';
   
    private $request;
    public function __construct(Request $r){
    	$this->request = $r;
    }

	public function getDetalhesConsulta($id_consulta){
		$sintegra = (new Sintegra())->getDadosConsulta($id_consulta);
		return view('sintegra.detalhes',["empresa"=>$sintegra]);
	}

    public function getInformacaoEmpresa($cnpj){
    	$empresa = [];
		$params = $this->request->all();
		
		if(!empty($params)){
			$usuario = Usuario::autenticar($params);
		} else {
			$usuario = (new Usuario)->getUsuario(session('id_usuario'));
		}
		
		if($usuario != null && 
		   !empty($usuario)){
			$empresa = $this->getDadosEmpresa($cnpj);
			
			if(!empty($empresa)){
				$sintegra = $this->salvarConsulta($usuario->{Usuario::ID}, $cnpj, $empresa);
				if(!is_null($sintegra)){
					$empresa['id_consulta'] = $sintegra->{Sintegra::ID};
				}
			}
		}
    	return json_encode($empresa, JSON_FORCE_OBJECT);
    }

    private function getDadosEmpresa($cnpj){
    	$empresa = [];
    	$cnpj = preg_replace ('/[^0-9\_]/', '', $cnpj);
		$params = ['num_cnpj' => $cnpj, 'botao' => 'Consultar' ];

		$pagina = CurlUtils::request(self::SINTEGRA_URL, $params);
		
		preg_match(self::SINTEGRA_RESULTADO_REGEX, $pagina, $tabela_resultado);
		
		if(!empty($pagina) && 
		   !empty($tabela_resultado[0])) {
			$empresa = $this->parsePaginaSintegraJson($tabela_resultado[0]);
		}
		return $empresa;
    }

    private function parsePaginaSintegraJson($pagina = ""){
		preg_match_all(self::SINTEGRA_VALORES_REGEX, $pagina, $matches);
		$empresa = [];
		if(!empty($matches[1])){
			$empresa = $matches[1];
			$empresa = [
				"cnpj" => TextUtils::limparDados($empresa[0]),
				"inscricao_estadual" => TextUtils::limparDados($empresa[1]),
				"razao_social" => TextUtils::limparDados($empresa[2]),
				"logradouro" => TextUtils::limparDados($empresa[3]),
				"numero" => TextUtils::limparDados($empresa[4]),
				"complemento" => TextUtils::limparDados($empresa[5]),
				"bairro" => TextUtils::limparDados($empresa[6]),
				"municipio" => TextUtils::limparDados($empresa[7]),
				"uf" => TextUtils::limparDados($empresa[8]),
				"cep" => TextUtils::limparDados($empresa[9]),
				"telefone" => TextUtils::limparDados($empresa[10]),
				"atividade_economica" => TextUtils::limparDados($empresa[11]),
				"data_inicio" => TextUtils::converterParaMillisegundos($empresa[12]),
				"situacao_cadastral" => TextUtils::limparDados($empresa[13]),
				"data_situacao_cadastral" => TextUtils::converterParaMillisegundos($empresa[14]),
				"regime_apuracao" => TextUtils::limparDados($empresa[15])
			];
		}
		
		return $empresa;
	}

    private function salvarConsulta($id_usuario, $cnpj, $empresa){
    	$sintegra = (new Sintegra())->getConsultaCNPJ($id_usuario, $cnpj);
    	if(empty($sintegra) || 
    	   is_null($sintegra)){
    		$sintegra = new Sintegra();
    		$sintegra->{Sintegra::CNPJ} = $cnpj;
    		$sintegra->{Sintegra::USUARIO} = $id_usuario;
    		$sintegra->{Sintegra::JSON} = json_encode($empresa);
    		$sintegra->save();
    		$sintegra->{Sintegra::ID} = $sintegra->id;
    	}
    	return $sintegra;
    }

    public function removerConsulta($id_consulta){
    	DB::table(Sintegra::TABELA)->where(Sintegra::ID, $id_consulta)->delete();
    	return redirect()->route('home');
    }
}
