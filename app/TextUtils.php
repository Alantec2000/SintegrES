<?php 
	namespace App;
	abstract class TextUtils {
		const CNPJ_MASK = "%s%s.%s%s%s.%s%s%s/%s%s%s%s-%s%s";
		const CEP_MASK = "%s%s%s%s%s-%s%s%s";
		const INSCRICAO_ESTADUAL_MASK = "%s%s%s.%s%s%s.%s%s-%s";
		const TELEFONE_MASK = "(%s%s) %s%s%s%s - %s%s%s%s";
		
		public static function formatar($formato, $texto){
			if(!empty($texto) && is_string($texto)){
				$texto = vsprintf($formato, str_split($texto));
			}
			return $texto;
		}
	}
?>