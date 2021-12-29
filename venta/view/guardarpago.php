<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../../");
}


if(!empty ($_POST)){
  //incluimos de nuevo la conexion ya que va dentro de una condicion
  require_once'../../conexion/conexion.php';
$conn= conexion();
//datos capturados en el formulario para almacenar los datos
 $idorden =$_POST['modal_id'];
 $total=$_POST['totalpagar'];
$clientepag= $_POST["clientepaga"];
  $cambio = $_POST["cambio"];
  
  $qg = $conn->prepare("SELECT * FROM pago where idorden = '$idorden'");
        $qg->execute();
//guardar datos en variables
    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $d = $data['idorden'];


  $query = $conn->prepare("SELECT * FROM orden where idorden = '$idorden'");
        $query->execute();
//guardar datos en variables
    $datosorden = $query->fetch(PDO::FETCH_ASSOC);
    $idmesa = $datosorden['idmesa'];
    $idmesero = $datosorden['idmesero'];
      
if ($idorden==$d) {
  # code...
  header("location:../mostrar.php?save=error");

}elseif($idorden!=$d){
  // incluye el archivo donde se encuentra nuestra funcion de guardar

  include ("pagoclass.php");

  $send = new pagoclass();
  $save =$send->guardar($total,$clientepag,$cambio,$idorden);
  $send->modificar($idorden);
  $send->modificarmesa($idmesa);
  $send->modificarmesero($idmesero);

   header("location:../mostrar.php?save=true");
}else{
    header("location:../mostrar.php?save=error");
}


}else{
  header("location:../mostrar.php?save=error");
}
?>