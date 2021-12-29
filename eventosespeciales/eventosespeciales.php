<?php
// se declaran variables a utilizar en la clase 
//segun la base de datos
class eventosespeciales{
	
	VAR $opcion;
	VAR $pastel;
	VAR $postre;
	
	VAR $preciopersona;
	
	
//funcion que sirve para guardar los datos 
	function guardar($opcion, $pastel, $postre, $preciopersona)
	{

		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d');

	try{
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$stmt = $conn->prepare("INSERT INTO eventosespeciales(opcion, pastel, postre, preciopersona,fecharegistro) VALUES(:a, :b, :c, :d, :e);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		$stmt->bindParam(':c',$c);
 		$stmt->bindParam(':d',$d);
 		$stmt->bindParam(':e',$e);
 		 		
	
 		//insert a row
 		
 		$a = $opcion;
 		$b = $pastel;

 		$c = $postre;
 		
 		$d = $preciopersona;
 		$e=$fecha;
 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($opcion, $pastel, $postre,  $preciopersona, $id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE eventosespeciales SET opcion='$opcion', pastel='$pastel', postre='$postre', preciopersona='$preciopersona' where ideventosespeciales ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  eventosespeciales WHERE ideventosespeciales= $id";

			$conn->exec($sql);
			
	}

}
?>