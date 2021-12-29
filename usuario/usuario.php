<?php
class usuario{


	//definir variables para la clase usuario segun la tabla usuario en la base de datos
	var $nombre;
	var $apellido;
	var $email;
	var $usuario;
	var $clave;
	var $pregunta;
	var $respuesta;
	var $idtipo;


	//funcion que guardar los datos del usuario
	
	function guardar($nombre,$apellido,$email,$usuario,$clave,$pregunta,$respuesta,$idtipo)
	{
	try{

		//fecha y hora
		date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');
		//conexion a la base de datos
 		include_once('../conexion/conexion.php');

 		$conn = conexion();


 		//prepare el sql and bind parameters
 		$stmt = $conn->prepare("INSERT INTO usuario (nombre,apellido,email,usuario,clave,intentos,bloqueado,pregunta,respuesta,estado,fecha,isadmin,ultimoingreso,razon,idtipousuario)
 		 VALUES(:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o);");
			
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
 		$stmt->bindParam(':n',$n);
 		$stmt->bindParam(':o',$o);

 	

 		//insert a row
 		$a = $nombre;
 		$b = $apellido;
 		$c = $email;
 		$d = $usuario;
 		$e = $clave;
 		$f = 0;
 		$g = 0;
 		$h = $pregunta;
 		$i = $respuesta;
 		$j="Activo";
 		$k=$fecha;
 		$l =0;
 		$m="0000-00-00 00:00:00";
 		$n = "Activado Correctamente";
 		$o = $idtipo;
 
 		$stmt->execute();
 		




 	 }catch(PDOExcepcion $e){
 		echo "Error:".$e->getMessage();

 	}
	}
	//fuuncion que muestra o lista los datos de los usuarios almacenados
	

//funcion para modificar datos del usuario
	var $id;
	function modificar($nombre,$apellido,$email,$usuario,$pregunta,$respuesta,$idtipo,$id)
	{
		require_once('../conexion/conexion.php');
		$conn = conexion();
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$sql = "UPDATE usuario SET nombre = '$nombre',apellido= '$apellido',email = '$email',
	usuario = '$usuario',pregunta = '$pregunta',respuesta = '$respuesta',idtipousuario = '$idtipo'	
	where idusuario = '$id'";

	$stmt = $conn->prepare($sql);
	$stmt->execute();
		
	}

	//funcion que sirve para eliminar los datos de platillo
	function eliminar($id){
		
		require_once('../conexion/conexion.php');
		$conn = conexion();
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM  usuario WHERE idusuario = $id";

			$conn->exec($sql);
			
	}

}
?>
