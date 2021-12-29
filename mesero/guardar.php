<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}


if(!empty ($_POST)){
  //incluimos de nuevo la conexion ya que va dentro de una condicion
  require_once'../conexion/conexion.php';
$conn= conexion();
//datos capturados en el formulario para almacenar los datos
$codigo= $_POST["codigo"];
  $nombre = $_POST["nombres"];
  $apellido = $_POST["apellidos"];
  $telefono = $_POST["telefono"];
  $direccion =$_POST['direccion'];


  //Selecciona telefono de la tabla mesero para comparar si ya existe un mesero con ese dui, email
    // para no poder registrarlo ya que es unico.
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $qg = $conn->prepare("SELECT * FROM mesero where codigo = '$codigo' or telefono = '$telefono' ");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $tele = $data['telefono'];
    $cod = $data['codigo'];
  


    if ($tele == $telefono) {
      header("location:mostrar.php?save=false");
    }elseif ($cod > 0) {
       header("location:mostrar.php?save=cod");
    }else{


// incluye el archivo donde se encuentra nuestra funcion de eliminar

  include ("mesero.php");

  $send = new mesero();
  $save =$send->guardar($codigo,$nombre,$apellido,$telefono,$direccion);
   header("location:mostrar.php?save=true");
 
}

}else{
  header("location:mostrar.php?save=error");
}
?>