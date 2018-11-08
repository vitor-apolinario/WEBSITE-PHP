<?php 
	include "includes/header_login.php";
	$mensagem = isset($_GET['erro']) ? "Usuário e ou senha incorretos" : "";
	$email = isset($_GET['email']) ? $_GET['email'] : "";
?>
<div class="container">
	<h1 style="text-align: center;">Login</h1>
	<form action="logar.php" method="post" id="form-login">
	    <div class="form-item">
	      <div>
		      <label for="email" class="label-alinhado">E-mail:</label>
		      <input type="email" id="email" name="email" maxlength="50" size="30" value="<?=$email?>">
	      </div>
	    </div>					    			    
	    <div class="form-item">
	    	<div>
		      <label for="senha" class="label-alinhado">Senha:</label>
		      <input type="password" id="senha" name="senha" size="30">
		      <span class="msg-erro" style="padding: 5px 0px 0px 50px"><?=$mensagem?></span>
	    	</div>
	    </div>			    
		<div class="form-buttons">
		   <input type="submit" id="botao" value="Confirmar">
		</div>
	</form>
</div>
<?php 
	include "includes/footer.php";
?>

