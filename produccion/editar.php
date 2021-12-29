<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}

 

  if(!empty($_POST)){

    
    $modal_id = $_POST['modal_id'];
    $fechaven = $_POST["modal_fecha"];
    $id_producto = $_POST["modal_producto"];
        $cantidad = $_POST["modal_cantidad"];
    $precio = $_POST["modal_precio"];
    $total = $_POST["modal_total"];

 include_once('../conexion/conexion.php');
    $conn = conexion();




      
      $qg = $conn->prepare("SELECT * FROM produccion WHERE idproduccion = '$modal_id'");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $cant = $data['cantidad'];
   
 
  
         include("produccion.php");
      $send = new produccion();

      $save = $send->modificar($fechaven, $cantidad, $precio, $total,$id_producto,$modal_id);

      $sql = "UPDATE producto SET cantidad=(cantidad-$cant)+$cantidad, entrada=(entrada-$cant)+$cantidad,preciounitario='$precio', 
    total=cantidad*'$precio',fechav='$fechaven' where idproducto = '$id_producto'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

     header("location:mostrar.php?modify=true");
  
    
   

  


  

  }else{

      header("location:mostrar.php?modify=error");

  } 
?> 