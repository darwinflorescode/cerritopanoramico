<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}


if (!empty($_POST)) {
  
   

    //Datos para almacenarlos, enviados desde el formulario
  $ide = $_POST['modid'];
  
    $razon = $_POST['modrazon'];
    $estado = $_POST['modestado'];

    require_once('../conexion/conexion.php');
    $conn = conexion();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $sql = "UPDATE proveedor SET  estado = '$estado',razon= '$razon' where idproveedor = '$ide'";

  $stmt = $conn->prepare($sql);
  $stmt->execute();
    
  
    header("location:mostrar.php?active=true");

     


    }else{

    	header("location:mostrar.php?active=false");

    }



?>