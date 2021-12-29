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

    

    $fechaven = $_POST["mod_fechad"];
    $id_producto = $_POST["idpro"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];
    $total = $_POST["total"];

  

     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $qg = $conn->prepare("SELECT idproducto,max(fechaproduccion) as fechap FROM `produccion` WHERE idproducto = $id_producto");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $d = $data['idproducto'];
    $f = $data['fechap'];

    date_default_timezone_set('America/El_Salvador'); 
    $fech = date('Y-m-d');

    if ($fech == $f) {
         header("location:mostrar.php?save=false");
   
    }elseif (($fech != $f) || ($f =="")) {
  
         include("produccion.php");
      $send = new produccion();

      $save = $send->guardar($fechaven, $cantidad, $precio, $total,$id_producto);

      $sql = "UPDATE producto SET entrada=entrada+'$cantidad',cantidad=cantidad+'$cantidad', preciounitario='$precio', 
    total=cantidad*'$precio',fechav='$fechaven' where idproducto = '$id_producto'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
     header("location:mostrar.php?save=true");
    }
    
   

  


  

  }else{

      header("location:mostrar.php?save=error");

  } 
?> 