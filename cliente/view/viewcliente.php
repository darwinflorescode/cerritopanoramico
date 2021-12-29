<?php

//conexion();
//Verifica que o venga vacion y con los parametros si existen
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';



	//condicion de  verificacion de datos
	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
		//addslashes(str) para no permitir el sql injection
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('idcliente','nombre','dui','apellido','telefono','direccion','email','whatsapp','fecha');//Columnas de busqueda de la tabla
		 $sTable = "cliente"; //tabla cliente
		 $sWhere = ""; //where de busqueda con like
	if ( $_GET['q'] != "" ) //si el paratro q no esta vacio
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


//conexion a la base de datos
	include '../../conexion/conexion.php';	
$connection = conexion();
//Query con la tabla select
$count_query = "SELECT * FROM $sTable $sWhere idcliente > 1 order by idcliente desc";
$query = $connection->prepare($count_query);



//Si es verdadero
if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}

$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';




//Query con l tabla cliente
$sql = "SELECT * FROM $sTable $sWhere idcliente > 1 order by idcliente desc LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
//Ejecuta la consulta
$q->execute();
$total = $q->rowcount();
$model = array();
//arrary de datos
while($rows = $q->fetch())
{
    $model[] = $rows;
}
	//Incluimos los modales	
include '../modales.php';
?>
<!-- Js y ajax para eiminar y editar los datos del cliente. Editar.js se utiliza para enviar los datos al modal-->
<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped">

<tbody>
	<tr>
	<!-- JEncabezado de la tabla-->
<th>ID</th>
<th>Nombre completo </th>
<th>Dui</th>
<th>Tel&eacute;fono</th>
<th>E-mail</th>
<th>Whatsapp</th>
<th>Direcci&oacute;n</th>

<th>Agregado</th>
<th></th>
	</tr>

<?php
if ($rowcount !=0){
	//Si el total de datos no esta vacio 
	//ejecuta el forach para recorrer los datos
	?>
<?php
foreach($model as $row)
    {
        echo "<tr>";
        echo "<td>".$row['idcliente']."</td>";
        echo "<td>".$row['nombre']." ".$row['apellido']."</td>";
        echo "<td><label class='badge label-primary'>".$row['dui']."</label></td>";
        $tele = $row['telefono'];

        $correo=$row['email'];

        $whapt =$row['whatsapp'];

       

        if ($tele != "") {
            echo "<td><a><li class='fa fa-phone'></li> ".$row['telefono']."</a></td>";
        }else{
             echo "<td><span class='badge label-primary' data-toggle='modal' data-target='#modal_update' onclick='editarcliente(".$row['idcliente'].");'> No existe registro </span></td>";
        }

echo "<td>";
 if ($correo!="") {
            echo "<a href='mailto:".$correo."'><span class='fa fa-envelope'> </span> ".$correo."</a>";

          }else{
            echo '<span class="badge label-info">Sin registro</span>';
          }
        
         echo "</td>";


echo "<td>";
 if ($whapt!="") {
            echo "<a><li class='fa fa-phone'></li> ".$whapt."</a>";

          }else{
            echo '<span class="badge label-info">Sin registro</span>';
          }
        
         echo "</td>";


        echo "<td>".$row['direccion']."</td>";

        echo "<td>".$row['fecha']."</td>";
      /*  echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/
 

        ?>

        	<!-- input para enviar los datos al modal a modificar-->
        <input type="hidden" value="<?php echo $row['idcliente'];?>" id="idcliente<?php echo $row['idcliente'];?>">
      <input type="hidden" value="<?php echo $row['nombre'];?>" id="nombre<?php echo $row['idcliente'];?>">
      <input type="hidden" value="<?php echo $row['apellido'];?>" id="apellido<?php echo $row['idcliente'];?>">
            <input type="hidden" value="<?php echo $row['dui'];?>" id="dui<?php echo $row['idcliente'];?>">
      <input type="hidden" value="<?php echo $row['telefono'];?>" id="telefono<?php echo $row['idcliente'];?>">
      <input type="hidden" value="<?php echo $row['direccion'];?>" id="direccion<?php echo $row['idcliente'];?>">
      <input type="hidden" value="<?php echo $row['email'];?>" id="email<?php echo $row['idcliente'];?>">
      <input type="hidden" value="<?php echo $row['whatsapp'];?>" id="whatsapp<?php echo $row['idcliente'];?>">



        <?php

        echo "</td>";

        
        echo "<td>";
        echo "
<div class='btn-group pull-right'>
<button  type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
<ul class='dropdown-menu'>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_update' data-placement='bottom' title='Editar Registro' onclick='editarcliente(".$row['idcliente'].");'><i class='fa fa-edit'></i> Editar</a></li>";



?>

<li><a style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Registro!" onclick='eliminarcliente(<?php echo $row['idcliente'];?>)'><i class='fa fa-trash'></i> Borrar</a></li>
</ul>
</div> 
</td>

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

