<?php

//conexion();
//Verificar si no vienen vaciosS
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';



//si se cumple a condicion
	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
    //addslashes(str) para no permitir sqlinjection
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
         //Creamos un array de acuerdo alas columnas de nuestrar tabla. en este caso es un inner join con la tabla tipo usuario
		 $aColumns = array('idproducto','producto.nombre','producto.tipomenu','producto.descripcion','producto.fechav','producto.fecha','tipoproducto.nombre','producto.estado');//Columnas de busqueda
		 $sTable = "producto"; // nombre de la tabla,
		 $sWhere = ""; //Condicion para hacer la busqueda con where
     //Si no esta vacio el parametro q viene con el metodo get
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


//Incluimos la conexion para instanciarla
	include '../../conexion/conexion.php';	
$connection = conexion();
//Query con la tabla y hacer el respectivo inner join
$count_query = "SELECT producto.*,tipoproducto.nombre as nombproducto, tipoproducto.idtipoproducto as idtipo FROM $sTable
   INNER JOIN tipoproducto ON producto.idtipoproducto = tipoproducto.idtipoproducto $sWhere  order by producto.idproducto desc";
//Ejecuta el query
$query = $connection->prepare($count_query);



//Si es verdadero la consulta
if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}
//Tptal paginas
$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';




//Query a la tabla con el inner join
$sql = "SELECT producto.*,tipoproducto.nombre as nombproducto, tipoproducto.idtipoproducto as idtipo FROM $sTable
   INNER JOIN tipoproducto ON producto.idtipoproducto = tipoproducto.idtipoproducto $sWhere order by producto.idproducto desc LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
//Ejecuta lel query
//Mostrar el tota de registros almaceados en el query
$total = $q->rowcount();
$model = array();
//Array
while($rows = $q->fetch())
{
    $model[] = $rows;
}
		//incluimoslos modales


$qg = $connection->prepare("SELECT sum(cantidad) as cant,sum(preciounitario) as precios,sum(total) as tot,sum(entrada) as entradas,sum(salida) as sale FROM producto");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $canti = $data['cant'];
    $precios = $data['precios'];
    $tota = $data['tot'];
    $entra = $data['entradas'];  
    $sale = $data['sale'];
?>

<!-- Javascript y ajax donde estan la funcione de eliminar y ediar para enviar los datos al modal utilizamos
editar.js -->
<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>
<!-- tabla dond mostramos los datos-->
<table class="table table-condensed table-hover table-striped">

<tbody>
<tr>
<th>ID</th>
        <th>Nombre</th>
        <th>Menú</th>
        <th>Descripci&oacute;n</th>
         <th>Entradas</th>
        <th>Existencia</th>
        <th>Salidas</th>
        <th>Precio/U</th>
         <th>Total</th>
       <th>Tipo/P</th>
       <th>Fecha/V</th>
         <th>Agregado</th>
        <th>Estado</th>
        <th></th>
<th></th>
</tr>

<?php
//Si es mayor a cero hacemos el foreach para recorrer los datos almacenados
if ($rowcount !=0){
	?>
<?php
$entradas=0;
$salidas=0;
$sumarcant =0;
$preciou =0;
$totalp=0;

 foreach($model as $row)
    {

        /* $entradas = $row['entrada'];*/
         $cantidad = $row['cantidad'];
    /*      $salida = $row['salida'];*/
          $preciou = $row['preciounitario'];
          $idd = $row['idproducto'];
          date_default_timezone_set('America/El_Salvador'); 

             $fech = date('Y-m-d');
    $fecve =$row['fechav'];

    $sumarcant+=$row['cantidad'];
           $preciou+=$row['preciounitario'];
           $totalp+=$row['total'];
           $entradas+=$row['entrada'];
           $salidas+=$row['salida'];

 

  


       echo "<tr>";
      
   

        
   

      

      

      


        echo "<td>".$row['idproducto']."</td>";
        echo "<td>".$row['nombre']."</td>";
        echo "<td>".$row['tipomenu']."</td>";








        echo "<td>".$row['descripcion']."</td>";
        echo "<td>".$row['entrada']."</td>";

        echo "<td>";

          if ($cantidad == 0) {
            echo "<span class='badge label-danger'>".$cantidad."</span>";
          }else{
             echo "<span class='badge label-info'>".$cantidad."</span>";
          }
           echo "</td>";

           echo "<td>".$row['salida']."</td>";
        echo "<td><span class='badge label-primary'><li class='glyphicon glyphicon-usd'></li> ".$row['preciounitario']."</span></td>";

        echo "<td><span class='badge label-success'><li class='glyphicon glyphicon-usd'></li> ".$row['total']."</span></td>";
        echo "<td>".$row['nombproducto']."</td>";
          
 





  echo "<td>";
        if (($fecve <= $fech)) {
          echo "<span class='badge label-danger' title='Este producto vence ".$fecve."'> $fecve </span>";
        }else{
           echo "<span class='badge label-success' title='Este producto vence ".$fecve."'> $fecve </span>";
        }

        echo "</td>";



       


        echo "<td>".date("Y-m-d", strtotime($row['fecha']))."</td>";
     
        $esta = $row['estado'];
        echo "<td>";


        if ($esta =="Activo") {
          echo "<span style='cursor:pointer;' class='badge label-success' data-toggle='modal' data-target='#modal_activar' onclick='activarproducto(".$row['idproducto'].");'>".$esta."</span>";
        }elseif($esta =="Inactivo"){
          echo "<span style='cursor:pointer;' class='badge label-danger' data-toggle='modal' data-target='#modal_activar' onclick='activarproducto(".$row['idproducto'].");'>".$esta."</span>";

        }
        echo "</td>";





        ?>
        <input type="hidden" value="<?php echo $row['nombre'];?>" id="nombre<?php echo $row['idproducto'];?>">
      <input type="hidden" value="<?php echo $row['tipomenu'];?>" id="tipomenu<?php echo $row['idproducto'];?>">
      <input type="hidden" value="<?php echo $row['idtipo'];?>" id="idtipo<?php echo $row['idproducto'];?>">
      <input type="hidden" value="<?php echo $row['descripcion'];?>" id="descripcion<?php echo $row['idproducto'];?>">
       <input type="hidden" value="<?php echo $row['estado'];?>" id="estado<?php echo $row['idproducto'];?>">
       <input type="hidden" value="<?php echo $row['razon'];?>" id="razon<?php echo $row['idproducto'];?>">


        <?php

        echo "</td>";

        
        echo "<td>";
        echo "
<div class='btn-group pull-right'>
<button type='button' class='btn btn-default  dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
<ul class='dropdown-menu'>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_update' data-placement='bottom' title='Editar Registro' onclick='editarproducto(".$row['idproducto'].");'><i class='fa fa-edit'></i> Editar</a></li>";

$estado = $row['estado'];

  if ($estado =="Activo") {
    # code...
  
?>
<li><a style="cursor:pointer;" data-toggle='modal' data-target='#modal_activar' data-toggle="tooltip" data-placement="bottom" title="Desactivar Registro!" onclick='activarproducto(<?php echo $row['idproducto'];?>);'><i class='fa fa-close'></i> Desactivar</a></li>

<?php

}elseif ($estado =="Inactivo") {
  ?>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_activar' data-toggle="tooltip" data-placement="bottom" title="Activar Registro!" onclick='activarproducto(<?php echo $row['idproducto'];?>);'><i class='fa fa-check-circle'></i> Activar</a></li>

  <?php
}else{
  ?>

<li><a style='cursor:pointer;' ><i class='fa fa-exclamation'></i> Error</a></li>

  <?php




}

?>

<li><a style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Registro!" onclick='eliminarproducto(<?php echo $row['idproducto'];?>)'><i class='fa fa-trash'></i> Borrar</a></li>
</ul>
</div> 
</td>

<?php
    }
 
    ?>





</tr>


<tr class="danger"> <td></td><td></td ><td></td><td>Totales por P&aacute;gina:</td><td><span class="badge label-primary"><?php echo $entradas; ?></span></td>
 <td><span class="badge label-info"><?php echo $sumarcant; ?></span></td><td><span class="badge label-warning"><?php echo $salidas; ?></span></td>
 <td><span class="badge label-primary"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($preciou,2); ?></span></td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($totalp,2); ?></span></td>
 <td></td><td></td><td></td><td></td><td></td>
 </tr>

<tr class="success"> <td></td><td></td><td></td><td>Totales Generales:</td>
 <td><span class="badge label-primary"><?php echo $entra; ?></span></td>

 <td><span class="badge label-info"><?php echo $canti; ?></span></td>
 <td><span class="badge label-warning"><?php echo $sale; ?></span></td>
 <td><span class="badge label-primary"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($precios,2); ?></span></td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($tota,2); ?></span></td>
 <td></td><td></td><td></td><td></td><td></td>
 </tr>
</tbody>

</table>

<!-- mostrar la paginacion del los datos-->
<div class="box-footer clearfix"><br>

		<?php
//mostrar los datos totaless
     echo "Mostrando  ".$total." de ".$rowcount." registros";?>



<?php
//mostrar paginacion de datos
 echo paginate($reload, $page, $total_pages, $adjacents)?>


</div>




<?php
}else {
  //Si no se cumple lo anterior muestra el siguiente mensaje
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

