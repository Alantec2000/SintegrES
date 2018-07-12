<?php 
	namespace App;
	use TextUtils;
	
	abstract class CurlUtils {

		/*
			Classe utilitária para requisições utilizando a extensão Curl do PHP
		*/

		public static function request($url, $params){
			$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
	    	$curl = curl_init ($url);
			curl_setopt ($curl, CURLOPT_USERAGENT, $userAgent);
			curl_setopt ($curl, CURLOPT_POST, true);
			curl_setopt ($curl, CURLOPT_POSTFIELDS, (is_array ($params) ? http_build_query ($params, '', '&') : $params));
			curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt ($curl, CURLOPT_HEADER, 1);
			
			return curl_exec($curl);
		}
	}

?>