<!--formulario para un nuevo registro -->

<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="condiciones_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nueva Condici&oacute;n</h4>
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
<label for="tax_number" class="col-sm-3 control-label">Descripci&oacute;n:</label>
<div class="col-sm-9">
<textarea name="mod_descripcion" id="mod_descripcion" style="width:100%;"  placeholder="Ingrese una descripción del producto es obligatorio" required></textarea>
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Evento Especial:</label>
<div class="col-sm-9">
	
<select name ="mod_eventosespeciales"  class=" form-control" required>
<option value="">--- Seleccione un Evento ---</option>
                        <?php
                 
                        
                  $sql = "SELECT * FROM eventosespeciales   order by ideventosespeciales desc";

                        $result = $connection->query($sql);

                        $rows = $result->fetchAll();


                      foreach ($rows as $row) { 

                      echo "<option value='";
                      echo $row['ideventosespeciales'];           
                              
                      echo "'>";
                      echo $row['opcion']; 
                      

                      echo "</option>";

                      }

                        ?>


                        </select>

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
</div>

</form>




<!--formulario para editar un registro -->

<form class="form-horizontal" action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'> </span> Editar Condiciones</h4>
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
<input type="hidden" name="idc" id="idc">
<label for="tax_number" class="col-sm-3 control-label">Descripción:</label>
<div class="col-sm-9">
<textarea name="modal_descripcion" style="width:100%;" id="modal_descripcion"  placeholder="Ingrese una descripción de condiciones obligatorio" required></textarea>
</div>
</div>

<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Evento Especial:</label>
<div class="col-sm-9">
  
<select name ="modal_eventosespeciales" id="modal_eventosespeciales"  class=" form-control" required>
<option value="">--- Seleccione un Evento ---</option>
                        <?php
                 
                        
                  $sql = "SELECT * FROM eventosespeciales   order by ideventosespeciales desc";

                        $result = $connection->query($sql);

                        $rows = $result->fetchAll();


                      foreach ($rows as $row) { 

                      echo "<option value='";
                      echo $row['ideventosespeciales'];           
                              
                      echo "'selected>";
                      echo $row['opcion']; 
                      

                      echo "</option>";

                      }

                        ?>


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
</div>
</form>