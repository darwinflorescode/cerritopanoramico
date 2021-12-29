<?php

//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';




	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('tipoplatillofuerte.idtipoplatillofuerte', 'tipoplatillofuerte.nombreplatillo','tipoplatillofuerte.descripcion', 'eventosespeciales.opcion');//Columnas de busqueda
		 $sTable = "tipoplatillofuerte";
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



	include '../../conexion/conexion.php';	
$connection = conexion();
$count_query = "SELECT tipoplatillofuerte.*, eventosespeciales.opcion as opcione FROM $sTable inner join eventosespeciales on tipoplatillofuerte.ideventosespeciales=eventosespeciales.ideventosespeciales $sWhere order by ideventosespeciales desc ";
$query = $connection->prepare($count_query);




if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}

$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';



// consulta para que muestre  en orden descendente los registros

$sql = "SELECT tipoplatillofuerte.*, eventosespeciales.opcion as opcione FROM $sTable inner join eventosespeciales on tipoplatillofuerte.ideventosespeciales=eventosespeciales.ideventosespeciales $sWhere order by ideventosespeciales desc LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
$total = $q->rowcount();
$model = array();
while($rows = $q->fetch())
{
    $model[] = $rows;
}
	
	include '../modales.php';	

?>

<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped">

<tbody>
	<tr>
<th>ID</th>

<th>Nombre Platillo</th>
<th>Descripci&oacute;n</th>
<th>Opcion  Evento</th>



<th></th>
	</tr>

<!-- se utiliza para almacenar el valor en los campos de la  base de datos -->
<?php
if ($rowcount !=0){
	?>
<?php
foreach($model as $row)
    {
        echo "<tr>";
        echo "<td>".$row['idtipoplatillofuerte']."</td>";

         echo "<td>".$row['nombreplatillo']."</td>";
       
         echo "<td>".$row['descripcion']."</td>";
         echo "<td>".$row['opcione']."</td>";

       
      /*  echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/

        ?>
  <!--sirven para imprimir el valor que tiene la tabla en el formulario para poder modificar -->
        
      <input type="hidden" value="<?php echo $row['idtipoplatillofuerte'];?>" id="idtipoplatillofuerte<?php echo $row['idtipoplatillofuerte'];?>">

      <input type="hidden" value="<?php echo $row['nombreplatillo'];?>" id="nombreplatillo<?php echo $row['idtipoplatillofuerte'];?>">
     
      <input type="hidden" value="<?php echo $row['descripcion'];?>" id="descripcion<?php echo $row['idtipoplatillofuerte'];?>">

      <input type="hidden" value="<?php echo $row['ideventosespeciales'];?>" id="eventoes<?php echo $row['idtipoplatillofuerte'];?>">
     



        <?php

        echo "</td>";

        
        echo "<td>";
        echo "
<div class='btn-group pull-right'>
<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
<ul class='dropdown-menu'>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_update' data-placement='bottom' title='Editar Registro' onclick='editartipoplatillofuerte(".$row['idtipoplatillofuerte'].");'><i class='fa fa-edit'></i> Editar</a></li>";



?>
<li><a style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Registro!" onclick='eliminarplatillofuerte(<?php echo $row['idtipoplatillofuerte'];?>)'><i class='fa fa-trash'></i> Borrar</a></li>
</ul>
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