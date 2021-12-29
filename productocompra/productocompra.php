<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class productocompra{
	VAR $idproductocompra;
	VAR $nombre;
	VAR $cantidad;
	VAR $descripcion;
	VAR $precio_unitario;
	var $total;
	
	
//funcion que sirve para guardar los datos de la materia
	function guardar($nombre,$descripcion)
	{

		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');

	try{
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$stmt = $conn->prepare("INSERT INTO productocompra(nombre,cantidad, descripcion, preciounitario, total, razon, fecha, estado) VALUES(:a,:b,:c,:d,:e,:f,:g,:h);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		$stmt->bindParam(':c',$c);
 		$stmt->bindParam(':d',$d);
 		$stmt->bindParam(':e',$e);
 		$stmt->bindParam(':f',$f);
 		$stmt->bindParam(':g',$g);
 		$stmt->bindParam(':h',$h);
 		
 		
	
 	
 		//insert a row
 		$a = $nombre;
 		$b = '0';
 		$c = $descripcion;
 		$d = '0';
 		$e = '0';
 		$f = '0';
 		$g = $fecha;
 		$h="Activo";
 		


 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($nombre,$descripcion, $estado,$id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE productocompra SET nombre='$nombre', 
		descripcion='$descripcion', estado='$estado' where idproductocompra ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  productocompra WHERE idproductocompra = $id";

			$conn->exec($sql);
			
	}





}
?>