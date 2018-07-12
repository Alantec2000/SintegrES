<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CurlUtils;
use App\Usuario;
use App\Sintegra;
use DB;

class SintegraController extends Controller {
	const SINTEGRA_URL = 'http://www.sintegra.es.gov.br/resultado.php';
	const SINTEGRA_RESULTADO_REGEX = '#<table.*class="resultado">.*</table>#sm';
	const SINTEGRA_VALORES_REGEX = '#<td.*class="valor".*>(&nbsp;(.*)|(.*))<\/td>#m';
   
    private $request;
    public function __construct(Request $r, Usuario $u){
    	$this->request = $r;
    }
    
	private function parsePaginaSintegraJson($pagina = ""){
		preg_match_all(self::SINTEGRA_VALORES_REGEX, $pagina, $matches);
		$empresa = $matches[1];
		return [
			"cnpj" => CurlUtils::limparDados($empresa[0]),
			"inscricao_estadual" => CurlUtils::limparDados($empresa[1]),
			"razao_social" => CurlUtils::limparDados($empresa[2]),
			"logradouro" => CurlUtils::limparDados($empresa[3]),
			"numero" => CurlUtils::limparDados($empresa[4]),
			"complemento" => CurlUtils::limparDados($empresa[5]),
			"bairro" => CurlUtils::limparDados($empresa[6]),
			"municipio" => CurlUtils::limparDados($empresa[7]),
			"uf" => CurlUtils::limparDados($empresa[8]),
			"cep" => CurlUtils::limparDados($empresa[9]),
			"telefone" => CurlUtils::limparDados($empresa[10]),
			"atividade_economica" => CurlUtils::limparDados($empresa[11]),
			"data_inicio" => CurlUtils::converterParaMillisegundos($empresa[12]),
			"situacao_cadastral" => CurlUtils::limparDados($empresa[13]),
			"data_situacao_cadastral" => CurlUtils::converterParaMillisegundos($empresa[14]),
			"regime_apuracao" => CurlUtils::limparDados($empresa[15])
		];
	}

	public function getDetalhesConsulta($id_consulta){
		$sintegra = (new Sintegra())->getDadosConsulta($id_consulta);
		return view('sintegra.detalhes',["empresa"=>$sintegra]);
	}

    public function getInformacaoEmpresa($cnpj){
    	$empresa = [];
		$params = $this->request->all();
		
		$usuario = !empty($params) ? Usuario::autenticar($params) : (new Usuario)->getUsuario(session('id_usuario'));

		if($usuario != null && !empty($usuario)){
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

    public function removerConsulta($id_consulta){
    	DB::table(Sintegra::TABELA)->where(Sintegra::ID, $id_consulta)->delete();
    	return redirect()->route('home');
    }

    private function salvarConsulta($id_usuario, $cnpj, $empresa){
    	$sintegra = (new Sintegra())->getConsultaCNPJ($id_usuario, $cnpj);
    	if(empty($sintegra) || is_null($sintegra)){
    		$sintegra = new Sintegra();
    		$sintegra->{Sintegra::CNPJ} = $cnpj;
    		$sintegra->{Sintegra::USUARIO} = $id_usuario;
    		$sintegra->{Sintegra::JSON} = json_encode($empresa);
    		$sintegra->save();
    		$sintegra->{Sintegra::ID} = $sintegra->id;
    	}
    	return $sintegra;
    }

    private function getDadosEmpresa($cnpj){
    	$empresa = [];
    	$cnpj = preg_replace ('/[^0-9\_]/', '', $cnpj);
		$params = ['num_cnpj' => $cnpj, 'botao' => 'Consultar' ];

		$pagina = CurlUtils::request(self::SINTEGRA_URL, $params);
		
		preg_match(self::SINTEGRA_RESULTADO_REGEX, $pagina, $tabela_resultado);
		
		if(!empty($pagina) && !empty($tabela_resultado[0])) {
			$empresa = $this->parsePaginaSintegraJson($tabela_resultado[0]);
		}
		return $empresa;
    }
}
