<!-- formulario para crear un nuevo registro-->

<form class="form-horizontal" enctype="multipart/form-data" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="mesa_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nueva Mesa</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Número mesa:</label>
<div class="col-sm-9">
<input type="text"    name="mod_numeromesa" maxlength="40" id="mod_numeromesa" placeholder="Ingrese el numero de mesa es obligatorio" required="" class="form-control">
</div>
</div>
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Imagen:</label>
<div class="col-sm-9">
<input type="file"    name="mod_imagen"  placeholder="Ingrese imagen de la mesa" required="" class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Descripción:</label>
<div class="col-sm-9">
<textarea name="mod_descripcion" id="mod_descripcion" style="width:100%;"  placeholder="Ingrese la descripción de la mesa es obligatorio" required></textarea>
</div>
</div>


<div class="form-group">
<label for="phone" class="col-sm-3 control-label"></label>
<div class="col-sm-9">
<div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              * Todos los  datos son requeridos.
            </div>
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





<!-- formulario para modificar un registro-->


<form class="form-horizontal" enctype="multipart/form-data" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'> </span> Editar Mesa</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" id="modimagen" name="modimagen">
<input type="hidden" name="modal_id" id="modal_id">
<label for="bussines_name" class="col-sm-3 control-label">Número mesa:</label>
<div class="col-sm-9">
<input type="text" maxlength="40"   name="modal_numeromesa" id="modal_numeromesa"  placeholder="Ingrese el numero de mesa es obligatorio" required="" class="form-control">
</div>
</div>

<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Imagen:</label>
<div class="col-sm-9">
<input type="file"    name="modal_imagenes"  placeholder="Ingrese imagen de la mesa"  class="form-control">
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Descripción:</label>
<div class="col-sm-9">
<textarea name="modal_descripcion" id="modal_descripcion" style="width:100%;"  placeholder="Ingrese la descripción de la mesa es obligatorio" required></textarea>
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Estado:</label>
<div class="col-sm-9">
<select class="form-control" name="modal_estado" id="modal_estado">
	<option value="Disponible" selected="">Disponible</option>
	<option value="Ocupada">Ocupada</option>
</select>
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
</form>