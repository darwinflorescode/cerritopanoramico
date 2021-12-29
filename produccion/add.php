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

    $modalpro = $_POST['modalpro'];
    $modal_id = $_POST['modalidd'];
    $cantidadnueva = $_POST["modalnuevacantidad"];
        $cantidad = $_POST["modalnuevacant"];
    $total = $_POST["modalnuevototal"];


 
  
         include("produccion.php");
      $send = new produccion();

      $save = $send->add($cantidad,$total,$modal_id);

      $sql = "UPDATE producto SET entrada=entrada+$cantidadnueva,cantidad=cantidad+$cantidadnueva, total='$total' where idproducto = '$modalpro'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
     header("location:mostrar.php?save=true");
  
    
   

  


  

  }else{

      header("location:mostrar.php?save=error");

  } 
?> 