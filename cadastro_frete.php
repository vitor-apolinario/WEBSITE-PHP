<?php
	@session_start();
	// AO FAZER LOGIN ARMAZENAR NA SESSION O TIPO DE USUÁRIO,
	// E EXIBIR A LISTA DE FRETES DE ACORDO E TAMBÉM ADICIONAR
	// UMA OPCAO CASO SEJA EMPRESA, PARA ARRUMAR OS DADOS
?>
<!DOCTYPE.php>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cadastro_frete.css">
		<title>Cadastro Frete-Fretch</title>
		<link href="https://fonts.googleapis.com/css?family=Gamja+Flower" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

<body>
	<!--cabeçalho-->
	<header>
		<a href="index.php" class="opcoes-desk"><div>Página inicial</div></a>
		<h1>Frete-Fetch</h1>
		<a href="login.php" class="opcoes-desk"><div style="background-color: #0088cc; color: #0088cc;">Faça seu login!</div></a>
		<a href="index.php" class="opcoes-mob"><div>Página inicial</div></a>
	</header>
	<!--fim cabeçalho-->

	<div class="container">
		<h1 style="text-align: center;">Solicitar serviço</h1>
		<form action="cliente.php" method="post" id="form-frete">
		    <div class="form-item">
		    	<h4>Local inicial</h4>
		    	<div>
		    		<label for="uf" class="label-alinhado">UF:</label>
			    	<select onchange="carregaCidades(this.value, 'cid')" id="uf" name="uf"   required>
						<option value="">Selecione...</option>
						<?php
							include "includes/conexao.php";
							$sql = "select nome, sigla from estado order by 1";
							$estados = mysqli_query($conexao, $sql);
							while ($estado = mysqli_fetch_array($estados)) {
								echo '<option value ="'.$estado['sigla'].'">'.$estado['nome'].'</option>';
						}?>
			    	</select>
			    	<br><span class="msg-erro label-alinhado" id="msg-uf-inicial"></span>
		    	</div>
			    <div>
			    	<label for="cid" class="label-alinhado">Cidade:</label>
			    	<select id="cid" name="cid" required>
			    		<option value="">Selecione...</option>
			    	</select>
			    	<br><span class="msg-erro label-alinhado" id="msg-cid-inicial"></span>
		    	</div>
		    </div>

				<div class="form-item">
					<h4>Destino</h4>
		    	<div>
		    		<label for="uf-dest" class="label-alinhado">UF:</label>
			    	<select onchange="carregaCidades(this.value, 'cid-dest')" id="uf-dest"  name="uf-dest"  required>
			    		<option value="">Selecione...</option>
						<?php
							$sql = "select nome, sigla from estado order by 1";
							$estados = mysqli_query($conexao, $sql);
							while ($estado = mysqli_fetch_array($estados)) {
								echo '<option value ="'.$estado['sigla'].'">'.$estado['nome'].'</option>';
						}?>
			    	</select>
			    	<br><span class="msg-erro label-alinhado" id="msg-uf-final"></span>
		    	</div>
			    <div>
			    	<label for="cid-dest" class="label-alinhado">Cidade:</label>
			    	<select id="cid-dest"  name="cid-dest" required>
			    		<option value="">Selecione...</option>
			    	</select>
			    	<br><span class="msg-erro label-alinhado" id="msg-cid-final"></span>
		    	</div>
		    </div>

		    <div class="form-item">
		    	<div>
			    	<label for="peso" class="label-alinhado">Peso:</label>
			    	<input type="number" id="peso" name="peso" value="1" min="1" required>
			    	<br><span class="msg-erro label-alinhado" id="msg-peso"></span>
				</div>
			    <div>
			    	<label for="volume" class="label-alinhado">Volume:</label>
			    	<input type="number" id="volume" name="volume" value="1" min="1" required>
			    	<br><span class="msg-erro label-alinhado" id="msg-volume"></span>
				</div>
		    </div>

		    <div class="form-item">
		    	<div>
		    		<label for="grupo" class="label-alinhado">Grupo:</label>
			    	<select id="grupo" required>
			    		<option value="">Selecione...</option>
			    		<option value="mat-cons">Materiais de construção</option>
			    		<option value="alim">Alimentícios</option>
						<option value="farm">Farmacêuticos</option>
			    	</select>
			    	<br><span class="msg-erro label-alinhado" id="msg-slct-grupo"></span>
		    	</div>
		    </div>

		    <div class="form-item">
		    	<div>
			    	<label for="txt" class="label-alinhado">Informações adicionais:</label>
			    	<textarea cols="30" rows="5" id="txt"></textarea>
			    	<br><span class="msg-erro label-alinhado" id="msg-info"></span>
		    	</div>
		    	<div>
		    		<label for="imagens">Envie imagens:</label>
		    		<input type="file" name="imagens" id="imagens">
		    		<br><span class="msg-erro label-alinhado" id="msg-img"></span>
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
