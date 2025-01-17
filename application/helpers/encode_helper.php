<?php
 
/**
 * Codifica uma string como base64 para uso em um URI CI.
 *
 * @param string $str String ou Array a ser codificado
 * @return string
 */
function voucher_base64_encode(&$str = "") {
	
	$salto = "caramelo";
    
	return base64_encode($str.$salto);
}
 
/**
 * Decodifica uma string base64 que foi codificado por url_base64_encode.
 *
 * @param string $str A seqüência de caracteres base64 para decodificar.
 * @return object
 */
function voucher_base64_decode(&$str = "") {
	
	$salto = "caramelo";
	
    return str_replace($salto,'',base64_decode($str)); 
}
 
// End of file: encode_helper.php
// Location: ./system/application/helpers/encode_helper.php