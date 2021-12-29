
<?php

//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';




  if($action == 'ajax'){


      // escaping, additionally removing everything that could be (html/javascript-) code
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
     $aColumns = array('clienteconfirmaevento.idclienteconfirmaevento','clienteconfirmaevento.precioporpersona','clienteconfirmaevento.cantidadpersona','clienteconfirmaevento.preciototal','clienteconfirmaevento.horainicio','clienteconfirmaevento.horafin','clienteconfirmaevento.fecharegistro','cliente.nombre','cliente.apellido','eventosespeciales.opcion');//Columnas de busqueda
     $sTable = "clienteconfirmaevento";
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
$count_query = "SELECT clienteconfirmaevento.*, concat(cliente.nombre,' ',cliente.apellido) as nomb, eventosespeciales.opcion as opcione FROM $sTable inner join cliente on clienteconfirmaevento.idcliente=cliente.idcliente  inner join eventosespeciales on clienteconfirmaevento.ideventosespeciales=eventosespeciales.ideventosespeciales $sWhere order by idclienteconfirmaevento desc  ";
$query = $connection->prepare($count_query);




if ($query->execute()) {

  $rowcount = $query->rowcount();
  
}

$total_pages = ceil($rowcount/$per_page);
    $reload = '../mostrar.php';



// consulta para que muestre  en orden descendente los registros

$sql = "SELECT clienteconfirmaevento.*, concat(cliente.nombre,' ',cliente.apellido) as nomb,  eventosespeciales.opcion as opcione FROM $sTable inner join cliente on clienteconfirmaevento.idcliente=cliente.idcliente  inner join eventosespeciales on clienteconfirmaevento.ideventosespeciales=eventosespeciales.ideventosespeciales $sWhere order by idclienteconfirmaevento desc  LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
$total = $q->rowcount();
$model = array();
while($rows = $q->fetch())
{
    $model[] = $rows;
}
  
  
  $qg = $connection->prepare("SELECT sum(precioporpersona) as precioper,sum(cantidadpersona) as canti,sum(preciototal) as price FROM clienteconfirmaevento");
       $qg->execute();

    $data = $qg->fetch(PDO::FETCH_ASSOC);
    $precioper = $data['precioper'];
     $cantiper = $data['canti'];
     $price =$data['price'];

?>

<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped">

<tbody>
  <tr>
<th>ID</th>
<th>Responsable</th>
<th>Cliente</th>
<th>Opcion Evento</th>
<th>Precio por Persona</th>
<th>Cantidad Personas</th>
<th>Precio Total</th>
<th>Anticipo</th>
<th>Pendiente</th>
<th>Fecha Eventos</th>
<th>Hora Inicio</th>
<th>Hora Fin</th>

<th>Registro</th>
<th>Estado</th>
<th></th>


  </tr>

<!-- se utiliza para almacenar el valor en los campos de la  base de datos -->
<?php
if ($rowcount !=0){
  ?>

<?php

$preciopers=0;
$cantidadper=0;
$preciotota=0;
foreach($model as $row)
    {
        echo "<tr>";
        date_default_timezone_set('America/El_Salvador');
         $fechahoy= date('Y-m-d');

        echo "<td>".$row['idclienteconfirmaevento']."</td>";
        echo "<td>".$row['nombreusuario']."</td>";
        echo "<td>".$row['nomb']."</td>";
        echo "<td>".$row['opcione']."</td>";
        echo "<td>".$row['precioporpersona']."</td>";
        $preciopers +=$row['precioporpersona'];
        echo "<td>".$row['cantidadpersona']."</td>";
        $cantidadper +=$row['cantidadpersona'];
        echo "<td>".$row['preciototal']."</td>";
         $preciotota +=$row['preciototal'];
        echo "<td>".$row['adelanto']."</td>";
        echo "<td>".$row['pendiente']."</td>";
        echo "<td>".$row['fecha']."</td>";
        echo "<td>".date("g:i A", strtotime($row['horainicio']))."</td>";
        echo "<td>".date("g:i A", strtotime($row['horafin']))."</td>";
        
        echo "<td>".$row['fecharegistro']."</td>";
         echo "<td>".$row['estado']."</td>";
        

        echo "</tr>";
    }
 
    ?>



</tr>

<tr class="danger"> <td></td><td></td><td colspan="2">Totales por P&aacute;gina:</td>
 <td><span class="badge label-info"><?php echo $preciopers; ?></span></td>
 <td><span class="badge label-info"><?php echo $cantidadper; ?></span></td>
 <td><span class="badge label-info"><?php echo $preciotota; ?></span></td><td></td><td></td><td></td><td></td><td></td><td></td>
<td></td>
 </tr>
<tr class="success"> <td></td><td></td><td colspan="2">Total General:</td>
 <td><span class="badge label-info"><?php echo $precioper; ?></span></td>
 <td><span class="badge label-info"><?php echo $cantiper; ?></span></td>
 <td><span class="badge label-info"><?php echo $price; ?></span></td><td></td><td></td><td></td><td></td><td></td><td></td>
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