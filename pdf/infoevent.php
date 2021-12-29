<?php

//Permite solo que ingrese el usuario que ha iniciado sesion.
session_start();
if (!$_SESSION["ok"])

{


  header("location:../");
}

if (!empty(intval($_GET['idevento']))) {

        $id = intval($_GET['idevento']);
       
    }else{

      $id = 0;
        echo "<script>alert('No se encontró Información del evento!')</script>";
   echo " <style type='text/css'> body{ background: url(../imagenes/oscuro.jpg);}  </style>
   <body><center><img align='center' src='../imagenes/cerrito.png'><br><h1>*Lo Siento ha ocurrido un error!!!</h1></center></body>";
    echo "<script>window.close();</script>";
    exit;
    }

date_default_timezone_set('America/El_Salvador'); 
    $fecha = date('d-m-Y g:i:s A');

require_once  '../conexion/conexion.php'; 
    $conn = conexion();
    $consultar = $conn->prepare("SELECT  * FROM eventosespeciales where ideventosespeciales=".$_GET['idevento']."");
                $consultar->execute();

                $dat = $consultar->fetch(PDO::FETCH_ASSOC);

                $idcomprobar=$dat['ideventosespeciales'];
                  $opciones = $dat['opcion'];
                    if ($idcomprobar !=$_GET['idevento']) {
                     echo "<script>window.close();</script>";
                      exit;
                    }


$imprimir="Cotización para eventos:".$opciones.",  ".$fecha;


$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
  font-size: 10pt;
}
#dv{
  text-align:center;
  color:#8B008B;
  background-color:#ADD8E6;
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
       
            Cotizaci&oacute;n<br>
            Para eventos especiales

              
   
            </div><br>

            <div style="background-color:#98FB98;  font-size: 25px;
    line-height: 40px; text-align:center; ">
                '.$opciones.'

              
   
            </div><br>';

            $sql = "SELECT * FROM entradas where ideventosespeciales=".$_GET['idevento']."";

                $quer = $conn->prepare($sql);
                $quer->execute();
                $valorar = $quer->rowcount();

                  if ($valorar!=0) {
                   
                  

                  

            $html .='<center><div  style="background-color:#82E105; font-size: 15px;  text-align:left; ">
             
             <b>ENTRADAS: </b>
            </div>
              <ol >';
            while ($rows = $quer->fetch()) {
               $html.='<div style="text-align:left; width:90%;">
         
              <li style="color:black;">'.$rows['descripcion'].'</li>
          
            </div>';
               }

                }else{
                
               }
                $html.='</ol></center>';
               
            $command = "SELECT * FROM tipoplatillofuerte where ideventosespeciales=".$_GET['idevento']."";

                $sqlcommand = $conn->prepare($command);
                $sqlcommand->execute();
                $ver = $sqlcommand->rowcount();

                  if ($ver!=0) {
                   
          

            $html .='<center><div  style="background-color:#82E105; font-size: 15px;  text-align:left; ">
             
             <b>PLATOS FUERTES: </b>
            </div>
              <ol >';
            while ($filas = $sqlcommand->fetch()) {
               $html.=' <div style="text-align:left; width:90%;">
         
              <li style="color:black;">'.$filas['nombreplatillo'].", ".$filas['descripcion'].'</li>
          
            </div>';
               }
               
           
          $html .='</ol></center>';

        }else{

            }

     $search = $conn->prepare("SELECT  * FROM eventosespeciales where ideventosespeciales='".$_GET['idevento'] ."'");
       $search->execute();

    $datos = $search->fetch(PDO::FETCH_ASSOC);
    $personprice = $datos['preciopersona'];
    $pasteles=$datos['pastel'];
    $postres=$datos['postre'];


  if ($pasteles =="") {
              # code...
            }else{ 

             $html .= '<center><div  style="background-color:#82E105; font-size: 15px;  text-align:left;">
             
             <b>Pastel: </b>
            </div><br><div style="text-align:left; width:83%;">-&nbsp;'.$pasteles.'</div> <br></center>';

            }


           if ($postres =="") {
              # code...
            }else{
              $html.='<center><div  style="background-color:#82E105; font-size: 15px;  text-align:left;">
             
              <b>Postres: </b>
            </div><br>
           
           <div style="text-align:left; width:83%;">-&nbsp;'.$postres.'</div><br></center>';

      
            }



             $comman = "SELECT * FROM tipoadicional where ideventosespeciales=".$_GET['idevento']."";

                $sqlcomman = $conn->prepare($comman);
                $sqlcomman->execute();
                $mostrar = $sqlcomman->rowcount();

                  if ($mostrar!=0) {

                   

            $html .='<center><div  style="background-color:#82E105; font-size: 15px;  text-align:left;">
             
             <b>Adicional: </b>
            </div>
            <div align="left" style="width:90%;"><b>Le incluimos,</b> por el mismo precio de manera especial a <b>Usted</b></div>
              ';
            while ($fil = $sqlcomman->fetch()) {
               $html .=' <div style="text-align:left; width:90%;">-&nbsp;'.$fil['descripcion'].'</div>';
               } 
               
                $html .='<br>';
            if ($personprice==0) {
                # code...
              }else{
          $html .= '<div style="background-color:#CC8EDD;  text-align:center; width:80%;"><b>Precio total por persona, todo incluido. $'.$personprice.'<b></div><br>
        ';

     }
           }else{

            } 

             $com = "SELECT * FROM condiciones where ideventosespeciales=".$_GET['idevento']."";

                $sqlcom = $conn->prepare($com);
                $sqlcom->execute();
                $mostrando = $sqlcom->rowcount();

                  if ($mostrando!=0) {

                   

            $html .='<center><div  style="background-color:#82E105; font-size: 15px; text-align:left;">
             
            <b>Condiciones: </b>
            </div>
            ';

            while ($fi = $sqlcom->fetch()) {
             $html .= '<div style="text-align:left; width:90%;">-&nbsp;'.$fi['descripcion']."</div>";
               } 
               
           
          

        }else{

            }
             $html .='</br></center>';
           
          


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