

 <script src="../lib/jquery.maskedinput.min.js" type="text/javaScript"></script>

        <script type="text/javascript">
//Funcion para crear mascaras de telefono y whatsasppp
//Con javascript y jqueryS.
$(function($){

	$("#mod_dui").mask("99999999-9");
		$("#modal_dui").mask("99999999-9");
   $("#mod_tel").mask("9999-9999");

   $("#modal_tel").mask("9999-9999");
    $("#mod_whatsapp").mask("9999-9999");
    $("#modal_whatsapp").mask("9999-9999");



});



</script>
<!-- Modal para almacenar un nuevo cliente-->

<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="cliente_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nuevo Cliente</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Nombres:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Uppercase;" maxlength="44" onkeyup =onkeyup ="javascript:this.value=this.value.toUpperCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_nombre" id="mod_nombre" placeholder="Ingrese sus nombres es obligatorio" required="" class="form-control">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Apellidos:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Uppercase;" maxlength="44" onkeyup ="javascript:this.value=this.value.toUpperCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_apellido" id="mod_apellido" placeholder="Ingrese sus apellidos es obligatorio" required="" class="form-control">
</div>
</div>


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Dui:</label>
<div class="col-sm-9">
  <input type="text" pattern="^\d{8}-\d{1}$" onkeypress="return justNumbers(event);" id="mod_dui" name="mod_dui"placeholder="Ingrese el dui" class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tel&eacute;fono:</label>
<div class="col-sm-9">
 <input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" onkeypress="return justNumbers(event);" id="mod_tel" name="mod_tel" placeholder="Ingrese su n&uacute;mero de tel&eacute;fono" class="form-control">
</div>
</div>




<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">E-mail:</label>
<div class="col-sm-9">
<input type="email" class="form-control" maxlength="42" name="mod_email" id="mo_email" placeholder="Ingrese su email" >
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Whatsapp:</label>
<div class="col-sm-9">
<input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" onkeypress="return justNumbers(event);" id="mod_whatsapp" name="mod_whatsapp" placeholder="Ingrese su n&uacute;mero de whatsapp" class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Direcci&oacute;n:</label>
<div class="col-sm-9">
<textarea name="mod_direccion" style="width:100%;" maxlength="162" id="mo_direccion" placeholder="Ingrese su direcci&oacute;n" ></textarea>
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary "><span class="fa fa-save " > </span> Registrar</button>
</div>

</div> 

</div> 
</div> 
</div>

</div>
</div>
</div>
</form>






















<!-- modal para modifcar los datos del cliente-->

<form class="form-horizontal" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Editar Cliente</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="modal_id" id="modal_id">
<label for="bussines_name" class="col-sm-3 control-label">Nombres:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Uppercase;" maxlength="44" onkeyup ="javascript:this.value=this.value.toUpperCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="modal_nombre" id="modal_nombre" placeholder="Ingrese sus nombres es obligatorio" required="" class="form-control">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Apellidos:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Uppercase;" maxlength="44" onkeyup ="javascript:this.value=this.value.toUpperCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="modal_apellido" id="modal_apellido" placeholder="Ingrese sus apellidos es obligatorio" required="" class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Dui:</label>
<div class="col-sm-9">
  <input type="text" pattern="^\d{8}-\d{1}$" onkeypress="return justNumbers(event);" id="modal_dui" name="modal_dui"placeholder="Ingrese el dui" class="form-control">
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tel&eacute;fono:</label>
<div class="col-sm-9">
 <input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" onkeypress="return justNumbers(event);" id="modal_tel" name="modal_tel" placeholder="Ingrese su n&uacute;mero de tel&eacute;fono" class="form-control">
</div>
</div>





<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">E-mail:</label>
<div class="col-sm-9">
<input type="email" class="form-control" name="modal_email" maxlength="42" id="modal_email" placeholder="Ingrese su email" >
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Whatsapp:</label>
<div class="col-sm-9">
<input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" onkeypress="return justNumbers(event);" id="modal_whatsapp" name="modal_whatsapp" placeholder="Ingrese su n&uacute;mero de whatsapp" class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Direcci&oacute;n:</label>
<div class="col-sm-9">
<textarea name="modal_direccion" maxlength="162" style="width:100%;" id="modal_direccion" placeholder="Ingrese su direcci&oacute;n" ></textarea>
</div>
</div>



<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary"><span class="fa fa-edit"> </span> Actuaizar</button>
</div>

</div> 

</div> 
</div> 
</div>

</div>
</div>
</div>
</form>
