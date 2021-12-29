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

    $id = $_POST['idconfirmarcancelacion'];

   
  $nuevototal =  $_POST["nuevototal"];


$sql ="UPDATE clienteconfirmaevento SET preciototal='$nuevototal', estado='Cancelado' WHERE idclienteconfirmaevento='$id'";
$cons=$conn->prepare($sql);
$cons->execute();
      header("location:mostrar.php?modify=true");
    
    

  } else{
         header("location:mostrar.php?modify=false");

  }
?> 