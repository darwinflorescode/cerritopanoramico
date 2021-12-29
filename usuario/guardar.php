<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{

//Redirecciona al index
  header("location:../");
}

//incuye la conexion para hacer la instancia
include_once('../conexion/conexion.php');
    $conn = conexion();

    // Si el metodo post del formulario del modal no viene vacio

if (isset($_POST)) {
  
   

    //Datos para almacenarlos, enviados desde el formulario
  //Guaardamos los datos en variables 
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
     $usuario = $_POST['usuario'];
     $clave = $_POST['clave'];
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];
    $idtipousuario = $_POST['idtipo'];
    


  //Selecciona dui o email de la tabla cliente para comparar si ya existe un cliente con ese dui, email
    // para no poder registrarlo ya que es unico.
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //Consulta para q nose repita el correo del mismo usuariio
      $qg = $conn->prepare("SELECT * FROM usuario where usuario = '$usuario' or email = '$email'");
       $qg->execute();
//guardar datos en variables
    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $d = $data['usuario'];
   $e = $data['email'];




    if ($email == $e) {

     header("location:mostrar.php?save=email");

    }elseif ($usuario==$d) {
      header("location:mostrar.php?save=user");
       

    }else{
///Instancia hacia el archivo usuario para llamar a la funcion de guardar

      include('usuario.php');
    

    $user = new usuario();
    
    $guar = $user->guardar($nombre,$apellido,$email,$usuario,md5($clave),$pregunta,$respuesta,$idtipousuario);
    
    header("location:mostrar.php?save=true");
 

  
  }
}

?>
