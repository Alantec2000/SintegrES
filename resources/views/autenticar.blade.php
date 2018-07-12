@php
	$form_params = [
		'id'=>"form_autenticar_usuario",
		'url'=>'usuario/login',
		'method'=>'POST',
		'action'=>'Usuario@autenticar',
	];
@endphp
@extends('app')
@section('card-content')
	<div id="form_autenticar_usuario_wrapper">
		{!! Form::open($form_params)!!}
			
			{!! Form::label(
					"txt_login_usuario",
					"Login:"
				)
			!!} <br>
			
			{!! Form::text(
					"login_usuario",
					'', [
					'id'=>'txt_login_usuario',
					'class'=>'form-control',
					'required'=>'true'
			    ])
			!!}
			{!! Form::label(
					"txt_login_usuario",
					" ", [
						'id'=>'login_usuario_error_label',
						'class'=>'label invalid-feedback error_label'
				])
			!!}<br>
			
			{!! Form::label(
					"txt_senha_usuario",
					"Senha:", [
						'class'=>'mg-top'
				])
			!!} <br>
			
			{!! Form::password(
					"senha_usuario",[
						'id'=>'txt_senha_usuario',
						'class'=>'form-control',
						'data-dismiss'=>"login_usuario_alert_header",
						'maxlength'=>16,
						'required'=>'true'
				])
			!!}
			
			{!! Form::label(
				"txt_senha_usuario",
				' ', [
					'id'=>'senha_usuario_error_label',
					'class'=>'label invalid-feedback error_label'
				])
			!!}<br>

			@if (isset($erro_autenticacao))
				<div id="form_autenticar_usuario_error_message" class="container">
					<h3 id="form_autenticar_usuario_error_message_body" class="text-center">
					
					{!! Form::label(
						"txt_login_usuario",
						$erro_autenticacao, [
							'id'=>'login_usuario_error_label',
							'class'=>'badge badge-warning error_label'
						])
					!!}<br>	
					
					</h3>
				</div>
			@endif
			<hr>
			<div id="footer-form-login" class="">
				{!! Form::submit(
					'Entrar', [
						'id' => 'btn_submit',
						'class'=>'btn orange-component float-right'
					])
				!!}
			</div>
		{!! Form::close()!!}
	</div>
@endsection
@section('footer')
	{!! Html::script('js/login.js') !!}
@endsection