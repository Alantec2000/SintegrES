<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Sintegra;
use Session;

class HomeController extends Controller {
    public function load(){
    	$id = session(Usuario::ID);
    	$usuario = (new Usuario())->where(Usuario::ID, $id)->get()->first();
    	$sintegra = new Sintegra();
    	$consultas_realizadas = $sintegra->getConsultasUsuario($usuario);
    	
    	return(view('home', ['consultas_realizadas' => $consultas_realizadas]));
    }
}
