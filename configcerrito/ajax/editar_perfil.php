<?php
session_start();
if (!$_SESSION["ok"]) {

//redirecciona al index.php del sistema o login si no existe la session
    header("location:../");

} else {

}
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
  if (!empty($_POST)) {
       require_once'../../conexion/conexion.php';
$conn= conexion();
//datos capturados en el formulario para almacenar los datos
$nombre_restaurante = $_POST["nombre_restaurante"]; 
$telefono = $_POST["telefono"];
$email = $_POST["email"];
$direccion = $_POST["direccion"];


$departamento = $_POST["departamento"];
$radios = $_POST["optionsRadios"];

 $sql = "UPDATE perfil SET nombrerestaurante='$nombre_restaurante',telefonos='$telefono',correoelectronico='$email',direccion='$direccion',departamento='$departamento',color='$radios' WHERE idperfil='1';";
        $oo               = $conn->prepare($sql);
        $query_new_insert = $oo->execute();

        if ($query_new_insert) {
        	header('location:../config.php?perfil=true');
        }else{
        	header('location:../config.php?perfil=false');
        }
    
    

  }else{
  	header('location:../config.php');
  }
?>