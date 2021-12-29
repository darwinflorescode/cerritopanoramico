<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}



  if(!empty($_POST)){

  $nombreplatillo =  $_POST["mod_nombre"];
  $descripcion =  $_POST["mod_descripcion"];
  $eventosespeciales =  $_POST["mod_eventosespeciales"];


   include_once('../conexion/conexion.php');
    $conn = conexion();

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $consult = $conn->prepare("SELECT * FROM tipoplatillofuerte where descripcion = '$descripcion'");
       $consult->execute();

    $data = $consult->fetch(PDO::FETCH_ASSOC);
    $back = $data['descripcion'];


    if ($back ==$descripcion) {
      header("location:mostrar.php?save=false");
    }else{


// se incluye el archivo que tiene la clase con las funciones de guardar
 include ("tipoplatillofuerte.php");

  $send = new tipoplatillofuerte();
  $save =$send->guardar($nombreplatillo, $descripcion, $eventosespeciales);
      header("location:mostrar.php?save=true");
     

      }


  }else {
    header("location:mostrar.php?save=false");
    
  } 
?> 