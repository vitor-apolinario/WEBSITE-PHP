<?php 
	include "includes/header_login.php";
?>
<div class="container">
	<h1 style="text-align: center;">Login</h1>
	<form action="logar.php" method="post" id="form-login">
	    <div class="form-item">
	      <div>
		      <label for="email" class="label-alinhado">E-mail:</label>
		      <input type="email" id="email" name="email" maxlength="50" size="30">
		      <br><span class="msg-erro label-alinhado" id="msg-email"></span>
	      </div>
	    </div>					    			    
	    <div class="form-item">
	    	<div>
		      <label for="senha" class="label-alinhado">Senha:</label>
		      <input type="password" id="senha" name="senha" size="30">
		      <br><span class="msg-erro label-alinhado" id="msg-senha"></span>
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

