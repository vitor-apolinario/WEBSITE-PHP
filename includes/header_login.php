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
<html lang = "pt-br">
	
	<head>
		<title>Login Frete-Fretch</title>
		<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cadastro_frete.css">
	</head>

<body>
	<!--cabeçalho-->
	<header>
		<a href="index.php" class="opcoes-desk"><div>Página inicial</div></a>
		<h1>Frete-Fetch</h1>
		<a href="cadastro.php" class="opcoes-desk"><div>Cadastre-se!</div></a>
		<a href="index.php" class="opcoes-mob"><div>Página inicial</div></a>
		<a href="cadastro.php" class="opcoes-mob"><div>Cadastre-se!</div></a>
	</header>
	<!--fim cabeçalho-->