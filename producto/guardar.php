<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}




  if(!empty($_POST)){

   $nombre = $_POST["mod_nombre"];
  $tipomenu = $_POST["tipomenu"];
  $idtipoproducto =  $_POST["tipoproducto"];
   $descripcion = $_POST["mod_descripcion"];

   include_once('../conexion/conexion.php');
    $conn = conexion();

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $consult = $conn->prepare("SELECT * FROM producto where nombre = '$nombre'");
       $consult->execute();

    $data = $consult->fetch(PDO::FETCH_ASSOC);
    $back = $data['nombre'];


    if ($back ==$nombre) {
      header("location:mostrar.php?save=false");
    }else{



 include ("producto.php");

  $send = new producto();
  $save =$send->guardar($nombre,$tipomenu,$idtipoproducto,$descripcion);
      header("location:mostrar.php?save=true");


      

      }


  }else {
    header("location:mostrar.php?save=false");
    
  } 
?> 