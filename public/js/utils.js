function limparErros($obj, $error_label){
	$error_label.hide();
	$obj.removeClass('is-invalid');
	$error_label.text("");
}

function mostrarErro($obj, $error_label, $erro){
	$error_label.show();
	$obj.addClass('is-invalid').focus();
	$error_label.text($erro);
}