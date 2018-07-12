<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    //Constantes do BD

    const TABELA = "usuarios";
    public $table = self::TABELA;
    const ID = "id_usuario";
    const LOGIN = "login_usuario";
    const SENHA = "senha_usuario";

    //Constantes Requisição
    const LOGIN_REQUEST = "usuario";
    const SENHA_REQUEST = "senha";


    public function realizarLogin($login, $senha){
    	$senha = str_replace(['-','\'','"',';'], '', $senha);
    	$usuario = (new Usuario())->where([[self::LOGIN, $login],[self::SENHA, $senha]])->get()->first();
    	return $usuario;
    }
	
    public function getUsuario($id){
        $usuario = (new Usuario())->where(self::ID, $id)->get([self::ID])->first();
        return $usuario;
    }

	//Autentica a partir de uma requisição
    public static function autenticar($params){
    	$usuario = null;
    	if(isset($params[self::LOGIN_REQUEST], $params[self::SENHA_REQUEST])){
    		$usuario = new Usuario();
    		$usuario = $usuario->realizarLogin($params['usuario'], $params['senha']);
    	}
    	return $usuario;
    }
}
