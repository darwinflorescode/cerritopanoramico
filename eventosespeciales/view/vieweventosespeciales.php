<?php

//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';




	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('eventosespeciales.ideventosespeciales','eventosespeciales.opcion', 'eventosespeciales.pastel', 'eventosespeciales.postre',  'eventosespeciales.preciopersona');//Columnas de busqueda
		 $sTable = "eventosespeciales";
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
      $porpagina=1;
    }
    


		$per_page = $porpagina; //la cantidad de registros que desea mostrar
		$adjacents  = 2; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/



	include '../../conexion/conexion.php';	
$connection = conexion();
$count_query = "SELECT * FROM $sTable $sWhere  order by ideventosespeciales desc";
$query = $connection->prepare($count_query);




if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}

$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';



// consulta para que muestre  en orden descendente los registros

$sql = "SELECT * FROM $sTable $sWhere  order by ideventosespeciales desc  LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
$total = $q->rowcount();
$model = array();
while($rows = $q->fetch())
{
    $model[] = $rows;
}
	
	include '../modales.php';	


	$qg = $connection->prepare("SELECT sum(preciopersona) as precioper FROM eventosespeciales");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $precioper = $data['precioper'];
	

?>

<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped">

<tbody>
	<tr>
<th>ID</th>

<th>Opci&oacute;n</th>
<th>Pastel</th>
<th>Postre</th>
<th>Precio Persona</th>
<th>Registro</th>

<th></th>
	</tr>

<!-- se utiliza para almacenar el valor en los campos de la  base de datos -->
<?php

$sumarcant=0;
if ($rowcount !=0){
	?>
<?php
foreach($model as $row)
    {
        echo "<tr>";
        echo "<td>".$row['ideventosespeciales']."</td>";
       
         echo "<td>".$row['opcion']."</td>";
         echo "<td>".$row['pastel']."</td>";

         echo "<td>".$row['postre']."</td>";
       

         

         echo "<td><span class='badge label-primary'>$".$row['preciopersona']."</span></td>";

         $sumarcant+=$row['preciopersona'];
            echo "<td>".$row['fecharegistro']."</td>";

       
      /*  echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/

        ?>
  <!--sirven para imprimir el valor que tiene la tabla en el formulario para poder modificar -->
        
      <input type="hidden" value="<?php echo $row['ideventosespeciales'];?>" id="ideventosespeciales<?php echo $row['ideventosespeciales'];?>">
     
      <input type="hidden" value="<?php echo $row['opcion'];?>" id="opcion<?php echo $row['ideventosespeciales'];?>">
      <input type="hidden" value="<?php echo $row['pastel'];?>" id="pastel<?php echo $row['ideventosespeciales'];?>">

      <input type="hidden" value="<?php echo $row['postre'];?>" id="postre<?php echo $row['ideventosespeciales'];?>">

      
      <input type="hidden" value="<?php echo $row['preciopersona'];?>" id="preciopersona<?php echo $row['ideventosespeciales'];?>">





        <?php

        echo "</td>";

        
        echo "<td>";
        echo "
<div class='btn-group pull-right'>
<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
<ul class='dropdown-menu'>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_update' data-placement='bottom' title='Editar Registro' onclick='editareventosespeciales(".$row['ideventosespeciales'].");' ><i class='fa fa-edit'></i> Editar</a></li>";



?>
<li><a style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Registro!" onclick='eliminareventosespeciales(<?php echo $row['ideventosespeciales'];?>)'><i class='fa fa-trash'></i> Borrar</a></li>
<li><a style="cursor:pointer;" href="../pdf/infoevent.php?idevento=<?php echo $row['ideventosespeciales']; ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Imprimir Registro!" ><i class='fa fa-print'></i> Imprimir</a></li>
</ul>
</div> 
</td>

<?php
    }
 
    ?>



</tr>

<tr class="danger"> <td></td><td></td><td></td><td>Totales por P&aacute;gina:</td>
 <td><span class="badge label-info"><?php echo $sumarcant; ?></span></td>
 <td></td>
<td></td>
 </tr>
<tr class="success"> <td></td><td></td><td></td><td>Total General:</td>
 <td><span class="badge label-info"><?php echo $precioper; ?></span></td>
 <td></td>
<td></td>
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