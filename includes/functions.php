<?php
function formata($prefixo, $valor){
	if ($prefixo=="R$") {
		return $prefixo . " " . str_replace(".", ",", number_format($valor, 2));
	}else
		return str_replace(".", ",", number_format($valor, 2)) . " " . $prefixo;
	
}
?>