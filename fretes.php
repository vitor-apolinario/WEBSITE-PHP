<?php  
	@session_start();
	// AO FAZER LOGIN ARMAZENAR NA SESSION O TIPO DE USUÁRIO, 
	// E EXIBIR A LISTA DE FRETES DE ACORDO E TAMBÉM ADICIONAR
	// UMA OPCAO CASO SEJA EMPRESA, PARA ARRUMAR OS DADOS
?>
<?php  
	include "includes/header_fretes.php";
?>	
	<div class="container">
		<nav id = "nav_desktop">
			<p id="menu_title">MENU</p>
			<ul>
				<a href="cadastro_frete.php"><li>Cadastro de fretes</li></a>
				<a href="fretes.php"><li>Histórico de fretes</li></a>
				<a href="sair.php"><li>Sair</li></a>
			</ul>
		</nav>
		<div id = "fretes_list">
			<h2 class="titulo-section" style="width: 100%;">Lista de fretes</h2>
			<div class="frete">
				<div class="frete-imagem">
					<a href="#">
						<figure>
							<img src="imagens/wood.jpg" alt="miniatura1">
							<figcaption>Carga de madeira</figcaption>
						</figure>
					</a>
				</div>
				<div class="info-wrapper">
					<p>De: Chapecó - Santa Catarina</p>
					<p>Até: Concórdia- Santa Catarina</p>
					<p>Peso: 1400kg</p>
					<p>Volume: 10m³</p>
					<p>Distância estimada: 50km</p>
					<p>Ramo: Materiais de construção</p>
					<p>Solicitante: Madeireira catarinense</p>
				</div>
				<div class="info-wrapper2">
					<p>Informações adicionais: A madeira deve permanecer seca.</p>
				</div>
			</div>
	 		<div class="frete">
				<div class="frete-imagem">
					<a href="#">
						<figure>
							<img src="imagens/tijolo.jpg" alt="miniatura1">
							<figcaption>Carga de tijolos</figcaption>
						</figure>
					</a>
				</div>
				<div class="info-wrapper">
					<p>De: São Luís - Maranhão</p>
					<p>Até: Fortaleza - Ceará</p>
					<p>Peso: 3000kg</p>
					<p>Volume: 100m³</p>
					<p>Distância estimada: 1500km</p>
					<p>Ramo: Materiais de construção</p>
					<p>Solicitante: Olaria Maranhense</p>
				</div>
				<div class="info-wrapper2">
					<p>Informações adicionais: O local possui empilhadeira para descarga do material.</p>
				</div>
			</div> 
			<div class="frete">
				<div class="frete-imagem">
					<a href="#">
						<figure>
							<img src="imagens/carvao.jpg" alt="miniatura1">
							<figcaption>Carga de carvão</figcaption>
						</figure>
					</a>
				</div>
				<div class="info-wrapper">
					<p>De: Sinop - Mato Grosso</p>
					<p>Até: Goiânia - Goiás</p>
					<p>Peso: 5000kg</p>
					<p>Volume: 10m³</p>
					<p>Distância estimada: 175km</p>
					<p>Ramo: Minerais Minerais Minerais Minerais Minerais Minerais Minerais Minerais Minerais</p>
					<p>Solicitante: Mineiradora matogrossense</p>
				</div>
				<div class="info-wrapper2">
					<p>Informações adicionais: blablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla</p>
				</div>
			</div>
			
			<div class="frete">
				<div class="frete-imagem">
					<a href="#">
						<figure>
							<img src="imagens/refri.jpg" alt="miniatura1">
							<figcaption>Carga de refrigerante</figcaption>
						</figure>
					</a>
				</div>
				<div class="info-wrapper">
					<p>De: São Paulo - São Paulo</p>
					<p>Até: Curitiba - Paraná</p>
					<p>Peso: 12000kg</p>
					<p>Volume: 70m³</p>
					<p>Distância estimada: 750km</p>
					<p>Ramo: Indústria alimentícia</p>
					<p>Solicitante: Grupo Coca-Cola Brasil</p>
				</div>
				<div class="info-wrapper2">
					<p>Informações adicionais: blablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla</p>
				</div>
			</div>
		</div>
	</div>
<?php 
	include "includes/footer.php";
?>