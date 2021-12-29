<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}

if(!empty($_POST)){

		include_once('../conexion/conexion.php');

 		$conn = conexion();

    $nombre = $_POST["namep"];
 

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $consult = $conn->prepare("SELECT * FROM tipoproducto where nombre = '$nombre'");
       $consult->execute();

    $data = $consult->fetch(PDO::FETCH_ASSOC);
    $nombres = $data['nombre'];

    if(($nombres ==  "") or ($nombre != $nombres)){

    	
         include("tipoproducto.php");
      $send = new tipoproducto();

      $save = $send->guardar($nombre);
      header("location:mostrar.php?save=true");


      

    }elseif($nombres == $nombre){

     header("location:mostrar.php?save=error");
    }else{
    	header("location:mostrar.php?save=error");
    }
   
  }