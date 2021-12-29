<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}
//este sirve para eliminar un registro por medio del id
if (!empty($_GET['id'])) {
	$id = $_GET['id'];

	if ($id > 0) {
		# code...
	
	include 'proveedor.php';

	 $provee = new Provider();
		$provee->delete($id);
header("location:mostrar.php");

}else{
	header("location:mostrar.php");
}
}

else{
	header("location:mostrar.php");
}
?>