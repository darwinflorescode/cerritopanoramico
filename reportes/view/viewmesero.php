<?php

//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('idmesero', 'codigo', 'nombre', 'apellido', 'telefono', 'direccion','fecha','estado', 'contadormesa');//Columnas de busqueda
		 $sTable = "mesero";
		 $sWhere = "";
	if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		
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

//se realiza la conxion a la base de datos

	include '../../conexion/conexion.php';	
$connection = conexion();
$count_query = "SELECT * FROM $sTable $sWhere  order by idmesero desc ";
$query = $connection->prepare($count_query);


if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}

$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';

// consulta para que muestre  en orden descendente los registros

$sql = "SELECT * FROM $sTable $sWhere ORDER BY idmesero desc LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
$total = $q->rowcount();
$model = array();
while($rows = $q->fetch())
{
    $model[] = $rows;
}
		

?>

<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped" >

<tbody>
	<tr>
<th>ID</th>
<th>C&oacute;digo </th>
<th>Nombre</th>
<th>Apellido</th>
<th>Tel&eacute;fono</th>
<th>Direcci&oacute;n</th>
<th>Fecha</th>
<th>Estado</th>
<th>Mesas</th>

<th></th>
	</tr >

<!-- se utiliza para almacenar el valor en los campos de la  base de datos -->
<?php
if ($rowcount !=0){
	?>
<?php
foreach($model as $row)
    {
        echo "<tr>";
        echo "<td>".$row['idmesero']."</td>";
        echo "<td>".$row['codigo']."</td>";


        echo "<td>".$row['nombre']."</td>";

        echo "<td>".$row['apellido']."</td>";

        echo "<td>".$row['telefono']."</td>";
        echo "<td>".$row['direccion']."</td>";
          echo "<td>".$row['fecha']."</td>";
        echo "<td>".$row['estado']."</td>";
        echo "<td>".$row['contadormesa']."</td>";
      /*  echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/
 

        ?>

         <!--sirven para imprimir el valor que tiene la tabla en el formulario para poder modificar -->
      <input type="hidden" value="<?php echo $row['idmesero'];?>" id="idmesa<?php echo $row['idmesero'];?>">
      <input type="hidden" value="<?php echo $row['codigo'];?>" id="codigo<?php echo $row['idmesero'];?>">
      <input type="hidden" value="<?php echo $row['nombre'];?>" id="nombre<?php echo $row['idmesero'];?>">
      <input type="hidden" value="<?php echo $row['apellido'];?>" id="apellido<?php echo $row['idmesero'];?>">
      <input type="hidden" value="<?php echo $row['telefono'];?>" id="telefono<?php echo $row['idmesero'];?>">
      <input type="hidden" value="<?php echo $row['direccion'];?>" id="direccion<?php echo $row['idmesero'];?>">
      <input type="hidden" value="<?php echo $row['estado'];?>" id="estado<?php echo $row['idmesero'];?>">
     
     

        <?php

        echo "</td>";


          # code...
        
        
?>

<!-- esta linea sirve para eliminar un registro-->

</div> 
</td>

<?php

    }
 
    ?>




</tr>
</tbody>

</table>


<div class="box-footer clearfix">

		<?php echo "Mostrando  ".$total." de ".$rowcount." registros";?>



<?php echo paginate($reload, $page, $total_pages, $adjacents)?>


</div>

<!-- sirve para mostrar un mensaje de que no hay registros almacenados-->
<?php
}else {
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