<!--formulario para un nuevo registro -->

<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="productocompra_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nuevo Producto de compra</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Nombre:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Lowercase;" onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_nombre" id="mod_nombre" placeholder="Ingrese el nombre del producto es obligatorio" required="" class="form-control">
</div>
</div>



<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Descripción:</label>
<div class="col-sm-9">
<textarea name="mod_descripcion" id="mod_descripcion" style="width:100%;"  placeholder="Ingrese una descripción del producto es obligatorio" required></textarea>
</div>
</div>





<div class="form-group">
<label for="phone" class="col-sm-3 control-label"></label>
<div class="col-sm-9">
<div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              * Los datos son requeridos.
            </div>
</div></div>


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
</form>












<!--formulario para editar un registro -->

<form class="form-horizontal" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'> </span> Editar Producto</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="idp" id="idp">
<label for="bussines_name" class="col-sm-3 control-label">Nombre:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Lowercase;" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="modal_nombre" id="modal_nombre" placeholder="Ingrese el nombre del producto es obligatorio" required="" class="form-control">
</div>
</div>




<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Descripción:</label>
<div class="col-sm-9">
<textarea name="modal_descripcion" style="width:100%;" id="modal_descripcion"  placeholder="Ingrese una descripción del producto es obligatorio" required></textarea>
</div>
</div>




<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Estado:</label>
<div class="col-sm-9">
<select class="form-control" name="modal_estadop" id="modal_estadop">
  
  <option value="Activo" selected="">Activo</option>
  <option value="Inactivo">Inactivo</option>
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


