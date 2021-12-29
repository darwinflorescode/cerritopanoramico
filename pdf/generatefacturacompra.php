<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{

  header("location:../");
}

include 'convertidor.php';

if (!empty(intval($_GET['idcompra']))) {

        $id = intval($_GET['idcompra']);
       
    }else{

      $id = 0;
        echo "<script>alert('Su factura no se puede generar!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

    }

  //hora y fecha
      date_default_timezone_set('America/El_Salvador'); 
    $fecha = date('d-m-Y g:i:s A');



require_once  '../conexion/conexion.php'; 
    $conn = conexion();
//consult para seleccionar todos los datos de la compra

    //Consulta a la tabla y le damos un limite
 $command = "SELECT detallecompra.cantidad,productocompra.nombre as nombrepr,detallecompra.precio,detallecompra.subtotal FROM detallecompra inner join productocompra 
 on detallecompra.idproductocompra = productocompra.idproductocompra WHERE idcompra = '$id'";
 //"SELECT detallecompra.cantidad,productocompra.nombre as nombrepr,detallecompra.precio,detallecompra.subtotal FROM detallecompra inner join productocompra  on detallecompra.idproductocompra = productocompra.idproductocompra WHERE idcompra = '$id'";

//Conexion donde ejecuta
$resultado = $conn->prepare($command);
$resultado->execute();
//Total de registros encontrados
$total = $resultado->rowcount();
//array
$data = array();

//Estructura ciclica de repeticion
while($rowss = $resultado->fetch())
{
    $datoss[] = $rowss;
}

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "SELECT compra.*,usuario.nombre as nombre,usuario.apellido as apell, proveedor.nombre as nomp,proveedor.nombrecontacto as nomc, proveedor.email,proveedor.direccion,proveedor.telefono, proveedor.telefonocontacto FROM compra inner join usuario on 
    compra.usuario_idusuario= usuario.idusuario inner join proveedor on compra.idproveedor = proveedor.idproveedor where idcompra = $id";

   /* $sql = "SELECT compra.*,usuario.nombre as nombrep,usuario.apellido as apell, proveedor.nombre as nom,proveedor.nombrecontacto as nomc,proveedor.email,proveedor.direccion,proveedor.telefono, FROM compra inner join usuario on 
    compra.idusuario= usuario.idusuario inner join proveedor on compra.idcompra = proveedor.idproveedor where idcompra = $id";*/

    $q = $conn->prepare($sql);
    $q->execute(array($id));

    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nombres=$data['nombre']." ".$data['apell'];
    $nomb=$data['nomp'];
    $nompro=$data['nomc'];
    $tele= $data['telefono'];
    $emai=$data['email'];
   
    $rowcount = $q->rowcount();


    if ($rowcount==0)
    {
    echo "<script>alert('Su factura no se puede generar!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

    }


$que ="SELECT sum(cantidad) as cant,sum(subtotal) as totaldinero FROM detallecompra  WHERE idcompra = $id";
 $qu = $conn->prepare($que);
    $qu->execute(array($id));

    $dato = $qu->fetch(PDO::FETCH_ASSOC);
    $totaldiner=$dato['totaldinero'];
    $cant=$dato['cant'];
   


    $query ="SELECT * FROM detallecompra  WHERE idcompra = $id";
 $quer= $conn->prepare($query);
    $quer->execute(array($id));

    $pagodata = $quer->fetch(PDO::FETCH_ASSOC);
   
    $idcom=$pagodata['idcompra'];
     

  

$dat = date('d-m-y');

$proveedorfecha =$nomb." ".$nompro." ".$dat;



$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
  font-size: 10pt;
}
p { margin: 0pt; }
table.items {
  border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
  border-left: 0.1mm solid #000000;
  border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
  text-align: center;
  border: 0.1mm solid #000000;
  font-variant: small-caps;
}
.items td.blanktotal {
  background-color: #EEEEEE;
  border: 0.1mm solid #000000;
  background-color: #FFFFFF;
  border: 0mm none #000000;
  border-top: 0.1mm solid #000000;
  border-right: 0.1mm solid #000000;
}
.items td.totals {
  text-align: right;
  border: 0.1mm solid #000000;
}
.items td.cost {
  text-align: "." center;
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table border="0" width="100%" align="center" cellpading="0" cellspacing="0" style="" >
        <tbody><tr>
          <td width="20%" style="text-align: left;" ><img src="../imagenes/cerrito.png" style="width:125px;"> </td>
          <td align="center" width="60%" style="">Restaurante El Cerrito Panor&aacute;mico<br><br>Km. 6 ½ Carretera Panor&aacute;mica<br><br>Tel&eacute;fono: 7690 - 1738 y 7771 - 9993.</td>
          <td a width="30%" style="text-align: right;">Factura de Compra No.<br /><span style="font-weight: bold; font-size: 12pt;">0'.$data['idcompra'].'</span></td>
        </tr>
      </tbody></table>
</htmlpageheader>


<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
P&aacute;gina {PAGENO} de {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<div style="text-align: right">Fecha:&nbsp;'.$fecha.'</div>

<table width="100%" style="font-family: serif;" cellpadding="10"><tr>
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">FACTURA DE PROVEEDOR:</span><br /><br />NOMBRE PROVEEDOR:&nbsp;<span style="border-bottom:1px solid black" align="left">'.$data['nomp'].'</span><br /><br />NOMBRE CONTACTO:&nbsp;<span style="border-bottom:1px solid black" align="left">'.$data['nomc'].'</span><br />TEL&Eacute;FONO:&nbsp;'.$tele.'<br />E-MAIL:&nbsp;'.$emai.'<br />DIRECI&Oacute;N:&nbsp; '.$data['direccion'].'</td>
<td width="10%">&nbsp;</td>
<td>RESPONSABLE COMPRA:<br /><u>'.$nombres.'</u></td>
</tr></table>

<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>

<td width="10%">CANTIDAD</td>
<td width="55%">DESCRIPCI&Oacute;N</td>
<td width="20%">PRECIO UNITARIO</td>
<td width="15%">SUBTOTAL</td>
</tr>
</thead>
<tbody>';

    foreach($datoss as $row)
    {
        $html .='<!-- END ITEMS HERE --><tr>

<td align="center">'.$row['cantidad'].'</td>
<td>'.$row['nombrepr'].'</td>
<td class="cost">$ '.$row['precio'].'</td>
<td class="cost">$ '.$row['subtotal'].'</td>

</tr>';
     }

$html .='
<!-- ITEMS HERE -->



<tr>
<td class="totals cost" colspan="0" ></td>

<td class="totals" style="text-align:left;">TOTAL (LETRAS) <b>'.numtoletras($totaldiner) .'</b></td>
<td class="totals">Subtotal:</td>
<td class="totals cost">$ '.number_format($totaldiner,2).'</td>

</tr>


<tr>
<td></td>
<td></td>
<td class="totals"><b>Total:</b></td>
<td class="totals cost"><b>$ '.number_format($totaldiner,2).'</b></td>
</tr>

</tbody>
</table>





</body>
</html>
';


//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================
/*
define('_MPDF_PATH','');*/
include("lib/pdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',15,15,41,41,10,10); 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Factura de Compra: ".$proveedorfecha);
$mpdf->SetAuthor("Francisco Viscarra");
$mpdf->SetWatermarkText("Cerrito Panorámico");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';





$mpdf->WriteHTML($html);


$mpdf->Output($proveedorfecha.'.pdf','I');

exit;

?>