

 <script src="../lib/jquery.maskedinput.min.js" type="text/javaScript"></script>

        <script type="text/javascript">
//Funcion para crear mascaras de telefono y dui.
$(function($){

   $("#mod_tele").mask("9999-9999");
   $("#mod_telec").mask("9999-9999");
      $("#mod_teledit").mask("9999-9999");
   $("#mod_telecedit").mask("9999-9999");

});



</script>

<!-- Estos modales sirve como formulario para guardar datos -->
<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="proveedor_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nuevo Proveedor</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Empresa:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Lowercase;" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_nombree" id="mod_nombree" placeholder="Ingrese el nombre de la empresa es obligatorio"  class="form-control">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">C&oacute;digo:</label>
<div class="col-sm-9">
<input type="text"  name="mod_codigoe" id="mod_codigoe" placeholder="Ingrese el código de la empresa es obligatorio"  class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tel&eacute;fono:</label>
<div class="col-sm-9">
 <input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" onkeypress="return justNumbers(event);" id="mod_tele" name="mod_tele"placeholder="Ingrese número de teléfono de la empresa" class="form-control" >
</div>
</div>



<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Email:</label>
<div class="col-sm-9">
<input type="email"  id="mod_emaile" name="mod_emaile"placeholder="Ingrese email de empresa " class="form-control">
</div>
</div>




<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Direcci&oacute;n:</label>
<div class="col-sm-9">
<textarea name="mod_direccion"  style="width:100%;" id="mod_direccion" placeholder="Ingrese dirección empresa "></textarea>
</div>
</div>



<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Nombre Contacto:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Lowercase;" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();"    id="mod_nombrec" name="mod_nombrec"placeholder="Ingrese el nombre del contacto es obligatorio" class="form-control" required>
</div>
</div>




<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tel&eacute;fono Contacto:</label>
<div class="col-sm-9">
 <input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" onkeypress="return justNumbers(event);" id="mod_telec" name="mod_telec"placeholder="Ingrese número del contacto es obligatorio" class="form-control" required>
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



<!-- Estos modales sirven como formulario para editar datos-->


<form class="form-horizontal" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'> </span> Editar Proveedor</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" id="id" name="id">
<label for="bussines_name" class="col-sm-3 control-label">Empresa:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Lowercase;" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_nomedit" id="mod_nomedit" placeholder="Ingrese el nombre de la empresa es obligatorio"  class="form-control">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">C&oacute;digo:</label>
<div class="col-sm-9">
<input type="text"  name="mod_codedit" id="mod_codedit" placeholder="Ingrese el código de la empresa es obligatorio"  class="form-control">
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tel&eacute;fono:</label>
<div class="col-sm-9">
 <input type="text"  pattern="^[7|2|6]\d{3}-?\d{4}$" onkeypress="return justNumbers(event);" id="mod_teledit" name="mod_teledit"placeholder="Ingrese número de la empresa" class="form-control">
</div>
</div>



<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Email:</label>
<div class="col-sm-9">
<input type="email"   id="mod_emailedit" name="mod_emailedit"placeholder="Ingrese email de empresa" class="form-control">
</div>
</div>




<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Direcci&oacute;n:</label>
<div class="col-sm-9">
<textarea name="mod_direccionedit"  style="width:100%;" id="mod_direccionedit" placeholder="Ingrese dirección empresa" ></textarea>
</div>
</div>



<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Nombre contacto:</label>
<div class="col-sm-9">
<input type="text" style="text-transform:Lowercase;" required onkeyup ="javascript:this.value=this.value.toLowerCase();"    id="mod_nombredit" name="mod_nombredit"placeholder="Ingrese el nombre del contacto es obligatorio" class="form-control">
</div>
</div>




<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tel&eacute;fono Contacto:</label>
<div class="col-sm-9">
 <input type="text" pattern="^[7|2|6]\d{3}-?\d{4}$" required onkeypress="return justNumbers(event);" id="mod_telecedit" name="mod_telecedit"placeholder="Ingrese número del contacto es obligatorio" class="form-control">
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






<!-- Este modal sirve comos formulario para modificar el estado -->
<form class="form-horizontal" action="disabled.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_activar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-check-square"> </span> Activar o Desactivar proveedor</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Estado proveedor</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="modid" id="modid">
<label for="bussines_name" class="col-sm-3 control-label">Nombre Empresa:</label>
<div class="col-sm-9">
<input type="text" class="form-control" readonly=""  placeholder="nombre usuario"  name="modnombre" id="modnombre" required="">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Raz&oacute;n o motivo:</label>
<div class="col-sm-9">
<textarea class="form-control"  placeholder="Razon o motivo de activar o desactivar usuario"  name="modrazon" id="modrazon" required=""></textarea>
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Estado:</label>
<div class="col-sm-9">
<select class="form-control" name="modestado" id="modestado">
  <option value="Activo" selected="">Activo</option>
  <option value="Inactivo">Inactivo</option>
</select>
</div>
</div>


<div class="form-group">
<label for="phone" class="col-sm-3 control-label"></label>
<div class="col-sm-9">
<div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              * Desactivar o activar proveedor temporalmente.
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