<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class producto{
	VAR $idproducto;
	VAR $nombre;
	VAR $descripcion;
	VAR $tipomenu;
	VAR $cantidad;
	VAR $precio_unitario;
	var $total;
    VAR $idtipoproducto;
	
//funcion que sirve para guardar los datos de la materia
	function guardar($nombre,$tipomenu,$idtipoproducto,$descripcion)
	{

		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');

	try{
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$stmt = $conn->prepare("INSERT INTO producto(nombre,tipomenu, entrada, cantidad, salida, descripcion, preciounitario, total, estado, fechav, razon, fecha, idtipoproducto) VALUES(:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m);");
			
 		$stmt->bindParam(':a',$a);
 		$stmt->bindParam(':b',$b);
 		$stmt->bindParam(':c',$c);
 		$stmt->bindParam(':d',$d);
 		$stmt->bindParam(':e',$e);
 		$stmt->bindParam(':f',$f);
 		$stmt->bindParam(':g',$g);
 		$stmt->bindParam(':h',$h);
 		$stmt->bindParam(':i',$i);
 		$stmt->bindParam(':j',$j);
 		$stmt->bindParam(':k',$k);
 		$stmt->bindParam(':l',$l);
 		$stmt->bindParam(':m',$m);
 		
	
 	
 		//insert a row
 		$a = $nombre;
 		$b = $tipomenu;
 		$c = 0;
 		$d = 0;
 		$e = 0;
 		$f = $descripcion;
 		$g = 0;
 		$h = 0;
 		$i = "Activo";
 		$j="0000-00-00";
 		$k = "Activado Correctamente";
 		$l = $fecha;
 		$m = $idtipoproducto;


 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($nombre,$tipomenu,$idtipoproducto,$descripcion,$id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE producto SET nombre='$nombre', tipomenu='$tipomenu',
		idtipoproducto = '$idtipoproducto', descripcion='$descripcion' where idproducto ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  producto WHERE idproducto = $id";

			$conn->exec($sql);
			
	}





}
?>