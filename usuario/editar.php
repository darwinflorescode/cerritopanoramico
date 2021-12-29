<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{
//Redirecciona al index

  header("location:../");
}

//Si elmetodo postdel modl no viene vacioS
if (!empty($_POST)) {
  
   

    //Datos para almacenarlos, enviados desde el formulario
  //Guardamos en variables los datos enviados desde el modal
  $ide = $_POST['mod_id'];
      $nombre = $_POST['mod_nombre'];
    $apellido = $_POST['mod_apellido'];
    $email = $_POST['mod_email'];
     $usuario = $_POST['mod_usuario'];
    $pregunta = $_POST['mod_pregunta'];
    $respuesta = $_POST['mod_respuesta'];
    $idtipousuario = $_POST['mod_tipo'];
    
//incluimos el archivo para hacer instancia a la funcion de editar

      include('usuario.php');
    

    $user = new usuario();
    //Funcion de editar
    $guar = $user->modificar($nombre,$apellido,$email,$usuario,$pregunta,$respuesta,$idtipousuario,$ide);
    //Redirecciona con parametro para mostrar su respectivo messsS
    header("location:mostrar.php?modify=true");
     


    }else{

    	header("location:mostrar.php?modify=false");

    }



?>