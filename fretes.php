<?php  
	include "includes/header_fretes.php";
?>	
	<div class="container">
		<nav id = "nav_desktop">
			<p id="menu_title">MENU</p>
			<ul>
				<a href="index.php"><li>Home</li></a>
				<?php  
				if ($_SESSION['usuario']['fl_tipo']=="E") {
				?>
				<a href="cadastro_frete.php"><li>Cadastro de fretes</li></a>
				<?php  
				}else{
				?>
				<a href="caminhoes.php"><li>Meus caminhões</li></a>
				<?php 
				} 
				?>
				<a href="fretes.php"><li>Histórico de fretes</li></a>
				<a href="sair.php"><li>Sair</li></a>
			</ul>
		</nav>
		<div id = "fretes_list">
			<h2 class="titulo-section" style="width: 100%;">Lista de fretes</h2>
			<?php
				if($_SESSION['usuario']['fl_tipo']=="E"){
					$cond="contratante = " . $_SESSION['usuario']['dados']['cnpj'];
				}else{
					$cond="motorista is null";
				}
				$sql="select
						f.ciot,
					    concat(cretirada.nome, ' - ', estador.nome) as cid_retirada,
					    concat(centrega.nome,  ' - ', estadoe.nome) as cid_entrega,
					    f.peso,
					    f.volume,
					    tpcarga.descr,
					    COALESCE(tpc.descr, 'Não especificado') as tpc,
					    e.nome,
					    f.obs,
					    c.nome
					from frete f 
					left join tpcaminhao tpc on 
					    tpc.sig=f.tipo_cami
					join empresa e on
					    e.cnpj=f.contratante
					join cidade cretirada on
					    cretirada.sigla=f.ret_cidad
					join estado estador on
					    estador.sigla=cretirada.estado
					join cidade centrega on
					    centrega.sigla=f.ent_cidad
					join estado estadoe on
					    estadoe.sigla=centrega.estado
					join tpcarga on
					    tpcarga.sigla=f.tipo
					left join caminhoneiro c on
						c.cpf=f.motorista
					where f.ent_dthr is null and " . $cond;			
				$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
				$rs = $con->prepare($sql);
				$rs->execute();
				while($row = $rs->fetch(PDO::FETCH_OBJ)){
			?>
			<div class="frete">
				<?php 
				if($_SESSION['usuario']['fl_tipo']=="E" && $row->nome == null)
				 echo "<a href='cadastros/del_frete.php?ciot=$row->ciot'><span class='cancelar-frete'><strong>X</strong></span></a>";
				?>
				<div class="frete-imagem">
					<a href="#">
						<figure>
							<img src="imagens/wood.jpg" alt="miniatura1">
							<figcaption>Carga de madeira</figcaption>
						</figure>
					</a>
				</div>
				<div class="info-wrapper">
					<p>De: <?=$row->cid_retirada;?></p>
					<p>Até: <?=$row->cid_entrega;?></p>
					<p>Peso: <?=$row->peso;?>kgs</p>
					<p>Volume: <?=$row->volume;?>m³</p>
					<p>Caminhão: <?=$row->tpc;?></p>
					<p>Tipo de carga: <?=$row->descr;?></p>
				</div>
				<div class="info-wrapper2">
					<p>Informações adicionais: <?=$row->obs;?>.</p>
				</div>
				<?php
				if($_SESSION['usuario']['fl_tipo']=="E") { 
					if ($row->nome == null) {
						echo "<div class='status-frete-pendente'>Entrega pendente</div>";
						echo "<a class='linke' href='cadastro_frete.php?ciot=" . $row->ciot  . "'><div class='editar-frete'>Editar informações</div></a>";
					}else
						echo "<div class='status-frete-andamento'>Entrega em andamento</div>";
				}else{
					echo "<div class='status-frete-liberado'>Pegar frete</div>";
				}
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