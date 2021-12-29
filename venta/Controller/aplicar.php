<?php
include_once('../../conexion/conexion.php');
    $conn = conexion();

if (!empty($_GET['id'])) {
	$id=$_GET['id'];
	$sql = "UPDATE orden set estado='Finalizado' where idorden = $id";

		$stmt = $conn->prepare($sql);
		$stmt->execute();


		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sq = "SELECT  orden.*,mesa.* from orden inner join mesa on orden.idmesa = mesa.idmesa  where idorden = '$id'";
    $q = $conn->prepare($sq);
    $q->execute(array($id));

    $data = $q->fetch(PDO::FETCH_ASSOC);
    $idme= $data['idmesa'];



    $sqr = "UPDATE mesa set estado='Disponible' where idmesa = '$idme'";

		$ejec = $conn->prepare($sqr);
		$ejec->execute();



		header("location:../mostrar_detalle.php?id=$id");

	
}else{
	header("location:../mostrar_detalle.php?id=$id");
}



?>