<?php
namespace EdiParser\Validator;

class ArquivoValidator {
	
	public static function validate($filename) {
		if (!file_exists($filename))
			throw new \Exception("Arquivo '$filename' não encontrado");
		
		$linhas = file($filename);
		
		$header = $linhas[0];
		if (substr($header, 42,5) != 'CIELO')
			return false;
		if (substr($header, 70,3) != '001')
			return false;
		return true;
	}
}