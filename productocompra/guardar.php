<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}




  if(!empty($_POST)){

  $nombre = $_POST["mod_nombre"];

  $descripcion =  $_POST["mod_descripcion"];


   include_once('../conexion/conexion.php');
    $conn = conexion();

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $consult = $conn->prepare("SELECT * FROM productocompra where nombre = '$nombre'");
       $consult->execute();

    $data = $consult->fetch(PDO::FETCH_ASSOC);
    $back = $data['nombre'];


    if ($back ==$nombre) {
      header("location:mostrar.php?save=false");
    }else{


// se incluye el archivo que tiene la clase con las funciones de guardar
 include ("productocompra.php");

  $send = new productocompra();
  $save =$send->guardar($nombre,$descripcion);
      header("location:mostrar.php?save=true");


      

      }


  }else {
    header("location:mostrar.php?save=false");
    
  } 
?> 