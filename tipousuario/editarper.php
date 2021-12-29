<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.

session_start();
if (!$_SESSION["ok"])

{

//Redirecciona al index.php
  header("location:../");
}

//Verifica los datos del modal  que no esten vacios para editar
if (!empty($_POST)) {

  //Guardamos en variables los datos enviados desde el modal
   $id = $_POST['idtipouser'];

   $inicio1='';
   $inicio2='';
   $inicio3='';
   $compra='';
   $inventario='';
   $evento='';
   $restaurante='';
   $contacto='';
   $venta='';

   $reporte='';
   $configuracion='';
   $admin='';

   $permiso1 = addslashes($_POST['permiso1']);
    $inicio1 = addslashes(@$_POST['inicio1']);
    $uno=$permiso1.$inicio1;


$permiso2 = addslashes($_POST['permiso2']);
$inicio2      = addslashes(@$_POST['inicio2']);
  $dos=$permiso2.$inicio2;

$permiso3 = addslashes($_POST['permiso3']);
$inicio3   = addslashes(@$_POST['inicio3']);
$tres=$permiso3.$inicio3;


$permiso4 = addslashes($_POST['permiso4']);
$compra = addslashes(@$_POST['compra1']);
$cuatro=$permiso4.$compra;

$permiso5 = addslashes($_POST['permiso5']);
$inventario    = addslashes(@$_POST['inventario1']);
$cinco=$permiso5.$inventario;


$permiso6 = addslashes($_POST['permiso6']);
$evento = addslashes(@$_POST['evento1']);
$seis=$permiso6.$evento;

$permiso7 = addslashes($_POST['permiso7']);
$restaurante = addslashes(@$_POST['restaurante1']);
$siete=$permiso7.$restaurante;

$permiso8 = addslashes($_POST['permiso8']);
$contacto = addslashes(@$_POST['contacto1']);
$ocho=$permiso8.$contacto;

$permiso9 = addslashes($_POST['permiso9']);
$venta=addslashes(@$_POST['venta1']);
$nueve =$permiso9.$venta;

$permiso10 = addslashes($_POST['permiso10']);
$reporte=addslashes(@$_POST['reporte1']);
$diez=$permiso10.$reporte;

$permiso11 = addslashes($_POST['permiso11']);
$adminuser=addslashes(@$_POST['adminuser1']);
$once=$permiso11.$adminuser;

$permiso12 = addslashes($_POST['permiso12']);
$configuracion=addslashes(@$_POST['configuracion1']);
$doce=$permiso12.$configuracion;
include '../conexion/conexion.php';
$conn=conexion();

$sql ="UPDATE modulos SET inicio1='$uno',inicio2='$dos',inicio3='$tres',compra='$cuatro',inventario='$cinco',evento='$seis',restaurante='$siete',contacto='$ocho',venta='$nueve',reporte='$diez',configuracion='$doce',admin='$once' WHERE idtipousuario ='$id' ";
echo $sql;
$prepa=$conn->prepare($sql);
$prepa->execute();
 header("location: mostrar.php?modify=true");

  }else{

  	header("location: mostrar.php?modify=false");

  }

?>