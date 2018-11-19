<?php 
	if (isset($_GET['ciot'])){
		$date = new DateTime();
		$date = $date->format('Y-m-d\TH:i:s');
		$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
		$stmt = $con->prepare("update frete set ent_dthr = ? where ciot = ?");
		$stmt->bindParam(1, $date);
		$stmt->bindParam(2, $_GET['ciot']);
		$stmt->execute();
	}
?>