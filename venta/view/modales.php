<!-- Mensajes alerfitys. Se carga mediante el load y el parametro enviado en la url -->

<?php

//Si los datos se alamacenaron correctamente
if (!empty($_GET['save'])) {

	$correcto = $_GET['save'];

	if ($correcto == "true") {
?>


<body onload="ok();"></body>
		<script>
			function ok(){
				alertify.success("Excelente. Pago almacenado correctamente");
				return false; 
				//setTimeout('location.href="mostrar.php"', 1500);
			}
		</script>

			<?php
	}elseif($correcto =="error"){

		?>



<!--  Si se repite eln nombre del tipo de usuario-->
<body onload="error();"></body>
		<script>
			function error(){
				alertify.error("Lo siento. Error en el proceso.");
				return false; 
				//setTimeout('location.href="mostrar.php"', 1500);
			}
		</script>


<?php




	}
}


?>


<!-- Modal para almacenar los datos del tipo -->
<form class="form-horizontal" action="view/guardarpago.php" method="POST"  accept-charset="utf-8"   autocomplete="off" role="form">
 
<div class="modal fade" id="modal_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-usd"> </span>  Caja</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activity" data-toggle="tab">Ingrese Datos</a></li>
</ul>
<div class="tab-content">
<div class="active tab-pane" id="activity">
<div class="form-group">
<input type="hidden" name="modal_id" id="modal_id">
<label for="bussines_name" class="col-sm-3 control-label">Nombre Cliente:</label>
<div class="col-sm-9">
<input type="text" readonly="" class="form-control" onkeypress="return soloLetras(event);"   onkeyup ="javascript:this.value=this.value.toLowerCase();" placeholder="Ingrese el nombre del cliente"  name="nombrecliente" id="nombrecliente" required="">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Total a Pagar:</label>
<div class="col-sm-9">
<input type="text" class="form-control" readonly=""   placeholder="Total"  name="totalpagar" id="totalpagar" required="">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Cliente Paga:</label>
<div class="col-sm-9">
<input type="text" class="form-control" onkeypress=" return justNumbers(event); "   onchange="if (parseFloat(this.value) < parseFloat(totalpagar.value)){alert('Lo siento.☻ \n No puedes pagar!'); this.value=''; cambio.value='';}else { cambio.value=parseFloat(this.value)-parseFloat(totalpagar.value); }" id="clientepaga"  placeholder="Ingrese dinero proporcionado del cliente"  name="clientepaga" required="">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Cambio:</label>
<div class="col-sm-9">
<input type="text" class="form-control" value="0"  onkeypress=" return justNumbers(event); " readonly="" maxlength="3"  placeholder="El cambio es"  name="cambio" id="cambio" size="5" required="">
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default"  data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" onclick="if(parseFloat(clientepaga.value) < (parseFloat(totalpagar.value)){alert('Es menor')}"  class="btn btn-primary"><span class="fa fa-save"> </span> Registrar</button>
</div>
</div> 





</div> 


</div> 
</div>

</div>
</div>
</div>
</form> 