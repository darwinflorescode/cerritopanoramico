<!--incluimos la libreria para poder utilizar la mascara para el numero de telefono -->

 <script src="../lib/jquery.maskedinput.min.js" type="text/javaScript"></script>

        <script type="text/javascript">
//Funcion para crear mascaras de telefono y dui.
$(function($){

   $("#telefono").mask("9999-9999");
   $("#modal_tel").mask("9999-9999");


});



</script>

<!--formulario para el registro nuevo -->
<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="mesero_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nuevo Mesero</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Código:</label>
<div class="col-sm-9">
<input type="text" name="codigo"  placeholder="Ingrese código" required="" class="form-control">
</div>
</div>
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Nombres:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Lowercase;" maxlength="45" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="nombres"  placeholder="Ingrese sus nombres es obligatorio" required="" class="form-control">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Apellidos:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:lowercase;" maxlength="45" onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="apellidos"  placeholder="Ingrese sus apellidos es obligatorio" required="" class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Teléfono:</label>
<div class="col-sm-9">
 <input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" id="telefono" onkeypress="return justNumbers(event);"  name="telefono" placeholder="Ingrese su número de teléfono" class="form-control">
</div>
</div>



<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Dirección:</label>
<div class="col-sm-9">
<textarea name="direccion" style="width:100%;"  placeholder="Ingrese su dirección es obligatorio" required></textarea>
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


<!--formulario para poder modificar los datos de un registro -->


<form class="form-horizontal" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'> </span> Editar Mesero</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">

<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Código:</label>
<div class="col-sm-9">
<input type="text" name="mod_codigo" id="mod_codigo"  placeholder="Ingrese código" required="" class="form-control">
</div>
</div>
<div class="form-group">
<input type="hidden" name="modal_id" id="modal_id">
<label for="bussines_name" class="col-sm-3 control-label">Nombres:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:lowercase;" maxlength="45" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_nombre"  id="mod_nombre" placeholder="Ingrese sus nombres es obligatorio" required="" class="form-control">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Apellidos:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:lowercase;" maxlength="45" onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_apellido"  id="mod_apellido" placeholder="Ingrese sus apellidos es obligatorio" required="" class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Teléfono:</label>
<div class="col-sm-9">
 <input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" id="modal_tel"  onkeypress="return justNumbers(event);"  name="modal_tel" placeholder="Ingrese su número de teléfono" class="form-control">
</div>
</div>



<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Dirección:</label>
<div class="col-sm-9">
<textarea name="modal_direccion" id="modal_direccion" style="width:100%;"  placeholder="Ingrese su dirección es obligatorio" required></textarea>
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Estado:</label>
<div class="col-sm-9">
<select name="mod_estado" class="form-control" id="mod_estado">
  <option value="Disponible">Disponible</option>
    <option value="No Disponible">No Disponible</option>
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