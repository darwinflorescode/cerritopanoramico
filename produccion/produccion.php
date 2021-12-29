<?php
// se declaran variables a utilizar en la clase tipoproducto segun la base de datos
class produccion{

	VAR $idproduccion;
	VAR $fecha;
	VAR $fecha_vencimiento;
	var $cantidad;
	VAR $preciounitario;
	var $total;
	VAR $id_producto;
	

//funcion que sirve para guardar los datos de la materia
	function guardar($fecha_vencimiento, $cantidad, $preciounitario, $total, $id_producto)
	{

		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d');
	try{
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//prepare el sql and bind parameters
 		$stmt = $conn->prepare("INSERT INTO produccion (fechaproduccion,fechavencimiento,cantidad,preciounitario,total,idproducto) 
 			VALUES(:a,:b,:c,:d,:e,:f);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		$stmt->bindParam(':c',$c);
 		$stmt->bindParam(':d',$d);
 		$stmt->bindParam(':e',$e);
 		$stmt->bindParam(':f',$f);

 		
 	
 		//insert a row
 		$a = $fecha;
 		$b = $fecha_vencimiento;
 		$c = $cantidad;
 		$d = $preciounitario;
 		$e = $total;
 		$f = $id_producto;
 		 		
 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}

//funcion para poder modificar los registros
	VAR $id;
	function modificar($fecha_vencimiento,$cantidad,$preciounitario,$total,$id_producto, $id)
		{

			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE produccion set fechavencimiento='$fecha_vencimiento', 
		cantidad='$cantidad', preciounitario='$preciounitario', total='$total', idproducto='$id_producto' where idproduccion = $id";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	function add($cantidad,$total, $id)
		{

			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE produccion set cantidad='$cantidad', preciounitario=preciounitario, total='$total' where idproduccion = $id";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	//funcion para poder eliminar los registros
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  produccion WHERE idproduccion = $id";

			$conn->exec($sql);
			
	}
		

}
?>