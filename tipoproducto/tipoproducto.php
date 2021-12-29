<?php
// se declaran variables a utilizar en la clase tipoproducto segun la base de datos
class tipoproducto{

	VAR $idtipoproducto;
	VAR $nombre;
	

//funcion que sirve para guardar los datos de la materia
	function guardar($nombre)
	{
	try{
		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//prepare el sql and bind parameters
 		$stmt = $conn->prepare("INSERT INTO tipoproducto (nombre,fecha) VALUES(:a, :b);");
			
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

//funcion para poder modificar los registros
	VAR $id;
	function modificar($nombre,$id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE tipoproducto set nombre='$nombre'  where idtipoproducto = '$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para poder eliminar los registros
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  tipoproducto WHERE idtipoproducto = $id";

			$conn->exec($sql);
			
	}
		


}
?>