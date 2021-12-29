<?php

include("../menu/header.php");


 if ($venta=="venta1") {

   }else{
    echo "<script>window.location='../menu/menu.php?denegado=access'</script>";
   }
//Permite solo que ingrese el usuario que ha iniciado sesion.

if (!$_SESSION["ok"])

{


  header("location:../");
}




if (!empty($_GET['id_venta'])) {

  $idventa = $_GET['id_venta'];



 
      $consultar = $conn->prepare("SELECT  orden.*,concat(cliente.nombre,' ',cliente.apellido) as nombrecliente FROM orden inner join cliente on orden.idcliente=cliente.idcliente where idorden='$idventa'");
       $consultar->execute();
         

    $dat = $consultar->fetch(PDO::FETCH_ASSOC);

$idorden=$dat['idorden'];
  $estad=$dat['estado'];
   
  
 
}else{
  echo "<script>window.location='mostrar.php'</script>";
}

?>

<script type="text/javascript" src="ajax1.js"></script> 
<script type="text/javascript" src="libs/ajaxagrega.js"></script>  <!-- Alertity -->
<div class="content-wrapper" style="min-height: 522px;">
 <input type="hidden" name="idventa" id="idventa" value="<?php echo $idventa; ?>">
<section class="content-header">

<section class="content">
<div class="row">


<div class="col-md-20">


<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="" data-toggle="tab" aria-expanded="false">Agregar Cortes&iacute;as</a></li>

<h5><span class="glyphicon glyphicon-shopping-cart"></span></h5>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<?php if ($estad=="Pendiente") {
  # code...
 ?>

<form  class="form-horizontal">
<div class="form-group ">

<label for="product_code" class="col-sm-2 control-label">Cliente:</label>
<div class="col-sm-4">
<input type="text" readonly="" required class="form-control" value="<?php echo $dat['nombrecliente']; ?>">

</div>

<label for="presentation" class="col-sm-2 control-label">Producto:</label>
<div class="col-sm-4">
<select name="cbo_producto" required onchange="load(this.value)" id="cbo_producto" style=" height: 300%;width: 77%" class="select form-control">
          <option value="0">--- Seleccione un producto ---</option>
           <?php
                  
                        
                  $sql = "SELECT * FROM producto where (tipomenu = 'Menu a la carta') And cantidad >=1 order by idproducto desc";

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
<label for="product_code" class="col-sm-2 control-label">Cantidad:</label>
<div class="col-sm-4">
<input  type='text' required placeholder="cantidad" value="1" onkeypress="return justNumbers(event);" onchange="if(cbo_producto.value==0){alert('Por favor.☻ \n Seleccione un producto'); cantidades.value='1' }else if(parseInt(this.value) > parseInt(cantidadexistente.value)){alert('Lo siento.☻ \n Cantidad Supera el Stock! O es cero'); cantidades.value='1'; }else if (parseInt(this.value) == 0){alert('Por favor.☻ \n Ingrese un numero Entero'); cantidades.value='1';}  "  class='form-control' name='cantidades' id='cantidades'>

</div>

<div class="col-sm-6">
<label class="col-sm-4 control-label"></label>
<button type="button" class="btn btn-success btn-agregar-cortesia"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Agregar</button>
       
                <a href="mostrar.php" class="btn btn-info"> <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Atras</a>
</div>







</div></form>
<div class='alert alert-info alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              Aviso!!! Cortes&iacute;as
            </div><br>


  <?php

  $que = "SELECT cortesia.*,producto.nombre as nombrepr,producto.preciounitario FROM cortesia inner join producto
  on cortesia.idproducto = producto.idproducto WHERE idorden = $idventa";
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


  $query = $conn->prepare("SELECT sum(subtotal) AS total FROM cortesia where idorden = '$idventa'");
      $query->execute();


      $totalparcial = $query->fetch(PDO::FETCH_ASSOC)['total'];
      
   ?>
<tr>
    
          <td colspan="3" style=" text-align:right;"><strong style="font-size: 12px;">TOTAL: &nbsp;</strong></td>
            <td ><?php echo "<span class='glyphicon glyphicon-usd'></span> ".number_format($totalparcial,2);?></td>
            



      </tr>

   
  </tbody>
</table>
</div>




</div>

 <?php 
 }else{

echo '<tr><td colspan="6"><div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4 style="text-align: center;">Aviso!!!</h4><h5 style="text-align: center;">No hay ninguna cortesia agregada a este cliente</h5> 
            </div></td></tr>';
  echo '  </tbody>
</table></div></div>';
}

}else{
  echo "<script>window.location='mostrar.php'</script>";
echo '<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4 style="text-align: center;">Aviso!!!</h4><h5 style="text-align: center;">Ha ocurrido un error</h5> 
            </div>';
  echo '<a href="mostrar.php" class="btn btn-info"> <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Atras</a>';
}


if ($idventa!=$idorden) {
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