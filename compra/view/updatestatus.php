

<?php 


//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{
//redirecciona al index

  header("location:../");
}

//verifica que el ID no este vacio
if (!empty($_GET['idcompra'])) {
	//guardamos iel id e una variable
	$id = $_GET['idcompra'];

	if ($id > 0) {


	require_once('../../conexion/conexion.php');
	$conn = conexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		$sql = "UPDATE compra SET estado='Finalizada' where idcompra ='$id'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
header("location:../mostrar.php");

}else{
	header("location:../mostrar.php");
}
}

else{
	header("location:../mostrar.php");
}




 ?>