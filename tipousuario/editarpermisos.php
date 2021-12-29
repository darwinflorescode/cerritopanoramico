<?php

include "../menu/header.php";

 if ($admin=="adminuser1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }
if (!$_SESSION["ok"]) {

//redirecciona al index.php del sistema o login si no existe la session
    header("location:../");

} else {

}


if (!empty($_GET['idprivilegio'])) {
  $idprivilegio =$_GET['idprivilegio'];

  if (($idprivilegio!=0) || ($idprivilegio!="")) {
    # code...
 

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT modulos.*,tipousuario.nombre FROM modulos inner join tipousuario on modulos.idtipousuario=tipousuario.idtipousuario  where modulos.idtipousuario = '$idprivilegio'";
$q   = $conn->prepare($sql);

$q->execute();

$data = $q->fetch();
$idtipos=$data['idtipousuario'];

if ($idtipos!=$idprivilegio) {
   echo "<script>window.location='mostrar.php';</script>";
}
$nombretipo =$data['nombre'];
$inicio1 = $data['inicio1'];
$inicio2      = $data['inicio2'];
$inicio3   = $data['inicio3'];

$compra = $data['compra'];
$inventario    = $data['inventario'];
$evento = $data['evento'];
$restaurante = $data['restaurante'];
$contacto = $data['contacto'];
$venta=$data['venta'];
$reporte=$data['reporte'];
$configuracion=$data['configuracion'];
$admin=$data['admin'];

if ($inicio1=="inicio11") {
 $inicio1='checked="true"';
}
if ($inicio2=="inicio21") {
 $inicio2='checked="true"';
}
if ($inicio3=="inicio31") {
 $inicio3='checked="true"';
}
if ($compra=="compras1") {
 $compra='checked="true"';
}
if ($inventario=="inventario1") {
 $inventario='checked="true"';
}
if ($evento=="evento1") {
 $evento='checked="true"';
}
if ($restaurante=="restaurante1") {
 $restaurante='checked="true"';
}
if ($contacto=="contacto1") {
 $contacto='checked="true"';
}
if ($venta=="venta1") {
 $venta='checked="true"';
}
if ($reporte=="reporte1") {
 $reporte='checked="true"';
}
if ($configuracion=="configuracion1") {
 $configuracion='checked="true"';
}
if ($admin=="adminuser1") {
 $admin='checked="true"';
}

?>
 <style>
#imga {

 width: 200px;
  height: 225px;
}

#imgaa {

 width: 60px;
  height: 80px;
}

#imgas {

    width: 100px;
  height: 120px;
}

</style>
<div class="content-wrapper" style="min-height: 400px;">
<section class="content-header">

</section>

  <div class="form-panel">
    <div class="container-fluid">
      <div class="row">
      <form method="POST" action="editarper.php" >
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >


          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><i class='fa fa-edit'></i> Privilegios</h3>
            </div>
            <div class="panel-body">
              <div class="row">

  
<div class="modal-body">
<div id="loader2" class="text-center"></div>
<div class="outer_div2"> <div class="form-group  ">
<label for="nombres" class="col-sm-2 control-label">Tipo Usuario:</label>
<div class="col-sm-4">
<input type="hidden" name="idtipouser"  value="<?php echo $idtipos; ?>">
<input type="text" class="form-control" readonly="" name="nombres" value="<?php echo $nombretipo; ?>" >

</div>
</div>
<table class="table table-hover table-nomargin">
<thead>
<tr>
<th>Módulo</th>
<th><input name="Todos" type="checkbox" value="1" id="todo" class=""/> Todos</th>

</tr>
</thead>
<tbody>
<tr>
<td>
Inicio Secci&oacute;n 1: (<font color="green" size="2">Vista</font>) <input type='hidden' name='permiso1' value='inicio1'>
</td>
<td><input type='checkbox' name='inicio1' value='1' <?php echo $inicio1; ?> class='ck'></td>

</tr>
<tr>
<td>
Inicio Secci&oacute;n 2: (<font color="green" size="2">Vista</font>) <input type='hidden' name='permiso2' value='inicio2'>
</td>
<td><input type='checkbox' name='inicio2' value='1' <?php echo $inicio2; ?> class='ck'></td>

</tr>
<tr>
<td>
Inicio Secci&oacute;n 3: (<font color="green" size="2">Vista</font>)<input type='hidden' name='permiso3' value='inicio3'>
</td>
<td><input type='checkbox' name='inicio3' value='1' <?php echo $inicio3; ?> class='ck'></td>

</tr>
<tr>
<td>
Compras: (<font color="green" size="2">Nuevas  Compras, Historial de Compras, Producto de Compras</font>) <input type='hidden' name='permiso4' value='compras'>
</td>
<td><input type='checkbox' name='compra1' value='1' <?php echo $compra; ?> class='ck'></td>

</tr>
<tr>
<td>
Inventario: (<font color="green" size="2">Tipo Producto, Productos, Producci&oacute;n</font>)<input type='hidden' name='permiso5' value='inventario'>
</td>
<td><input type='checkbox' name='inventario1' value='1' <?php echo $inventario; ?> class='ck'></td>

</tr>
<tr>
<td>
Eventos Especiales: (<font color="green" size="2">Evento paso a paso, Crear evento especial, Entradas, Platillo Fuerte, Adicional Incluye, Condiciones, Confirmar Evento</font>) <input type='hidden' name='permiso6' value='evento'>
</td>
<td><input type='checkbox' name='evento1' value='1' <?php echo $evento; ?> class='ck'></td>

</tr>
<tr>
<td>
Restaurante: (<font color="green" size="2">Mesas, Mesero</font>) <input type='hidden' name='permiso7' value='restaurante'>
</td>
<td><input type='checkbox' name='restaurante1' <?php echo $restaurante; ?> value='1' class='ck'></td>

</tr>
<tr>
<td>
Contactos: (<font color="green" size="2">Clientes, Proveedores</font>) <input type='hidden' name='permiso8' value='contacto'>
</td>
<td><input type='checkbox' name='contacto1' value='1' <?php echo $contacto; ?> class='ck'></td>

</tr>
<tr>
<td>
Facturaci&oacute;n:(<font color="green" size="2">Nueva Venta, Administrar Ventas</font>) <input type='hidden' name='permiso9' value='venta'>
</td>
<td><input type='checkbox' name='venta1' <?php echo $venta; ?> value='1' class='ck'></td>

</tr>
<tr>
<td>
Reportes: (<font color="green" size="2">Todos los reportes</font>)<input type='hidden' name='permiso10' value='reporte'>
</td>
<td><input type='checkbox' name='reporte1' <?php echo $reporte; ?> value='1' class='ck'></td>

</tr>
<tr>
<td>
Admnistrar Usuarios: (<font color="green" size="2">Tipo Usuario, Usuarios</font>) <input type='hidden' name='permiso11' value='adminuser'>
</td>
<td><input type='checkbox' name='adminuser1' <?php echo $admin; ?> value='1' class='ck'></td>

</tr>
<tr>
<td>
Configuraci&oacuten: (<font color="green" size="2">Perfil Restaurante, Copia de seguridad de Base de Datos</font>)<input type='hidden' name='permiso12' value='configuracion'>
</td>
<td><input type='checkbox' name='configuracion1' <?php echo $configuracion; ?> value='1' class='ck'></td>

</tr>

</tbody>
</table></div>
</div>


 


<center><button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-refresh"></i> Actualizar Privilegios</button>
<a href="mostrar.php" class="btn btn-success">Atr&aacute;s&nbsp;</a></center>





                </div>
        <div class='col-md-12' id="resultados_ajax"></div><!-- Carga los datos ajax -->
              </div>
            </div>
              
          </div>
        </div>
    </form>
      </div>
    </div>


<script type="text/javascript">
  

  $('#todo').change(function() {
    var checkboxes = $(".ck");
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});
</script>


</section>

  <?php

   }else{
      echo "<script>window.location='mostrar.php';</script>";
   }
}elseif(empty($_GET['idprivilegio'])){
 echo "<script>window.location='mostrar.php';</script>";
}
include "../menu/footer.php"
?>

