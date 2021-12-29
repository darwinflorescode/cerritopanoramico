

<form class="form-horizontal" action="guardar.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="producto_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class='fa fa-save'> </span> Nuevo Producto</h4>
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
<input type="text" style="text-transform:Lowercase;" maxlength="105" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="mod_nombre" id="mod_nombre" placeholder="Ingrese el nombre del producto es obligatorio" required="" class="form-control">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Tipo men&uacute;</label>
<div class="col-sm-9">
<select class="form-control" required name="tipomenu">
    <option value="Menu a la carta" selected="">Menu a la carta</option>
  <option  value="Banquete">Banquete</option>

</select>
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tipo producto:</label>
<div class="col-sm-9">
<select class="form-control" name="tipoproducto"  required placehoder="Seleccione">
<option value="">--- Seleccione un Tipo Producto ---</option>

   <?php
                   
                    $sql = 'SELECT * FROM tipoproducto order by idtipoproducto desc';
                    $result = $conn->query($sql);
                    $rows = $result->fetchALL();
                    foreach ($rows as $row) {
                     
                  
                        echo "<option value='";
                        echo $row['idtipoproducto'];
                        echo "'>";
                        echo $row['nombre'];
                        echo "</option>";
                    }
                ?>
                </select>
</select>
</div>
</div>





<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Descripción:</label>
<div class="col-sm-9">
<textarea name="mod_descripcion" style="width:100%;"  placeholder="Ingrese una descripción del producto es obligatorio" required></textarea>
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
</form>





















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
<input type="text" style="text-transform:Lowercase;" maxlength="105" onkeyup =onkeyup ="javascript:this.value=this.value.toLowerCase();" onkeypress="return soloLetras(event);" onpaste="return false" name="modal_nombre" id="modal_nombre" placeholder="Ingrese el nombre del producto es obligatorio" required="" class="form-control">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Tipo menú o compra:</label>
<div class="col-sm-9">
<select class="form-control" name="modal_tipomenu" id="modal_tipomenu">
  <option value="Menu a la carta" selected="">Menu a la carta</option>
  <option  value="Banquete">Banquete</option>

</select>
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Tipo producto:</label>
<div class="col-sm-9">
<select class="form-control" name="modal_tipoproducto" id="modal_tipoproducto">
<option value="">--- Seleccione un Tipo Producto ---</option>
   <?php
                   
                    $sql = 'SELECT * FROM tipoproducto order by idtipoproducto desc';
                    $result = $conn->query($sql);
                    $rows = $result->fetchALL();
                    foreach ($rows as $row) {
                     
                  
                        echo "<option value='";
                        echo $row['idtipoproducto'];
                        echo "' selected>";
                        echo $row['nombre'];
                        echo "</option>";
                    }
                ?>
                </select>
</select>
</div>
</div>





<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Descripción:</label>
<div class="col-sm-9">
<textarea name="modal_descripcion" style="width:100%;" id="modal_descripcion"  placeholder="Ingrese una descripción del producto es obligatorio" required></textarea>
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


<form class="form-horizontal" action="disabled.php" method="post" accept-charset="utf-8"   autocomplete="off" role="form" >
 
<div class="modal fade" id="modal_activar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title"><span class="fa fa-check-square"> </span> Activar o Desactivar producto</h4>
</div>
<div class="modal-body">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="#activit" data-toggle="tab">Estado producto</a></li>

</ul>
<div class="tab-content">
<div class="active tab-pane" id="activit">
<div class="form-group">
<input type="hidden" name="mod_aid" id="mod_aid">
<label for="bussines_name" class="col-sm-3 control-label">Nombre producto:</label>
<div class="col-sm-9">
<input type="text" class="form-control" readonly=""  placeholder="nombre producto"  name="mod_nombrep" id="mod_nombrep" required="">
</div>
</div>
<div class="form-group">
<label for="bussines_name" class="col-sm-3 control-label">Razón o motivo:</label>
<div class="col-sm-9">
<textarea class="form-control"  placeholder="Razon o motivo de activar o desactivar producto"  name="mod_razonp" id="mod_razonp" required=""></textarea>
</div>
</div>
<div class="form-group">
<label for="tax_number" class="col-sm-3 control-label">Estado:</label>
<div class="col-sm-9">
<select class="form-control" name="mod_estadop" id="mod_estadop">
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
              * Llene los campos para Activar o Desactivar producto.
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


<?php
if (!empty($_GET['save'])) {

  $correcto = $_GET['save'];

  if ($correcto == "true") {

    ?>
    <body onload="save();"></body>
    <script>
      function save(){
        alertify.success("Excelente. Producto almacenado");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php




  }elseif($correcto =="false"){
    
    ?>
    <body onload="name();"></body>
    <script>
      function name(){
        alertify.error("Error. El nombre producto ya existe !");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php






  }elseif($correcto =="error"){
        ?>
    <body onload="error();"></body>
    <script>
      function error(){
        alertify.error("Error. Existe un error en el proceso!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php





  }




}elseif (!empty($_GET['modify'])) {

  $modificar = $_GET['modify'];

  if ($modificar == "true") {
       ?>
    <body onload="modificartrue();"></body>
    <script>
      function modificartrue(){
        alertify.success("Excelente. Datos modificados!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php
  }elseif ($modificar =="false"){

       ?>
    <body onload="modificarfalse();"></body>
    <script>
      function modificarfalse(){
        alertify.error("Error. Lo siento no pudo modificar datos!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php

  }
  else{
    header("location:mostrar.php");
  }
}




if (!empty($_GET['active'])) {

    $active = $_GET['active'];


    if ($active == "true") {
        ?>
    <body onload="activetrue();"></body>
    <script>
      function activetrue(){
        alertify.success("Excelente. Se guardaron los cambios!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>




    <?php
    }elseif ($active == "false") {
        ?>
    <body onload="activefalse();"></body>
    <script>
      function activefalse(){
        alertify.error("Error. Lo siento no se completó!");
        return false; 
        //setTimeout('location.href="mostrar.php"', 1500);
      }
    </script>

    <?php


}else{
  header("location:mostrar.php");
}



}




?>