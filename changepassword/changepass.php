<?php
//incluimos el menu principla del sistema
include("../menu/header.php");


?>
<div class="content-wrapper" style="min-height: 400px;">
 
<section class="content-header">
<h1><i>Cambiar contrase&ntilde;a</i></h1>
</section>
 
<?php
//mensajes de dialogo  

if (!empty($_GET['save'])) {

	$correcto = $_GET['save'];

	if ($correcto == "true") {

    ?>
    <body onload="save();"></body>
    <script>
      function save(){
        alertify.success("Excelente. Se modificó su nueva contrase&ntilde;a");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php




	}elseif($correcto =="false"){

		?>
		 <body onload="savefalse();"></body>
    <script>
      function savefalse(){
        alertify.error("Error. No se modificó su contraseña");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>

		<?php 

	}

	 }





 ?>

<section class="content">
<div class="row">
<div class="col-md-3">
 
<div class="box box-primary">
<div class="box-body box-profile">
<div id="load_img">
<img class="img-responsive"  style="height:225px;" src="../imagenes/cerrito.png" class="img-circle" alt="User Image">
</div>

<p class="text-muted text-center mail-text">Restaurante Cerrito Panor&aacute;mico</p>
</div>
 
</div>
 
</div>
 <!-- Pdir contraseña actual-->
<div class="col-md-7">
<form class="form-horizontal" action="changepass.php" accept-charset="utf-8"   autocomplete="off" role="form" method="post"  name="profi">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="" data-toggle="tab" aria-expanded="true">Cambia tu Contrase&ntilde;a</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="form-group">
<label for="number_id" class="col-sm-3 control-label">Contrase&ntilde;a actual:</label>
<div class="col-sm-9">
<input type="password" class="form-control" required  name="passw" placeholder="Ingrese su contrase&ntilde;a actual" value="">
</div>
</div>





<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-primary" ><span class="fa fa-unlock"></span> Verificar</button>

</div>

</div>

</form>


<?php 
if ( !empty($_POST['passw'])) {

	$passwr = $_POST['passw'];


  $quer = $conn->prepare("SELECT * FROM usuario  where usuario = '$usuario' and clave = MD5('$passwr')");
     $quer->execute();

     $rowcount = $quer->rowcount();



if ($rowcount) {







//formulario de cambiar contraseña
 ?>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9"> <div class="alert bg-green alert-dismissable">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Excelente. Sus contrase&ntilde;a es correcta </a>
</div> </div></div>

<form method="post" action="validar.php">
<div class="form-group">
<label for="number_id" class="col-sm-3 control-label">usuario:</label>
<div class="col-sm-9">
<input type="text" readonly="" class="form-control" required  name="users" placeholder="Usuario" value="<?php echo $usuario; ?>">
</div>
</div>

<div class="form-group">
<label for="number_id" class="col-sm-3 control-label">Nueva contrase&ntilde;a:</label>
<div class="col-sm-9">
<input type="password" class="form-control" required  name="newpass" placeholder="Ingrese su nueva contrase&ntilde;a" value="">
</div>
</div>
<div class="form-group">
<label for="number_id" class="col-sm-3 control-label">Repita su contrase&ntilde;a:</label>
<div class="col-sm-9">
<input type="password" class="form-control" required onchange="if(this.value==newpass.value){return false;}else if(this.value != newpass.value){alert('Su contrase&ntilde;a es diferente a la anterior'); this.value='';} "  name="repeatpass" placeholder="Repita su nueva contrase&ntilde;a" value="">
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-8">
<button type="submit" class="btn btn-success" ><span class="fa fa-unlock"> </span>  Cambiar Contrase&ntilde;a </button>

</div></div>
</form>


<?php }else{

	echo '<div class="form-group">
<div class="col-sm-offset-3 col-sm-9"> <div class="alert bg-red alert-dismissable">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  Lo siento. Sus contrase&ntilde;a actual es incorrecta!</a>
</div> </div>
';
} 




}?>

</div>
</div>
 
 
</div>
 
</div>
 





</div>
 


</section> 


                        <?php

//Incluimos el copyright
include("../menu/footer.php");

?>