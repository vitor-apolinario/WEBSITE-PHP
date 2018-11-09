<?php
	@session_start();
	// AO FAZER LOGIN ARMAZENAR NA SESSION O TIPO DE USUÁRIO,
	// E EXIBIR A LISTA DE FRETES DE ACORDO E TAMBÉM ADICIONAR
	// UMA OPCAO CASO SEJA EMPRESA, PARA ARRUMAR OS DADOS
?>

<?php
	include "includes/header_cadastro.php"
?>

	<?php
		if (!isset($_GET['ok'])){
	?>
	<div class="container">
		<h1 style="text-align: center;">Cadastre-se</h1>
		<form action="cadastros/cad_usuario.php" method="post" id="form-cadastro">
			<div class="tipo-usuario">
				<label>SOU:</label>
			    <label><input type="radio" name="fl_usuario" value="C" id="uC" onchange="tipoUsuario(this.value)" <? if(isset($_GET['c']) && $_GET['c'] == 'c'){echo "checked";}?>>Caminhoneiro</label>
			    <label><input type="radio" name="fl_usuario" value="E" id="uE" onchange="tipoUsuario(this.value)" <? if(isset($_GET['c']) && $_GET['c'] == 'e'){echo "checked";}?>>Empresa</label>
			</div>
		    <div class="form-item">
		      <div>
			      <label for="nome" class="label-alinhado">Nome:</label>
			      <input type="text" id="nome" name="nome" maxlength="50" placeholder="Nome completo">
		      	  <br><span class="msg-erro" id="msg-nome"></span>
		      </div>
		      <div>
			      <label for="cpfcnpj" class="label-alinhado">CPF/CNPJ:</label>
			      <input type="text" id="cpfcnpj" name="cpfcnpj" maxlength="13" placeholder="xxxxxxxxxxx">
		      	  <br><span class="msg-erro" id="msg-cpfcnpj"></span>
		      </div>
		    </div>
		    <div class="form-item">
		      <div>
			      <label for="email" class="label-alinhado">E-mail:</label>
			      <input type="email" id="email" name="email" placeholder="fulano@dominio" maxlength="50">
			      <br><span class="msg-erro" id="msg-email"></span>
			  </div>
 			  <div class="local">
			  	<select onchange="carregaCidades(this.value)" id="uf-select">
			    	<option value="">UF</option>
						<?php
							include "includes/conexao.php";
							$sql="select sigla from estado";
							$resultado=mysqli_query($conexao, $sql);
							while($uf=mysqli_fetch_array($resultado))
								echo "<option value='".$uf['sigla']."'>".$uf['sigla']."</option>";
						?>
			    </select>
			    <select id="city-select">
			    	<option value="">Cidade</option>
			    </select>
			   </div>
		    </div>
		    <div class="form-item">
		        <div>
			      <label for="telefone" class="label-alinhado">Telefone:</label>
			      <input type="text" id="telefone" name="telefone" placeholder="(ddd) x xxxx-xxx" maxlength="50">
			      <br><span class="msg-erro" id="msg-telefone"></span>
			    </div>
			    <div>
			      <label for="endereco" class="label-alinhado">Endereço:</label>
			      <input type="text" id="endereco" name="endereco" placeholder="Rua, número, complemento" maxlength="50">
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
			      <label>CNH:</label>
			      <label><input type="radio" name="categoria" value="C" id="c1" checked>C</label>
			      <label><input type="radio" name="categoria" value="D" id="c2">D</label>
			      <label><input type="radio" name="categoria" value="E" id="c3">E</label>
		      </div>
		    </div>
		    <div class="form-item">
		      <div>
			      <label for="senha2" class="label-alinhado">Repita:</label>
			      <input type="password" id="senha2" name="senha2" placeholder="Mínimo 6 caracteres">
		      	  <br><span class="msg-erro" id="msg-senha2"></span>
		      </div>
		      <div>
			      <label for="datanasc" class="label-alinhado">Data:</label>
			      <input type="date" id="datanasc" name="datanasc">
		      <br><span class="msg-erro" id="msg-datanasc"></span>
		      </div>
		    </div>
		    <div class="form-item">
		    	<div>
			      <label><input type="checkbox" class="label-alinhado" id="concordo" name="concordo"> Li e estou de acordo com os termos de uso do site</label>
			      <br><span class="msg-erro" id="msg-concordo"></span>
			    </div>
		    </div>
			<div class="form-buttons">
			   <input type="submit" id="botao" value="Confirmar">
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
