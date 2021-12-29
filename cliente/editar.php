<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{

//redirecciona al index
  header("location:../");
}

//conexion a la base de datos
include_once('../conexion/conexion.php');
    $conn = conexion();

//Si no vienesn vacios los los campos enviados desde el formulario
  if(!empty($_POST)){
    //Guardamos en variables los datos
    $id = $_POST['modal_id'];
    $nombre = $_POST["modal_nombre"];
    $apellido = $_POST["modal_apellido"];
     $dui = $_POST["modal_dui"];
    $telefono = $_POST["modal_tel"];
    $direccion = $_POST["modal_direccion"];
    $email = $_POST["modal_email"];
     $whatsapp = $_POST["modal_whatsapp"];


//instancia a la clase para tener acceso a la funcion de editar
         include("cliente.php");
      $send = new Cliente();

      $save = $send->editar($nombre, $apellido, $dui, $telefono, $direccion, $email, $whatsapp,$id);
      //redirecciona con prametro 
      header("location:mostrar.php?modify=true");


      
    

  } else{
         header("location:mostrar.php?modify=false");

  }
?> 