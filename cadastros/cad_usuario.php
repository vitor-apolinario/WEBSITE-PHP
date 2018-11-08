<?php
	include_once "../includes/conexao.php";
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	// $sql="INSERT INTO `usuario`(`email`, `senha`, `fl_tipo`) VALUES ('".$_POST['email']."','".$_POST['senha']."','C')";
	// mysqli_query($conexao, $sql);
	// header("Location: ../index.php");
?>