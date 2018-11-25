<?php
	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
	$stmt = $con->prepare("delete from caminhao where placa = ?");
	$stmt->bindParam(1 , $_GET['placa']);
	if ($stmt->execute()) {
		header("Location: ../caminhao.php");
	}else
		echo "ocorreu um erro ao deletar";
?>
