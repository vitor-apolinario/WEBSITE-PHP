<?php
	@session_start();
	if(isset($_SESSION['usuario'])){
		header("Location: index.php");
	}
	if(isset($_POST['cadastrar'])){


		$fl_usuario= trim($_POST['fl_tipo']);
		$nome=       trim($_POST['nome']);
		$email=      trim($_POST['email']);
		$cid=		 trim($_POST['cid']);
		$telefone=   trim($_POST['telefone']);
		$endereco=   trim($_POST['endereco']);
		$senha1=     trim($_POST['senha']);
		$senha2=     trim($_POST['senha2']);
		$concordo=   isset($_POST['concordo']) ? 1 : 0;

		$erros=array();
		if(isset($_POST['cpf'])){
			$cpf = $_POST['cpf'];
			if(strlen($cpf) != 11){
				$erros[] = "Digite um CPF valido";
			}
		}


		if(isset($_POST['cnpj'])){
			$cnpj = $_POST['cnpj'];
			if(strlen($cnpj) != 14){
				$erros[] = "Digite um CNPJ valido";
			}
		}
		if (empty($nome) || !strstr($nome," "))
			$erros[] = "Digite seu nome completo";

		if(empty($email) || !(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)))
	           $erros[] = "Digite um email válido";
		if(empty($cid))
			$erros[] = "Selecione uma cidade";
		if(empty($telefone))
			$erros[] = "Digite um telefone";
		if(empty($endereco))
	     	$erros[] = "Digite um endereço";
		if(strlen($senha1) < 6)
			$erros[] = "A senha deve ter no mínimo 6 caracteres";
		else{
			if($senha1 != $senha2)
				$erros[] = "As senhas não conferem";
		}
		if(!($concordo))
			$erros[] = "Você deve concordar com os termos do site";

		$sql_valida="SELECT
						email
					FROM
						usuario u
					WHERE u.email='$email'";
		include_once "includes/conexao.php";
		$result=mysqli_fetch_array(mysqli_query($conexao, $sql_valida), MYSQLI_ASSOC);

		if(isset($result)){
			$erros[] = "Email já em uso";
		}

		if (count($erros) == 0) {
			include_once "includes/conexao.php";

			if ($fl_usuario=="c") {
				$categoria=$_POST['categoria'];
				$datanasc=$_POST['datanasc'];
				$arrayName[]=$categoria;
				$arrayName[]=$datanasc;
			}
			//--------------------------------------------------


			//------------valida email/senha NO BD----
			//-----------------------------------------

			//---------insert cam/emp------------------

			if ($_POST['fl_tipo']=="c"){
				$sql_camemp="INSERT INTO `caminhoneiro`(`cnh`, `nome`, `fone`, `cpf`, `email`, `dtnasc`, `ender`, `ender_cida`)
				VALUES ('$categoria', '$nome', '$telefone', $cpf, '$email','$datanasc', '$endereco', '$cid');";
				$type="C";
			}else{
				$sql_camemp="INSERT INTO `empresa`(`cnpj`, `nome`, `ender`, `fone`, `email`, `ender_cidad`)
				VALUES ($cnpj, '$nome', '$endereco', '$telefone', '$email', '$cid');";
				$type="E";
			}

			//-----------------------------------------

			$senha1=md5($senha1);
			//--------insert table usuario-------------
			$sql_usuario="INSERT INTO `usuario`(`email`, `senha`, `fl_tipo`)
			VALUES ('$email', '$senha1', '$type');";

			//-----------------------------------------

			mysqli_query($conexao, $sql_usuario);
			mysqli_query($conexao, $sql_camemp);
			header("Location: login.php");
			//header("Location: ../index.php");
			//---------------somente para debug-----------------
		}

	}
?>

<?php
	include "includes/header_cadastro.php"
?>
	<?php
		if(!isset($_GET['c'])){
			header("location: index.php");
		}
		if (!isset($_GET['ok'])){
	?>
	<div class="container">

		<h1 style="text-align: center;">Cadastre-se</h1>
		<?php
		// caso houver, exibe os erros
		if(isset($erros) and count($erros) > 0){
			echo "<ul>";
			foreach ($erros as $erro) {
				echo "<li style='color:red'>$erro</li>";
			}
			echo "</ul>";
		}
		?>
		<form action="" method="post" onsubmit="return validaCadastro()" id="form-cadastro">
		    <div class="form-item">
				<input type="hidden" id = "fl_tipo" name = "fl_tipo" value = "<?=$_GET['c']?>">
		      <div>
			      <label for="nome" class="label-alinhado">Nome:</label>
			      <input type="text" id="nome" name="nome" maxlength="50" value="<?=isset($nome) ? $nome : '';?>" placeholder="Nome completo">
		      	  <br><span class="msg-erro" id="msg-nome"></span>
		      </div>
			  <?php
			  	if($_GET['c'] == 'c'){
			  ?>
		      <div>
			      <label for="cpf" class="label-alinhado">CPF:</label>
			      <input type="text" id="cpf" name="cpf" maxlength="12" value="<?=isset($cpf) ? $cpf: '';?>" placeholder="xxxxxxxxxxx">
		      	  <br><span class="msg-erro" id="msg-cpf"></span>
		      </div>
		  	<?php } ?>
		    </div>
		    <div class="form-item">
		      <div>
			      <label for="email" class="label-alinhado">E-mail:</label>
			      <input type="email" id="email" name="email" value="<?=isset($email) ? $email : '';?>" placeholder="fulano@dominio" maxlength="50">
			      <br><span class="msg-erro" id="msg-email"></span>
			  </div>
			  <?php
			  	if($_GET['c'] == 'e'){
			  ?>
			  <div>
				<label for="cnpj" class="label-alinhado">CNPJ:</label>
				<input type="text" id="cnpj" name="cnpj" value="<?=isset($cnpj) ? $cnpj : '';?>" maxlength="14" placeholder="xxxxxxxxxxx">
				<br><span class="msg-erro" id="msg-cnpj"></span>
			  </div>
			  <?php } ?>
		    </div>

		    <div class="form-item">
		        <div>
			      <label for="telefone" class="label-alinhado">Telefone:</label>
			      <input type="text" id="telefone" name="telefone" value="<?=isset($telefone) ? $telefone : '';?>" placeholder="(xx) x xxxx-xxx" maxlength="50">
			      <br><span class="msg-erro" id="msg-tele"></span>
			    </div>
			    <div>
			      <label for="endereco" class="label-alinhado">Endereço:</label>
			      <input type="text" id="endereco" name="endereco" value="<?=isset($endereco) ? $endereco : '';?>" placeholder="Rua, número, complemento" maxlength="50">
			      <br><span class="msg-erro" id="msg-endereco"></span>
			  </div>
		    </div>
		    <div class="form-item">
		      <div>
			      <label for="senha" class="label-alinhado">Senha:</label>
			      <input type="password" id="senha" name="senha" placeholder="Mínimo 6 caracteres">
			      <br><span class="msg-erro" id="msg-senha"></span>
		      </div>
			  <div class="local">
			  <select onchange="carregaCidades(this.value, 'city-select')" id="uf-select">
				  <option value="">UF</option>
					  <?php
						  include "includes/conexao.php";
						  $sql="select sigla from estado";
						  $resultado=mysqli_query($conexao, $sql);
						  while($uf=mysqli_fetch_array($resultado))
							  echo "<option value='".$uf['sigla']."'>".$uf['sigla']."</option>";
					  ?>
			  </select>
			  <select id="city-select" name="cid">
				  <option value="">Cidade</option>
				  <option value="POA">Porto Alegre</option>
			  </select>
			  <br><span class="msg-erro" id="msg-cidade"></span>
			 </div>

		    </div>
		    <div class="form-item">
		      <div>
			      <label for="senha2" class="label-alinhado">Repita:</label>
			      <input type="password" id="senha2" name="senha2" placeholder="Mínimo 6 caracteres">
		      	  <br><span class="msg-erro" id="msg-senha2"></span>
		      </div>
			  <?php
			  	if($_GET['c'] == 'c'){
			  ?>
			  <div class="local" id = "local">
				<label>CNH:</label>
				<label><input type="radio" name="categoria" value="C" id="c1" checked>C</label>
				<label><input type="radio" name="categoria" value="D" id="c2">D</label>
				<label><input type="radio" name="categoria" value="E" id="c3">E</label>
			</div>
			<?php } ?>
		    </div>
			<div class="form-item">
				<?php
  			  	if($_GET['c'] == 'c'){
  			  	?>
				<div>
  			      <label for="datanasc" class="label-alinhado">Data:</label>
  			      <input type="date" id="datanasc" name="datanasc">
  		      <br><span class="msg-erro" id="msg-datanasc"></span>
  		      </div>
			  <?php } ?>
			</div>
		    <div class="form-item">

		    	<div>
			      <label><input type="checkbox" class="label-alinhado" id="concordo" name="concordo" <?=isset($_POST['concordo']) ? 'checked' : '';?>> Li e estou de acordo com os termos de uso do site</label>
			      <br><span class="msg-erro" id="msg-concordo"></span>
			    </div>
		    </div>
			<div class="form-buttons">
			   <input type="submit" id="botao" name = "cadastrar" value="Confirmar">
			   <input type="reset" id="botao-limpar" value="Limpar">
			</div>
		</form>
	</div>
	<?php
		}else{
	?>
		<p style="font-weight: bold; font-size: 1.5em;">Cadastro efetuado com sucesso!</p>
	<?php
		}
	?>

<?php
	include "includes/footer.php";
?>
