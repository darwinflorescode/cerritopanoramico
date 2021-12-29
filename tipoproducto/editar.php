<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}
if (!empty($_POST)) {

   $id = $_POST['mod_idp'];
    $nombre = $_POST['mod_nombrep'];

    


      include('tipoproducto.php');
    

    $tip = new tipoproducto();
    
    $guar = $tip->modificar($nombre,$id);
    header("location: mostrar.php?modify=true");

  }else{

  	header("location: mostrar.php?modify=false");

  }

?>