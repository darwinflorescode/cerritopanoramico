<?php

class tipo{
	//definir variables para la clase tipo de usuario segun la tabla usuario en la base de datos
	var $nombre;

	//funcion que guardar los datos del tipo de usuario
	
	function guardar($nombre)
	{
	try{
		//para almacenar la fecha actual
		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');
		
 		include_once('../conexion/conexion.php');

 		$conn = conexion();


 		//prepare el sql and bind parameters
 		$stmt = $conn->prepare('INSERT INTO tipousuario(nombre,agregado)
 		 VALUES(:a, :b)');
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);

 	

 		//insert a row
 		$a = $nombre;
 		$b = $fecha;
 
 
 		$stmt->execute();
 		
 		




 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();

 	}
	}

//Funcion para modifcar los datos del tipo de id
	var $id;
	function modificar($nombre,$id)
	{
		//conexion archivo para hacer la instancia
		require_once('../conexion/conexion.php');
		$conn = conexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		//Query
	$sql = "UPDATE tipousuario SET nombre = '$nombre',agregado = NOW() where idtipousuario = '$id'";

	$stmt = $conn->prepare($sql);
	$stmt->execute();

	
		
	}

	//funcion que sirve para eliminar los datos del tipo de usuario
	function eliminar($id){
		//Conexion 
		require_once('../conexion/conexion.php');
		$conn = conexion();

		try{
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  tipousuario WHERE idtipousuario = $id";

			$conn->exec($sql);


			}catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();

 	}
			
	}


}
?>