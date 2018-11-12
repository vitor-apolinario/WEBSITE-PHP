<?php
	include_once "../includes/conexao.php";
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	$fl_usuario= $_POST['fl_tipo'];
	$nome=       $_POST['nome'];
	$email=      $_POST['email'];
	$cid=		 $_POST['cid'];
	$telefone=   $_POST['telefone'];
	$endereco=   $_POST['endereco'];
	$senha1=     $_POST['senha'];
	$senha2=     $_POST['senha2'];
	$email=      $_POST['email'];
	$concordo=   isset($_POST['concordo']) ? 1 : 0;

	if(isset($_POST['cpf']))
		$cpf = $_POST['cpf'];

	if(isset($_POST['cpf']))
		$cnpj = $_POST['cpf'];

	//-----------aqui devem ser validados os dados------

	//--------------------------------------------------


	//---------------somente para debug-----------------
	$arrayName = array(
		$fl_usuario,
		$nome,
		$email,
		$cid,
		$telefone,
		$endereco,
		$senha1,
		$senha2,
		$email,
		$concordo
	);
	if ($fl_usuario=="c") {
		$categoria=$_POST['categoria'];
		$datanasc=$_POST['datanasc'];
		$arrayName[]=$categoria;
		$arrayName[]=$datanasc;
	}
	echo "<pre>";
	print_r($arrayName);
	echo "</pre>";
	//--------------------------------------------------


	//------------valida email/senha NO BD-----
	$sql_valida="SELECT *
				 FROM(
    				SELECT email, 'E' as fl_tipo FROM empresa
    				UNION ALL
    				SELECT email, 'C' as fl_tipo FROM caminhoneiro
				 ) u
				 WHERE u.email='$email'";
	$result=mysqli_fetch_array(mysqli_query($conexao, $sql_valida), MYSQLI_ASSOC);

	if(isset($result)){
		echo "email já cadastrado, query não será executada!";
		die();
	}
	//-----------------------------------------

	//---------insert cam/emp------------------
	echo "<pre>";
	if ($_POST['fl_tipo']=="c"){
		echo $sql_camemp="INSERT INTO `caminhoneiro`(`cnh`, `nome`, `fone`, `cpf`, `email`, `dtnasc`, `ender`, `ender_cida`)
		VALUES ('$categoria', '$nome', '$telefone', $cpf, '$email','$datanasc', '$endereco', '$cid');";
		$type="C";
	}else{
		echo $sql_camemp="INSERT INTO `empresa`(`cnpj`, `nome`, `ender`, `fone`, `email`, `ender_cidad`)
		VALUES ($cnpj, '$nome', '$endereco', '$telefone', '$email', '$cid');";
		$type="E";
	}
	echo "</pre>";
	//-----------------------------------------

	//--------insert table usuario-------------
	echo "<pre>";
	echo $sql_usuario="INSERT INTO `usuario`(`email`, `senha`, `fl_tipo`)
	VALUES ('$email', '$senha1', '$type');";
	echo "</pre>";
	//-----------------------------------------

	mysqli_query($conexao, $sql_usuario);
	mysqli_query($conexao, $sql_camemp);
	//header("Location: ../index.php");
?>
