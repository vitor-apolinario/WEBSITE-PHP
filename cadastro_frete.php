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
				  and ent_dthr is null
				  and ciot = ?
				  and contratante = ?";
	//	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");
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
<?php
	if(isset($_POST['ciot'])){
		if
		(
			!isset($_POST['ret_cidad'])   || empty($_POST['ret_cidad'])  ||
			!isset($_POST['ret_local'])   || empty($_POST['ret_local'])  ||
			!isset($_POST['ent_cidad'])   || empty($_POST['ent_cidad'])  ||
			!isset($_POST['ent_local'])   || empty($_POST['ent_local'])  ||
			!isset($_POST['peso'])        || empty($_POST['peso'])       ||
			!isset($_POST['volume'])      || empty($_POST['volume'])     ||
			!isset($_POST['valor'])       || empty($_POST['valor'])      ||
			!isset($_POST['tipo'])        || empty($_POST['tipo'])       ||
			!isset($_POST['tipo_cami'])   || empty($_POST['tipo_cami'])  ||
			!isset($_POST['obs'])         || empty($_POST['obs'])        ||
			!isset($_POST['ret_dthr'])    || empty($_POST['ret_dthr'])   ||
			!isset($_POST['contratante']) || empty($_POST['contratante'])||
			!isset($_POST['ciot'])        || empty($_POST['ciot'])
		){
			echo "<p>Preencha todos os campos do formulário</p>";
			die();
		}

		$ret_cidad=   trim($_POST['ret_cidad']);
		$ret_local=   trim($_POST['ret_local']);
		$ent_cidad=   trim($_POST['ent_cidad']);
		$ent_local=   trim($_POST['ent_local']);
		$peso=        trim($_POST['peso']);
		$volume=      trim($_POST['volume']);
		$valor=       trim($_POST['valor']);
		$tipo=        $_POST['tipo'];
		$tipo_cami=   $_POST['tipo_cami'] /*== "NA" ? null : $_POST['tipo_cami']*/;
		$obs=         trim($_POST['obs']);
		$ret_dthr=    $_POST['ret_dthr'];
		$contratante= $_POST['contratante'];
		$ciot=        $_POST['ciot'];


		//$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");

		$stmt = $con->prepare("update frete set ret_cidad=?, ret_local=?, ent_cidad=?, ent_local=?, peso=?, volume=?, valor=?, tipo=?, tipo_cami=?, obs=?, ret_dthr=?, contratante=? where ciot=?");
		$stmt->bindParam(1 , $ret_cidad);
		$stmt->bindParam(2 , $ret_local);
		$stmt->bindParam(3 , $ent_cidad);
		$stmt->bindParam(4 , $ent_local);
		$stmt->bindParam(5 , $peso);
		$stmt->bindParam(6 , $volume);
		$stmt->bindParam(7 , $valor);
		$stmt->bindParam(8 , $tipo);
		$stmt->bindParam(9 , $tipo_cami);
		$stmt->bindParam(10, $obs);
		$stmt->bindParam(11, $ret_dthr);
		$stmt->bindParam(12, $contratante);
		$stmt->bindParam(13, $ciot);
		if ($stmt->execute()) {
			header("Location: fretes.php");
		}else
			echo "ocorreu um erro ao inserir";
	}else if(isset($_POST['cadastrar'])){
		if
		(
			!isset($_POST['ret_cidad'])   || empty($_POST['ret_cidad'])  ||
			!isset($_POST['ret_local'])   || empty($_POST['ret_local'])  ||
			!isset($_POST['ent_cidad'])   || empty($_POST['ent_cidad'])  ||
			!isset($_POST['ent_local'])   || empty($_POST['ent_local'])  ||
			!isset($_POST['peso'])        || empty($_POST['peso'])       ||
			!isset($_POST['volume'])      || empty($_POST['volume'])     ||
			!isset($_POST['valor'])       || empty($_POST['valor'])      ||
			!isset($_POST['tipo'])        || empty($_POST['tipo'])       ||
			!isset($_POST['tipo_cami'])   || empty($_POST['tipo_cami'])  ||
			!isset($_POST['obs'])         || empty($_POST['obs'])        ||
			!isset($_POST['ret_dthr'])    || empty($_POST['ret_dthr'])   ||
			!isset($_POST['contratante']) || empty($_POST['contratante'])
		){
			echo "<p>Preencha todos os campos do formulário</p>";
			die();
		}

		$ret_cidad=   trim($_POST['ret_cidad']);
		$ret_local=   trim($_POST['ret_local']);
		$ent_cidad=   trim($_POST['ent_cidad']);
		$ent_local=   trim($_POST['ent_local']);
		$peso=        trim($_POST['peso']);
		$volume=      trim($_POST['volume']);
		$valor=       trim($_POST['valor']);
		$tipo=        $_POST['tipo'];
		$tipo_cami=   $_POST['tipo_cami'] /*== "NA" ? null : $_POST['tipo_cami']*/;
		$obs=         trim($_POST['obs']);
		$ret_dthr=    $_POST['ret_dthr'];
		$contratante= $_POST['contratante'];


		// exemplo de select usando PDO
		// $con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		// $rs = $con->query("select sigla, descr from tpcarga");
		// while($row = $rs->fetch(PDO::FETCH_OBJ)){
	 	// 	echo $row->sigla . " - ";
	 	// 	echo $row->descr . "<br/><hr/>";
		// }

	//	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");

		$stmt = $con->prepare("INSERT INTO frete (ret_cidad, ret_local, ent_cidad, ent_local, peso, volume, valor, tipo, tipo_cami, obs, ret_dthr, contratante) values (?,?,?,?,?,?,?,?,?,?,?,?)");
		$stmt->bindParam(1 , $ret_cidad);
		$stmt->bindParam(2 , $ret_local);
		$stmt->bindParam(3 , $ent_cidad);
		$stmt->bindParam(4 , $ent_local);
		$stmt->bindParam(5 , $peso);
		$stmt->bindParam(6 , $volume);
		$stmt->bindParam(7 , $valor);
		$stmt->bindParam(8 , $tipo);
		$stmt->bindParam(9 , $tipo_cami);
		$stmt->bindParam(10, $obs);
		$stmt->bindParam(11, $ret_dthr);
		$stmt->bindParam(12, $contratante);

		if($stmt->execute() === false){
		    echo "<pre>";
		    print_r($stmt->errorInfo());
		    echo "</pre>";
		}else{
			header("Location: fretes.php");
		}
	}
?>

<div class="container">
	<h1 style="text-align: center;"><?=$titulo;?></h1>
	<form action="" method="post" id="form-frete">
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
			   <input type="submit" id="botao" value="Confirmar" name="cadastrar">
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
