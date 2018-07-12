$(document).ready(function(){
	$txt_cnpj_empresa = $("#txt_cnpj_empresa");
	$cnpj_empresa_error_label = $("#cnpj_empresa_error_label");
	
	$btn_consultar_cnpj = $("#btn_consultar_cnpj");

	$txt_cnpj_empresa.mask('00.000.000/0000-00');

	$("#consulta_sintegra_wrapper").on('click', function(e){
		switch(e.target.id){
			case 'btn_consultar_cnpj':
				consultarCNPJ();
			break;
			case 'txt_cnpj_empresa':
				limparErros($txt_cnpj_empresa, $cnpj_empresa_error_label);
			break;
		};
	});
});

var validarConsulta = function(cnpj){
	let no_error = true;
	
	if(cnpj.length < 14){
		mostrarErro($txt_cnpj_empresa, $cnpj_empresa_error_label, "CNPJ curto demais!");
		no_error = false;
	}

	return no_error;
}

function consultarCNPJ(){
	$btn_consultar_cnpj.prop('disabled', true);
	let cnpj = $txt_cnpj_empresa.val().trim().replace(/[./-]|[A-z]/g, '');
	if(validarConsulta(cnpj)) {
		$.ajax({
			'type':'GET',
			'url': APP_URL + "/consulta/sintegra/" + cnpj,
			'dataType': 'json',
			'success':function(data){
				if(data && data.id_consulta){
					window.location = APP_URL + "/consulta/get/" + data.id_consulta;
				} else {
					mostrarErro($txt_cnpj_empresa, $cnpj_empresa_error_label, "CNPJ Não encontrado!");
				}
				$btn_consultar_cnpj.prop('disabled',false);
			}
		}).always(function(){
			$btn_consultar_cnpj.prop('disabled',false);
		}).responseJSON;
	} else {
		$btn_consultar_cnpj.prop('disabled', false);
	}

}