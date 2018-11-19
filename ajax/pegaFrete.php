<?php  
	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
	$stmt = $con->prepare("update frete set motorista = ? where ciot = ?");
	$stmt->bindParam(1 , $_GET['cpf']);
	$stmt->bindParam(2 , $_GET['ciot']);
	
	if($stmt->execute()){
		echo "reload";
	}else
		echo "";
?>
