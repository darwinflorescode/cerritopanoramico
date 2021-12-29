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
    $id = $_POST['id'];
   
  $opcion =  $_POST["modal_opcion"];
  $pastel =  $_POST["modal_pastel"];
  $postre =  $_POST["modal_postre"];
  
  $preciopersona =  $_POST["modal_preciopersona"];

   

// incluye el archivo de la clase donde esta la funcion de modificar
        include("eventosespeciales.php");
      $send = new eventosespeciales();

      $save = $send->modificar($opcion, $pastel, $postre, $preciopersona, $id);
      header("location:mostrar.php?modify=true");


      
    

  } else{
         header("location:mostrar.php?modify=false");

  }
?> 