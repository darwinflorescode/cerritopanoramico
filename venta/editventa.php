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



 
      $consultar = $conn->prepare("SELECT  * FROM orden where idorden='$idventa'");
       $consultar->execute();
         

    $dat = $consultar->fetch(PDO::FETCH_ASSOC);

$idorden=$dat['idorden'];
  $estad=$dat['estado'];
    $iduser = $dat['idusuario'];
   $idclient= $dat['idcliente'];
   $idmes= $dat['idmesa'];
   $idmeser= $dat['idmesero'];
   
  
 
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
<li class="active"><a href="" data-toggle="tab" aria-expanded="false">Editar Datos Principales Venta</a></li>

<h5><span class="glyphicon glyphicon-shopping-cart"></span></h5>
</ul>
<div class="tab-content">
<div id="resultados_ajax"></div>
<div class="tab-pane active" id="details">
<?php if ($estad=="Pendiente") {
  # code...
 ?>
<input type="hidden" name="idorden" id="idorden" value="<?php echo $idventa; ?>">
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
<label for="model" class="col-sm-2 control-label">Cliente:</label>
<div class="col-sm-4">
<select name="idcliente" id="idcliente" required style=" height: 300%;width: 77%" class="select form-control">
				<option value="0">--- Seleccione un Cliente ---</option>

					 <?php
				
					 $sq = "SELECT * FROM cliente where idcliente=$idclient order by idcliente desc";

            $resultado = $conn->query($sq);

            $linea = $resultado->fetchAll();


          foreach ($linea as $client) { 

          echo "<option value='";
                      echo $client['idcliente'];           
                              
                      echo "' selected>";

                      if ($client['nombre'] == "&" and $client['apellido'] =="&") {
                        echo "* No Registra Cliente";
                      }else{

                        echo "-"." ".$client['nombre']." ".$client['apellido']; 
                      }
                      
                      

                      echo "</option>";

                      }
					
                        
                  $sq = "SELECT * FROM cliente where idcliente <> $idclient order by idcliente desc";

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
<select name="idmesa" required id="idmesa" style=" height: 300%;width: 77%" class="select form-control">
				<option value="0">--- Seleccione una Mesa ---</option>
					 <?php
              
                        
                  $consult = "SELECT * FROM mesa where idmesa=$idmes  order by idmesa desc ";

                        $show = $conn->query($consult);

                        $line = $show->fetchAll();


                      foreach ($line as $data) { 

                      echo "<option value='";
                      echo $data['idmesa'];           
                              
                      echo "' selected>";
                      echo "#"." ".$data['numeromesa']; 
                      

                      echo "</option>";

                      }






                       $consult = "SELECT * FROM mesa where idmesa <> $idmes and estado = 'Disponible' or idmesa=1 order by idmesa desc";

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
<select name="idmesero" required id="idmesero" style=" height: 300%;width: 77%" class="select form-control">
				<option value="0">--- Seleccione un Mesero ---</option>
					 <?php
              
                        
                  $ver = "SELECT * FROM mesero where idmesero=$idmeser and contadormesa <= 8 and contadormesa >= 0 order by idmesero desc";

                        $raya = $conn->query($ver);

                        $col = $raya->fetchAll();


                      foreach ($col as $todo) { 

                      echo "<option value='";
                      echo $todo['idmesero'];           
                              
                      echo "' selected>";

                  

                      	echo "-"." ".$todo['nombre']." ".$todo['apellido']."&nbsp;Atiende&nbsp;".$todo['contadormesa']."&nbsp; Mesas"; 
                      
                      
                      

                      echo "</option>";

                      }





                       $ver = "SELECT * FROM mesero where idmesero <> $idmeser and contadormesa <= 8 and contadormesa >= 0 order by idmesero desc";

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

</div>
</section> 
</section> 




<?php

include("../menu/footer.php");

?>