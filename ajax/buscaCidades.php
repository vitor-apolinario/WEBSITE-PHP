<?php
	include "../includes/conexao.php";
	$sql="SELECT * FROM `cidade` WHERE estado='".$_GET['uf']."'";
}
?>