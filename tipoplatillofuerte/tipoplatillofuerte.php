<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class tipoplatillofuerte{
	
	VAR $nombreplatillo;
	VAR $descripcion;
	VAR $eventosespeciales;
	
	
	
//funcion que sirve para guardar los datos de la materia
	function guardar($nombreplatillo, $descripcion, $eventosespeciales)
	{

		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');

	try{
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$stmt = $conn->prepare("INSERT INTO tipoplatillofuerte(nombreplatillo,descripcion, ideventosespeciales) VALUES(:a, :b, :c);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		$stmt->bindParam(':c',$c);
 		 		
	
 		//insert a row
 		
 		$a = $nombreplatillo;

 		$b = $descripcion;
 		$c = $eventosespeciales;
 		


 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($nombreplatillo, $descripcion, $eventosespeciales, $id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE tipoplatillofuerte SET nombreplatillo= '$nombreplatillo', descripcion='$descripcion', ideventosespeciales='$eventosespeciales' where idtipoplatillofuerte ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  tipoplatillofuerte WHERE idtipoplatillofuerte = $id";

			$conn->exec($sql);
			
	}

}
?>