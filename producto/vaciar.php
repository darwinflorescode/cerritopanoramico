

<?php 


//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{
//redirecciona al index

  header("location:../");
}

//verifica que el ID no este vacio
if (!empty($_GET['vacio'])) {
	//guardamos iel id e una variable
	$vacio = $_GET['vacio'];

	if ($vacio=="ok") {


	require_once('../conexion/conexion.php');
	$conn = conexion();
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    date_default_timezone_set('America/El_Salvador'); 
        $fechas = date('Y-m-d');

		$sql = "UPDATE producto SET entrada=0,cantidad=0,salida=0,preciounitario=0.00,total=0.00,fechav='0000-00-00' where fechav < '$fechas'";

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