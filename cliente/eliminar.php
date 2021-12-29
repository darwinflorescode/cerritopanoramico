<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{
//redirecciona al index

  header("location:../");
}

//verifica que el ID no este vacio
if (!empty($_GET['id'])) {
	//guardamos iel id e una variable
	$id = $_GET['id'];

	if ($id > 0) {
		# code...
	//incluimos la clase
	include 'cliente.php';
// y enviamos el id a la funcion eliminar
	$user = new cliente();
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