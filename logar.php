<?php
	include "includes/conexao.php";
	echo "<pre>";
	if (isset($_SESSION))
		print_r($_SESSION);
	if (isset($_POST))
		print_r($_POST);
	echo "</pre>";

	// $sql = "select * from produto where id = {$_GET['id']}";
	// $resultado = mysqli_query($conexao, $sql);
	// $dados = mysqli_fetch_array($resultado);

	$email00=$_POST['email'];
	$senha00=md5($_POST['senha']);

	$sql="select * from usuario where email='$email00' and senha='$senha00'";
	$resultset=mysqli_fetch_array(mysqli_query($conexao, $sql), MYSQLI_ASSOC);
	if(count($resultset)>0){
		@session_start();
		$_SESSION['usuario'] = $resultset;
		if ($resultset['fl_tipo']=="E") {
			$resultset=mysqli_fetch_array(mysqli_query($conexao, "select * from empresa where email='$email00'"), MYSQLI_ASSOC);
		}else
			$resultset=mysqli_fetch_array(mysqli_query($conexao, "select * from caminhoneiro where email='$email00'"), MYSQLI_ASSOC);
		$_SESSION['usuario']['dados'] = $resultset;
		header("Location: index.php");
	}else
		header("Location: login.php?erro=1&email=$email00");
?>