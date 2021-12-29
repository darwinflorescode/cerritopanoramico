<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}

   require'../conexion/conexion.php';
  $conn = conexion();

//conexion ala base de datos
  


  if (!empty($_POST)) {
  
    $id =$_POST['id'];
    $nombre_empresa = $_POST['mod_nomedit'];
    $codigo = $_POST['mod_codedit'];
    $telefono = $_POST['mod_teledit'];
    $email = $_POST['mod_emailedit'];
    $direccion = $_POST['mod_direccionedit'];
     $nombre_contacto = $_POST['mod_nombredit'];
    $telcont = $_POST['mod_telecedit'];


      //Instancia para almacenar los datos
      include('proveedor.php');
    $provee = new Provider();
    
    $sendParam = $provee->edit($nombre_empresa, $codigo, $telefono, $email, $direccion, $nombre_contacto, $telcont, $id);
    
header("location:mostrar.php?modify=true");
    
  }else{
    header("location:mostrar.php?modify=false");
  }

  ?>