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




if (isset($_POST['accion'])) {
include_once('../conexion/conexion.php');
    $conn = conexion();
  $opcionevento = $_POST['optionevento'];


 	$query = $conn->prepare("SELECT  * FROM eventosespeciales where opcion='$opcionevento'");
 	$query->execute();
	$row = $query->rowcount();
       if ($row)
       {
       echo "<script>location.href='crearevento.php?idevento=error'; </script> ";
       }else{

       	$insertar = $conn->prepare("INSERT INTO eventosespeciales(opcion,pastel,postre,preciopersona,fecharegistro) VALUES('".$opcionevento."','','',0.00,NOW())");
       	$insertar->execute();


      $consultar = $conn->prepare("SELECT  max(ideventosespeciales) as idevento FROM eventosespeciales");
       $consultar->execute();

    $dat = $consultar->fetch(PDO::FETCH_ASSOC);
    $idevento = $dat['idevento'];

    echo "<script>location.href='crearevento.php?idevento=".$idevento."'; </script> ";

       }




 

}else{
	




?>


  


<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<section class="content">
<div class="row">
 
<div class="col-md-20">
<form class="form-horizontal" action="crearevento.php" method="POST" accept-charset="utf-8"   autocomplete="off" role="form" >
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="nuevacompra.phpdetails" data-toggle="tab" aria-expanded="true">Nuevo Evento</a></li>
<li class=""><a aria-expanded="false">Entradas. Paso 2 </a></li>
<li class=""><a aria-expanded="false">Platillos Fuertes. Paso 3 </a></li>
<li class=""><a aria-expanded="false">Adicional Incluye. Paso 4 </a></li>
<li class=""><a aria-expanded="false">Condiciones. Paso 5 </a></li>
<li class=""><a aria-expanded="false">Asignar Precio. Paso 6 </a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">

<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Opci&oacute;n Evento:</label>
<div class="col-sm-4">
<input type="text" required name="optionevento" onkeyup ="javascript:this.value=this.value.toUpperCase();" placeholder="Opci&oacute;n Evento" id="optionevento" class="form-control">

</div>

</div>
<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label"></label>
<div class="col-sm-4">
 <button type="submit" class="btn btn-primary" name="accion"><span class="fa fa-save"></span>&nbsp;GUARDAR</button>

 <?php if (!empty($_GET['idevento'])) {

 	$idev=$_GET['idevento'];

 	if ($idev!="error") {
 	
 		echo "</div></div>";
 		echo '<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              &Eacute;xito. Evento almacenado correctamente. <a href="step2.php?idevento='.$idev.'" class="badge label-info"> Siguiente <span class="fa fa-chevron-right"></span></a>
            </div>';
 	}elseif ($idev=="error") {
 		echo "</div></div>";
 		echo '<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              error. Ya existe la opcion del evento. 
            </div>';
 	}else{
 		echo "</div></div>";

 	}

 	# code...
 } ?>
    







</div>






 
</div>
 
</div>
 
</form>
<?php if (@$_GET['idevento'] > 0) {
  # code...
}else{?>

<form method="GET" action="step2.php" accept-charset="utf-8"   autocomplete="off" role="form">
  
  <input type="text" onchange="if (parseInt(this.value)==0 ){ alert('Digita un numero entero y <> 0'); this.value='';}" required name="idevento" placeholder='Ingrese el c&oacute;digo.'>
  <input type="submit" value="INGRESA EL C&Oacute;DIGO DEL  EVENTO ALMACENADO">
</form>

<?php }  ?>
</div>
 
</div>
</section> 
</div> 



<?php

include("../menu/footer.php");

}
?>

