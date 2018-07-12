<?php

namespace App\Http\Middleware;

use Closure;
use App\Usuario;
class UsuarioMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if($this->sessaoAberta() || $request->path() == 'autenticar'){
            return $next($request);
        } else {
            return redirect()->route('autenticar');
        }
    }

    private function sessaoAberta(){
        if(session('id_usuario')){
            $usuario = (new Usuario())->getUsuario(session('id_usuario'));
            if(empty($usuario)){
                session(['status' => false]);   
            }
        }
        return session('status');
    }
}
