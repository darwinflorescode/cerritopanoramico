<?php

include("../menu/header.php");
if ($evento=="evento1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }


//Permite solo que ingrese el usuario que ha iniciado sesion.

if (!$_SESSION["ok"])

{


  header("location:../index.php");
}



include_once('../conexion/conexion.php');
    $conn = conexion();
if (isset($_POST['accion'])) {

    $ideven = $_POST['ideventos'];
  $descripcionpastel = $_POST['descripcionpastel'];
    $descripcionpostre = $_POST['descripcionpostre'];
      $preciopersona = $_POST['preciopersona'];


    

       	$update = $conn->prepare("UPDATE eventosespeciales SET pastel='$descripcionpastel',postre='$descripcionpostre',preciopersona='$preciopersona' where ideventosespeciales='$ideven'");
       	if ($update->execute()) {
          echo "<script>location.href='step6.php?idevento=".$ideven."&message=add'; </script> ";
        }else{
           echo "<script>location.href='step6.php?idevento=".$ideven."&message=error'; </script> ";
        }


    

     




 

}else{
	




?>


  


<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<section class="content">
<div class="row">
 
<div class="col-md-20">
<form class="form-horizontal" action="step6.php" method="POST" accept-charset="utf-8"   autocomplete="off" role="form" >
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class=""><a href="crearevento.php" data-toggle="" aria-expanded="false">Nuevo Evento</a></li>
<li class=""><a  href="step2.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Entradas. Paso 2 </a></li>
<li class=""><a href="step3.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Platillos Fuertes. Paso 3 </a></li>
<li class=""><a href="step4.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Adicional Incluye. Paso 4 </a></li>
<li class=""><a href="step5.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Condiciones. Paso 5 </a></li>
<li class="active"><a href="step6.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Asignar Precio. Paso 6 </a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">

<?php 
  $search = $conn->prepare("SELECT  * FROM eventosespeciales where ideventosespeciales='".$_GET['idevento'] ."'");
       $search->execute();

    $datos = $search->fetch(PDO::FETCH_ASSOC);
    $personprice = $datos['preciopersona'];
    $pasteles=$datos['pastel'];
    $postres=$datos['postre'];

if ($personprice == 0.00) {
 

 ?>

<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Descripci&oacute;n de Pastel:</label>
<div class="col-sm-9">
<input type="hidden" name="ideventos" id="ideventos" value="<?php echo $_GET['idevento']; ?>">
<textarea class="form-control"  name="descripcionpastel"  Placeholder="Ingrese una descripci&oacute;n de del pastel. Si desea agregar al evento"></textarea>

</div>

</div>


<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Descripci&oacute;n de Postre:</label>
<div class="col-sm-9">
<textarea class="form-control"  name="descripcionpostre"  Placeholder="Ingrese una descripci&oacute;n del postre. Si desea agregar al evento"></textarea>

</div>

</div>

<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Precio total, Todo incluido $:</label>
<div class="col-sm-9">
<input type="text" placeholder="Ingrese un precio total todo incluido del evento creado.  De acuerdo a lo considerado" name="preciopersona" class="form-control" required>

</div>

</div>

<?php if (!empty($_GET['message'])):
$message=$_GET['message'];

if ($message=="add") {

  echo '<center>
<div class="alert alert-success alert-dismissable"style="width:66%;">
            Agregado Correctamente
   
            </div>
</center>';
  # code...
}elseif ($message=="error") {
   echo '<center>
<div class="alert alert-danger alert-dismissable"style="width:66%;">
            Error. Se repiti&oacute; la descripci&oacute;n   
            </div>
</center>';
}else
{

}

 ?>


  
<?php endif ?>


<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label"></label>
<div class="col-sm-4">
 <button type="submit" class="btn btn-primary" name="accion"><span class="fa fa-save"></span>&nbsp;Agregar</button>
 
 </div></div>

 <?php
}else{

  ?>
  <center><div class="alert alert-success alert-dismissable" style=" width:90%;">
           Has finalizado. Deseas Imprimir?. <a target="_blank" href="../pdf/infoevent.php?idevento=<?php echo $_GET['idevento']; ?>" class="badge label-info"> <span class="fa fa-print"></span>&nbsp;Imprimir</a>
   
            </div></center>

            <?php 

}


  if (!empty($_GET['idevento'])) {

 	$idev=$_GET['idevento'];

 	if (($idev!="") || ($idev!=0)) {

    ?>
 





     
    <center><div class="alert alert-dismissable" style="background-color:#ADD8E6; width:90%;">
            <font size="4" color="#8B008B">   <center> Cotizaci&oacute;n </center>
              <center> Para eventos especiales</center>

              </font>
   
            </div>

             <div class="alert" style="background-color:#98FB98; width:90%;">
             <?php
              $consultar = $conn->prepare("SELECT  * FROM eventosespeciales where ideventosespeciales=".$_GET['idevento']."");
                $consultar->execute();

                $dat = $consultar->fetch(PDO::FETCH_ASSOC);

                $idcomprobar=$dat['ideventosespeciales'];
                  $opciones = $dat['opcion'];
                    if ($idcomprobar !=$_GET['idevento']) {
                     echo "<script>location.href='crearevento.php'; </script> ";
                    }

                   ?>


             
              <center> <?php echo $opciones; ?> </center>
            </div></center>

            <?php $sql = "SELECT * FROM entradas where ideventosespeciales=".$_GET['idevento']."";

                $quer = $conn->prepare($sql);
                $quer->execute();
                $valorar = $quer->rowcount();

                  if ($valorar!=0) {
                   
                  

                   ?>

            <center><div  style="background-color:#82E105;  text-align:left; width:90%;">
             
             <font size="3" color="black"> <b>ENTRADAS: </b></font>
            </div>
              <ol >
            <?php while ($rows = $quer->fetch()) {
               echo ' <div style="text-align:left; width:90%;">
         
              <li style="color:black;">'.$rows['descripcion'].'</li>
          
            </div>';
               } ?>
               
           
          </ol></center>






<?php 
}else{

}

 $command = "SELECT * FROM tipoplatillofuerte where ideventosespeciales=".$_GET['idevento']."";

                $sqlcommand = $conn->prepare($command);
                $sqlcommand->execute();
                $ver = $sqlcommand->rowcount();

                  if ($ver!=0) {
                   
                  

                   ?>

            <center><div  style="background-color:#82E105;  text-align:left; width:90%;">
             
             <font size="3" color="black"> <b>PLATOS FUERTES: </b></font>
            </div>
              <ol >
            <?php while ($filas = $sqlcommand->fetch()) {
               echo ' <div style="text-align:left; width:90%;">
         
              <li style="color:black;">'.$filas['nombreplatillo'].", ".$filas['descripcion'].'</li>
          
            </div>';
               } ?>
               
           
          </ol></center>

          <?php  }else{

            } ?>


            <?php if ($pasteles =="") {
              # code...
            }else{ ?>
              <center><div  style="background-color:#82E105;  text-align:left; width:90%;">
             
             <font size="3" color="black"> <b>Pastel: </b></font>
            </div>
           
            <?php   echo ' <div style="text-align:left; width:83%;">-&nbsp;'.$pasteles."</div>"; ?>
              

  <br>

          </center>

            <?php 
            }


           if ($postres =="") {
              # code...
            }else{ ?>
              <center><div  style="background-color:#82E105;  text-align:left; width:90%;">
             
             <font size="3" color="black"> <b>Postres: </b></font>
            </div>
           
            <?php   echo ' <div style="text-align:left; width:83%;">-&nbsp;'.$postres."</div>"; ?>
              

  <br>

          </center>

            <?php 
            }

             $comman = "SELECT * FROM tipoadicional where ideventosespeciales=".$_GET['idevento']."";

                $sqlcomman = $conn->prepare($comman);
                $sqlcomman->execute();
                $mostrar = $sqlcomman->rowcount();

                  if ($mostrar!=0) {

                   ?>

            <center><div  style="background-color:#82E105;  text-align:left; width:90%;">
             
             <font size="3" color="black"> <b>Adicional: </b></font>
            </div>
            <div align="left" style="width:90%;"><b>Le incluimos,</b> por el mismo precio de manera especial a <b>Usted</b></div><br>
              
            <?php while ($fil = $sqlcomman->fetch()) {
               echo ' <div style="text-align:left; width:90%;">-&nbsp;'.$fil['descripcion']."</div>";
               } ?>
               
           
       
              <?php if ($personprice==0) {
                # code...
              }else{ ?>
          <div style="background-color:#CC8EDD;  text-align:center; width:50%;"><font color="black" size="3"> <?php echo "<b>Precio total por persona, todo incluido. $".$personprice; ?><b></font></div><br>


          </center>

          <?php }
           }else{

            }  

             $com = "SELECT * FROM condiciones where ideventosespeciales=".$_GET['idevento']."";

                $sqlcom = $conn->prepare($com);
                $sqlcom->execute();
                $mostrando = $sqlcom->rowcount();

                  if ($mostrando!=0) {

                   ?>

            <center><div  style="background-color:#82E105;  text-align:left; width:90%;">
             
             <font size="3" color="black"> <b>Condiciones: </b></font>
            </div>
            <div align="left" style="width:90%;">
              <ol >
            <?php while ($fi = $sqlcom->fetch()) {
               echo ' <div style="text-align:left; width:90%;">-&nbsp;'.$fi['descripcion']."</div>";
               } ?>
               
           
          </ol></center>

          <?php  }else{

            } ?>
            <br>
            <center>
              <div style="width:90%;">
                Restaurante El Cerrito Panorámico, km. 6 ½ Carretera Panorámica, a 5 minutos Santiago Texacuangos, búscanos como Restaurante El Cerrito Panorámico.<br>
              Para cualquier detalle comunicarse al 7852-9486, con Francisco Viscarra. <a href="mailto:Visc44@hotmail.com">Visc44@hotmail.com</a>

              </div>


            </center>

            <br>


  <?php
  echo "<br>";
 	}else{ 
 		echo "</div></div>";
        echo "<script>location.href='crearevento.php'; </script> ";
  }

 	

 	# code...
 }else{
 echo "<script>location.href='crearevento.php'; </script> ";
  } ?>
    







</div>






 
</div>
 
</div>
 
</form>
</div>
 
</div>
</section> 




<?php

include("../menu/footer.php");

}
?>

