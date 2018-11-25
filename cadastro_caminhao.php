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
	if (isset($_GET['placa'])){
		$sql="select * from caminhao where placa = ? and motorista = ?";
	//	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");
		$rs = $con->prepare($sql);
		$rs->bindParam(1, $_GET['placa']);
		$rs->bindParam(2, $_SESSION['usuario']['dados']['cpf']);
		$rs->execute();
		if($rs->rowCount()==0)
			header("Location: fretes.php");
		$row = $rs->fetch(PDO::FETCH_OBJ);
	}
?>
<?php
	if(isset($_POST['ok'])){


		$tipo=   trim($_POST['tipo']);
		$apelido=   trim($_POST['apelido']);
		$placa=   trim($_GET['placa']);




	//	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");
		$stmt = $con->prepare("update caminhao set tipo=?, apelido=? where placa=?");
		$stmt->bindParam(1 , $tipo);
		$stmt->bindParam(2 , $apelido);
		$stmt->bindParam(3 , $placa);

		if ($stmt->execute()) {
			header("Location: fretes.php");
		}else
			echo "ocorreu um erro ao inserir";
	}else if(isset($_POST['cadastrar'])){


		$placa=   trim($_POST['placa']);
		$tipo=   trim($_POST['tipo']);
		$apelido=   trim($_POST['apelido']);
		$motorista=   trim($_SESSION['usuario']['dados']['cpf']);



		// exemplo de select usando PDO
		// $con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		// $rs = $con->query("select sigla, descr from tpcarga");
		// while($row = $rs->fetch(PDO::FETCH_OBJ)){
	 	// 	echo $row->sigla . " - ";
	 	// 	echo $row->descr . "<br/><hr/>";
		// }

	//	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");
		$stmt = $con->prepare("INSERT INTO caminhao (placa, apelido, tipo, motorista) values (?,?,?,?)");
		$stmt->bindParam(1 , $placa);
		$stmt->bindParam(2 , $apelido);
		$stmt->bindParam(3 , $tipo);
		$stmt->bindParam(4 , $motorista);

		if($stmt->execute() === false){
		    echo "<pre>";
		    print_r($stmt->errorInfo());
		    echo "</pre>";
		}else{
			header("Location: caminhao.php");
		}
	}
?>

<div class="container">
	<h1 style="text-align: center;">Meu Caminhão</h1>
	<form action="" method="post" id="form-frete">
			<div class="form-item">
				<div>
	    		<label for="ent_local" class="label-alinhado">Placa:</label>
	    		<input type="text" name="placa" maxlength="50" id="placa" <?=isset($row->placa) ? "value='$row->placa' disabled" : "" ?>>
	    		<br><span class="msg-erro label-alinhado" id="msg-placa"></span>
	    	</div>
				<div>
	    		<label for="ent_local" class="label-alinhado">Apelido:</label>
	    		<input type="text" name="apelido" maxlength="50" id="apelido" <?=isset($row->apelido) ? "value='$row->apelido'" : "" ?>>
	    		<br><span class="msg-erro label-alinhado" id="msg-apelido"></span>
	    	</div>
			</div>
	    <div class="form-item">
	    	<div>
	    		<label for="tipo" class="label-alinhado">Tipo de caminhão:</label>
		    	<select id="tipo" name="tipo" required>
		    		<option value="">Selecione...</option>
		    		<?php
		    			include_once "includes/conexao.php";
		    			$s=mysqli_query($conexao, "select sig, descr from tpcaminhao;");
		    			while ($tp = mysqli_fetch_array($s)) {
		    				$c = (isset($row->tipo) && ($row->tipo==$tp['sig'])) ? 'selected' : '';
		    				echo "<option value='".$tp['sig']."' $c>".$tp['descr']."</option>";
		    			}
		    		?>
		    	</select>
		    	<br><span class="msg-erro label-alinhado" id="msg-tipo-cami"></span>
	    	</div>
	    </div>


	    <div class="form-buttons">
				<?php
						if(isset($_GET['placa'])){
							echo "<input type = 'hidden' name = 'ok' value = 'ok'>";
						}
				 ?>
			   <input type="submit" id="botao" value="Confirmar" name="cadastrar">
			   <input type="reset" id="botao-limpar" value="Limpar">
		</div>
	</form>
</div>

<?php
	include "includes/footer.php";
?>
