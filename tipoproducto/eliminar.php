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
	
	include 'tipoproducto.php';

	$user = new tipoproducto();
		$user->eliminar($id);
header("location:mostrar.php");

}else{
	header("location:mostrar.php?eliminar=error");
}
}

else{
	header("location:mostrar.php");
}
?>