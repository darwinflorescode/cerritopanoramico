<?php

include("../menu/header.php");

 if ($compra=="compras1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }

@session_start();

//Permite solo que ingrese el usuario que ha iniciado sesion.

if (!$_SESSION["ok"])

{


  header("location:../index.php");
}


$_SESSION['detalle'] = array();





?>


    <script type="text/javascript" src="libs/ajax.js"></script>  <!-- Alertity -->
  


<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<section class="content">
<div class="row">
 
<div class="col-md-20">
<form class="form-horizontal"  accept-charset="utf-8"   autocomplete="off" role="form">
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="nuevacompra.php#details" data-toggle="tab" aria-expanded="true">Nueva compra</a></li>
<li class=""><a href="mostrar.php" data-toggle="" aria-expanded="false">Mostrar Compras</a></li>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">

<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Usuario:</label>
<div class="col-sm-4">
<select name="idusuario" readonly id="idusuario" class="form-control">
           <?php
        
          
          
                        
                  $sqls = "SELECT * FROM usuario where  usuario='$usuario' and clave = MD5('$clave')";

            $resultad = $conn->query($sqls);

            $fil = $resultad->fetchAll();


          foreach ($fil as $user) { 

          echo "<option value='";
          echo $user['idusuario'];           
                  
          echo "'>";
          echo $user['nombre']." ".$user['apellido']; ; 
          

          echo "</option>";

                      }

                        ?>

        </select>

</div>
<label for="model" class="col-sm-2 control-label">Proveedor:</label>
<div class="col-sm-4">
<select name="idproveedor" id="idproveedor" style=" height: 300%;width: 77%" class="select form-control">
 <option value="0">Seleccione un proveedor</option>
           <?php
              
                        
                  $sqlr = "SELECT * FROM Proveedor where estado='Activo'  order by idproveedor desc";

                        $resulta = $conn->query($sqlr);

                        $fila = $resulta->fetchAll();


                      foreach ($fila as $datos) { 

                      echo "<option value='";
                      echo $datos['idproveedor'];           
                              
                      echo "'>";
                      echo $datos['nombre']."  -".$datos['nombrecontacto']; 
                      

                      echo "</option>";

                      }

                        ?>

        </select>
</div>
</div>
<div class="form-group">
<label for="product_name" class="col-sm-2 control-label">Producto:</label>
<div class="col-sm-4">
<select name="cbo_producto" id="cbo_producto" style=" height: 300%;width: 77%" class="select form-control "  class="col-md-2 form-control">
          <option value="0">Seleccione un producto</option>
           <?php
                  
                        
                  $sql = "SELECT * FROM productocompra where estado='Activo' order by idproductocompra desc";

                        $result = $conn->query($sql);

                        $rows = $result->fetchAll();


                      foreach ($rows as $row) { 

                      echo "<option value='";
                      echo $row['idproductocompra'];           
                              
                      echo "'>";
                      echo $row['nombre']; 
                      

                      echo "</option>";

                      }

                        ?>


                        </select>
</div>
<label for="presentation" class="col-sm-2 control-label">Precio Unitario Compra:</label>
<div class="col-sm-4">
<input type ='text'  onkeypress="return justNumbers(event);"  placeholder="Precio Compra" name='preciocompra' id="preciocompra" class='form-control'>
</div>
</div>





<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Cantidad:</label>
<div class="col-sm-4">
<input  type='text' onchange="if (parseInt(this.value) <= 0){alert('Lo siento. Ingrese números enteros'); this.value=1;} "   placeholder="Cantidad" onkeypress="return justNumbers(event);"  class='form-control' name='cantidad' id='cantidadcompra'>

</div>
<label for="product_code" class="col-sm-2 control-label">Fecha de Vencimiento:</label>
<div class="col-sm-4">
<input  type='date'   class='form-control'  min="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" value="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>"    name='fechav' id='fechav'>

</div>
</div>
<div class="form-group ">



<div class="col-sm-6">
<label class="col-sm-4 control-label"></label>
        <button type="button" class="btn btn-primary btn-agregar-producto"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Agregar</button>
        <button type="button"  class="btn btn btn-success guardar-carrito"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;Guardar</button>
        <a href="mostrar.php" class="btn btn-info"> <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Mostrar</a>       
</div>







</div>



<div class="panel panel-default">
       <div class="panel-heading">
            <h3 class="panel-title">Listado de Compras de Productos</h3>
          </div>
      <div class="panel-body detalle-producto">
        <?php if(count($_SESSION['detalle'])>0){?>
          <table class="table">
              <thead>
                  <tr>
                      <th>Descripción</th>
                      <th>Fecha de vencimiento</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Subtotal</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                foreach($_SESSION['detalle'] as $k => $detalle){ 
                ?>
                  <tr>
                    <td><?php echo $detalle['producto'];?></td>
                    <td><?php echo $detalle['fechav'];?></td>
                      <td><?php echo number_format($detalle['cantidad'],2);?></td>
                      <td><?php echo number_format($detalle['precio'],2);?></td>
                      <td><?php echo $detalle['subtotal'];?></td>
                      <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar</button></td>
                  </tr>
                  <?php }?>
              </tbody>
          </table>
        <?php }else{?>
        <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay Productos Agregados
            </div>
        <?php }?>
      </div>
    </div>
    <button type="button" class="btn btn-primary btn-guardar-imprimir"><span class="fa fa-save"></span>&nbsp;Guardar e Imprimir</button>

</div>
 

 
</div>
 
</div>
 
</form>
 
</div>
  
 
</div>
  
 

</section> 




<?php

include("../menu/footer.php");

?>

