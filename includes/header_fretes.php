<?php  
	@session_start();
	// AO FAZER LOGIN ARMAZENAR NA SESSION O TIPO DE USUÁRIO, 
	// E EXIBIR A LISTA DE FRETES DE ACORDO E TAMBÉM ADICIONAR
	// UMA OPCAO CASO SEJA EMPRESA, PARA ARRUMAR OS DADOS
?>
<?php
	include "includes/conexao.php";
	echo "<pre>";
	echo "session:";
	if (isset($_SESSION))
		print_r($_SESSION);
	echo "request:";
	if (isset($_REQUEST))
		print_r($_REQUEST);
	echo "</pre>";
?>
<!DOCTYPE.php>
<html lang="pt-br">
	<head>
		<title>Frete-Fetch</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/fretes.css">
		<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

<body>
	<!--cabeçalho-->
	<header class="c1">
		<div class="top-wrap">
			<label for="controle-menu">&#9776;</label>
			<h1>Frete-Fetch</h1>
			<input type="checkbox" id="controle-menu">
		</div>
		<nav id = "nav_mobile">
			<div class="menu-opcoes">
				<div><a href="cadastro_frete.php">Cadastro de fretes</a></div>
				<div><a href="fretes.php">Histórico de fretes</a></div>
			</div>
		</nav>
	</header>
	<!--fim cabeçalho-->