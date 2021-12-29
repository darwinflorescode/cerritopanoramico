

<?php 


//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{
//redirecciona al index

  header("location:../");
}

//verifica que el ID no este vacio
if (!empty($_GET['idbanquete'])) {
	//guardamos iel id e una variable
	$id = $_GET['idbanquete'];

	if ($id > 0) {


	require_once('../conexion/conexion.php');
	$conn = conexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE clienteconfirmaevento SET estado='Pagado' where idclienteconfirmaevento ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
header("location:mostrar.php");

}else{
	header("location:mostrar.php");
}
}

else{
	header("location:mostrar.php");
}




 ?>