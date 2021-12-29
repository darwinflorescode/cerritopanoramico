<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.

session_start();
if (!$_SESSION["ok"])

{

//Redirecciona al index.php
  header("location:../");
}

//Verifica los datos del modal  que no esten vacios para editar
if (!empty($_POST)) {

  //Guardamos en variables los datos enviados desde el modal
   $id = $_POST['mod_id'];
    $nombre = addslashes($_POST['mod_nombre']);



    

    //incluimos el archivo para hacer la instancia y poder tener acceso a las funciones de editar
      include('tipo.php');
    

    $tip = new tipo();
    
    $guar = $tip->modificar($nombre,$id);
    //redireciona enviando un paramtreo
    header("location: mostrar.php?modify=true");

  }else{

  	header("location: mostrar.php?modify=false");

  }

?>