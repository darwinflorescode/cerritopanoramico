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
    $id = $_POST['idc'];
   
    $descripcion =  $_POST["modal_descripcion"];
    $eventosespeciales =  $_POST["modal_eventosespeciales"];
   

// incluye el archivo de la clase donde esta la funcion de modificar
        include("condiciones.php");
      $send = new condiciones();

      $save = $send->modificar($descripcion, $eventosespeciales, $id);
      header("location:mostrar.php?modify=true");


      
    

  } else{
         header("location:mostrar.php?modify=false");

  }
?> 