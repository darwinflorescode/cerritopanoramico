<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class tipoadicional{
	
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
 		$stmt = $conn->prepare("INSERT INTO tipoadicional(descripcion, ideventosespeciales) VALUES(:a, :b);");
			
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
	function modificar($descripcion, $eventosespeciales,  $id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE tipoadicional SET descripcion='$descripcion', ideventosespeciales='$eventosespeciales' where idtipoadicional ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  tipoadicional WHERE idtipoadicional = $id";

			$conn->exec($sql);
			
	}

}
?>