<?php 
if (!empty($_POST)) {

	$user = $_POST['users'];
	$newpass = $_POST['newpass'];

	  //incluimos de nuevo la conexion ya que va dentro de una condicion
  require_once'../conexion/conexion.php';
$conn= conexion();

      $qg = $conn->prepare("SELECT * FROM usuario where usuario = '$user'");
       $qg->execute();
        $rowcount = $qg->rowcount();



        if ($rowcount) {


		$sql = "UPDATE usuario SET clave= MD5('$newpass') where usuario ='$user'";

		$stmt = $conn->prepare($sql);
		$stmt->execute();

		header("location:changepass.php?save=true");
        	





        }else{
        	header("location:changepass.php?save=false");

        }


}
















 ?>