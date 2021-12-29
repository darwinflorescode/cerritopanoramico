<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}


include_once('../conexion/conexion.php');
    $conn = conexion();


  if(!empty($_POST)){
    $id = $_POST['idp'];
    $nombre = $_POST["modal_nombre"];
  $tipomenu = $_POST["modal_tipomenu"];
  $idtipoproducto =  $_POST["modal_tipoproducto"];
   $descripcion = $_POST["modal_descripcion"];



         include("producto.php");
      $send = new producto();

      $save = $send->modificar($nombre, $tipomenu, $idtipoproducto, $descripcion,$id);
      header("location:mostrar.php?modify=true");


      
    

  } else{
         header("location:mostrar.php?modify=false");

  }
?> 