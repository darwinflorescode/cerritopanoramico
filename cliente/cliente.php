<?php
//clase cliente 
	class Cliente{
		//variables de la clase
		var $id;
		var $nombre;
		var $apellido;
		var $dui;
		var $telefono;
		var $direccion;
		var $email;
		var $whatsapp;
//funcion para guardar los datos del cliente
		function generate_insert($nombre, $apellido, $dui, $telefono, $direccion, $email, $whatsapp)
		{
			//hora y fecha
			date_default_timezone_set('America/El_Salvador'); 
		$fecha = date('Y-m-d H:i:s');


		try {
			//conexion a la base de datos
			require_once('../conexion/conexion.php');
			$conn=conexion();
			//Query insert 
			$stmt = $conn->prepare("INSERT INTO cliente(nombre, apellido, dui,telefono, direccion, email, whatsapp,fecha) VALUES (:a, :b, :c, :d, :e, :f, :g, :h)");
		$stmt->bindParam(':a', $a);
		$stmt->bindParam(':b', $b);
		$stmt->bindParam(':c', $c);
		$stmt->bindParam(':d', $d);
		$stmt->bindParam(':e', $e);
		$stmt->bindParam(':f', $f);
		$stmt->bindParam(':g', $g);
		$stmt->bindParam(':h', $h);
		
		$a = $nombre;
 		$b = $apellido;
 		$c =$dui;
 		$d = $telefono;
 		$e = $direccion;
 		$f = $email;
 		$g = $whatsapp;
 		$h =$fecha;

 
		$stmt->execute();

		} catch (PDOException $e) {
			echo "Error:".$e->getMessage();
		}
			
		}
	

	//Fiuncion para eliminar un cliente

		function eliminar($id)
		{
		try{
			//Conexion al la base de datos
			require_once'../conexion/conexion.php';
			$conn = conexion();
			//Query de leiminacion delete
		$sql = "DELETE FROM  cliente WHERE idcliente = $id";

		$conn->exec($sql);

					
		}catch(PDOException $e){
		echo $sql. "<br>" . $e->getMessage();

		}
		}
		//Funcion para modificar los datos del cliente
		function editar($nombre, $apellido,$dui, $telefono, $direccion, $email, $whatsapp, $id)
		{
			try {
				//conexion a la base de datos
				require_once'../conexion/conexion.php';
				$conn=conexion();
				//Query update	
		$sql = "UPDATE cliente set nombre='$nombre', apellido='$apellido', dui='$dui', telefono='$telefono', direccion='$direccion', email='$email', whatsapp='$whatsapp' where idcliente='$id'";
		$stmt = $conn->prepare($sql);
		//Ejecuta la consulta
		$stmt->execute();
		
	} catch (PDOException $e) {
		echo $sql."<br>".$e->getMessage();
	}
		}


	}	
?>