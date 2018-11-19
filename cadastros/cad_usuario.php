<?php
	include_once "../includes/conexao.php";
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	if
	(
		!isset($_POST['fl_tipo'])	|| empty($_POST['fl_tipo'])  ||
		!isset($_POST['nome'])		|| empty($_POST['nome'])	 ||
		!isset($_POST['email'])		|| empty($_POST['email'])	 ||
		!isset($_POST['cid'])		|| empty($_POST['cid'])		 ||
		!isset($_POST['telefone'])	|| empty($_POST['telefone']) ||
		!isset($_POST['endereco'])	|| empty($_POST['endereco']) ||
		!isset($_POST['senha'])		|| empty($_POST['senha'])	 ||
		!isset($_POST['senha2'])	|| empty($_POST['senha2'])	 ||
		!isset($_POST['email'])		|| empty($_POST['email'])	 ||
		!isset($_POST['concordo'])  || empty($_POST['concordo'])
	){
		echo "<p>Preencha todos os campos do formulário</p>";
		die();
	}

	$fl_usuario= trim($_POST['fl_tipo']);
	$nome=       trim($_POST['nome']);
	$email=      trim($_POST['email']);
	$cid=		 trim($_POST['cid']);
	$telefone=   trim($_POST['telefone']);
	$endereco=   trim($_POST['endereco']);
	$senha1=     trim($_POST['senha']);
	$senha2=     trim($_POST['senha2']);
	$concordo=   isset($_POST['concordo']) ? 1 : 0;

	if(isset($_POST['cpf']))
		$cpf = $_POST['cpf'];

	if(isset($_POST['cnpj']))
		$cnpj = $_POST['cnpj'];

	$erros=array();

	//-----------aqui devem ser validados os dados------
	//--------------------------------------------------

	if (count($erros)>0) {
		echo "Houveram erros!";
	}
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
	$sql_valida="SELECT 
					email 
				FROM 
					usuario u	
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
		VALUES ('$categoria', '$nome', '$telefone', '$cpf', '$email','$datanasc', '$endereco', '$cid');";
		$type="C";
	}else{
		echo $sql_camemp="INSERT INTO `empresa`(`cnpj`, `nome`, `ender`, `fone`, `email`, `ender_cidad`)
		VALUES ($cnpj, '$nome', '$endereco', '$telefone', '$email', '$cid');";
		$type="E";
	}
	echo "</pre>";
	//-----------------------------------------

	$senha1=md5($senha1);
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
