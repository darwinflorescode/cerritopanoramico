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
		 $aColumns = array('idusuario','usuario.nombre','usuario.apellido','usuario.email','usuario.estado','usuario.fecha','usuario.ultimoingreso','tipousuario.nombre');//Columnas de busqueda
		 $sTable = "usuario"; // nombre de la tabla
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
$count_query = "SELECT usuario.*,tipousuario.nombre as nombu FROM $sTable INNER JOIN tipousuario on usuario.idtipousuario=tipousuario.idtipousuario $sWhere ";
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
$sql = "SELECT usuario.*,tipousuario.nombre as nombu FROM $sTable INNER JOIN tipousuario on usuario.idtipousuario=tipousuario.idtipousuario $sWhere ORDER BY idusuario desc LIMIT $offset,$per_page";

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

?>

<!-- tabla dond mostramos los datos-->
<table class="table table-condensed table-hover table-striped">
<tbody>
	<tr>
  <!-- Encabezado de la tablas-->
<th>ID</th>
<th>Nombre completo </th>
<th>Email</th>
<th>Usuario</th>
<th>Agregado</th>
<th>Ingresó Sistema</th>
<th>Tipo Usuario</th>
<th>Estado</th>
<th></th>
	</tr>

<?php
//Si es mayor a cero hacemos el foreach para recorrer los datos almacenados
if ($rowcount !=0){
	?>
<?php
foreach($model as $row)
    {
      //Mostrar los datos en celdas y filas
        echo "<tr>";
        echo "<td>".$row['idusuario']."</td>";
        echo "<td>".$row['nombre']." ".$row['apellido']."</td>";
        echo "<td><a href='mailto:".$row['email']."'> <span class='fa fa-envelope'></span> ".$row['email']."</a></td>";
        echo "<td>".$row['usuario']."</td>";
        echo "<td>".$row['fecha']."</td>";
       echo "<td>".$row['ultimoingreso']."</td>";
        echo "<td>".$row['nombu']."</td>";

        $esta = $row['estado'];
        echo "<td>";


        if ($esta =="Activo") {
        	echo "<span class='btn btn-xs btn-success' data-toggle='modal' data-target='#modal_activar' onclick='activar(".$row['idusuario'].");'>".$esta."</span>";
        }elseif($esta =="Inactivo"){
        	echo "<span class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modal_activar' onclick='activar(".$row['idusuario'].");'>".$esta."</span>";
        }

        ?>
        <input type="hidden" value="<?php echo $row['nombre'];?>" id="nombre<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['nombre']." ".$row['apellido'];?>" id="nombrec<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['apellido'];?>" id="apellido<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['email'];?>" id="email<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['usuario'];?>" id="usuario<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['pregunta'];?>" id="pregunta<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['respuesta'];?>" id="respuesta<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['razon'];?>" id="razon<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['estado'];?>" id="estado<?php echo $row['idusuario'];?>">
      <input type="hidden" value="<?php echo $row['idtipousuario'];?>" id="nombreusuario<?php echo $row['idusuario'];?>">

        <?php

        echo "</td>";

    ?>

<?php
    }
 
    ?>

</tr>
</tbody>
</table>
<!-- mostrar la paginacion del los datos-->
<div class="box-footer clearfix"><br><br><br>

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

