<?php 

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}


include_once('../conexion/conexion.php');
    $conn = conexion();

//datos enviados desde el formulario de este mismo archivo pa poder modificar
  if (!empty($_POST)) {

    $ide = $_POST['modal_id'];
   
    $numeromesa = $_POST['modal_numeromesa'];
   $imagen=addslashes(file_get_contents($_FILES['modal_imagenes'] ['tmp_name']));



    $descripcion = $_POST['modal_descripcion'];
    $estado = $_POST['modal_estado'];
        
  # code...

//Intancia para clase cliente a la funcion modificar y envio de datos.
    include('mesa.php');
    
    $mesa = new mesa();
    $send = $mesa->modificar($numeromesa,$imagen,$descripcion, $estado, $ide);
     header("location:mostrar.php?modify=true");

  
  }else{
      header("location:mostrar.php?modify=false");
  } 
?>
