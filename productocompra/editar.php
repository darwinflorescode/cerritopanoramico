<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}

// se incluye la conexion con la base de datos
include_once('../conexion/conexion.php');
    $conn = conexion();


  if(!empty($_POST)){
    $id = $_POST['idp'];
    $nombre = $_POST["modal_nombre"];
    
    $descripcion =  $_POST["modal_descripcion"];
    $estado = $_POST["modal_estadop"];


// incluye el archivo de la clase donde esta la funcion de modificar
        include("productocompra.php");
      $send = new productocompra();

      $save = $send->modificar($nombre,$descripcion, $estado, $id);
      header("location:mostrar.php?modify=true");


      
    

  } else{
         header("location:mostrar.php?modify=false");

  }
?> 