<nav id = "nav_desktop">
	<p id="menu_title">MENU</p>
	<ul>
		<a href="index.php"><li>Home</li></a>
		<a href="fretes.php"><li>Minha lista</li></a>
		<?php  
		if ($_SESSION['usuario']['fl_tipo']=="E") {
		?>	
		<a href="cadastro_frete.php"><li>Cadastro de fretes</li></a>
		<a href="fretes_historico.php"><li>Fretes concluídos</li></a>
		<?php  
		}else{
		?>
		<a href="fretes_historico.php"><li>Serviços prestados</li></a>
		<a href="caminhoes.php"><li>Meus caminhões</li></a>
		<?php 
		} 
		?>
		<a href="relatorios.php"><li>Gráfico</li></a>
		<a href="sair.php"><li>Sair</li></a>
	</ul>
</nav>