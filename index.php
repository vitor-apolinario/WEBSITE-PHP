<?php  
	@session_start();
	// AO FAZER LOGIN ARMAZENAR NA SESSION O TIPO DE USUÁRIO, 
	// E EXIBIR A LISTA DE FRETES DE ACORDO E TAMBÉM ADICIONAR
	// UMA OPCAO CASO SEJA EMPRESA, PARA ARRUMAR OS DADOS
?>
<?php 
	include "includes/header_index.php"
?>

<div class="container">
<section class="c2" id="start">
	<div class="top-wrap">
		<img src="imagens/png/020-solution.png" class="ico-left" alt="icone representando uma solução.">
		<h2 class="titulo-section">Junte se a nós!</h2>
	</div>
	<div id= "opcoes_cadastro">
		<a href="cadastro.php"><div class="sou">
			<p class="sou-title">SOU CAMINHONEIRO</p>
			<p class="sou-desc">Encontre fretes de maneira fácil e ágil</p>
		</div></a>
		<a href="cadastro.php"><div class="sou">
			<p class="sou-title">SOU EMPRESA</p>
			<p class="sou-desc">Anuncie e gerencie suas cargas</p>
		</div></a>
	</div>
</section>

<section class="c3" id="como-funciona">
	<div class="top-wrap">
		<h2 class="titulo-section">Como funciona?</h2>
		<img src="imagens/png/012-location.png" alt="imagem representando uma localização." class="ico-right">
	</div>
	<div class="func">
		<h3>Para motoristas</h3>
		<p>&emsp;Crie sua conta, cadastre seus caminhões e pé na estrada! Você terá uma lista de fretes à nível  nacional ao seu dispor, com histórico de viagens e estatísticas sobre seus serviços.</p>
	</div>
	<div class="func">
		<h3>Para empresas</h3>
		<p>&emsp;Crie sua conta e solicite seus serviços, confiados à profissionais capacitados. Agilize seus processos de lógística e melhore o fluxo do seu negócio.</p>
	</div>
</section>

<section class="c4" id="sobre-nos">
	<div class="top-wrap">
		<img src="imagens/png/023-teamwork.png" alt="imagem representando trabalho em equipe." class="ico-left">
		<h2 class="titulo-section">Sobre nós</h2>
	</div>
	<div class="container-historia">
		<p>&emsp;A Frete-Fetch é uma xxx que surgiu em 2018 na cidade de Chapecó - SC com a ideia de usar a tecnologia para resolver problemas do cotidiano. O nosso primeiro software é voltado para a área da logística de forma à ajudar os envolvidos neste processo, fornecendo melhor qualidade e diversidade nos serviços de frete, de forma transparente e valorizando a concorrência. A plataforma permite ao motorista e as empresas realizar acordos sem intermediários permitindo ao cliente um preço justo e sem altas taxas, e ao autônomo uma melhor facilidade de gerenciar seus serviços, além da liberdade para selecionar seus trabalhos sem depender uma transportadora.</p>
	</div>
</section>
</div>

<?php 
	include "includes/footer.php";
?>