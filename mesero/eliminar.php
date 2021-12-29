<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}
// incluye el archivo donde se encuentra nuestra funcion de eliminar
if (!empty($_GET['id'])) {
	$id = $_GET['id'];

	if ($id > 0) {
		# code...
	
	include 'mesero.php';

	$user = new mesero();
		$user->eliminar($id);
header("location:mostrar.php");

}else{
	header("location:mostrar.php");
}
}

else{
	header("location:mostrar.php");
}
?>