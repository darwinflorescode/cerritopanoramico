
<!--formulario para el registro nuevo -->
<script src="view/ajax.js"></script>
<form class="form-horizontal" action="guardar.php" method="POST" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="clienteconfirmaevento_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span>&nbsp;Cliente Confirma Evento</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Ingrese Datos</a></li>

</ul>

<div class="form-group">
<?php 

session_start();
$usuario = $_SESSION['usuario'];
$clave = $_SESSION['pass'];
$conn=conexion();
 $sqls = "SELECT * FROM usuario where  usuario='$usuario' and clave = MD5('$clave')";

            $resultad = $conn->prepare($sqls);
            $resultad->execute();

            $user=$resultad->fetch();
            

 ?>
 <input type="hidden" name="usuario" value="<?php echo $user['nombre']." ".$user['apellido'];; ?>">
<label for="tax_number" class="col-sm-3 control-label">Cliente:</label>
<div class="col-sm-9">
  
<select name ="mod_cliente" id='mod_cliente' style="color:blue;" class=" form-control" required>
<option value="">--- Seleccione un cliente---</option>
                        <?php
                 
                        
                  $sql = "SELECT * FROM cliente where idcliente>1  order by idcliente desc";

                        $result = $connection->query($sql);

                        $rows = $result->fetchAll();


                      foreach ($rows as $row) { 

                      echo "<option value='";
                      echo $row['idcliente'];           
                              
                      echo "'>";
                      echo $row['nombre']." ".$row['apellido']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";if ($row['dui']=="") {
                        echo $row['dui'];
                      }else{echo "Dui:&nbsp;".$row['dui'].""; }
                      

                      echo "</option>";

                      }

                        ?>


                        </select>

</div>
</div>


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Evento Especial:</label>
<div class="col-sm-9">
  
<select name ="mod_eventosespeciales" onchange="loadd(this.value); mod_cantidad.value=''; mod_preciototal.value='';mod_pendiente.value=''; mod_adelanto.value='';"  class=" form-control" required style="color:blue;">
<option value="">--- Seleccione un Evento ---</option>
                        <?php
                 
                        
                  $sqld = "SELECT * FROM eventosespeciales where preciopersona > 0 order by ideventosespeciales desc";

                        $resultado = $connection->query($sqld);

                        $rowsc = $resultado->fetchAll();


                      foreach ($rowsc as $rowf) { 

                      echo "<option value='";
                      echo $rowf['ideventosespeciales'];           
                              
                      echo "'>";
                      echo $rowf['opcion']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Precio: $&nbsp;".$rowf['preciopersona']; 
                      

                      echo "</option>";

                      }

                        ?>


                        </select>

</div>
</div>


<div id="myDiv"></div>



<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Cantidad Personas:</label>
<div class="col-sm-9">
<input type="number" name="mod_cantidad" onkeypress="return justNumbers(event);" onchange="if (parseInt(this.value)==0){alert('La cantidad debe ser mayor a cero'); this.value=''}else{mod_preciototal.value=this.value*mod_precio.value; calculo.value=(this.value*mod_precio.value)/2;} "  id="mod_cantidad" placeholder="Ingrese cantidad de personas" required="" class="form-control">
</div>
</div>


<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Precio Total $:</label>
<div class="col-sm-9">
<input type ='text' onkeypress="return justNumbers(event);" readonly="" placeholder="Ingrese el Precio Total del Evento" name='mod_preciototal' id="mod_preciototal" class='form-control'>

</div>
</div>


<div class="form-group">
<label for="Fechaevento" class="col-sm-3 control-label">Fecha del Evento:</label>
<div class="col-sm-9">
<input type="date" min="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" value="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" class="form-control" id="mod_fecha" name="mod_fecha" placeholder="Seleccione La Fecha del Evento" required />
</div>
</div>
              

<div class="form-group">
<label for="horainicio" class="col-sm-3 control-label">Hora de Inicio:</label>
<div class="col-sm-9">
<input type="time" class="form-control" id="mod_horainicio" name="mod_horainicio" placeholder="Escriba Aqu&iacute; La Hora de Inicio del evento" required />
</div>
</div>


<div class="form-group">
<label for="horafin" class="col-sm-3 control-label">Hora Fin:</label>
<div class="col-sm-9">
<input type="time" class="form-control" id="mod_horafin" name="mod_horafin" placeholder="Escriba Aqu&iacute; La Hora de Inicio del evento" required />
</div>
</div>


<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Anticipo (50%) $:</label>
<div class="col-sm-9">
<input type="text" readonly="" placeholder="El 50%" name="calculo" >* <font color="red">Sugerido</font>
<input type ='text'  placeholder="Ingrese el Anticipo del Evento" onkeypress="return justNumbers(event);" onchange="if((parseFloat(this.value) > parseFloat(mod_preciototal.value))){alert('Lo siento.☻ \n El anticipo es > a lo acordado.'); this.value='';this.focus(); mod_pendiente.value='';}else{(mod_pendiente.value)=parseFloat(mod_preciototal.value) - parseFloat(this.value);}   if (parseFloat(this.value)==0){alert('Lo siento.☻ \n El anticipo debe ser <> a  0.'); this.value=''; this.focus(); mod_pendiente.value='';}else{(mod_pendiente.value)=parseFloat(mod_preciototal.value)- parseFloat(this.value);}  " name='mod_adelanto' id="mod_adelanto" class='form-control'>
</div>
</div>

<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Pendiente $:</label>
<div class="col-sm-9">
<input type ='text' readonly="" placeholder="Ingrese la cantidad pendiente del pago del Evento" name='mod_pendiente' id="mod_pendiente" class='form-control'>
</div>
</div>




<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-primary" onmousemove="if((parseFloat(mod_adelanto.value) > parseFloat(mod_preciototal.value))){alert('Lo siento.☻ \n El anticipo es > a lo acordado.'); mod_adelanto.value='';mod_adelanto.focus(); mod_pendiente.value='';}else{(mod_pendiente.value)=parseFloat(mod_preciototal.value) - parseFloat(mod_adelanto.value);}   if (parseFloat(this.value)==0){alert('Lo siento.☻ \n El anticipo debe ser <> a  0.'); mod_adelanto.value=''; mod_adelanto.focus(); mod_pendiente.value='';}else{(mod_pendiente.value)=parseFloat(mod_preciototal.value)- parseFloat(mod_adelanto.value);}  "><span class="fa fa-save"> </span> Registrar</button>
</div>

</div> 

</div> 
</div> 
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



<!--formulario para editar registro-->
<form class="form-horizontal"  action="editar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'></span> Editar Confirmacion del Cliente</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">

<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="idconfirmar" id="idconfirmar">
<label for="tax_number" class="col-sm-3 control-label">Cliente:</label>
<div class="col-sm-9">
  
<select name ="modal_cliente" id='modal_cliente' style="color:gray;" class=" form-control" required>
<option value="">--- Seleccione un cliente---</option>
                        <?php
                 
                        
                  $sqlc = "SELECT * FROM cliente where idcliente>1  order by idcliente desc";

                        $resultt = $connection->query($sqlc);

                        $r = $resultt->fetchAll();


                      foreach ($r as $ro) { 

                      echo "<option value='";
                      echo $ro['idcliente'];           
                              
                      echo "' selected>";
                    echo $row['nombre']." ".$ro['apellido']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";if ($ro['dui']=="") {
                        echo $ro['dui'];
                      }else{echo "Dui:&nbsp;".$ro['dui'].""; }
                      

                      echo "</option>";

                      }

                        ?>


                        </select>

</div>
</div>


<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Evento Especial:</label>
<div class="col-sm-9">
  
<select name ="modal_eventosespeciales" id='modal_eventosespeciales' onmousemove ="loading(this.value);" onchange="loading(this.value); modal_cantidad.value=''; modal_preciototal.value='';modal_pendiente.value=''; modal_adelanto.value='';"  class=" form-control" required style="color:blue;" >
<option value="">--- Seleccione un Evento ---</option>
                        <?php
                 
                        
                  $sqlr = "SELECT * FROM eventosespeciales where preciopersona > 0 order by ideventosespeciales desc";

                        $resulta = $connection->query($sqlr);

                        $rowse = $resulta->fetchAll();


                      foreach ($rowse as $rowa) { 

                      echo "<option value='";
                      echo $rowa['ideventosespeciales'];           
                              
                      echo "'selected>";
                      echo $rowa['opcion']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Precio: $&nbsp;".$rowa['preciopersona']; 
                      

                      echo "</option>";

                      }

                        ?>


                        </select>

</div>
</div>


<div id="myDi"></div>





<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Cantidad de Personas:</label>
<div class="col-sm-9">
<input type="text" onkeypress="return justNumbers(event);" onchange="if (parseInt(this.value)==0){alert('La cantidad debe ser mayor a cero'); this.value=''}else{modal_preciototal.value=this.value*mod_precio.value}" onfocus="loading(modal_eventosespeciales.value);" name="modal_cantidad" id="modal_cantidad" placeholder="Ingrese cantidad de personas" required="" class="form-control">
</div>
</div>


<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Precio Total $:</label>
<div class="col-sm-9">
<input type ='text'  placeholder="Ingrese el Precio Total del Evento" name='modal_preciototal' id="modal_preciototal" class='form-control'>
</div>
</div>


<div class="form-group">
<label for="Fechaevento" class="col-sm-3 control-label">Fecha del Evento:</label>
<div class="col-sm-9">
<input type="date" class="form-control" min="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" value="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" class="form-control" id="modal_fecha" name="modal_fecha" placeholder="Seleccione La Fecha del Evento" required />
</div>
</div>
              

<div class="form-group">
<label for="horainicio" class="col-sm-3 control-label">Hora de Inicio:</label>
<div class="col-sm-9">
<input type="time" class="form-control" id="modal_horainicio" name="modal_horainicio" placeholder="Escriba Aqu&iacute; La Hora de Inicio del evento" required />
</div>
</div>


<div class="form-group">
<label for="horafin" class="col-sm-3 control-label">Hora Fin:</label>
<div class="col-sm-9">
<input type="time" class="form-control" id="modal_horafin" name="modal_horafin" placeholder="Escriba Aqu&iacute; La Hora de Inicio del evento" required />
</div>
</div>


<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Anticipo(50%) $:</label>
<div class="col-sm-9">
<input type ='text' onkeypress="return justNumbers(event);" onchange="if((parseFloat(this.value) > parseFloat(modal_preciototal.value))){alert('Lo siento.☻ \n El anticipo es > a lo acordado.'); this.value='';this.focus(); modal_pendiente.value='';}else{(modal_pendiente.value)=parseFloat(modal_preciototal.value) - parseFloat(this.value);}   if (parseFloat(this.value)==0){alert('Lo siento.☻ \n El anticipo debe ser <> a  0.'); this.value=''; this.focus(); modal_pendiente.value='';}else{(modal_pendiente.value)=parseFloat(modal_preciototal.value)- parseFloat(this.value);} "  placeholder="Ingrese el Anticipo del Evento" name='modal_adelanto' id="modal_adelanto" class='form-control'>
</div>
</div>

<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Pendiente $:</label>
<div class="col-sm-9">
<input type ='text' readonly=""  placeholder="Ingrese la cantidad pendiente del pago del Evento" name='modal_pendiente' id="modal_pendiente" class='form-control'>
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
</div>
</div>
</div>
</div>

</form>













<!--formulario para editar registro-->
<form class="form-horizontal"  action="cancelar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_cancelar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-edit'></span> Cancelar Evento</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">

<li class="active"><a href="#activit" data-toggle="tab">Modifique Datos</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<input type="hidden" name="idconfirmarcancelacion" id="idconfirmarcancelacion">


<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Precio Total $:</label>
<div class="col-sm-9">
<input type ='text' readonly=""  placeholder="Ingrese el Precio Total del Evento" name='cancelartotal' id="cancelartotal" class='form-control'>
</div>
</div>



<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Anticipo(50%) $:</label>
<div class="col-sm-9">
<input type ='text'  readonly="" onkeypress="return justNumbers(event);"  placeholder="Ingrese el Anticipo del Evento" name='aplicaradelanto' id="aplicaradelanto" class='form-control'>
</div>
</div>

<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Porcentaje devolución (50%) $:</label>
<div class="col-sm-9">
<input type ='text' onkeypress="return justNumbers(event);" onchange="if (this.value <=0 ){alert('Digite Numeros positivos'); this.value=''}else{nuevototal.value=aplicaradelanto.value*this.value;} "   placeholder="Ingrese la cantidad pendiente del pago del Evento" name='devolucion' id="devolucion" class='form-control'>
</div>
</div>

<div class="form-group">
<label for="presentation" class="col-sm-3 control-label">Nuevo Total $:</label>
<div class="col-sm-9">
<input type ='text' readonly=""  placeholder="NUevo total dinero" name='nuevototal' id="nuevototal" class='form-control'>
</div>
</div>









<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"> </span> Cerrar</button>
<button type="submit" id="guardar_datos" class="btn btn-danger"><span class="fa fa-edit"> </span> Aplicar</button>
</div>

</div> 

</div> 
</div> 
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