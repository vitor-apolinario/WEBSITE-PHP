<?php  
//	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
	$con = new PDO("mysql:host=localhost;dbname=id7242851_ff;charset=UTF8", "id7242851_root", "senha");
	$stmt = $con->prepare("update frete set motorista = ? where ciot = ?");
	$stmt->bindParam(1 , $_GET['cpf']);
	$stmt->bindParam(2 , $_GET['ciot']);
	
	if($stmt->execute()){
		echo "reload";
	}else
		echo "";
?>
