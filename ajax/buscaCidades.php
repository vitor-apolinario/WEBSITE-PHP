<?php
	include "../includes/conexao.php";
	$sql="SELECT sigla, nome FROM `cidade` WHERE estado='".$_GET['uf']."'";
	$result=mysqli_query($conexao, $sql);
	echo '<option value="">Cidade</option>';
	while($data=mysqli_fetch_array($result))
		echo"<option value='".$data['sigla']."'>".$data['nome']."</option>";
?>
