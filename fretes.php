<?php
	@session_start();
	include "includes/header_fretes.php";
	if(!isset($_SESSION['usuario'])){
		header("Location: login.php");
	}
	include "includes/functions.php";
?>	
	<div class="container">
		<?php  
			include "includes/menu_sticky.php";
		?>
		<div id = "fretes_list">
			<?php
				$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
				if($_SESSION['usuario']['fl_tipo']=="E"){
					$cond="contratante = " . $_SESSION['usuario']['dados']['cnpj'];
				}else{
					//verifica se o motorista tem um frete em andamento
					$rs = $con->prepare("select * from frete where ent_dthr is null and motorista = ?");
					$rs->bindParam(1, $_SESSION['usuario']['dados']['cpf']);
					if ($rs->execute()) {					
						if($rs->rowCount()){
							//se sim, ele só pode visualizá-lo
							$cond="f.motorista = '" . $_SESSION['usuario']['dados']['cpf'] . "' limit 1";
							echo "<h2 class='titulo-section' style='width: 100%;'>Frete em andamento</h2>";
						}else{
							//senão, ele só pode visualizar os disponíveis
							$cond="motorista is null";
							echo "<h2 class='titulo-section' style='width: 100%;'>Lista de fretes</h2>";
						}
					}					
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
					    c.nome as nomec,
					    cpf,
					    f.valor
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
					where 
						f.ent_dthr is null 
						and " . $cond;
				$rs = $con->prepare($sql);
				$rs->execute();
				while($row = $rs->fetch(PDO::FETCH_OBJ)){
			?>
			<div class="frete">
				<?php 
				if($_SESSION['usuario']['fl_tipo']=="E" && $row->nomec == null)
				 echo "<a class='linke' href='cadastros/del_frete.php?ciot=$row->ciot'><span class='cancelar-frete'><strong>X</strong></span></a>";
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
					<p>Tipo de carga: <?=$row->descr;?></p>
					<p>Informações adicionais: <?=$row->obs;?>.</p>
				</div>
				<div class="info-wrapper2">
					<p>Peso:   <?=formata("KGS",$row->peso);?></p>
					<p>Volume: <?=formata("M³",$row->volume);?></p>
					<p>Valor:  <?=formata("R$",$row->valor);?></p>
					<p>Caminhão: <?=$row->tpc;?></p>
				</div>
				<?php
				if($_SESSION['usuario']['fl_tipo']=="E") { 
					if ($row->nomec == null) {
						echo "<div class='status-frete-pendente'>Entrega pendente</div>";
						echo "<a class='linke' href='cadastro_frete.php?ciot=" . $row->ciot  . "'><div class='editar-frete'>Editar informações</div></a>";
					}else
						echo "<a class='linke' href='cadastros/finalizar_frete.php?ciot=".$row->ciot."'><div id='andamento$row->ciot' class='status-frete-andamento' onmouseenter='finalizarFrete($row->ciot)' onmouseleave='finalizarFrete($row->ciot)'>Entrega em andamento</div></a>";
				}else{
					if($row->cpf != $_SESSION['usuario']['dados']['cpf']){
						$cpf=$_SESSION['usuario']['dados']['cpf'];
				?>					
						<div class="status-frete-liberado" id="pegar<?=$row->ciot?>" onclick="pegarFrete(<?=$row->ciot?>, <?="'".$cpf."'"?>)" >Pegar frete</div>
				<?php
					}else{
						echo "<div class='status-frete-andamento'>Realizando entrega...</div>";
					}
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