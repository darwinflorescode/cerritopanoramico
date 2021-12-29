<?php 
class pagoclass{


	//definir variables para la clase usuario segun la tabla usuario en la base de datos
	var $total;
	var $pagocliente;
	var $cambio;
	var $idorden;



	//funcion que guardar los datos del usuario
	
	function guardar($total,$pagocliente,$cambio,$idorden)
	{
	try{

		//conexion a la base de datos
 		include_once('../../conexion/conexion.php');

 		$conn = conexion();


 		//prepare el sql and bind parameters
 		$stmt = $conn->prepare("INSERT INTO pago (total,pagocliente,cambio,idorden)
 		 VALUES(:a,:b,:c,:d);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		$stmt->bindParam(':c',$c);
 		$stmt->bindParam(':d',$d);

 	

 		//insert a row
 		$a = $total;
 		$b = $pagocliente;
 		$c = $cambio;
 		$d = $idorden;
 		
 
 		$stmt->execute();
 		




 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();

 	}
	}

	//funcion para modificar datos del usuario
	var $id;
	function modificar($id)
	{
		require_once('../../conexion/conexion.php');
		$conn = conexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$sql = "UPDATE orden SET estado = 'Pagada'	where idorden = '$id'";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
		
	}

	function modificarmesa($id)
	{
		require_once('../../conexion/conexion.php');
		$conn = conexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$sqr = "UPDATE mesa SET estado = 'Disponible'	where idmesa = '$id'";

	$stmf = $conn->prepare($sqr);
	$stmf->execute();
		
	}
	function modificarmesero($id)
	{
		require_once('../../conexion/conexion.php');
		$conn = conexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$sq = "UPDATE mesero SET contadormesa = contadormesa-1	where idmesero = '$id'";

	$stmc = $conn->prepare($sq);
	$stmc->execute();
		
	}

	 }



 ?>