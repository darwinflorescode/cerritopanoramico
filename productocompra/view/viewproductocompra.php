<?php

//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';




	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('idproductocompra','nombre','cantidad','descripcion','preciounitario', 'total','fecha');//Columnas de busqueda
		 $sTable = "productocompra";
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
		$per_page = 15; //la cantidad de registros que desea mostrar
		$adjacents  = 2; //brecha entre páginas después de varios adyacentes
		$offset = ($page - 1) * $per_page;
		//Cuenta el número total de filas de la tabla*/



	include '../../conexion/conexion.php';	
$connection = conexion();
$count_query = "SELECT * FROM $sTable $sWhere ";
$query = $connection->prepare($count_query);




if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}

$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';



// consulta para que muestre  en orden descendente los registros

$sql = "SELECT * FROM $sTable $sWhere ORDER BY idproductocompra desc LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
$total = $q->rowcount();
$model = array();
while($rows = $q->fetch())
{
    $model[] = $rows;
}
		
include '../modales.php';


  $qg = $connection->prepare("SELECT sum(cantidad) as cant,sum(preciounitario) as precios,sum(total) as tot FROM productocompra");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $cantid = $data['cant'];
    $precioss = $data['precios'];
    $totas = $data['tot']; 
?>

<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped">

<tbody>
	<tr>
<th>ID</th>
<th>Nombre</th>
<th>Descripci&oacute;n</th>
<th>Cantidad</th>
<th>Precio Unitario</th>
<th>Total</th>
<th>Estado</th>
<th>Agregado</th>
<th></th>
	</tr>

<!-- se utiliza para almacenar el valor en los campos de la  base de datos -->
<?php
if ($rowcount !=0){
	?>
<?php

$canti = 0;
$precios=0;
$tota=0;
foreach($model as $row)
    {
        echo "<tr>";
        date_default_timezone_set('America/El_Salvador'); 

             $fech = date('Y-m-d');
    		$fecve =$row['fecha'];

        echo "<td>".$row['idproductocompra']."</td>";
        echo "<td>".$row['nombre']."</td>";
       

         
         echo "<td>".$row['descripcion']."</td>";

         echo "<td><span class='badge label-info'>".$row['cantidad']."</span></td>";

        echo "<td><span class='badge label-primary'>".$row['preciounitario']."</span></td>";

        echo "<td><span class='badge label-success'>".$row['total']."</span></td>";

          $canti +=$row['cantidad'];
          $precios +=$row['preciounitario'];
              $tota +=$row['total'];

          $esta = $row['estado'];
        echo "<td>";


        if (($esta=="Activo")) {

          echo "<span class='btn btn-xs btn-success' >".$esta."</span>";
        }else if($esta=="Inactivo"){
          echo "<span class='btn btn-xs btn-danger' >".$esta."</span>";

        }
        echo "</td>";

      /*  echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/
      echo "<td>";
        if (($fecve <= $fech)) {
          echo "<span class='badge label-danger' title='Este producto vence ".$fecve."'> $fecve </span>";
        }else{
           echo "<span class='badge label-success' title='Este producto vence ".$fecve."'> $fecve </span>";
        }

        echo "</td>";

        ?>
  <!--sirven para imprimir el valor que tiene la tabla en el formulario para poder modificar -->
        
      <input type="hidden" value="<?php echo $row['idproductocompra'];?>" id="idproductocompra<?php echo $row['idproductocompra'];?>">
      <input type="hidden" value="<?php echo $row['nombre'];?>" id="nombre<?php echo $row['idproductocompra'];?>">
      <input type="hidden" value="<?php echo $row['estado'];?>" id="estadonn<?php echo $row['idproductocompra'];?>">
      <input type="hidden" value="<?php echo $row['descripcion'];?>" id="descripcion<?php echo $row['idproductocompra'];?>">
    
     



        <?php

        echo "</td>";

        
        echo "<td>";
        echo "
<div class='btn-group pull-right'>
<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
<ul class='dropdown-menu'>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_update' data-placement='bottom' title='Editar Registro' onclick='editarproductocompra(".$row['idproductocompra'].");'><i class='fa fa-edit'></i> Editar</a></li>";



?>
<!-- esta linea sirve para eliminar un registro-->
<li><a style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Registro!" onclick='eliminarproductocompra(<?php echo $row['idproductocompra'];?>)'><i class='fa fa-trash'></i> Borrar</a></li>
</ul>
</div> 
</td>

<?php
    }
 
    ?>



</tr>

<tr class="danger"> <td></td><td></td><td>Totales por P&aacute;gina:</td>
 <td><span class="badge label-info"><?php echo $canti; ?></span></td>
 <td><span class="badge label-primary"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($precios,2); ?></span></td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($tota,2); ?></span></td>
 <td></td>
 </td><td></td><td>
 </tr>

 <tr class="success"> <td></td><td></td><td>Totales Generales:</td>
 <td><span class="badge label-info"><?php echo $cantid; ?></span></td>
 <td><span class="badge label-primary"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($precioss,2); ?></span></td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($totas,2); ?></span></td>
 <td></td>
 </td><td></td><td>
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