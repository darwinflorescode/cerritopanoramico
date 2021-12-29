<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class mesa{
	VAR $idmesa;
	VAR $numeromesa;
	var $imagen;
	VAR $descripcion;
	var $estado;

	
    
//funcion que sirve para guardar los datos de la materia
	function guardar($numeromesa,$imagen,$descripcion)
	{
	try{


 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$query = "INSERT INTO mesa(numeromesa,imagen,descripcion,fecha,estado) VALUES('$numeromesa','$imagen','$descripcion',Now(),'Disponible');";
 		$stmt=$conn->prepare($query);
		
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($numeromesa,$imagen,$descripcion,$estado,$id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE mesa SET numeromesa='$numeromesa',imagen='$imagen',descripcion='$descripcion', estado='$estado' where idmesa ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  mesa WHERE idmesa = $id";

			$conn->exec($sql);
			
	}

}
?>