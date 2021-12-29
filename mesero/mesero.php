<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class mesero{
	VAR $idmesero;
	var $codigo;
	VAR $nombre;
	VAR $apellido;
	VAR $telefono;
	VAR $direccion;
	var $estado;


    
//funcion que sirve para guardar los datos de la materia
	function guardar($codigo,$nombre,$apellido,$telefono,$direccion)
	{
	try{


			date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');
		
 		require_once('../conexion/conexion.php');


 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$stmt = $conn->prepare("INSERT INTO mesero(codigo,nombre,apellido,telefono,direccion,fecha,estado, contadormesa) VALUES(:a,:b,:c,:d,:e,:f,:g,:h);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		$stmt->bindParam(':c',$c);
 		$stmt->bindParam(':d',$d);
 		$stmt->bindParam(':e',$e);
 		$stmt->bindParam(':f',$f);
 		$stmt->bindParam(':g',$g);
 		$stmt->bindParam(':h',$h);

 		
 		//insert a row
 		$a= $codigo;
 		$b = $nombre;
 		$c = $apellido;
 		$d = $telefono;
 		$e = $direccion;
 		$f= $fecha;
 		$g = "Disponible";
 		$h= '0';
 
 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($codigo,$nombre,$apellido,$telefono,$direccion,$estado,$id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE mesero SET codigo='$codigo',nombre='$nombre',apellido='$apellido', telefono='$telefono',
		direccion = '$direccion', estado='$estado' where idmesero ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  mesero WHERE idmesero = $id";

			$conn->exec($sql);
			
	}





}
?>