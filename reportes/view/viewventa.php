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
		 $aColumns = array('idorden','orden.fechaorden','cliente.nombre','cliente.apellido','mesa.numeromesa','mesero.nombre','mesero.apellido','usuario.nombre','usuario.apellido','orden.estado');//Columnas de busqueda
		 $sTable = "orden"; // nombre de la tabla
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
$count_query = "SELECT orden.idorden,orden.fechaorden,concat(cliente.nombre,' ',cliente.apellido) as nombrecliente,mesa.numeromesa,concat(mesero.nombre,' ',mesero.apellido) as nombremesero,concat(usuario.nombre,' ',usuario.apellido) nombreusuario,orden.estado FROM $sTable inner join cliente on orden.idcliente=cliente.idcliente INNER join mesa on orden.idmesa = mesa.idmesa INNER JOIN mesero on orden.idmesero = mesero.idmesero INNER JOIN usuario on orden.idusuario = usuario.idusuario $sWhere order by orden.idorden desc";
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
$sql = "SELECT orden.idorden,orden.fechaorden,concat(cliente.nombre,' ',cliente.apellido) as nombrecliente,mesa.numeromesa,concat(mesero.nombre,' ',mesero.apellido) as nombremesero,concat(usuario.nombre,' ',usuario.apellido) nombreusuario,orden.estado FROM $sTable inner join cliente on orden.idcliente=cliente.idcliente INNER join mesa on orden.idmesa = mesa.idmesa INNER JOIN mesero on orden.idmesero = mesero.idmesero INNER JOIN usuario on orden.idusuario = usuario.idusuario $sWhere order by orden.idorden desc LIMIT $offset,$per_page";

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

$qg = $connection->prepare("SELECT sum(subtotal) as tot FROM detalleorden");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);

    $t = $data['tot'];
    $to=$t*0.1;
    $tota=$t+$to; 

?>

<script type="text/javascript" src="../js/editar.js"></script>
<!-- tabla dond mostramos los datos-->
<table class="table table-condensed table-hover table-striped">

<tbody>
	<tr>
  <!-- Encabezado de la tablas-->
<th>ID</th>
<th>Fecha</th>
<th>Nombre Cliente</th>
<th>Mesa</th>
<th>Nombre Mesero</th>
<th>Nombre Usuario</th>
<th>Total</th>
<th>P/Cliente</th>
<th>Cambio</th>
<th>Estado</th>
<th></th>
	</tr>

<?php
//Si es mayor a cero hacemos el foreach para recorrer los datos almacenados
if ($rowcount !=0){
	?>
<?php
$totalp=0;
foreach($model as $row)
    {
      //Mostrar los datos en celdas y filas
        echo "<tr>";
        echo "<td>".$row['idorden']."</td>";
        echo "<td>".$row['fechaorden']."</td>";
        echo "<td>";
          if ($row['nombrecliente']=="& &") {
            echo "<span class='badge label-danger'>Cliente no registrado </span>";
          }else{
            echo $row['nombrecliente'];
          }

        echo "</td>";
        echo "<td><span class='badge label-primary'>".$row['numeromesa']."</span></td>";
        echo "<td>".$row['nombremesero']."</td>";
       echo "<td>".$row['nombreusuario']."</td>";


        include_once('../../conexion/conexion.php');
    $conn = conexion();

         $consult = $conn->prepare("SELECT sum(subtotal) as totales FROM detalleorden where idorden = ".$row['idorden']."");
       $consult->execute();

    $daa = $consult->fetch(PDO::FETCH_ASSOC);

    $totals=$daa['totales'];
    
    $aporte=$totals * 0.1;
    $totalas = $totals + $aporte;
    $totalp+=$totalas;
    
        echo "<td><span class='badge label-primary'><li class='glyphicon glyphicon-usd '></li> ".number_format($totalas,2)."</span></td>";

         $quert = $conn->prepare("SELECT * FROM pago where idorden = ".$row['idorden']."");
       $quert->execute();

    $pagodata = $quert->fetch(PDO::FETCH_ASSOC);

    $pagocliente = $pagodata['pagocliente'];
    $cambio = $pagodata['cambio'];

    if (($pagocliente=="") || ($cambio=="")) {
        echo "<td><span class='badge label-danger'><li class='glyphicon glyphicon-usd '></li> 0</span></td>";
    echo "<td><span class='badge label-danger'><li class='glyphicon glyphicon-usd '></li> 0</span></td>";
    }else{
      echo "<td><span class='badge label-success'><li class='glyphicon glyphicon-usd '></li> ".number_format($pagocliente,2)."</span></td>";
    echo "<td><span class='badge label-info'><li class='glyphicon glyphicon-usd '></li> ".number_format($cambio,2)."</span></td>";
    }

        $estadoventa=$row['estado'];

        if ($estadoventa =="Pendiente") {
           echo "<td><span class='badge label-danger'>".$estadoventa."</span></td>";
        }else{
            echo "<td><span class='badge label-success'>".$estadoventa."</span></td>";
        }
       
        ?>
      
<input type="hidden" value="<?php echo $row['nombrecliente'];?>" id="nombreclient<?php echo $row['idorden'];?>">
<input type="hidden" value="<?php echo $totalas;?>" id="totalpaga<?php echo $row['idorden'];?>">

        <?php

        echo "</td>";

        
        echo "<td>";
        //botton de acciones
    

 } ?>
</ul>
</div> 
</td>

<?php
    }
 
    ?>

</tr>
<tr class="danger"> <td></td><td></td><td></td><td></td>
 <td></td>
 <td>Total por P&aacute;gina:</td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($totalp,2); ?></span></td>

 <td></td>
 <td></td>
 <td></td>
 <td></td>
 </tr>


 <tr class="success"> <td></td><td></td><td></td><td></td>
 <td></td>
 <td>Total General:</td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($tota,2); ?></span></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>

 </tr>
</tbody>

</table>
<br>
<!-- mostrar la paginacion del los datos-->
<div class="box-footer clearfix">
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
			
			<?php
		}                    

?>

