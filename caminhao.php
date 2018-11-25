<?php
	@session_start();
	if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['fl_tipo']=="E"){
		header("Location: login.php");
	}
	include "includes/functions.php";
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

		</nav>
	</header>
	<div class="container">
		<?php
			include "includes/menu_sticky.php";
		?>
		<div id = "fretes_list">
			<?php
				$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
				$sql="select * from caminhao join caminhoneiro on cpf = motorista join tpcaminhao on sig = tipo where cpf = ".$_SESSION['usuario']['dados']['cpf'];
				$rs = $con->prepare($sql);
				$rs->execute();
				if(!$rs->rowCount()){
					echo "<a class='linke' href='cadastro_caminhao.php'><div class='editar-frete'>Cadastrar meu caminhão</div></a>";
				}
				while($row = $rs->fetch(PDO::FETCH_OBJ)){
			?>
			<div class="frete">
				<?php
				echo "<a class='linke' href='cadastros/del_caminhao.php?placa=$row->placa'><span class='cancelar-frete'><strong>X</strong></span></a>";
				?>
				<div class="info-wrapper">
					<p>Placa: <?=$row->placa;?></p>
					<p>Apelido: <?=$row->apelido;?></p>
					<p>Tipo: <?=$row->descr;?></p>
				</div>
				<div class="info-wrapper2">

				</div>
				<?php
				echo "<a class='linke' href='cadastro_caminhao.php?placa=" . $row->placa  . "'><div class='editar-frete'>Editar informações</div></a>";
				?>
			</div>
			<?php
				}
				?>
		</div>
	</div>
<?php
	include "includes/footer.php";
?>
