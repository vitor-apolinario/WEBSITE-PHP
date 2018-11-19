<?php  
	echo "<pre>";
	print_r($_POST);
	echo "<pre>";

	if
	(
		!isset($_POST['ret_cidad'])   || empty($_POST['ret_cidad'])  ||
		!isset($_POST['ret_local'])   || empty($_POST['ret_local'])  ||
		!isset($_POST['ent_cidad'])   || empty($_POST['ent_cidad'])  ||
		!isset($_POST['ent_local'])   || empty($_POST['ent_local'])  ||
		!isset($_POST['peso'])        || empty($_POST['peso'])       ||
		!isset($_POST['volume'])      || empty($_POST['volume'])     ||
		!isset($_POST['valor'])       || empty($_POST['valor'])      ||
		!isset($_POST['tipo'])        || empty($_POST['tipo'])       ||
		!isset($_POST['tipo_cami'])   || empty($_POST['tipo_cami'])  ||
		!isset($_POST['obs'])         || empty($_POST['obs'])        ||
		!isset($_POST['ret_dthr'])    || empty($_POST['ret_dthr'])   ||
		!isset($_POST['contratante']) || empty($_POST['contratante']) 
	){
		echo "<p>Preencha todos os campos do formulário</p>";
		die();
	}

	$ret_cidad=   trim($_POST['ret_cidad']);
	$ret_local=   trim($_POST['ret_local']);
	$ent_cidad=   trim($_POST['ent_cidad']);
	$ent_local=   trim($_POST['ent_local']);
	$peso=        trim($_POST['peso']);
	$volume=      trim($_POST['volume']);
	$valor=       trim($_POST['valor']);
	$tipo=        $_POST['tipo'];
	$tipo_cami=   $_POST['tipo_cami'] /*== "NA" ? null : $_POST['tipo_cami']*/;
	$obs=         trim($_POST['obs']);
	$ret_dthr=    $_POST['ret_dthr'];
	$contratante= $_POST['contratante'];

	$arrayName = array(
		$ret_cidad,
		$ret_local,
		$ent_cidad,
		$ent_local,
		$peso,
		$volume,
		$valor,
		$tipo,
		$tipo_cami,
		$obs,
		$ret_dthr,
		$contratante
	);
	echo "<pre>";
	print_r($arrayName);
	echo "</pre>";

	// exemplo de select usando PDO
	// $con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
	// $rs = $con->query("select sigla, descr from tpcarga");
	// while($row = $rs->fetch(PDO::FETCH_OBJ)){
 	// 	echo $row->sigla . " - ";
 	// 	echo $row->descr . "<br/><hr/>";
	// }

	$con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
	$stmt = $con->prepare("INSERT INTO frete (ret_cidad, ret_local, ent_cidad, ent_local, peso, volume, valor, tipo, tipo_cami, obs, ret_dthr, contratante) values (?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bindParam(1 , $ret_cidad);
	$stmt->bindParam(2 , $ret_local);
	$stmt->bindParam(3 , $ent_cidad);
	$stmt->bindParam(4 , $ent_local);
	$stmt->bindParam(5 , $peso);
	$stmt->bindParam(6 , $volume);
	$stmt->bindParam(7 , $valor);
	$stmt->bindParam(8 , $tipo);
	$stmt->bindParam(9 , $tipo_cami);
	$stmt->bindParam(10, $obs);
	$stmt->bindParam(11, $ret_dthr);
	$stmt->bindParam(12, $contratante);

	if($stmt->execute() === false){
	    echo "<pre>";
	    print_r($stmt->errorInfo());
	    echo "</pre>";
	}
?>