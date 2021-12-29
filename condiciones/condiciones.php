<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class condiciones{
	
	VAR $descripcion;
	VAR $eventosespeciales;
	
	
	
//funcion que sirve para guardar los datos de la materia
	function guardar($descripcion, $eventosespeciales)
	{

		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');

	try{
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$stmt = $conn->prepare("INSERT INTO condiciones(descripcion, ideventosespeciales) VALUES(:a, :b);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		 		
	
 		//insert a row
 		
 		$a = $descripcion;

 		$b = $eventosespeciales;
 		


 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($descripcion, $eventosespeciales, $id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE condiciones SET descripcion='$descripcion', ideventosespeciales='$eventosespeciales' where idcondiciones ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  condiciones WHERE idcondiciones= $id";

			$conn->exec($sql);
			
	}

}
?>