<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}



  if(!empty($_POST)){
     $usuarios =  $_POST["usuario"];
  $preciopersona =  $_POST["mod_precio"];
  $cantidadpersona =  $_POST["mod_cantidad"];
  $preciototal =  $_POST["mod_preciototal"];
  $fechaevento =  $_POST["mod_fecha"];
  $horainicio =  $_POST["mod_horainicio"];
  $horafin =  $_POST["mod_horafin"];
  $adelanto =  $_POST["mod_adelanto"];
  $pendiente =  $_POST["mod_pendiente"];
  $cliente =  $_POST["mod_cliente"];
  $eventosespeciales =  $_POST["mod_eventosespeciales"];


   include_once('../conexion/conexion.php');
    $conn = conexion();

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $consultador = $conn->prepare("SELECT * FROM clienteconfirmaevento where fecha = '$fechaevento' and horainicio='$horainicio'");
       $consultador->execute();
       $validando = $consultador->rowcount();

       if ($validando) {
          header("location:mostrar.php?save=false");

        }else
        { 
      $consult = $conn->prepare("SELECT * FROM clienteconfirmaevento where idcliente = '$cliente' and ideventosespeciales='$eventosespeciales' and fecha='$fechaevento'");
       $consult->execute();
       $validar = $consult->rowcount();

  


    if ($validar) {
      header("location:mostrar.php?save=false");


     
    }else{

       // se incluye el archivo que tiene la clase con las funciones de guardar
 include ("clienteconfirmaevento.php");

  $send = new clienteconfirmaevento();
  $save =$send->guardar($usuarios,$preciopersona, $cantidadpersona, $preciototal, $fechaevento, $horainicio, $horafin, $adelanto, $pendiente, $cliente, $eventosespeciales);
      header("location:mostrar.php?save=true");

     

      }


          
        }


  }else {
    header("location:mostrar.php?save=false");
    
  } 
?> 