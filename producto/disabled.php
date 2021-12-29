<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}


if (!empty($_POST)) {
  
   

    //Datos para almacenarlos, enviados desde el formulario
  $ide = $_POST['mod_aid'];
  
    $razon = $_POST['mod_razonp'];
    $estado = $_POST['mod_estadop'];

    require_once('../conexion/conexion.php');
    $conn = conexion();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $sql = "UPDATE producto SET  estado = '$estado',razon= '$razon' where idproducto = '$ide'";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
    
  
    header("location:mostrar.php?active=true");

     


    }else{

    	header("location:mostrar.php?active=false");

    }



?>