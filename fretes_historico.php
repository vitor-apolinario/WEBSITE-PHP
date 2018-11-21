<?php
	@session_start();
	include "includes/header_cadastro_frete.php";
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
			<h2 class="titulo-section" style="width: 100%;">Histórico de serviços</h2>
			<?php
				$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
				if($_SESSION['usuario']['fl_tipo']=="E"){
					$cond="contratante = " . $_SESSION['usuario']['dados']['cnpj'];
				}else{
					$cond="f.motorista = " . $_SESSION['usuario']['dados']['cpf'];
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
					    f.valor,
					    f.ret_dthr,
					    f.ent_dthr
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
						f.ent_dthr is not null 
						and " . $cond;
				$rs = $con->prepare($sql);
				$rs->execute();
				while($row = $rs->fetch(PDO::FETCH_OBJ)){
			?>
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
					<p>Carregamento em: <?=$row->ret_dthr;?></p>
					<p>De: <?=$row->cid_retirada;?></p>
					<p>Até: <?=$row->cid_entrega;?></p>
					<p>Tipo de carga: <?=$row->descr;?></p>
					<p>Informações adicionais: <?=$row->obs;?>.</p>
				</div>
				<div class="info-wrapper2">
					<p>Entrega em:      <?=$row->ent_dthr;?></p>
					<p>Peso:   <?=formata("KGS",$row->peso);?></p>
					<p>Volume: <?=formata("M³",$row->volume);?></p>
					<p>Valor:  <?=formata("R$",$row->valor);?></p>
					<p>Caminhão: <?=$row->tpc;?></p>
				</div>
				<div class="status-frete-liberado">Frete concluído!</div>
			</div>
			<?php 
			} 
			?>
		</div>
	</div>
<?php 
	include "includes/footer.php";
?>