<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{

//Redirecciona al index
  header("location:../");
}

//Si el id a eliminar no viene vacio
if (!empty($_GET['id'])) {
	//Guardamos el ID en una variable
	$id = $_GET['id'];

	if ($id > 0) {
		# code...
	//Instancia para la funcion eliminar
	include 'usuario.php';

	$user = new usuario();
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