<!--Modal para cambiar la contraseña del usuario
Formulario

 -->

<form class="form-horizontal" action="changepass.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_cambiarpass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-lock'> </span> Cambiar contrase&ntilde;a usuario</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Nueva contrase&ntilde;a</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="mod_passid" id="mod_passid">
<label for="bussines_name" class="col-sm-3 control-label">Nombre Usuario:</label>
<div class="col-sm-9">
<input type="text" class="form-control" readonly=""  placeholder="nombre usuario"  name="mod_passnombre" id="mod_passnombre" required="">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Contrase&ntilde;a:</label>
<div class="col-sm-9">
<input type="password" class="form-control"  placeholder="Ingrese su nueva contrase&ntilde;a"  name="mod_passclave" id="mod_passclave" required="">
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Repetir Contrase&ntilde;a:</label>
<div class="col-sm-9">
<input type="password" class="form-control" onchange="if(this.value != mod_passclave.value) { alert('Su contraseña es diferente a la ingresada anteriormente.'); this.value='';}"  placeholder="compruebe su contrase&ntilde;a"  name="mod_passclave1" id="mod_passclave1" required="">
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













<!-- Modal para activar o desactivar usuario su estado
formulario de -->

<form class="form-horizontal" action="disabled.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_activar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-check-square"> </span> Activar o Desactivar Usuario</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Estado usuario</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="mod_aid" id="mod_aid">
<label for="bussines_name" class="col-sm-3 control-label">Nombre Usuario:</label>
<div class="col-sm-9">
<input type="text" class="form-control" readonly=""  placeholder="nombre usuario"  name="mod_anombre" id="mod_nombres" required="">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Comentario:</label>
<div class="col-sm-9">
<textarea class="form-control"  placeholder="Comentario de activar o desactivar usuario"  name="mod_arazon" id="mod_razon" required=""></textarea>
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Estado:</label>
<div class="col-sm-9">
<select class="form-control" name="mod_aestado" id="mod_estado">
  <option value="Activo" selected="">Activo</option>
  <option value="Inactivo">Inactivo</option>
</select>
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



<!-- Modal para registrar un nuevo usuario
formulario-->
<form class="form-horizontal" method="post" id="guardar_user" action="guardar.php" name="guardar_cliente"  accept-charset="utf-8"   autocomplete="off" role="form">
 
<div class="modal fade" id="modal_register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-save"> </span> Nuevo usuario</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activity" data-toggle="tab">Ingrese Datos</a></li>
</ul>
<div class="tab-content">
<div class="active tab-pane" id="activity">
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Nombres:</label>
<div class="col-sm-9">
<input type="text" class="form-control" placeholder="Ingrese sus nombres es obligatorio"  name="nombre" required="">
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Apellidos:</label>
<div class="col-sm-9">
<input type="text" placeholder="Ingrese sus apellidos es obligatorio" required class="form-control" name="apellido">
</div>
</div>
<div class="form-group">
<label for="website" class="col-sm-3 control-label">E-mail:</label>
<div class="col-sm-9">
<input type="email" required placeholder="Ingrese su correo electronico es obligatorio" class="form-control"  name="email">
</div>
</div>


<div class="form-group">
<label for="first_name" required  class="col-sm-3 control-label">Usuario:</label>
<div class="col-sm-9">
<input type="text" class="form-control" placeholder="Ingrese su usuario es obligatorio"  name="usuario" required="">
</div>
</div>
<div class="form-group">
<label for="last_name" class="col-sm-3 control-label">Contrase&ntilde;a:</label>
<div class="col-sm-9">
<input type="password" required placeholder="ingrese su contrase&ntilde;a de accesso es obligatorio"  class="form-control"  name="clave" required="">
</div>
</div>
<div class="form-group">
<label for="email" class="col-sm-3 control-label">Pregunta de Seguridad:</label>
<div class="col-sm-9">
<input type="password" required  class="form-control" placeholder="Ingrese su pregunta secreta es obligatorio"  name="pregunta">
</div>
</div>
<div class="form-group">
<label for="phone" class="col-sm-3 control-label">Respuesta de Seguridad:</label>
<div class="col-sm-9">
<input type="password" required  placeholder="Ingrese su respuesta secreta" class="form-control"  name="respuesta" required="">
</div>
</div>

<div class="form-group">
<label for="" class="col-sm-3 control-label">Tipo usuario:</label>

<div class="col-sm-9">


<select name ="idtipo"  class=" form-control" required>
<option value="">--- Seleccione un Tipo Usuario ---</option>
                        <?php
                 
                        
                  $sql = "SELECT * FROM tipousuario   order by idtipousuario desc";

                        $result = $connection->query($sql);

                        $rows = $result->fetchAll();


                      foreach ($rows as $row) { 

                      echo "<option value='";
                      echo $row['idtipousuario'];           
                              
                      echo "'>";
                      echo $row['nombre']; 
                      

                      echo "</option>";

                      }

                        ?>


                        </select>

  


</div>
</div>


<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary"><span class="fa fa-save"></span> Registrar</button>
</div>
</div> 





</div> 


</div> 
</div>

</div>
</div>


</div>
</form> 



 <form class="form-horizontal" action="editar.php" method="post" id="update_registe" name="update_register"  accept-charset="utf-8"   autocomplete="off" role="form">
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-edit">  </span>Editar usuario</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="mod_id" id="mod_id">
<label for="bussines_name" class="col-sm-3 control-label">Nombres:</label>
<div class="col-sm-9">
<input type="text" class="form-control" placeholder="Ingrese sus nombres es obligatorio"  name="mod_nombre" id="mod_nombre" required="">
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Apellidos:</label>
<div class="col-sm-9">
<input type="text" placeholder="Ingrese sus apellidos es obligatorio" required class="form-control" id="mod_apellido" name="mod_apellido">
</div>
</div>
<div class="form-group">
<label for="website" class="col-sm-3 control-label">E-mail:</label>
<div class="col-sm-9">
<input type="email" required placeholder="Ingrese su correo electronico es obligatorio" id="mod_email" class="form-control"  name="mod_email">
</div>
</div>
<div class="form-group">
<label for="first_name" required  class="col-sm-3 control-label">Usuario:</label>
<div class="col-sm-9">
<input type="text" class="form-control" placeholder="Ingrese su usuario es obligatorio" id="mod_usuario"  name="mod_usuario" required="">
</div>
</div>
<div class="form-group">
<label for="email" class="col-sm-3 control-label">Pregunta de Seguridad:</label>
<div class="col-sm-9">
<input type="password" required  class="form-control" placeholder="Ingrese su pregunta secreta es obligatorio" id="mod_pregunta" name="mod_pregunta">
</div>
</div>
<div class="form-group">
<label for="phone" class="col-sm-3 control-label">Respuesta de Seguridad:</label>
<div class="col-sm-9">
<input type="password" required id="mod_respuesta" placeholder="Ingrese su respuesta secreta" class="form-control"  name="mod_respuesta" required="">
</div>
</div>

<div class="form-group">
<label for="address1" class="col-sm-3 control-label">Tipo usuario:</label>
<div class="col-sm-9">
<select name ="mod_tipo" id="mod_tipo" class="form-control" required>
<option value=""> ---Seleccione un Tipo Usuario ---</option>
                        <?php
                  
                        
                  $sql = "SELECT * FROM tipousuario   order by idtipousuario desc";

                        $result = $connection->query($sql);

                        $rows = $result->fetchAll();


                      foreach ($rows as $row) { 

                      echo "<option value='";
                      echo $row['idtipousuario'];           
                              
                      echo "' selected>";
                      echo $row['nombre']; 
                      

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
</form>
