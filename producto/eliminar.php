<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}

if (!empty($_GET['id'])) {
	$id = $_GET['id'];

	if ($id > 0) {
		# code...
	
	include 'producto.php';

	$user = new producto();
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