
<form class="form-horizontal" action="guardar.php" method="POST"  accept-charset="utf-8"   autocomplete="off" role="form">
 
<div class="modal fade" id="modal_tipoproducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-save"> </span>  Nuevo tipo producto</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activity" data-toggle="tab">Ingrese Datos</a></li>
</ul>
<div class="tab-content">
<div class="active tab-pane" id="activity">
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Nombre:</label>
<div class="col-sm-9">
<input type="text" class="form-control" onkeypress="return soloLetras(event);"   onkeyup ="javascript:this.value=this.value.toLowerCase();" placeholder="Ingrese el nombre del tipo de usuario"  name="namep" required="">
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary"><span class="fa fa-save"> </span> Registrar</button>
</div>
</div> 





</div> 


</div> 
</div>

</div>
</div>
</div>
</form> 





<form class="form-horizontal" action="editar.php" method="POST"  accept-charset="utf-8"   autocomplete="off" role="form">
 
<div class="modal fade" id="modal_updatep" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-edit"> </span>  Editar tipo producto</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activity" data-toggle="tab">Modifique Datos</a></li>
</ul>
<div class="tab-content">
<div class="active tab-pane" id="activity">
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Nombre:</label>
<div class="col-sm-9">
<input type="text" class="form-control" onkeypress="return soloLetras(event);"   onkeyup ="javascript:this.value=this.value.toLowerCase();" placeholder="Ingrese el nombre del tipo de usuario"  name="mod_nombrep" id="mod_nombrep" required="">
<input type="hidden" name="mod_idp" id="mod_idp">
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary"><span class="fa fa-save"> </span> Actualizar</button>
</div>
</div> 





</div> 


</div> 
</div>

</div>
</div>
</div>
</form>






<?php

if (!empty($_GET['save'])) {

	$correcto = $_GET['save'];

	if ($correcto == "true") {
?>


<body onload="ok();"></body>
		<script>
			function ok(){
				alertify.success("Excelente. Se almacenó correctamente");
				return false; 
				//setTimeout('location.href="mostrar.php"', 1500);
			}
		</script>

			<?php
	}elseif($correcto =="error"){

		?>


<body onload="error();"></body>
		<script>
			function error(){
				alertify.error("Error. Se repitió nombre del tipo producto.");
				return false; 
				//setTimeout('location.href="mostrar.php"', 1500);
			}
		</script>


<?php




	}
}elseif (!empty($_GET['eliminar'])) {

	$eliminar = $_GET['eliminar'];

if($eliminar == "error"){

		echo '<center><i><p class="alert alert-danger">Error en el proceso! Espere... </p></i></center> ';
		echo "<meta http-equiv='refresh' content='2; url=http://localhost/cerritopanoramico/tipousuario/mostrar.php'/ >";

	}
	

}elseif (!empty($_GET['modify'])) {

	$modificar = $_GET['modify'];

	if ($modificar == "true") {
		?>
		<body onload="okey();"></body>
		<script>
			function okey(){
				alertify.success("Excelente. Se modificó correctamente");
				return false; 
				//setTimeout('location.href="mostrar.php"', 1500);
			}
		</script>




		<?php
	}elseif($modificar =="false"){
		?>

		<body onload="merror();"></body>
		<script>
			function merror(){
				alertify.error("Error al modificar este registro.");
				return false; 
				//setTimeout('location.href="mostrar.php"', 1500);
			}
		</script>



		<?php

	}
}


?>
