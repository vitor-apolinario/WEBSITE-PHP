<?php  
	@session_start();
	// AO FAZER LOGIN ARMAZENAR NA SESSION O TIPO DE USUÁRIO, 
	// E EXIBIR A LISTA DE FRETES DE ACORDO E TAMBÉM ADICIONAR
	// UMA OPCAO CASO SEJA EMPRESA, PARA ARRUMAR OS DADOS
?>
<!DOCTYPE.php>
<html lang="pt-br">
	<head>
		<title>Cadastro Frete-Fretch</title>
		<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<!-- <link rel="stylesheet" href="css/cadastro.css"> -->
		<link rel="stylesheet" href="css/cadastro_frete.css">
	</head>

<body>
	<!--cabeçalho-->
	<header>
		<a href="index.php" class="opcoes-desk"><div>Página inicial</div></a>
		<h1>Frete-Fetch</h1>
		<a href="login.php" class="opcoes-desk"><div>Faça seu login!</div></a>
		<a href="index.php" class="opcoes-mob"><div>Página inicial</div></a>
		<a href="login.php" class="opcoes-mob"><div>Faça seu login!</div></a>
	</header>
	<!--fim cabeçalho-->

	<div class="container">
		<h1 style="text-align: center;">Cadastre-se</h1>
		<form action="cadastros/cad_usuario.php" method="post" id="form-cadastro">
		    <div class="form-item">
		      <div>
			      <label for="nome" class="label-alinhado">Nome:</label>
			      <input type="text" id="nome" name="nome" maxlength="50" placeholder="Nome completo">
		      	  <br><span class="msg-erro label-alinhado" id="msg-nome"></span>
		      </div>
		    </div>
		    <div class="form-item">
		      <div>
			      <label for="email" class="label-alinhado">E-mail:</label>
			      <input type="email" id="email" name="email" placeholder="fulano@dominio" maxlength="50">
			      <br><span class="msg-erro label-alinhado" id="msg-email"></span>
			  </div>
		    </div>					    
		    <div class="form-item">
			   	<div>
			      <label for="endereco" class="label-alinhado">Endereço:</label>
			      <input type="text" id="endereco" name="endereco" placeholder="Rua, número, complemento" maxlength="50">
			      <br><span class="msg-erro label-alinhado" id="msg-endereco"></span>
			    </div>
		    </div>			    
		    <div class="form-item">
		      <div>
			      <label for="senha" class="label-alinhado">Senha:</label>
			      <input type="password" id="senha" name="senha" placeholder="Mínimo 6 caracteres">
			      <br><span class="msg-erro label-alinhado" id="msg-senha"></span>
		      </div>
		    </div>
		    <div class="form-item">
		      <div>
			      <label for="senha2" class="label-alinhado">Repita a Senha:</label>
			      <input type="password" id="senha2" name="senha2" placeholder="Mínimo 6 caracteres">
		      <br><span class="msg-erro label-alinhado" id="msg-senha2"></span>
		      </div>
		    </div>
		    <div class="form-item">
		    	<div>
			      <label class="label-alinhado"></label>
			      <label><input type="checkbox" id="concordo" name="concordo"> Li e estou de acordo com os termos de uso do site</label>
			      <br><span class="msg-erro label-alinhado" id="msg-concordo"></span>
			    </div>
		    </div>				    
			<div class="form-buttons">
			   <input type="submit" id="botao" value="Confirmar">
			   <input type="reset" id="botao-limpar" value="Limpar">
			</div>
		</form>
	</div>

	<footer>
		<p style="text-align: right; padding-right: 20px;">Icons by <a href="https://www.flaticon.com/authors/ddara" style="text-decoration: none; color: black;">Ddara</a> from <a href="https://www.flaticon.com/" style="text-decoration: none; color: black;">Flaticon</a>.</p>
	</footer>
	<script src="javascript/cadastro.js"></script>
</body>
</html>