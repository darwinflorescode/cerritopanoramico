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
    $sql = "SELECT usuario.*,tipousuario.nombre as nombu FROM usuario INNER JOIN tipousuario on usuario.idtipousuario=tipousuario.idtipousuario where  fecha BETWEEN '$desde' AND '$hasta' order by idusuario desc";

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

    $sql = "SELECT usuario.*,tipousuario.nombre as nombu FROM usuario INNER JOIN tipousuario on usuario.idtipousuario=tipousuario.idtipousuario order by idusuario desc";

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
<tr style="background-color:#EEEEEE;">
<td colspan="5"><b>Reporte de Usuario<b>&nbsp;&nbsp;&nbsp;' . $total . '&nbsp;&nbsp;&nbsp;registros</td>

<td colspan="3">';
if (($desde == 0) && ($hasta==0)) {
 $html .= $desde.$hasta;
}elseif  (($desde != 0) && ($hasta!=0)){
  $html .= date("d-m-Y", strtotime($desde))."  - ".date("d-m-Y", strtotime($hasta));
}


$html .='</td>


</tr>
<tr style="background-color:#5BE66F;">
<td>ID</td>
<td>Nombre completo </td>
<td>Email</td>
<td>Usuario</td>
<td>fecha de registro</td>
<td>Ingresó Sistema</td>
<td>Tipo Usuario</td>
<td>Estado</td>
</tr>
</thead>

<tbody><!-- END ITEMS HERE -->';
$suma = 0;
if ($total != 0) {
    # code...

    foreach ($model as $row) {

        $suma += $row['idusuario'];
        $html .= '<tr><td>' . $row["idusuario"] . '</td><td>' . $row['nombre'] . " " . $row['apellido'] . '</td>';

        $html .= '<td>' . $row['email'] . '</td>';

        $html .= '<td>' . $row['usuario'] . '</td>';

        $html .= '<td>' . date("d-m-Y", strtotime($row['fecha'])) . '</td>';

        $html .= '<td>' . $row['ultimoingreso'] . '</td>';

        $html .= '<td>' . $row['nombu'] . '</td>';

        $html .= '<td>' . $row['estado'] . '</td>';

        //$html.='<td>'.$row['nomu'].'</td>';//
        $html.="</tr>";

    }

    

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
$mpdf->SetTitle("Reporte usuario ".$fecha);
$mpdf->SetAuthor("Francisco Viscarra");
$mpdf->SetWatermarkText("Cerrito Panorámico");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font    = 'DejaVuSansCondensed';

$mpdf->WriteHTML($html);

$mpdf->Output('Reporte usuario  ' . $fecha . '.pdf', 'I');

exit;
