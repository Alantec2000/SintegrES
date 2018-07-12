<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Session;

class UsuarioController extends Controller
{
	private $usuario;
	private $request;

	public function __construct(Request $request, Usuario $usuario){
		$this->request = $request;
		$this->usuario = $usuario;
	}

	public function autenticar(){
		$params = $this->request->all();
		$usuario = $this->usuario->realizarLogin($params['login_usuario'], $params['senha_usuario']);

		if(!is_null($usuario)){
			$this->iniciarSessao($usuario);
			return redirect()->route('home');
		} else {
			return view('autenticar', ["erro_autenticacao" => "Usuário ou senha inválidos!"]);
		}
	}

	public function sair(){
		Session::flush();
		return redirect('autenticar');
	}

	private function iniciarSessao(Usuario $usuario){
		session([
			"id_usuario" => $usuario->{Usuario::ID},
			"login" => $usuario->{Usuario::LOGIN},
			"status" => true,
			"data_acesso" => strtotime('now')
		]);
	}
}
