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
		<form action="cadastros/cad_frete.php" method="post" id="form-frete">
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
								echo '<option value ="'.$estado['sigla'].'">'.$estado['nome'].'</option>';
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
			    	<input type="text" id="ret-local" name="ret_local" maxlength="50">
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
								echo '<option value ="'.$estado['sigla'].'">'.$estado['nome'].'</option>';
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
		    		<input type="text" name="ent_local" maxlength="50" id="ent_local">
		    		<br><span class="msg-erro label-alinhado" id="msg-ent-local"></span>
		    	</div>
		    </div>

		    <div class="local-item">
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
				<div>
			    	<label for="valor" class="label-alinhado">Valor:</label>
			    	<input type="number" id="valor" name="valor" value="1" min="1" required>
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
			    				echo "<option value='".$tp['sigla']."'>".$tp['descr']."</option>";
			    			}
			    		?>
			    	</select>
			    	<br><span class="msg-erro label-alinhado" id="msg-slct-tipo"></span>
		    	</div>
		    	<div>
		    		<label for="tipo_cami" class="label-alinhado">Tipo de caminhão:</label>
			    	<select id="tipo_cami" name="tipo_cami" required>
			    		<option value="">Selecione...</option>
			    		<option value="NA">Não específicado</option>
			    		<?php  
			    			include_once "includes/conexao.php";
			    			$s=mysqli_query($conexao, "select sig, descr from tpcaminhao;");
			    			while ($tp = mysqli_fetch_array($s)) {
			    				echo "<option value='".$tp['sig']."'>".$tp['descr']."</option>";
			    			}
			    		?>
			    	</select>
			    	<br><span class="msg-erro label-alinhado" id="msg-tipo-cami"></span>
		    	</div>
		    </div>

		    <div class="form-item">
		    	<div>
			    	<label for="obs" class="label-alinhado">Informações adicionais:</label>
			    	<textarea cols="30" rows="5" id="obs" name="obs"></textarea>
			    	<br><span class="msg-erro label-alinhado" id="msg-obs"></span>
		    	</div>
<!-- 		    <div>
		    		<label for="imagens">Envie imagens:</label>
		    		<input type="file" name="imagens" id="imagens">
		    		<br><span class="msg-erro label-alinhado" id="msg-img"></span>
		    	</div> -->
		    	<div>
		    		<label for="ret_dthr">Horário de retirada:</label>
		    		<input type="datetime-local" id="ret_dthr" name="ret_dthr">
		    	</div>
		    </div>
		    <div class="form-buttons">
				   <input type="submit" id="botao" value="Confirmar">
				   <input type="reset" id="botao-limpar" value="Limpar">
			</div>
			<input type="hidden" name="contratante" value="<?=$_SESSION['usuario']['dados']['cnpj']?>">
		</form>
	</div>

	<footer>
		<p style="text-align: right; padding-right: 20px;">Icons by <a href="https://www.flaticon.com/authors/ddara" style="text-decoration: none; color: black;">Ddara</a> from <a href="https://www.flaticon.com/" style="text-decoration: none; color: black;">Flaticon</a>.</p>
	</footer>
	<script src="javascript/cadastro.js"></script>
</body>
</html>