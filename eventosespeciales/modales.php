<!--formulario para un nuevo registro -->

<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="eventosespeciales_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nuevo Evento Especial</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Opci&oacute;n:</label>
<div class="col-sm-9">
<input type="text" name="mod_opcion" onkeyup ="javascript:this.value=this.value.toUpperCase();" id="mod_opcion" class="form-control"  placeholder="Ingrese una Opci&oacute;n de evento" required>
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Pastel:</label>
<div class="col-sm-9">
<input type="text" name="mod_pastel" id="mod_pastel" class="form-control"  placeholder="Detalle del pastel para evento">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Postre:</label>
<div class="col-sm-9">
<input type="text" name="mod_postre" id="mod_postre" class="form-control"  placeholder="Detalle del postre para evento">
</div>
</div>


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Precio por Persona: $</label>
<div class="col-sm-9">
<input type="text" onkeypress="return justNumbers(event);"  name="mod_preciopersona" id="mod_preciopersona" class="form-control" placeholder="Ingrese el precio por persona para este evento" required>
</div>
</div>




<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos"  class="btn btn-primary"><span class="fa fa-save"> </span> Registrar</button>
</div>

</div> 

</div> 
</div> 
</div>

</div>
</div>
</div>
</div>

</form>




<!--formulario para editar un registro -->

<form class="form-horizontal" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'> </span> Editar Evento Especial</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">

<div class="form-group">
<input type="hidden" name="id" id="id">
<label for="tax_number" class="col-sm-3 control-label">Opci&oacute;n:</label>
<div class="col-sm-9">
<input type="text" onkeyup ="javascript:this.value=this.value.toUpperCase();" name="modal_opcion" id="modal_opcion" class="form-control"  placeholder="Ingrese una Opci&oacute;n de evento" required>
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Pastel:</label>
<div class="col-sm-9">
<input type="text" name="modal_pastel" id="modal_pastel" class="form-control" placeholder="Ingrese pastel para evento">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Postre:</label>
<div class="col-sm-9">
<input type="text" name="modal_postre" id="modal_postre" class="form-control"  placeholder="Ingrese postre para evento">
</div>
</div>


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Precio por Persona: $</label>
<div class="col-sm-9">
<input type="text" onkeypress="return justNumbers(event);"  name="modal_preciopersona" id="modal_preciopersona" class="form-control" placeholder="Ingrese el precio por persona para evento" required>
</div>
</div>



<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary"><span class="fa fa-edit"> </span> Actualizar</button>
</div>

</div> 

</div> 
</div> 
</div>

</div>
</div>
</div>
</div>
</form>