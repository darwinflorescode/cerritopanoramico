<?php

include("../menu/header.php");


 if ($compra=="compras1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }
//Permite solo que ingrese el usuario que ha iniciado sesion.

if (!$_SESSION["ok"])

{


  header("location:../");
}




if (!empty($_GET['id_compra'])) {

  $idcompra = $_GET['id_compra'];



 
      $consultar = $conn->prepare("SELECT  compra.*,proveedor.nombre as nombreproveedor FROM compra inner join proveedor on compra.idproveedor=proveedor.idproveedor where idcompra='$idcompra'");
       $consultar->execute();
         

    $dat = $consultar->fetch(PDO::FETCH_ASSOC);

$idcompra=$dat['idcompra'];
  
   
  
 
}else{
  echo "<script>window.location='mostrar.php'</script>";
}

?>


<script type="text/javascript" src="libs/ajaxagrega.js"></script>  <!-- Alertity -->
<div class="content-wrapper" style="min-height: 522px;">
 <input type="hidden" name="idcompra" id="idcompra" value="<?php echo $idcompra; ?>">
<section class="content-header">

<section class="content">
<div class="row">


<div class="col-md-20">


<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="" data-toggle="tab" aria-expanded="false">Agregar Productos</a></li>

<h5><span class="glyphicon glyphicon-shopping-cart"></span></h5>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>

<form  class="form-horizontal">
<div class="form-group ">

<label for="product_code" class="col-sm-2 control-label">Proveedor:</label>
<div class="col-sm-4">
<input type="text" readonly="" required class="form-control" value="<?php echo $dat['nombreproveedor']; ?>">

</div>

<label for="presentation" class="col-sm-2 control-label">Producto:</label>
<div class="col-sm-4">
<select name="cbo_producto" required onchange="load(this.value)" id="cbo_producto" style=" height: 300%;width: 77%" class="select form-control">
          <option value="0">--- Seleccione un producto ---</option>
           <?php
                  
                        
                  $sql = "SELECT * FROM productocompra  order by idproductocompra desc";

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
</div>


<div class="form-group ">


<label for="presentation" class="col-sm-2 control-label">Precio Unitario Compra:</label>
<div class="col-sm-4">
<input type="text" onkeypress="return justNumbers(event);" name="preciocompra" id="preciocompra" class="form-control">
                        
</div>
<label for="product_code" class="col-sm-2 control-label">Cantidad a Comprar:</label>
<div class="col-sm-4">
<input  type='text' required placeholder="cantidad" value="1" onkeypress="return justNumbers(event);" onchange="if(cbo_producto.value==0){alert('Por favor.☻ \n Seleccione un producto'); cantidades.value='1' } "  class='form-control' name='cantidades' id='cantidades'>

</div>
</div>




<div class="form-group ">


<div class="col-sm-6">
<label class="col-sm-4 control-label"></label>
<button type="button" class="btn btn-success btn-agregar-producto"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Agregar</button>
       
                <a href="mostrar.php" class="btn btn-info"> <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Atras</a>
</div>







</div></form>
<div class='alert alert-info alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              Aviso!!! Detalle de compras
            </div><br>


  <?php


  $que = "SELECT detallecompra.*,productocompra.nombre as nombrepr,productocompra.preciounitario FROM detallecompra inner join productocompra on detallecompra.idproductocompra = productocompra.idproductocompra WHERE idcompra = $idcompra";
  $res = $conn->query($que);
  $filas = $res->fetchAll();
  $todo = count($filas);

  ?>
<table class="table table-condensed table-hover table-striped">
  <tbody>
    <tr>
      <th>CANTIDAD</th>
      <th>DESCRIPCI&Oacute;N</th>
      <th>PRECO UNITARIO</th>
      <th align="center">PRECIO TOTAL</th>
      <th></th>
   
    </tr>

      <?php
        if ($todo>=1) {
          # code...
        
  foreach ($filas as $mostrar) {


  ?>
    <tr>

        
      <td><?php echo $mostrar['cantidad'] ; ?></td>
        <td> <?php echo $mostrar['nombrepr'] ; ?></td>
        <td><span class='glyphicon glyphicon-usd'></span><?php echo $mostrar['precio'] ; ?></td>
         <td ><span class='glyphicon glyphicon-usd'></span> <?php echo $mostrar['subtotal'] ; ?></td>

          </tr>
   <?php

}


  $query = $conn->prepare("SELECT sum(subtotal) AS total FROM detallecompra where idcompra = '$idcompra'");
      $query->execute();


      $totalparcial = $query->fetch(PDO::FETCH_ASSOC)['total'];
   
   ?>
<tr>
    
          <td colspan="3" style=" text-align:right;"><strong style="font-size: 12px;">SUBTOTAL: &nbsp;</strong></td>
            <td ><?php echo "<span class='glyphicon glyphicon-usd'></span> ".number_format($totalparcial,2);?></td>
            



      </tr>
      
       <tr>
    
          <td colspan="3" style=" text-align:right;"><strong style="font-size: 12px;">TOTAL A PAGAR: &nbsp;</strong></td>
            <td><?php echo "<span class='glyphicon glyphicon-usd'></span> ".number_format($totalparcial,2) ;?></td>
            



      </tr>

   
  </tbody>
</table>
</div>




</div>

 <?php 
 }



if ($idcompra!=$idcompra) {
  echo "<script>window.location='mostrar.php'</script>";
}else{
 
}
?>
</div>
 
</div>
 

</div>


</section> 
</section> 




<?php

include("../menu/footer.php");

?>