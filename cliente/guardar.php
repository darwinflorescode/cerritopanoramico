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

//Metodo post del fomulario del modal guardar
  if(!empty($_POST)){
    //guaramos en variables los datos enviados
    $nombre = $_POST["mod_nombre"];
    $apellido = $_POST["mod_apellido"];
    $dui = $_POST["mod_dui"];
    $telefono = $_POST["mod_tel"];
    $direccion = $_POST["mod_direccion"];
    $email = $_POST["mod_email"];
    $whatsapp = $_POST["mod_whatsapp"];

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
      $consult = $conn->prepare("SELECT * FROM cliente where dui='$dui'");
       $consult->execute();
         $data = $consult->fetch(PDO::FETCH_ASSOC);

    $duis = $data['dui'];


    if($duis > 0){
       header("location:mostrar.php?save=false");
      //Instancia con la clase cliente donde se encuantran las funciones de gurdar
       

    }elseif($duis ==""){

        include("cliente.php");
      $send = new Cliente();

      $save = $send->generate_insert($nombre, $apellido, $dui ,$telefono, $direccion, $email, $whatsapp);
      //redirecciona con paramtro para mostrar un mensaje
      header("location:mostrar.php?save=true");
          
    
    }else{
       header("location:mostrar.php?save=error");
    }

  }else{
      header("location:mostrar.php?save=error");
      }
?> 