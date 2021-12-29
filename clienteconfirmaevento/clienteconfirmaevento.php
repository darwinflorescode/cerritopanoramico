<?php
// se declaran variables a utilizar en la clase materia
//segun la base de datos
class clienteconfirmaevento{
	var $usuario;
	VAR $preciopersona;
	var $cantidadpersona;
	VAR $preciototal;
	VAR $fechaevento;
	VAR $horainicio;
	VAR $horafin;
	VAR $adelanto;
	VAR $pendiente;
	VAR $cliente;
	VAR $eventosespeciales;
	
	
	
//funcion que sirve para guardar los datos de la materia
	function guardar($usuario,$preciopersona, $cantidadpersona, $preciototal, $fechaevento, $horainicio, $horafin, $adelanto, $pendiente, $cliente, $eventosespeciales)
	{

		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');

	try{
 		require_once('../conexion/conexion.php');

 		$conn = conexion();

 		//guarda los datos que estan ingresados en el formulario en la base de datos
 		$stmt = $conn->prepare("INSERT INTO clienteconfirmaevento(nombreusuario,precioporpersona, cantidadpersona, preciototal, fecha, horainicio, horafin, adelanto, pendiente, fecharegistro, estado, idcliente, ideventosespeciales) VALUES(:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m);");
			
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
 		$a = $usuario;
 		$b = $preciopersona;
 		$c = $cantidadpersona;
 		$d = $preciototal;
 		$e = $fechaevento;
 		$f = $horainicio;
 		$g = $horafin;
 		$h = $adelanto;
 		$i = $pendiente;
 		$j = $fecha;
 		$k="Reservado";
 		$l = $cliente;
 		$m= $eventosespeciales;
 		


 
 		$stmt->execute();

 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();
 	}
}



//funcion para poder modificar los registros
	VAR $id;
	function modificar($preciopersona, $cantidadpersona, $preciototal, $fechaevento, $horainicio, $horafin, $adelanto, $pendiente, $cliente, $eventosespeciales, $id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE clienteconfirmaevento SET precioporpersona = '$preciopersona', cantidadpersona='$cantidadpersona', preciototal ='$preciototal', fecha ='$fechaevento', horainicio='$horainicio', horafin ='$horafin', adelanto ='$adelanto', pendiente ='$pendiente', idcliente ='$cliente', ideventosespeciales='$eventosespeciales' where idclienteconfirmaevento ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
			
		}
	
	//funcion para eliminar registro
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  clienteconfirmaevento WHERE idclienteconfirmaevento= $id";

			$conn->exec($sql);
			
	}

}
?>