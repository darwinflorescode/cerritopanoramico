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



 
      $consultar = $conn->prepare("SELECT  * FROM compra where idcompra='$idcompra'");
       $consultar->execute();
         

    $dat = $consultar->fetch(PDO::FETCH_ASSOC);

$idorden=$dat['idcompra'];

    $iduser = $dat['usuario_idusuario'];
   
   $idprovee= $dat['idproveedor'];
   
  
 
}else{
  echo "<script>window.location='mostrar.php'</script>";
}

?>

<script src="libs/editajax.js"></script>
<div class="content-wrapper" style="min-height: 522px;">
 
<section class="content-header">

<section class="content">
<div class="row">


<div class="col-md-20">


<div class="nav-tabs-custom">
<ul class="nav nav-tabs">
<li class="active"><a href="" data-toggle="tab" aria-expanded="false">Editar Datos Principales Compra</a></li>

<h5><span class="glyphicon glyphicon-shopping-cart"></span></h5>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">

<input type="hidden" name="idcompra" id="idcompra" value="<?php echo $idcompra; ?>">
<form  class="form-horizontal">
<div class="form-group ">

<label for="product_code" class="col-sm-2 control-label">Usuario:</label>
<div class="col-sm-4">
<select name="idusuario" id="idusuario" required  readonly class="form-control">
					 <?php
				
					
					
                        
                  $sqls = "SELECT * FROM usuario where  idusuario='$iduser'";

            $resultad = $conn->query($sqls);

            $fil = $resultad->fetchAll();


          foreach ($fil as $user) { 

          echo "<option value='";
          echo $user['idusuario'];           
                  
          echo "' selected>";
          echo $user['nombre']." ".$user['apellido']; ; 
          

          echo "</option>";

                      }

                        ?>

				</select>

</div>

<label for="presentation" class="col-sm-2 control-label">Proveedor:</label>
<div class="col-sm-4">
<select name="idproveedor" required id="idproveedor" style=" height: 300%;width: 77%" class="select form-control">
				<option value="0">--- Seleccione un Proveedor ---</option>
					 <?php
              
                        
                  $ver = "SELECT * FROM proveedor where idproveedor=$idprovee  order by idproveedor desc";

                        $raya = $conn->query($ver);

                        $col = $raya->fetchAll();


                      foreach ($col as $todo) { 

                      echo "<option value='";
                      echo $todo['idproveedor'];           
                              
                      echo "' selected>";

                  

                      	echo "-"." ".$todo['nombre']."&nbsp;"; 
                      
                      
                      

                      echo "</option>";

                      }





                       $ver = "SELECT * FROM proveedor where idproveedor <> $idprovee order by idproveedor desc";

                        $raya = $conn->query($ver);

                        $col = $raya->fetchAll();


                      foreach ($col as $todo) { 

                      echo "<option value='";
                      echo $todo['idproveedor'];           
                              
                      echo "'>";

                  

                        echo "-"." ".$todo['nombre']."&nbsp;"; 
                      
                      
                      

                      echo "</option>";

                      }

                        ?>

				</select>
</div>
</div>
<br><br><br><br>


<table class="table table-condensed table-hover table-striped" >

<tbody>
  <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
    <th> <button type="button" class="btn btn-primary btn-agregar-producto"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Agregar Productos</button>
        <button type="button"  class="btn btn btn-success btn-editar"><span class="glyphicon glyphicon-edit"></span>&nbsp;Modificar</button>
                <a href="mostrar.php" class="btn btn-info"> <span class="glyphicon glyphicon-circle-arrow-left"></span>&nbsp;Atras</a></th>
  </tr>
  </tbody>

</table>


</div>
 </form>
 <?php 




if ($idcompra!=$idcompra) {
  echo "<script>window.location='mostrar.php'</script>";
}else{
 
}
?>
</div>
 
</div>
 

</div>

</div>
</section> 
</section> 




<?php

include("../menu/footer.php");

?>