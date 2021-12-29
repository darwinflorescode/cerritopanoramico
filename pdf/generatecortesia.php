<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../");
}
if (!empty(intval(@$_GET['id_cortesia']))) {

        $id = intval($_GET['id_cortesia']);
       
    }else{

      $id = 0;
        echo "<script>alert('Lo siento. Existe un error en el proceso!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;
    }

  //hora y fecha
      date_default_timezone_set('America/El_Salvador'); 
    $fecha = date('d-m-Y H:i:s');



require_once  '../conexion/conexion.php'; 
    $conn = conexion();
//consult para seleccionar todos los datos de la venta

    //Consulta a la tabla y le damos un limite
 $command = "SELECT cortesia.cantidad,producto.nombre as nombrepr,cortesia.precio,cortesia.subtotal FROM cortesia inner join producto
  on cortesia.idproducto = producto.idproducto WHERE idorden = '$id'";
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



if ($resultado->rowcount()>0) {
 
}else{
    echo "<script>alert('Lo siento. No existe cortesía a esta venta!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;
}

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT orden.*,usuario.nombre as nombrep,usuario.apellido as apell, cliente.nombre as nom,cliente.apellido as ape,cliente.email,cliente.direccion,cliente.telefono,mesa.numeromesa,concat(mesero.nombre,' ',mesero.apellido) as nombremesero FROM orden inner join usuario on 
    orden.idusuario= usuario.idusuario inner join cliente on orden.idcliente = cliente.idcliente inner join mesa on orden.idmesa = mesa.idmesa inner join mesero on orden.idmesero = mesero.idmesero where idorden = $id";
    $q = $conn->prepare($sql);
    $q->execute(array($id));

    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nombres=$data['nombrep']." ".$data['apell'];
    $tele= $data['telefono'];
    $emai=$data['email'];
   
    $rowcount = $q->rowcount();


    if ($rowcount==0)
    {
    echo "<script>alert('Lo siento. No existe cortesía a esta venta!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

    }


$que ="SELECT sum(subtotal) as totaldinero FROM cortesia  WHERE idorden = $id";
 $q = $conn->prepare($que);
    $q->execute(array($id));

    $dato = $q->fetch(PDO::FETCH_ASSOC);
    $totaldiner=$dato['totaldinero'];


  
$cliente = $data['nom']." ".$data['ape']; 
$dat = date('d-m-y');

$clientefecha =$cliente." ".$dat;






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
          <td a width="30%" style="text-align: right;">Cortes&iacute;a No.<br /><span style="font-weight: bold; font-size: 12pt;">0'.$data['idorden'].'</span></td>
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
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">FACTURA A:</span><br /><br />NOMBRE:&nbsp;'.$data['nom']." ".$data['ape'].'<br />TEL&Eacute;FONO:&nbsp;'.$tele.'<br />E-MAIL:&nbsp;'.$emai.'<br />DIRECI&Oacute;N:&nbsp; '.$data['direccion'].'</td>
<td width="10%">&nbsp;</td>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">RESTAURANTE:</span><br /><br />MESA:&nbsp; '.$data['numeromesa'].'<br />MESERO:&nbsp; '.$data['nombremesero'].'<br />RESPONSABLE VENTA:<br /><u>'.$nombres.'</u></td>
</tr></table>

<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>

<td width="10%">CANTIDAD</td>
<td width="45%">DESCRIPCI&Oacute;N</td>
<td width="20%">PRECIO UNITARIO</td>
<td width="25%">SUBTOTAL PRODUCTO</td>
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
<td class="blanktotal" colspan="2" rowspan="5"></td>
<td class="totals">Total:</td>
<td class="totals cost">$ '.number_format($totaldiner,2).'</td>
</tr>

</tbody>
</table>


<div style="text-align: center; font-style: italic;"><br><center>Cortes&iacute;a Especial!</center><br><br>Restaurante El Cerrito Panor&aacute;mico, km. 6 ½ Carretera Panor&aacute;mica, a 5 minutos Santiago Texacuangos, búscanos como Restaurante El Cerrito Panor&aacute;mico.
Para cualquier detalle comunicarse al 7852-9486, con Francisco Viscarra. <a href="mailto:Visc44@hotmail.com">Visc44@hotmail.com</a></div>


</body>
</html>
';


//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================

//define('_MPDF_PATH','');
include("lib/pdf/mpdf.php");

$mpdf=new mPDF('c','A4','','',15,15,41,41,10,10); 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Cortesía de Venta Para: ".$clientefecha);
$mpdf->SetAuthor("Francisco Viscarra");
$mpdf->SetWatermarkText("Cerrito Panorámico");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';





$mpdf->WriteHTML($html);


$mpdf->Output($clientefecha.'.pdf','I');

exit;

?>