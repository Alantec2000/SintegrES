//Constantes
const MIN_PASS_SIZE = 6;
const MAX_PASS_SIZE = 16;

$(document).ready(function(){
	//Inicialização

	// Elementos da página
	
	$txt_login_usuario = $("#txt_login_usuario");
	$login_usuario_error_label = $("#login_usuario_error_label");
	
	$txt_senha_usuario = $("#txt_senha_usuario");
	$senha_usuario_error_label = $("#senha_usuario_error_label");
	
	$btn_submit = $("#btn_submit");

	// Fim inicialização

	//Tarefas realizadas antes de apresentar a página

	setTimeout(function(){
		$("#form_autenticar_usuario_error_message").slideUp();
	}, 5000);

	//Fim Tarefas iniciais

	//Delegação de eventos

	$('#form_autenticar_usuario_wrapper').on('click', function(e){
		e.preventDefault();
		switch(e.target.id){
			case 'btn_submit':
				autenticar(e);
			break;
			case 'txt_login_usuario':
				limparErros($txt_login_usuario, $login_usuario_error_label);
			break;
			case 'txt_senha_usuario':
				limparErros($txt_senha_usuario, $senha_usuario_error_label);
			break;
		}
	});

	// Fim Delegação de Eventos
});

function autenticar(e){
	if(validar_form_autenticacao()){
		$('#form_autenticar_usuario').submit();
	}
};

function validar_form_autenticacao(){
	let no_error = true;
	if(!$txt_senha_usuario.get(0).checkValidity()) {
		mostrarErro($txt_login_usuario, $login_usuario_error_label, "Preencha este campo!");
		no_error = false;
	}
	if($txt_senha_usuario.val().trim().length < MIN_PASS_SIZE){
		mostrarErro($txt_senha_usuario, $senha_usuario_error_label, "Informe ao menos 6 caracteres!");
		no_error = false;
	} else if($txt_senha_usuario.val().trim().length > MAX_PASS_SIZE){
		mostrarErro($txt_senha_usuario, $senha_usuario_error_label, "Senha não pode ser superior a 16 caracteres!");
		no_error = false;
	}
	return no_error;
}