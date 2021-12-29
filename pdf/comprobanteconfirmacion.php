<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../");
}

if (!empty(intval($_GET['ideventoconfirmacion']))) {

        $id = intval($_GET['ideventoconfirmacion']);
        $idconfirma = intval($_GET['idconfirma']);

       
    }else{
echo "<script>alert('Su comprobante no se puede generar!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";

    exit;
    }

date_default_timezone_set('America/El_Salvador'); 
    $fecha = date('d-m-Y g:i:s A');

require_once  '../conexion/conexion.php'; 
    $conn = conexion();
    $comm="SELECT clienteconfirmaevento.*,concat(cliente.nombre,' ',cliente.apellido) as nombrecliente,cliente.dui,cliente.direccion,cliente.telefono FROM clienteconfirmaevento inner join cliente on clienteconfirmaevento.idcliente=cliente.idcliente where clienteconfirmaevento.idclienteconfirmaevento='$idconfirma'";
    $preparar=$conn->prepare($comm);
    $preparar->execute();

    $datosconfirma=$preparar->fetch();

    $idconfirmacion=$datosconfirma['idclienteconfirmaevento'];
    $nombrec=$datosconfirma['nombrecliente'];
    $dui =$datosconfirma['dui'];
    $direccion=$datosconfirma['direccion'];
    $telefono=$datosconfirma['telefono'];
    $preciototal =$datosconfirma['preciototal'];
    $cantidadpersona=$datosconfirma['cantidadpersona'];
    $adelanto=$datosconfirma['adelanto'];
    $pendiente=$datosconfirma['pendiente'];
      $fechaevento= date("d-m-Y", strtotime($datosconfirma['fecha']));
       $horainicio= date("g:i A", strtotime($datosconfirma['horainicio']));
      $horafin= date("g:i A", strtotime($datosconfirma['horafin']));


    if (($idconfirmacion!=$_GET['idconfirma']) || ($idconfirmacion=="")) {

      echo "<script>alert('Su comprobante no se puede generar!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit();
      # code...
    }




    $consultar = $conn->prepare("SELECT  * FROM eventosespeciales where ideventosespeciales=".$_GET['ideventoconfirmacion']."");
                $consultar->execute();

                $dat = $consultar->fetch(PDO::FETCH_ASSOC);

                $idcomprobar=$dat['ideventosespeciales'];
                  $opciones = $dat['opcion'];
                    if (($idcomprobar!=$_GET['ideventoconfirmacion']) || ($idcomprobar=="")) {
                    echo "<script>alert('Su comprobante no se puede generar!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
                      exit;
                    }


$imprimir="Contrato de prestación de servicios: Evento ".$opciones.",  ".$fecha;


$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
  font-size: 10pt;
}
#dv{
  text-align:center;
 
  width:100%;
  font-size: 30px;
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
          <td a width="30%" style="text-align: right;"></td>
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
<div id="dv">
       
          
Contrato de Prestación de servicios
              
   
            </div><br>';

            $html.='<br><div style="text-align: font-size: 5%, center; font-style: arial;">Nosotros:<b> OSCAR FRANCISCO MARTÍNEZ VISCARRA </b>de  _______  años de edad, con domicilio en San Francisco Chinameca, Departamento de La paz, con Documento Único de Identidad Numero: cero uno dos uno cero cinco ocho cuatro- cero, actuando en calidad de representante de Restaurante El Cerrito Panorámico, ubicado en el kilómetro seis y medio de La Carretera Panorámica, en la jurisdicción de San Francisco Chinameca, que en lo sucesivo se denomina el contratado, y <b> '.$nombrec.'</b> con domicilio en, _____________________ con Documento Único de Identidad Numero:  <b><u>'.$dui.'</u></b> ; dirección particular: '.$direccion.' del municipio de __________________________ y numero de tel&eacute;fono:<b><u> '.$telefono.'</u> </b> , el cual actúa en representación propia, que en lo sucesivo se denominara el contratante. Convenimos celebrar el presente contrato de prestación de servicios alimenticios,  en el evento denominado: _____________________ , sujeto a las siguientes clausulas:<br> <b>I-</b>&nbsp; Restaurante El Cerrito Panorámico se compromete a prestar el local por un periodo no mayor a las 5 horas a partir de las '.$horainicio.' hasta las '.$horafin.' en la fecha '.$fechaevento.'. Los servicios incluyen:<br> ___________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________<br> <b>II-</b>______________________________________________________________________________________________________________________________________________________________________________________ <br> <b>III- </b> El valor total por el servicio antes mencionado es de $ '.$preciototal. ' &nbsp;atención para '.$cantidadpersona.' &nbsp;personas adultas y _________ niños/as. Cancelando el contratante a la firma del presente contrato la cantidad de $ '.$adelanto.'  en concepto de adelanto y el resto '.$pendiente.' inmediatamente después de terminado el evento.<br><b>IV-</b>
            ______________________________________________________________________________________________________________________________________________________________________________________<br><b>V-</b>
            ______________________________________________________________________________________________________________________________________________________________________________________<br><b>VI-</b>
            ________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________<br><b>VII-</b>
            ________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________<br><br><br><br><br><br><br>F.___________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F.__________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Francisco Viscarra&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$nombrec.'
            <br>Representante de El Restaurante Cerrito Panorámico&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contratante</div>

';


            
           
          


$html.='<div style="text-align: font-size: 1%; center; font-style: italic;"><br><br><br>Restaurante El Cerrito Panor&aacute;mico, km. 6 ½ Carretera Panor&aacute;mica, a 5 minutos Santiago Texacuangos, búscanos como Restaurante El Cerrito Panor&aacute;mico.
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
$mpdf->SetTitle($imprimir);
$mpdf->SetAuthor("Francisco Viscarra");
$mpdf->SetWatermarkText("Cerrito Panorámico");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';





$mpdf->WriteHTML($html);


$mpdf->Output($imprimir.'.pdf','I');

exit;

?>