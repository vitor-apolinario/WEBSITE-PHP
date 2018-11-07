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
<?php  
	$link="login.php";
	$msg="Área de login";
	if(isset($_SESSION['usuario'])){
		$link="fretes.php";
		$msg="Minha página";
	}
?>
<!DOCTYPE.php>
<html lang="pt-br">
	<head>
		<title>Frete-Fetch</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/styles.css">
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
		<nav>
			<div class="menu-opcoes">
				<div><a href="#start">Comece já!</a></div>
				<div><a href="#como-funciona">Como funciona?</a></div>
				<div><a href="#sobre-nos">Sobre nós</a></div>
				<div><a href="<?=$link?>"><?=$msg?></a></div>
			</div>
		</nav>
	</header>
	<!--fim cabeçalho-->