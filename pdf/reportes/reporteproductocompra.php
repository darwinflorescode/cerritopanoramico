<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"]) {

    header("location:../");
}

include '../../conexion/conexion.php';
$connection = conexion();

if (!empty(intval($_GET['desde'] != 0)) and !empty(intval($_GET['hasta'] != 0))) {

    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];

//Query con l tabla cliente
    $sql = "SELECT * FROM productocompra where  fecha BETWEEN '$desde' AND '$hasta' order by idproductocompra desc";

    $q = $connection->prepare($sql);
    //Ejecuta la consulta
    $q->execute();
    $total = $q->rowcount();
    $model = array();
    //arrary de datos
    while ($rows = $q->fetch()) {
        $model[] = $rows;
    }

} elseif (!empty(intval($_GET['desde'] == 0)) and !empty(intval($_GET['hasta'] == 0))) {
    $desde = "Todos" . $hasta;

    $sql = "SELECT * FROM productocompra order by idproductocompra desc";

    $q = $connection->prepare($sql);
    //Ejecuta la consulta
    $q->execute();
    $total = $q->rowcount();
    $model = array();
    //arrary de datos
    while ($rows = $q->fetch()) {
        $model[] = $rows;
    }

} else {
    echo "<script>alert('Error. El reporte no puede mostrarse!')</script>";
    echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;
}

//hora y fecha
date_default_timezone_set('America/El_Salvador');
$fecha = date('d-m-Y g:i:s A');

$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
  font-size: 10pt;
}
p { margin: 0pt; }

td { vertical-align: top; }

#ds tr td {
  text-align: center;
  border: 0.1mm solid #000000;

}


</style>

</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
<table border="0" width="100%" align="center" cellpading="0" cellspacing="0" style="" >
        <tbody><tr>
          <td width="20%" style="text-align: left;" ><img src="../../imagenes/cerrito.png" style="width:125px;"> </td>
          <td align="center" width="60%" style="">Restaurante El Cerrito Panor&aacute;mico<br><br>Km. 6 ½ Carretera Panor&aacute;mica<br><br>Tel&eacute;fono: 7690 - 1738 y 7771 - 9993.</td>
          <td a width="30%" style="text-align: right;">Fecha Impresi&oacute;n.<br /><span style="font-weight: bold; font-size: 12pt;">' . $fecha . '</span></td>
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



<br />

<table id="ds" width="100%" style="font-size: 10pt; border-collapse: collapse; " cellpadding="8">

<thead>
<tr style="background-color:#EEEEEE">
<td colspan="7"><b>Reporte de Producto Compra<b>&nbsp;&nbsp;&nbsp;' . $total . '&nbsp;&nbsp;&nbsp;registros</td>

<td colspan="1">';
if (($desde == 0) && ($hasta==0)) {
 $html .= $desde.$hasta;
}elseif  (($desde != 0) && ($hasta!=0)){
  $html .= date("d-m-Y", strtotime($desde))."  - ".date("d-m-Y", strtotime($hasta));
}


$html .='</td>



</tr>
<tr style="background-color:#5BE66F;">
<td>ID</td>
<td>Nombre</td>
<td>Descripci&oacute;n</td>
<td>Cantidad</td>
<td>Precio Unitario</td>
<td>Total</td>
<td>Estado</td>
<td>fecha de ingreso</td>
</tr>
</thead>

<tbody><!-- END ITEMS HERE -->';

$sumac  = 0;
$suma   = 0;
$sumast = 0;
if ($total != 0) {
    # code...

    foreach ($model as $row) {

        $suma += $row['preciounitario'];
        $sumac += $row['cantidad'];
        $sumast += $row['total'];
        $html .= '<tr><td>' . $row["idproductocompra"] . '</td><td>' . $row['nombre'] . '</td>

       <td>' . $row['descripcion'] . '</td>';

        $html .= '<td style="background-color:#EEEEEE">' . $row['cantidad'] . '</td>';
        $html .= '<td style="background-color:#EEEEEE">$' . number_format($row['preciounitario'],2) . '</td>';
        $html .= '<td style="background-color:#EEEEEE">$' . number_format($row['total'],2) . '</td>';
        $html .= '<td>' . $row['estado'] . '</td>';

        $html .= '<td>' . date("d-m-Y", strtotime($row['fecha'])) . '</td></tr>';

    }
    $html .= '<tr><td align="right" colspan="3">Totales </td><td style="background-color:#EEEEEE">' . $sumac . '</td><td style="background-color:#EEEEEE" >$' . number_format($suma,2) . '</td><td style="background-color:#EEEEEE">$' . number_format($sumast,2) . '</td><td colspan="2"></td></tr>';

} else {

    echo "<script>alert('Error. No se encontraron datos que mostrar!')</script>";
    echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;
}


$html .= '




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

//define('_MPDF_PATH', '');
include "../lib/pdf/mpdf.php";

$mpdf = new mPDF('c', 'A4', '', '', 15, 15, 41, 41, 10, 10);
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Reporte Producto Compra ".$fecha);
$mpdf->SetAuthor("Francisco Viscarra");
$mpdf->SetWatermarkText("Cerrito Panorámico");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font    = 'DejaVuSansCondensed';

$mpdf->WriteHTML($html);

$mpdf->Output('Reporte Producto Compra  ' . $fecha . '.pdf', 'I');

exit;
