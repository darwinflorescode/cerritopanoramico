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
$codigo= $_POST['mod_codigo'];
$id= $_POST['modal_id'];
  $nombre = $_POST["mod_nombre"];
  $apellido = $_POST["mod_apellido"];
  $telefono = $_POST["modal_tel"];
  $direccion =$_POST['modal_direccion'];
  $estado = $_POST['mod_estado'];


//incluye el archivo donde esta la funcion de modificar

  include ("mesero.php");

  $send = new mesero();
  $save =$send->modificar($codigo,$nombre,$apellido,$telefono,$direccion,$estado,$id);
   header("location:mostrar.php?modify=true");


}else{
  header("location:mostrar.php?save=error");
}
?>