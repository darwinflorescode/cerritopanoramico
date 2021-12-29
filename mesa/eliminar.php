<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}

// llamamos el archivo de nuestra clase mesa en el que se encuentran las funciones
if (!empty($_GET['id'])) {
	$id = $_GET['id'];

	if ($id > 0) {
		# code...
	
	include 'mesa.php';

	$user = new mesa();
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