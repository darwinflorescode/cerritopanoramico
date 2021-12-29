<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}

// se incluye la conexion con la base de datos
include_once('../conexion/conexion.php');
    $conn = conexion();


  if(!empty($_POST)){

    $id = $_POST['idconfirmar'];

   
  $preciopersona =  $_POST["mod_precio"];
  $cantidadpersona =  $_POST["modal_cantidad"];
  $preciototal =  $_POST["modal_preciototal"];
  $fechaevento =  $_POST["modal_fecha"];
  $horainicio =  $_POST["modal_horainicio"];
  $horafin =  $_POST["modal_horafin"];
  $adelanto =  $_POST["modal_adelanto"];
  $pendiente =  $_POST["modal_pendiente"];
  $cliente =  $_POST["modal_cliente"];
  $eventosespeciales =  $_POST["modal_eventosespeciales"];




// incluye el archivo de la clase donde esta la funcion de modificar
        include("clienteconfirmaevento.php");
      $send = new clienteconfirmaevento();

      $save = $send->modificar($preciopersona, $cantidadpersona, $preciototal, $fechaevento, $horainicio, $horafin, $adelanto, $pendiente, $cliente, $eventosespeciales, $id);
      header("location:mostrar.php?modify=true");
    
    

  } else{
         header("location:mostrar.php?modify=false");

  }
?> 