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
    $nombreplatillo=$_POST['nombreplatillo'];
  $descripcion = $_POST['descripcion'];


 	$query = $conn->prepare("SELECT  * FROM tipoplatillofuerte where nombreplatillo='$nombreplatillo' and ideventosespeciales='$ideven'");
 	$query->execute();
	$row = $query->rowcount();
       if ($row)
       {
       echo "<script>location.href='step3.php?idevento=".$ideven."&message=error'; </script> ";
       }else{

       	$insertar = $conn->prepare("INSERT INTO tipoplatillofuerte(nombreplatillo,descripcion,ideventosespeciales) VALUES('".$nombreplatillo."','".$descripcion."','$ideven')");
       	$insertar->execute();

/*
      $consultar = $conn->prepare("SELECT  max(ideventosespeciales) as idevento FROM eventosespeciales");
       $consultar->execute();

    $dat = $consultar->fetch(PDO::FETCH_ASSOC);
    $idevento = $dat['idevento'];*/

    echo "<script>location.href='step3.php?idevento=".$ideven."&message=add'; </script> ";

       }




 

}else{
	




?>


  


<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<section class="content">
<div class="row">
 
<div class="col-md-20">
<form class="form-horizontal" action="step3.php" method="POST" accept-charset="utf-8"   autocomplete="off" role="form" >
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class=""><a href="crearevento.php" data-toggle="" aria-expanded="false">Nuevo Evento</a></li>
<li class=""><a  href="step2.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Entradas. Paso 2 </a></li>
<li class="active"><a href="step3.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Platillos Fuertes. Paso 3 </a></li>
<li class=""><a href="step4.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Adicional Incluye. Paso 4 </a></li>
<li class=""><a href="step5.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Condiciones. Paso 5 </a></li>
<li class=""><a href="step6.php?idevento=<?php echo $_GET['idevento']; ?>" data-toggle="" aria-expanded="false">Asignar Precio. Paso 6 </a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Nombre Platillo:</label>
<div class="col-sm-9">
<input type="hidden" name="ideventos" id="ideventos" value="<?php echo $_GET['idevento']; ?>">
<input type="text" required name="nombreplatillo" placeholder="Ingrese un nombre del platillo fuerte" class="form-control">
</div>

</div>
<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Descripci&oacute;n:</label>
<div class="col-sm-9">
<textarea class="form-control" required name="descripcion" id="descripcion" Placeholder="Ingrese una descripci&oacute;n del platillo fuerte"></textarea>

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
            Error. Se repiti&oacute; la el nombre del platillo  
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
 <a href="step4.php?idevento=<?php echo $_GET['idevento']; ?>" class="btn btn-info"> Siguiente <span class="fa fa-chevron-right"></span></a>


 <?php if (!empty($_GET['idevento'])) {

 	$idev=$_GET['idevento'];

 	if (($idev!="") || ($idev!=0)) {

    ?>
  </div></div>
     
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

            <center><div  style="background-color:#00FF00;  text-align:left; width:90%;">
             
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

            <center><div  style="background-color:#00FF00;  text-align:left; width:90%;">
             
             <font size="3" color="black"> <b>PLATOS FUERTES: </b></font>
            </div>
              <ol >
            <?php while ($filas = $sqlcommand->fetch()) {
               echo ' <div style="text-align:left; width:90%;">
         
              <li style="color:black;">'.$filas['nombreplatillo'].", ".$filas['descripcion'].'</li>
          
            </div>';
               } ?>
               
           
          </ol></center>

          <?php  } ?>


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

