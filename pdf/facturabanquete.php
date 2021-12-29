<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../");
}

include 'convertidor.php';
if (!empty(intval(@$_GET['idconfirma']))) {

        $id = intval($_GET['idconfirma']);
       
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
//consult para seleccionar todos los datos de la venta

    //Consulta a la tabla y le damos un limite
 $command = "SELECT detallevento.*,producto.nombre as nombrepr,producto.preciounitario FROM detallevento inner join producto
  on detallevento.idproducto = producto.idproducto WHERE detallevento.idclienteconfirmaevento = '$id'";
//Conexion donde ejecuta
$resultado = $conn->prepare($command);
$resultado->execute();
//Total de registros encontrados
$total = $resultado->rowcount();

    if ($total==0)
    {
    echo "<script>alert('No hay productos que mostrar en el detalle!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

    }

//array
$data = array();

//Estructura ciclica de repeticion
while($rowss = $resultado->fetch())
{
    $datoss[] = $rowss;
}

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT  clienteconfirmaevento.*,concat(cliente.nombre,' ',cliente.apellido) as nombrecliente,cliente.dui,cliente.telefono,cliente.direccion,cliente.email FROM clienteconfirmaevento inner join cliente on clienteconfirmaevento.idcliente=cliente.idcliente where clienteconfirmaevento.idclienteconfirmaevento='$id'";
    $q = $conn->prepare($sql);
    $q->execute(array($id));

    $data = $q->fetch(PDO::FETCH_ASSOC);
    $nombresuser=$data['nombreusuario'];
 

   
    $rowcount = $q->rowcount();


    if ($rowcount==0)
    {
    echo "<script>alert('No hay productos que mostrar en el detalle!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;

    }


$que ="SELECT sum(cantidad) as cant,sum(subtotal) as totaldinero FROM detallevento  WHERE idclienteconfirmaevento = $id";
 $qu = $conn->prepare($que);
    $qu->execute(array($id));

    $dato = $qu->fetch(PDO::FETCH_ASSOC);
    $totaldiner=$dato['totaldinero'];
     $cant=$dato['cant'];
    $mesr = $totaldiner*0.1;

     


  

$dat = date('d-m-y');



if (($data['nombrecliente'] =="& &")) {
 $nombrescompleto ="________________________________<br>";
 $clientefecha ="Cliente no registrado ".$dat;
}else{
  $nombrescompleto=$data['nombrecliente'];
  $clientefecha =$nombrescompleto." ".$dat;
}

if ($data['dui'] == "") {
  $dui ="____________________________________<br>";
}else{
  $dui=$data['dui'];
}

if ($data['telefono'] == "") {
  $telefonos ="______________________________<br>";
}else{
  $telefonos=$data['telefono'];
}

if ($data['email'] == "") {
  $emailes ="_________________________________<br>";
}else{
  $emailes=$data['email'];
}

if ($data['direccion'] == "") {
  $direcciones ="______________________________<br>";
}else{
  $direcciones=$data['direccion'];
}

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
          <td a width="30%" style="text-align: right;">Comprobante de Banquete No.<br /><span style="font-weight: bold; font-size: 12pt;">0'.$data['idclienteconfirmaevento'].'</span></td>
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
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">FACTURA A:</span><br /><br />NOMBRE:&nbsp;'.$nombrescompleto.'<br />DUI:&nbsp;'.$dui.'<br />TEL&Eacute;FONO:&nbsp;'.$telefonos.'<br />E-MAIL:&nbsp;'.$emailes.'<br />DIRECI&Oacute;N:&nbsp; '.$direcciones.'</td>
<td width="10%">&nbsp;</td>
<td width="45%" style="border: 0.1mm solid #888888;"><span style="font-size: 7pt; color: #555555; font-family: sans;">RESTAURANTE:</span><br /><br />RESPONSABLE VENTA:<br /><u>'.$data['nombreusuario'].'</u></td>
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


</tbody>
</table>

Precio total banquete $'.$data['preciototal'] .'
<div style="text-align: center; font-style: italic;"><br><center>Gracias por preferirnos!</center><br><br>Restaurante El Cerrito Panor&aacute;mico, km. 6 ½ Carretera Panor&aacute;mica, a 5 minutos Santiago Texacuangos, búscanos como Restaurante El Cerrito Panor&aacute;mico.
Para cualquier detalle comunicarse al 7852-9486, con Francisco Viscarra. <a href="mailto:'.correoelectronico.'">'.correoelectronico.'</a></div>


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
$mpdf->SetTitle("Comprobante de banquete: ".$clientefecha);
$mpdf->SetAuthor("Francisco Viscarra");
$mpdf->SetWatermarkText("Cerrito Panorámico");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';





$mpdf->WriteHTML($html);


$mpdf->Output($clientefecha.'.pdf','I');

exit;

