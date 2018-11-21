<?php
	@session_start();
	include "includes/header_cadastro_frete.php";
	/*echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";*/
	if(!isset($_SESSION['usuario'])){
		header("Location: login.php");
	}
?>
<?php
	$form_action="cadastros/cad_frete.php";
	if (isset($_GET['ciot'])){
		$titulo="Alterar frete";
		$form_action="cadastros/alt_frete.php";
		$sql="select
				f.*,
				cretirada.sigla  as sigcr,
				cretirada.estado as siger,
				centrega.sigla   as sigce,
				centrega.estado  as sigee
			from frete f
			join cidade cretirada on
				cretirada.sigla=f.ret_cidad
			join cidade centrega on
			    centrega.sigla=f.ent_cidad
			where motorista is null
				  and ret_dthr is null
				  and ent_dthr is null
				  and ciot = ?
				  and contratante = ?";
		$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$rs = $con->prepare($sql);
		$rs->bindParam(1, $_GET['ciot']);
		$rs->bindParam(2, $_SESSION['usuario']['dados']['cnpj']);
		$rs->execute();
		if($rs->rowCount()==0)
			header("Location: fretes.php");
		$row = $rs->fetch(PDO::FETCH_OBJ);
	}else{
		$titulo="Solicitar serviço";
	}
?>

<div class="container">
	<h1 style="text-align: center;"><?=$titulo;?></h1>
	<form action="<?=$form_action?>" method="post" id="form-frete">
	    <div class="local-item">
	    	<h4>Local de retirada</h4>
	    	<div>
	    		<label for="uf" class="label-alinhado">UF:</label>
		    	<select onchange="carregaCidades(this.value, 'ret_cidad')" id="uf" name="uf" required>
					<option value="">Selecione...</option>
					<?php
						include "includes/conexao.php";
						$sql = "select nome, sigla from estado order by 1";
						$estados = mysqli_query($conexao, $sql);
						while ($estado = mysqli_fetch_array($estados)) {
							$s = (isset($row->sigcr) && ($row->siger==$estado['sigla'])) ? 'selected' : '';
							echo "<option value='".$estado['sigla']."' $s>".$estado['nome']."</option>";
					}?>
		    	</select>
		    	<br><span class="msg-erro label-alinhado" id="msg-uf-inicial"></span>
	    	</div>
		    <div>
		    	<label for="ret_cidad" class="label-alinhado">Cidade:</label>
		    	<select id="ret_cidad" name="ret_cidad" required>
		    		<option value="">Selecione...</option>
		    	</select>
		    	<br><span class="msg-erro label-alinhado" id="msg-ret-cidad"></span>
	    	</div>
	    	<div>
		    	<label for="ret_local" class="label-alinhado">Local:</label>
		    	<input type="text" id="ret-local" name="ret_local" maxlength="50" <?=isset($row->ret_local) ? "value='$row->ret_local'" : "" ?>>
		    	<br><span class="msg-erro label-alinhado" id="msg-ret-local"></span>
	    	</div>
	    </div>

			<div class="local-item">
			<h4>Local de entrega</h4>
	    	<div>
	    		<label for="uf-dest" class="label-alinhado">UF:</label>
		    	<select onchange="carregaCidades(this.value, 'ent_cidad')" id="uf-dest"  name="uf-dest"  required>
		    		<option value="">Selecione...</option>
					<?php
						$sql = "select nome, sigla from estado order by 1";
						$estados = mysqli_query($conexao, $sql);
						while ($estado = mysqli_fetch_array($estados)) {
							$s = (isset($row->sigce) && ($row->sigee==$estado['sigla'])) ? 'selected' : '';
							echo "<option value='".$estado['sigla']."' $s>".$estado['nome']."</option>";
					}?>
		    	</select>
		    	<br><span class="msg-erro label-alinhado" id="msg-uf-final"></span>
	    	</div>
		    <div>
		    	<label for="ent_cidad" class="label-alinhado">Cidade:</label>
		    	<select id="ent_cidad"  name="ent_cidad" required>
		    		<option value="">Selecione...</option>
		    	</select>
		    	<br><span class="msg-erro label-alinhado" id="msg-ent-cidade"></span>
	    	</div>
	    	<div>
	    		<label for="ent_local" class="label-alinhado">Local:</label>
	    		<input type="text" name="ent_local" maxlength="50" id="ent_local" <?=isset($row->ent_local) ? "value='$row->ent_local'" : "" ?>>
	    		<br><span class="msg-erro label-alinhado" id="msg-ent-local"></span>
	    	</div>
	    </div>

	    <div class="local-item">
	    	<div>
		    	<label for="peso" class="label-alinhado">Peso:</label>
		    	<input type="number" id="peso" name="peso" min="1" required <?=isset($row->peso) ? "value='$row->peso'" : "1" ?>>
		    	<br><span class="msg-erro label-alinhado" id="msg-peso"></span>
			</div>
		    <div>
		    	<label for="volume" class="label-alinhado">Volume:</label>
		    	<input type="number" id="volume" name="volume" min="1" required <?=isset($row->volume) ? "value='$row->volume'" : "1" ?>>
		    	<br><span class="msg-erro label-alinhado" id="msg-volume"></span>
			</div>
			<div>
		    	<label for="valor" class="label-alinhado">Valor:</label>
		    	<input type="number" id="valor" name="valor"  min="1" required <?=isset($row->valor) ? "value='$row->valor'" : "1" ?>>
		    	<br><span class="msg-erro label-alinhado" id="msg-valor"></span>
			</div>
	    </div>

	    <div class="form-item">
	    	<div>
	    		<label for="tipo" class="label-alinhado">Tipo de carga:</label>
		    	<select id="tipo" name="tipo" required>
		    		<option value="">Selecione...</option>
		    		<?php
		    			include_once "includes/conexao.php";
		    			$r=mysqli_query($conexao, "select sigla, descr from tpcarga;");
		    			while ($tp = mysqli_fetch_array($r)) {
		    				$tpc = (isset($row->tipo) && ($row->tipo==$tp['sigla'])) ? 'selected' : '';
		    				echo "<option value='".$tp['sigla']."' $tpc>".$tp['descr']."</option>";
		    			}
		    		?>
		    	</select>
		    	<br><span class="msg-erro label-alinhado" id="msg-slct-tipo"></span>
	    	</div>
	    	<div>
	    		<label for="tipo_cami" class="label-alinhado">Tipo de caminhão:</label>
		    	<select id="tipo_cami" name="tipo_cami" required>
		    		<option value="">Selecione...</option>
		    		<?php
		    			include_once "includes/conexao.php";
		    			$s=mysqli_query($conexao, "select sig, descr from tpcaminhao;");
		    			while ($tp = mysqli_fetch_array($s)) {
		    				$c = (isset($row->tipo_cami) && ($row->tipo_cami==$tp['sig'])) ? 'selected' : '';
		    				echo "<option value='".$tp['sig']."' $c>".$tp['descr']."</option>";
		    			}
		    		?>
		    	</select>
		    	<br><span class="msg-erro label-alinhado" id="msg-tipo-cami"></span>
	    	</div>
	    </div>

	    <div class="form-item">
	    	<div>
		    	<label for="obs" class="label-alinhado">Informações adicionais:</label>
		    	<textarea cols="30" rows="5" id="obs" name="obs">
		    		<?= isset($row->obs) ? $row->obs  : ""  ?>
		    	</textarea>
		    	<br><span class="msg-erro label-alinhado" id="msg-obs"></span>
	    	</div>
<!-- 		    <div>
	    		<label for="imagens">Envie imagens:</label>
	    		<input type="file" name="imagens" id="imagens">
	    		<br><span class="msg-erro label-alinhado" id="msg-img"></span>
	    	</div> -->
	    	<div>
	    		<label for="ret_dthr">Horário de retirada:</label>
	    		<?php
	    			if(isset($row->ret_dthr)){
		    			$date = new DateTime($row->ret_dthr);
		    			$dataInput = $date->format('Y-m-d\TH:i:s');
	    			}else
	    				$dataInput = "";
	    		?>
	    		<input type="datetime-local" id="ret_dthr" name="ret_dthr" value="<?=$dataInput?>">
	    	</div>
	    </div>
	    <div class="form-buttons">
			   <input type="submit" id="botao" value="Confirmar">
			   <input type="reset" id="botao-limpar" value="Limpar">
		</div>
		<input type="hidden" name="contratante" value="<?=$_SESSION['usuario']['dados']['cnpj']?>">
		<?php
		if(isset($_GET['ciot']))
			echo "<input type='hidden' name ='ciot' value='".$_GET['ciot']."'>";
		?>
	</form>
</div>

<?php
	include "includes/footer.php";
?>
