
<!-- Estos modales son los formularios para guardar una nueva produccion-->
<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="produccion_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nueva producción</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">

<label for="bussines_name" class="col-sm-3 control-label">Fecha vencimiento:</label>
<div class="col-sm-9">
<input type="date"  name="mod_fechad"  id="mod_fechad" min="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" value="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>"  id="mod_fechad" placeholder="Ingrese la fecha es obligatorio" required="" class="form-control">
</div>
</div>


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Nombre producto:</label>
<div class="col-sm-9">
<select class="form-control" name="idpro" required>
<option value=""> --- Seleccione un Producto ---</option>
   <?php

   //Esta es a consulta sql que nos ayuda a llamar la llave foranea del producto
                   
                    $sql = 'SELECT * FROM producto where estado ="Activo" and (tipomenu="Menu a la carta" or tipomenu ="Banquete") order by idproducto desc';
                    $result = $conn->query($sql);
                    $rows = $result->fetchALL();
                    foreach ($rows as $row) {
                     
                  
                        echo "<option value='";
                        echo $row['idproducto'];
                        echo "'>";
                        echo $row['nombre'];
                        echo "</option>";
                    }
                ?>
                </select>
</select>
</div>
</div>

<script type="text/javascript">
  function focu(){
    document.getElementById('cantidad').focus();

  }
   function foc(){

    document.getElementById('precio').focus();
  }
</script>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Cantidad:</label>
<div class="col-sm-9">
<input type="number" pattern="/^\d*$/;"   name="cantidad" id="cantidad" placeholder="Ingrese una cantidad"  onchange="if(this.value <= 0){alert('Escriba números positivos y diferente a 0'); this.value=''; focu();}else{total.value = (cantidad.value) * (precio.value); } " required class="form-control">
</div>
</div>


<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Precio / U:</label>
<div class="col-sm-9">
<input type="text"  onkeypress="return justNumbers(event);" name="precio" placeholder="Ingrese un precio unitario"   onchange="if(this.value == 0){alert('Escriba números positivos y diferente a 0'); this.value=''; foc();}else{total.value =(cantidad.value) *  (this.value);} " required class="form-control">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Total:</label>
<div class="col-sm-9">
<input type="text"  onkeypress="return justNumbers(event);"  name="total" placeholder="Total"  readonly="" onchange="total.value = (cantidad.value * this.value);" required class="form-control">
</div>
</div>

<div class="form-group">
<label for="phone" class="col-sm-3 control-label"></label>
<div class="col-sm-9">
<div class='alert alert-warning alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              * Los datos son requeridos.
            </div>
</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary" ><span class="fa fa-save"> </span> Registrar</button>
</div>

</div> 

</div> 
</div> 
</div>

</div>
</div>
</div>
</form>




<!-- Estos modales son los formularios para modificar un registro de produccion -->

<form class="form-horizontal" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'> </span> Editar producción</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modofique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="modal_id" id="modal_id">

<label for="bussines_name" class="col-sm-3 control-label">Fecha vencimiento:</label>
<div class="col-sm-9">
<input type="date"  name="modal_fecha"  id="modal_fecha" min="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" value="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>"  id="mod_fecha" placeholder="Ingrese la fecha es obligatorio" required="" class="form-control">
</div>
</div>


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Nombre producto:</label>
<div class="col-sm-9">
<select class="form-control" name="modal_producto" id="modal_producto" required>
<option value=""> --- Seleccione un Producto ---</option>
   <?php

   //Esta es a consulta sql que nos ayuda a llamar la llave foranea del producto
                   
                    $sql = 'SELECT * FROM producto where estado ="Activo" and (tipomenu="Menu a la carta" or tipomenu ="Banquete")  order by idproducto desc';
                    $result = $conn->query($sql);
                    $rows = $result->fetchALL();
                    foreach ($rows as $row) {
                     
                  
                        echo "<option value='";
                        echo $row['idproducto'];
                        echo "'selected>";
                        echo $row['nombre'];
                        echo "</option>";
                    }
                ?>
                </select>
</select>
</div>
</div>

<script type="text/javascript">
  function focuss(){
    document.getElementById('modal_cantidad').focus();

  }
   function focc(){

    document.getElementById('modal_precio').focus();
  }
</script>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Cantidad:</label>
<div class="col-sm-9">
<input type="number"  onkeypress="return justNumbers(event);" pattern="/^\d*$/;"   name="modal_cantidad" id="modal_cantidad" placeholder="Ingrese una cantidad"  onchange="if(this.value <=0){alert('Escriba números positivos y diferente a 0'); this.value=''; focuss();}else{modal_total.value = (modal_cantidad.value) * (modal_precio.value); } " required class="form-control">
</div>
</div>


<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Precio / U:</label>
<div class="col-sm-9">
<input type="text"  onkeypress="return justNumbers(event);" name="modal_precio" id="modal_precio" placeholder="Ingrese un precio unitario"   onchange="if(this.value <= -1 ){alert('Escriba números positivos y diferente a 0'); this.value=''; focc();}else{modal_total.value =(modal_cantidad.value) *  (this.value);} " required class="form-control">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Total:</label>
<div class="col-sm-9">
<input type="text"  onkeypress="return justNumbers(event);" name="modal_total" id="modal_total" placeholder="Total"  readonly="" onchange="modal_total.value = (modal_cantidad.value * this.value);" required class="form-control">
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


<!-- Estos modales son los formularios para agregar cantidad a un registro de produccion -->

<form class="form-horizontal" action="add.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-plus-square'> </span> Agregar cantidad a la producción</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Agregue Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="modalpro" id="modalpro">
<input type="hidden" name="modalidd" id="modalidd">

<label for="bussines_name" class="col-sm-3 control-label">Nombre producto:</label>
<div class="col-sm-9">
<input type="text"  name="modalnombre" readonly="" id="modalnombre" placeholder="Ingrese el nombre del producto es obligatorio" required="" class="form-control">
</div>
</div>


<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Existencia:</label>
<div class="col-sm-9">
<input type="number" readonly="" onkeypress="return justNumbers(event);"   name="modalcantidad" id="modalcantidad" placeholder="Ingrese una cantidad" required class="form-control">
</div>
</div>


<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Nueva cantidad:</label>
<div class="col-sm-9">
<input type="number" pattern="/^\d*$/;"  onkeypress="return justNumbers(event);" onchange="if(this.value <= 0){alert('Escriba números positivos y diferente a 0'); this.value=''; focuss();}else{modalnuevototal.value = (modalnuevacantidad.value) * (modalprecio.value) + parseFloat(modaltotala.value); modalnuevacant.value=parseFloat(this.value) + parseFloat(modalcantidad.value); nuevo.value=(modalnuevacantidad.value) * (modalprecio.value);} "  name="modalnuevacantidad" id="modalnuevacantidad" placeholder="Ingrese una cantidad"  onkeyup="if(this.value <= -1){alert('Escriba números positivos y diferente a 0'); this.value=''; focuss();}else{modalnuevototal.value = (modalnuevacantidad.value) * (modalprecio.value) + parseFloat(modaltotala.value); modalnuevacant.value=parseFloat(this.value) + parseFloat(modalcantidad.value); nuevo.value=(modalnuevacantidad.value) * (modalprecio.value);} "  required class="form-control">
</div>
</div>


<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Precio / U: $</label>
<div class="col-sm-9">
<input type="text" readonly="" onkeypress="return justNumbers(event);" name="modalprecio" id="modalprecio" placeholder="Ingrese un precio unitario"   onchange="if(this.value <=-1 ){alert('Escriba números positivos y diferente a 0'); this.value=''; focc();}else{modaltotal.value =(modalnuevacantidad.value) *  (this.value);} " required class="form-control"><input size="5"  type="text" readonly="" required name="nuevo" id="nuevo">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Total actual:</label>
<div class="col-sm-9">
<input type="text"  onkeypress="return justNumbers(event);" name="modaltotala" id="modaltotala" placeholder="Total actual"  readonly="" required class="form-control">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Total Nueva cantidad:</label>
<div class="col-sm-9">
<input type="text"  onkeypress="return justNumbers(event);" name="modalnuevacant" id="modalnuevacant" placeholder="Total"  readonly="" required class="form-control">
</div>
</div>

<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Nuevo Total: $</label>
<div class="col-sm-9">
<input type="text"  onkeypress="return justNumbers(event);" name="modalnuevototal" id="modalnuevototal" placeholder="Total"  readonly="" onchange="this.value = modalnuevacantidad.value * modalprecio.value + modaltotala.value;" required class="form-control">
</div>
</div>



<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit"  id="guardar_datos" class="btn btn-primary" onmousemove="if((modalcantidad.value < 0.9) || (modalprecio.value == 0) || (modalnuevototal.value == 0) || (modalnuevacant.value == 0)){alert('Ingrese una cantidad / precio, nueva cantidad / nuevo total')} "><span class='fa fa-plus-square'> </span> Agregar</button>
</div>

</div> 

</div> 
</div> 
</div>

</div>
</div>
</div>
</form>