<?php 
	namespace App;
	abstract class TextUtils {
		const CNPJ_MASK = "%s%s.%s%s%s.%s%s%s/%s%s%s%s-%s%s";
		const CEP_MASK = "%s%s%s%s%s-%s%s%s";
		const INSCRICAO_ESTADUAL_MASK = "%s%s%s.%s%s%s.%s%s-%s";
		const TELEFONE_MASK = "(%s%s) %s%s%s%s - %s%s%s%s";

		public static function converterParaMillisegundos($info){
	    	$result = 0;
	    	if(!empty(trim($info))){
				$result = strtotime(
					\DateTime::createFromFormat('d/m/Y',$info)
							 ->format('m/d/Y')
				);
	    	}
	    	return $result;
	    }

	    public static function limparDados($info){
	    	return str_replace(["&nbsp;","/",".","-"], '', trim($info));
	    }

		public static function formatar($formato, $texto){
			if(!empty($texto) && is_string($texto)){
				try {
					$texto = vsprintf($formato, str_split($texto));
				} catch (Exception $e) {
					error_log($e->getMessage());
				}
			}
			return $texto;
		}
	}
?>