<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
// Como usuario registrado
session_start();
if (!$_SESSION["ok"])

{

//redirecciona al index
  header("location:../");
}

//Si los datos enviados con el metodo post no son vacios
if(!empty($_POST)){

		include_once('../conexion/conexion.php');

 		$conn = conexion();
//Guardamos en una variable ese dato q viene desde el modal
    $nombre = addslashes($_POST["name"]);
 

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Consulta para verificar si existe una tip de usuario con el mismo nombre
      $consult = $conn->prepare("SELECT * FROM tipousuario where nombre = '$nombre'");
       $consult->execute();
       //guardar datos en una variable
    $data = $consult->fetch(PDO::FETCH_ASSOC);
    $nombres = $data['nombre'];
    // si se cumple esto
    if(($nombres ==  "") or ($nombres != $nombres)){

    	//Instancia al archivo tipo donde se encuentran la funcion de gurdar
         include("tipo.php");
      $send = new tipo();

      $save = $send->guardar($nombre);

        $ql="SELECT max(idtipousuario) as max from tipousuario";
        $preparar=$conn->prepare($ql);
      $preparar->execute();
       //guardar datos en una variable
    $d= $preparar->fetch(PDO::FETCH_ASSOC);
    $idtipomax = $d['max'];






      $sq="INSERT INTO modulos(inicio1,inicio2,inicio3,compra,inventario,evento,restaurante,contacto,venta,reporte,configuracion,admin,idtipousuario) VALUES('','','','','','','','','','','','','$idtipomax');";
      $pre=$conn->prepare($sq);
      $pre->execute();


      header("location:mostrar.php?correcto=guardar");

    





      
      //Sino redirecciona con un parametro de error
    }elseif($nombres == $nombre){

     header("location:mostrar.php?correcto=error");
    }else{
    	header("location:mostrar.php?correcto=error");
    }
   

   //EN este caso verificar el id enviado desde la funcion eliminar
    // en javascript enviado desde el registro q desea eliminar
  }elseif (!empty($_GET['id'])) {
  	$id = $_GET['id'];
    //guardamos en una variable el ID
    //Instancia hacia el archivo donde se encuentra la funcion de eliminar
  	include("tipo.php");
      $enviar = new tipo();

      $save = $enviar->eliminar($id);
      header("location:mostrar.php");
  }else{
  	header("location:mostrar.php?eliminar=error");

  }
?>