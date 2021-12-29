<?php 
	class Provider{
		//se defincin las variables segun la tabla del proveedor que existe en la base de datos
		var $id;
		var $nombre_empresa;
		var $codigo;
		var $telefono;
		var $email;
		var $direccion;
		var $nombre_contacto;
		var $telcont;


		//funcion que guarda los datos del proveedor
		function save($nombre_empresa, $codigo, $telefono, $email, $direccion, $nombre_contacto, $telcont){

			date_default_timezone_set('America/El_Salvador'); 
			$fecha = date('Y-m-d H:i:s');
			try {
				require_once('../conexion/conexion.php');
				$conn=conexion();

				$stmt = $conn->prepare("INSERT INTO proveedor(nombre, codigo, telefono, email, direccion, nombrecontacto, telefonocontacto,fecha, estado, razon) VALUES (:a, :b, :c, :d, :e, :f, :g, :h, :i, :j)");

				$stmt->bindParam(':a', $a);
				$stmt->bindParam(':b', $b);
				$stmt->bindParam(':c', $c);
				$stmt->bindParam(':d', $d);
				$stmt->bindParam(':e', $e);
				$stmt->bindParam(':f', $f);
				$stmt->bindParam(':g', $g);
				$stmt->bindParam(':h', $h);
				$stmt->bindParam(':i', $i);
				$stmt->bindParam(':j', $j);
		
				$a = $nombre_empresa;
				$b = $codigo;
				$c = $telefono;
				$d = $email;
				$e = $direccion;
				$f = $nombre_contacto;
				$g = $telcont;
				$h=$fecha;
				$i = "Activo";
				$j="Activo Correctamente";
				

				$stmt->execute();

			} catch (PDOException $e) {
			echo "Error:".$e->getMessage();
			}
		}



		//funcion que permite eliminar un proveedor seleccionado. por sus id

		function delete($id){
		
			require_once('../conexion/conexion.php');
			$conn = conexion();
		
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM  proveedor WHERE idproveedor = '$id'";

			$conn->exec($sql);
			
		}



			//funcion que lista todos los proveedores almacenados 
		
			//funcion qie permite editar los proveedor
		function edit($nombre_empresa, $codigo, $telefono, $email, $direccion, $nombre_contacto, $telcont,$id)
		{
			require_once('../conexion/conexion.php');
			$conn = conexion();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			$sql = "UPDATE proveedor SET nombre = '$nombre_empresa', codigo='$codigo', telefono='$telefono', email ='$email', direccion ='$direccion', nombrecontacto ='$nombre_contacto', telefonocontacto ='$telcont'	where idproveedor = '$id'";

			$stmt = $conn->prepare($sql);
			$stmt->execute();
				
	}
}

	?>