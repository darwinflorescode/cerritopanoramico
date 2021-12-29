<?php

//Se verifica si se cumple o no esta vacio el parametro action
//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';



//Condicion para verifcarsi se cumple
	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
		//addcslashes(str, charlist) para no permitir el sql injection
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('idtipousuario','nombre','agregado');//Columnas de busqueda de aacuerdo a la base de datos
		 $sTable = "tipousuario"; // nombre de la tabla
		 $sWhere = ""; //where donde la condicion de busqueda se encuentra
		if ( $_GET['q'] != "" ) //Si no esta vacio
		{
			//Genera el la busqueda con el comudin like con el array acolumnns de a base de datos
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


//Incluimmos la cnexion
	include '../../conexion/conexion.php';	
$connection = conexion();
//Consulta a la tabla y incluimos la condicion
$count_query = "SELECT * FROM $sTable $sWhere order by idtipousuario desc ";
$query = $connection->prepare($count_query);



//Si es verdadero y se ejecuta corretament
if ($query->execute()) {

	$rowcount = $query->rowcount();
	
}

$total_pages = ceil($rowcount/$per_page);
		$reload = '../mostrar.php';




//Consulta a la tabla y le damos un limite
$sql = "SELECT * FROM $sTable $sWhere ORDER BY idtipousuario desc LIMIT $offset,$per_page";
//Conexion donde ejecuta
$q = $connection->prepare($sql);
$q->execute();
//Total de registros encontrados
$total = $q->rowcount();
//array
$model = array();

//Estructura ciclica de repeticion
while($rows = $q->fetch())
{
    $model[] = $rows;
}
			
?>

<!-- tabla donde se muestran los datos -->
<table class="table table-condensed table-hover table-striped">

<tbody>
	<tr>
	<!-- datos de la cabecera -->
		<th>ID</th>
		<th>Nombre</th>
		<th>Agregado</th>
		<th></th>
	</tr>

<?php
//Si la consulta no esta vacia
if ($rowcount !=0){
	?>
<?php

//Foreach para recorrer los datos y mostrarlos
foreach($model as $row){
	?>
      <tr>
      <td><?php
      $idtipo =$row['idtipousuario'];
       echo $row['idtipousuario'];?></td>
      <td><?php echo $row['nombre'];?></td>
      <td><?php echo $row['agregado'];?></td>

     
   <td>
   <!-- Input q almacena el nombre del tipo de usuario para enviarlo mediante el ajax y editar este datos -->
        <input type="hidden" value="<?php echo $row['nombre'];?>" id="nombre<?php echo $row['idtipousuario'];?>">

        <?php
        //Booton de opciones de eliminar editar
        echo "<div class='btn-group pull-right'>
<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
<ul class='dropdown-menu'>

";


if ($idtipo==1) {
	# code...

?>

<?php }else{ ?>
<li><a style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Registro!" onclick='eliminartipo(<?php echo $row['idtipousuario'];?>)'><i class='fa fa-trash'></i> Borrar</a></li>
<li><a  style='cursor:pointer;' data-toggle='modal' data-target='#modal_update' data-placement='bottom' title='Editar Registro' onclick='editartipo(<?php echo $row['idtipousuario'];?>)'>
<i class='fa fa-edit'></i> Editar</a></li><li><a  style='cursor:pointer;' href='editarpermisos.php?idprivilegio=<?php echo $row['idtipousuario'];?>'><i class='fa fa-user'></i> Editar Permisos</a></li>

<?php } ?>
</ul>
</div> 
</td>

<?php
    }
 
    ?>





</tr>
</tbody>

</table>

<!-- Paginacion contenedor -->
<div class="box-footer clearfix"><br>

		<?php echo "Mostrando  ".$total." de ".$rowcount."  registros";?>



<?php
//mostrar paginacion de los datos 

 echo paginate($reload, $page, $total_pages, $adjacents)
 ?>


</div>




<?php
}else {

	//Si no se cumple nada de lo anterior muestra el mensaje donde dice q no hay datos
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


