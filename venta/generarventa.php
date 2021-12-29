<?php

include("../menu/header.php");

 if ($venta=="venta1") {

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
  <script type="text/javascript" src="ajax1.js"></script> 

<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<section class="content">
<div class="row">


<div class="col-md-20">
<form name="update_register" id="" class="form-horizontal" >
<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="" data-toggle="tab" aria-expanded="false">Nueva Venta</a></li>

<h5><span class="glyphicon glyphicon-shopping-cart"></span></h5>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Usuario:</label>
<div class="col-sm-4">
<select name="idusuario" id="idusuario" readonly class="form-control">
					 <?php
				
					
					
                        
                  $sqls = "SELECT * FROM usuario where  usuario='$usuario' and clave = MD5('$clave')";

            $resultad = $conn->query($sqls);

            $fil = $resultad->fetchAll();


          foreach ($fil as $user) { 

          echo "<option value='";
          echo $user['idusuario'];           
                  
          echo "'>";
          echo $user['nombre']." ".$user['apellido']; 
          

          echo "</option>";

                      }

                        ?>

				</select>

</div>
<label for="model" class="col-sm-2 control-label">Cliente:</label>
<div class="col-sm-4">
<select name="idcliente" id="idcliente" style=" height: 300%;width: 77%" class="select form-control">
				<option value="0">--- Seleccione un Cliente ---</option>
					 <?php
				
					
					
                        
                  $sq = "SELECT * FROM cliente order by idcliente desc";

            $resultado = $conn->query($sq);

            $linea = $resultado->fetchAll();


          foreach ($linea as $client) { 

          echo "<option value='";
                      echo $client['idcliente'];           
                              
                      echo "'>";

                      if ($client['nombre'] == "&" and $client['apellido'] =="&") {
                        echo "* No Registra Cliente";
                      }else{

                        echo "-"." ".$client['nombre']." ".$client['apellido']; 
                      }
                      
                      

                      echo "</option>";

                      }

                        ?>

				</select>
</div>
</div>
<div class="form-group">
<label for="product_name" class="col-sm-2 control-label">Mesa:</label>
<div class="col-sm-4">
<select name="idmesa" id="idmesa" style=" height: 300%;width: 77%" class="select form-control">
				<option value="0">--- Seleccione una Mesa ---</option>
					 <?php
              
                        
                  $consult = "SELECT * FROM mesa where estado = 'Disponible' or idmesa=1 ";

                        $show = $conn->query($consult);

                        $line = $show->fetchAll();


                      foreach ($line as $data) { 

                      echo "<option value='";
                      echo $data['idmesa'];           
                              
                      echo "'>";
                      echo "#"." ".$data['numeromesa']; 
                      

                      echo "</option>";

                      }

                        ?>

				</select>
</div>
<label for="presentation" class="col-sm-2 control-label">Mesero:</label>
<div class="col-sm-4">
<select name="idmesero" id="idmesero" style=" height: 300%;width: 77%" class="select form-control">
				<option value="0">--- Seleccione un Mesero ---</option>
					 <?php
              
                        
                  $ver = "SELECT * FROM mesero where contadormesa <= 8 and contadormesa >= 0";

                        $raya = $conn->query($ver);

                        $col = $raya->fetchAll();


                      foreach ($col as $todo) { 

                      echo "<option value='";
                      echo $todo['idmesero'];           
                              
                      echo "'>";

                  

                      	echo "-"." ".$todo['nombre']." ".$todo['apellido']."&nbsp;Atiende&nbsp;".$todo['contadormesa']."&nbsp; Mesas"; 
                      
                      
                      

                      echo "</option>";

                      }

                        ?>

				</select>
</div>
</div>

<div class="form-group">
<label for="product_name" class="col-sm-2 control-label">Fecha:</label>
<div class="col-sm-4">
<input type="date" readonly=""  value="<?php date_default_timezone_set('America/El_Salvador'); echo date('Y-m-d');?>" name="fecha" id="fecha" class="form-control">
</div>
<label for="presentation" class="col-sm-2 control-label">Producto:</label>
<div class="col-sm-4">
<select name="cbo_producto" id="cbo_producto" onchange="load(this.value);cantidades.value='1'; if (this.value==0){cantidades.value=1;} if (this.value==0){cantidades.value=1;} "  style=" height: 300%;width: 77%" class="select form-control">
					<option value="0">--- Seleccione un producto ---</option>
					 <?php

           date_default_timezone_set('America/El_Salvador'); 
        $fechas = date('Y-m-d');
                  
                        
                  $sql = "SELECT * FROM producto where (tipomenu = 'Menu a la carta') And cantidad >=1 and estado='Activo' and fechav >= '$fechas' order by idproducto desc";

                        $result = $conn->query($sql);

                        $rows = $result->fetchAll();


                      foreach ($rows as $row) { 

                      echo "<option value='";
                      echo $row['idproducto'];           
                              
                      echo "'>";
                      echo $row['nombre']; 
                      

                      echo "</option>";

                      }

                        ?>


                        </select>
                        
</div>
</div>



<div id="myDiv"></div>


<div class="form-group ">
<label for="product_code" class="col-sm-2 control-label">Cantidad a vender:</label>
<div class="col-sm-4">
<input  type='text' placeholder="cantidad" value="1" onkeypress="return justNumbers(event);" onchange="if((parseInt(this.value) > parseInt(cantidadexistente.value))){alert('Lo siento.☻ \n Cantidad Supera el Stock! O es cero'); cantidades.value='1';}   if (parseInt(this.value)==0){alert('Lo siento.☻ \n Cantidad Supera el Stock! O es cero'); cantidades.value='1';} "  class='form-control' name='cantidades' id='cantidades'>

</div>

<div class="col-sm-6">
<label class="col-sm-4 control-label"></label>
        <button type="button" class="btn btn-primary btn-agregar-producto"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Agregar</button>
        <button type="button"  class="btn btn btn-success guardar-carrito"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;Guardar</button>
                <a href="mostrar.php" class="btn btn-info"> <span class="glyphicon glyphicon-eye-open"></span>&nbsp;Mostrar</a>
</div>







</div>



<div class="panel panel-success">
       <div class="panel-heading panel-red">
            <h1 class="panel-title"><b><i>Listado de productos agregados a la venta</i></b></h1>
          </div>
      <div class="panel-body detalle-producto">
        <?php if(count($_SESSION['detalle'])>0){?>
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Nomnbre / Descripción</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total /Producto</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                foreach($_SESSION['detalle'] as  $detalle){ 
                ?>
                  <tr>
                    <td><?php echo $detalle['producto'];?></td>
                      <td><?php echo $detalle['cantidad'];?></td>
                       <td><?php echo $detalle['stock'];?></td>
                      <td><?php echo $detalle['precio'];?></td>
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
<a class="btn btn-primary " href="cancelar.php"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Vaciar carrito</a>
</div>
 
</div>
 
</div>
 
</form>
</div>

</div>
</section> 
</section> 




<?php

include("../menu/footer.php");

?>