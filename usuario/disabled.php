<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{

//Redirecciona al index
  header("location:../");
}
//Si el metodo post no viene vacio desde el modal

if (!empty($_POST)) {
  
   

    //Datos para almacenarlos, enviados desde el formulario
  $ide = $_POST['mod_aid'];
  // Guardamos datos que vienen desde los input desde el modal
    $razon = $_POST['mod_arazon'];
    $estado = $_POST['mod_aestado'];
//requerimos la conexion pra instanciarla
    require_once('../conexion/conexion.php');
    $conn = conexion();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Queru update activar o desactivar usuario con su comentario
  $sql = "UPDATE usuario SET intentos=0, bloqueado=0, estado = '$estado',razon= '$razon' where idusuario = '$ide'";

//Ejecuta el query
  $stmt = $conn->prepare($sql);
  $stmt->execute();
    
  //Redirecciona con parametro para enviar menjaje
    header("location:mostrar.php?active=true");

     


    }else{

    	header("location:mostrar.php?active=false");

    }



?>