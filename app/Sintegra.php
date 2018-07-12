<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Usuario;

class Sintegra extends Model {

    use SoftDeletes;

    const TABELA = "sintegra";
    protected $table = "sintegra";
    const ID = "id_sintegra";
    const USUARIO = "id_usuario_sintegra";
    const CNPJ = "cnpj_empresa_sintegra";
    const JSON = "dados_empresa_sintegra";



    public function getConsultasUsuario(Usuario $usuario){
    	$colunas = [
            self::ID . " as id", 
            self::USUARIO . " as usuario", 
            self::CNPJ . " as usuario", 
            self::JSON
        ];
        
        $consultas = $this
                        ->join(Usuario::TABELA . " as u", "u.".Usuario::ID, self::USUARIO)
                        ->where(self::USUARIO, $usuario->{Usuario::ID})
                        ->get($colunas);
    	
        if(sizeof($consultas) > 0){
            foreach ($consultas as $consulta) {
                $consulta['json'] = json_decode($consulta[Sintegra::JSON]);
            }
        }
        return $consultas;
    }

    public function getDadosConsulta($id_consulta){
        $colunas = [self::ID . " as id", self::USUARIO . " as usuario", self::CNPJ . " as usuario", self::JSON];

        $consulta = $this
                        ->join(Usuario::TABELA . " as u", "u.".Usuario::ID, self::USUARIO)
                        ->where([
                            [self::ID, $id_consulta],
                            [self::USUARIO, session(Usuario::ID)]
                        ])->get($colunas)->first();

        if(!is_null($consulta)) {
            $consulta['json'] = json_decode($consulta[Sintegra::JSON]);
        }

        return $consulta;
    }

    public function getConsultaCNPJ($id, $cnpj){
        return $this
                ->join(Usuario::TABELA . " as u", "u.".Usuario::ID, self::USUARIO)
                ->where([[self::USUARIO, $id], [self::CNPJ, $cnpj]])
                ->get()->first();
    }
}
