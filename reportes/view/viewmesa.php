<?php

//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';




	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('idmesa','numeromesa','descripcion','fecha', 'estado');//Columnas de busqueda
		 $sTable = "mesa";
		 $sWhere = "";
	if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ') and';
		
   }elseif( $_GET['q'] == "" ){
   	$sWhere="WHERE";
   }


		include '../../lib/pagination.php'; //incluir el archivo de paginación
		//las variables de paginación
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		 $mostrartodo=(isset($_REQUEST['per_page']));
    if ($mostrartodo!="") {
      $porpagina=$_REQUEST['per_page'];
    }else
    {
      $porpagina=5;
    }
    


		$per_page = $porpagina; //la cantidad de registros que desea mostrar
		$adjacents  = 2; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/


//se incluye la conexion a la base de datos
	include '../../conexion/conexion.php';	
$connection = conexion();
$count_query = "SELECT * FROM $sTable $sWhere idmesa > 1 ORDER BY idmesa desc ";
$query = $connection->prepare($count_query);




if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}

$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';




// consulta para que muestre  en orden descendente los registros
$sql = "SELECT * FROM $sTable $sWhere idmesa > 1 ORDER BY idmesa desc LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
$total = $q->rowcount();		

?>

<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>
 <style>
#imga {

	width: 100px;
}

</style>

<table class="table table-condensed table-hover table-striped" >

<tbody>
	<tr>
<th>ID</th>
<th>N&uacute;mero </th>
<th>Imagen</th>
<th>Descripci&oacute;n</th>
<th>Fecha</th>
<th>Estado</th>

<th></th>
	</tr >

<!-- se utiliza para almacenar el valor en los campos de la  base de datos -->
<?php
if ($rowcount !=0){
	?>
<?php
while ($row = $q->fetch()) {
        echo "<tr>";
        echo "<td>".$row['idmesa']."</td>";
        echo "<td>".$row['numeromesa']."</td>";

        $imagend=$row['imagen'];

        if ($imagend!="") {

        	?>

        	<td><img src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>" id="imga"></td>

        	<?php 
        }else{
        	echo '<td><img src="../mesa/img/1.jpg" id="imga"></td>';
        }

  echo "<td>".$row['descripcion']."</td>";

        echo "<td>".$row['fecha']."</td>";

        echo "<td>".$row['estado']."</td>";
      /*  echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/
 

        ?>
        <!--sirven para imprimir el valor que tiene la tabla en el formulario para poder modificar -->
      <input type="hidden" value="<?php echo $row['idmesa'];?>" id="idmesa<?php echo $row['idmesa'];?>">
      <input type="hidden" value="<?php echo $row['numeromesa'];?>" id="numeromesa<?php echo $row['idmesa'];?>">

      <input type="hidden" value="<?php echo $row['descripcion'];?>" id="descripcion<?php echo $row['idmesa'];?>">
      <input type="hidden" value="<?php echo $row['fecha'];?>" id="fecha<?php echo $row['idmesa'];?>">
      <input type="hidden" value="<?php echo $row['estado'];?>" id="estado<?php echo $row['idmesa'];?>">
     

        <?php

        echo "</td>";
       
?>

<?php
    }
 
    ?>


</tr>
</tbody>

</table>

  <!-- paginacion de datos-->
<div class="box-footer clearfix">

    <?php
    //mostrando resultado de datos
     echo "Mostrando  ".$total." de ".$rowcount." registros";?>

<?php
//PAginacion de datos
 echo paginate($reload, $page, $total_pages, $adjacents)?>


</div>

<?php
}else {
  //sino se cumple lo anterior muestra el siguiente mssg donde no s muestran los datos
      ?>
      </table>
      <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4 style="text-align: center;">Aviso!!!</h4><h5 style="text-align: center;">No hay datos para mostrar</h5> 
            </div>
      <?php
    }

  }
                

?>
