<?php
	include "../includes/conexao.php";
    $sql_valida="SELECT
                    email
                FROM
                    usuario u
                WHERE u.email='{$_GET["email"]}'";
    include_once "../includes/conexao.php";
    $result=mysqli_fetch_array(mysqli_query($conexao, $sql_valida), MYSQLI_ASSOC);

	if(isset($result)){
		echo "S";
	}else{
		echo "N";
	}
?>
