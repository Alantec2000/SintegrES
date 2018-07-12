<nav id="sintegres-navbar" class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="#">
			Sintegr<span class='orange-component'>Es</span>
		</a>
		<div class="navber-header">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>	
		</div>
		
		<div class="collapse navbar-collapse" id="lista_menus_sintegres">
			@if(Route::getCurrentRoute()->uri() != 'autenticar')
				<ul class="navbar-nav mr-auto">
				</ul>
				@if (session('status'))
					<div id="usuario_actions_menu_wrapper" class="float-right">
						<a id="nome_usuario_sintegres" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{session('login')}}
						</a>
						<div class="nav-item dropdown">
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="nav-link orange-component" href="{{url('usuario/sair')}}">Sair</a>
							</div>
						</div>
					</div>
				@endif
			@endif
		</div>
	</div>
</nav>