<?php  
//	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
	$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");
	$stmt = $con->prepare("delete from frete where ciot=?");
	$stmt->bindParam(1 , $_GET['ciot']);
	if ($stmt->execute()) {
		header("Location: ../fretes.php");
	}else
		echo "ocorreu um erro ao deletar";
?>