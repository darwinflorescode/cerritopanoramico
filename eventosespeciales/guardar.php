<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}



  if(!empty($_POST)){

  $opcion =  $_POST["mod_opcion"];
  $pastel =  $_POST["mod_pastel"];
  $postre =  $_POST["mod_postre"];
  
  $preciopersona =  $_POST["mod_preciopersona"];

  

   include_once('../conexion/conexion.php');
    $conn = conexion();

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $consult = $conn->prepare("SELECT * FROM eventosespeciales where opcion='$opcion'");
       $consult->execute();

    $data = $consult->fetch(PDO::FETCH_ASSOC);
    $back = $data['opcion'];


    if ($back ==$opcion) {
      header("location:mostrar.php?save=false");
    }else{


// se incluye el archivo que tiene la clase con las funciones de guardar
 include ("eventosespeciales.php");

  $send = new eventosespeciales();
  $save =$send->guardar($opcion, $pastel, $postre, $preciopersona);
      header("location:mostrar.php?save=true");
     

      }


  }else {
    header("location:mostrar.php?save=false");
    
  } 
?> 