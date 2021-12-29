<?php
//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../index.php");
}


if(!empty ($_POST)){
  //incluimos de nuevo la conexion ya que va dentro de una condicion
  require_once'../conexion/conexion.php';
$conn= conexion();

//datos capturados en el formulario para almacenar los datos
$numeromesa = $_POST["mod_numeromesa"];
$imagen=addslashes(file_get_contents($_FILES['mod_imagen'] ['tmp_name']));
  $descripcion = $_POST["mod_descripcion"];
  
 
    $sql = "SELECT * FROM mesa where numeromesa = '$numeromesa'";
    $q = $conn->prepare($sql);
    $q->execute();

    $data = $q->fetch(PDO::FETCH_ASSOC);

    $num = $data['numeromesa'];

    if ($num == $numeromesa) {
      header("location:mostrar.php?save=false");
    }else{

// llamamos el archivo de nuestra clase mesa en el que se encuentran las funciones
  include ("mesa.php");

 $send = new mesa();
  $save =$send->guardar($numeromesa,$imagen,$descripcion);
  header("location:mostrar.php?save=true");
}

}else{
    header("location:mostrar.php?save=error");
}
?>