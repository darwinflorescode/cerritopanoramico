<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.

session_start();
if (!$_SESSION["ok"])

{

//redirecciona al index
  header("location:../");
}

//Si no esta vacio
if (!empty($_POST)) {
  
   

    //Datos para almacenarlos, enviados desde el formulario
  $ide = $_POST['mod_passid'];
  
    $pass1 = $_POST['mod_passclave'];
    $pass2 = $_POST['mod_passclave1'];

//guardamos en variables los datos enviados


// Si es igual la contraseña repetida
    if ($pass1 == $pass2) {
      //Include la conexion para instanciarla
      require_once('../conexion/conexion.php');
    $conn = conexion();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Query update clave
  $sql = "UPDATE usuario SET intentos=0, bloqueado=0, clave = md5('$pass1') where idusuario = '$ide'";

  $stmt = $conn->prepare($sql);
  //ejecuta query
  $stmt->execute();
    
  //redireccina con paramtro para enviar el respectivo mensaje
    header("location:mostrar.php?change=true");
     
    }else{
        header("location:mostrar.php?change=false");

    }

    

     


    }else{

    	header("location:mostrar.php");

    }



?>