<?php

//conexion();
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {

    // escaping, additionally removing everything that could be (html/javascript-) code
    //la variable para que traiga los valores de columnas desde la base de datos
    $q        = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
    $aColumns = array('produccion.idproduccion', 'produccion.fechaproduccion', 'produccion.fechavencimiento', 'produccion.cantidad', 'produccion.preciounitario', 'produccion.total', 'producto.nombre'); //Columnas de busqueda
    $sTable   = "produccion";
    $sWhere   = "";
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';

    }

    include '../../lib/pagination.php'; //incluir el archivo de paginación
    //las variables de paginación
    $page        = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $mostrartodo = (isset($_REQUEST['per_page']));
    if ($mostrartodo != "") {
        $porpagina = $_REQUEST['per_page'];
    } else {
        $porpagina = 5;
    }

    $per_page  = $porpagina; //la cantidad de registros que desea mostrar
    $adjacents = 2; //brecha entre páginas después de varios adyacentes
    $offset    = ($page - 1) * $per_page;
    //Cuenta el número total de filas de la tabla*/

    include '../../conexion/conexion.php';
    $connection = conexion();
//Este es el inner join en una consulta para llamar las llaves foranias.
    $count_query = "SELECT produccion.*, producto.nombre as nombre,producto.estado FROM $sTable inner join producto on produccion.idproducto=producto.idproducto $sWhere and producto.estado='Activo' order by idproduccion desc ";
    $query       = $connection->prepare($count_query);

//Si la consulta es ejecutada entonces que la cuente y regrese al mostrar los datos
    if ($query->execute()) {

        $rowcount = $query->rowcount();

    }

    $total_pages = ceil($rowcount / $per_page);
    $reload      = '../mostrar.php';

//esta es la consulta para ver los datos de la base de datos.
    $sql = "SELECT produccion.*,producto.nombre as nombre,producto.estado FROM $sTable inner join producto on produccion.idproducto=producto.idproducto $sWhere and producto.estado='Activo' ORDER BY idproduccion desc LIMIT $offset,$per_page";

    $q = $connection->prepare($sql);
    $q->execute();
    $total = $q->rowcount();
    $model = array();
    while ($rows = $q->fetch()) {
        $model[] = $rows;
    }

    $qg = $connection->prepare("SELECT sum(cantidad) as cant,sum(preciounitario) as precios,sum(total) as tot FROM produccion");
    $qg->execute();

    $data    = $qg->fetch(PDO::FETCH_ASSOC);
    $canti   = $data['cant'];
    $precios = $data['precios'];
    $tota    = $data['tot'];

    ?>



<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped">

<tbody>
  <tr>
<th>ID</th>
<th>Fecha Producción</th>
<th>Fecha Vencimiento</th>
<th>Nombre producto</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Total</th>
<th></th>
  </tr>

<?php
if ($rowcount != 0) {
        ?>
<?php
$sumarcant = 0;
        $preciou   = 0;
        $totalp    = 0;
//Este foreach hace que imprima todos los campos de una tabla y de la misma manera los recorra.
        foreach ($model as $row) {

            echo "<tr>";
            date_default_timezone_set('America/El_Salvador');
            $fech   = date('Y-m-d');
            $fechap = $row['fechaproduccion'];

            echo "<td>" . $row['idproduccion'] . "</td>";
            echo "<td>" . $row['fechaproduccion'] . "</td>";

            $fecve = $row['fechavencimiento'];

            echo "<td>";
            //Este es por si la fecha es igual al valor de la fecha de vencimiento  o mayor entonces esta vigente
            if (($fecve == $fech) || ($fecve < $fech)) {
                echo "<label class='badge label-danger' title='Este producto vence " . $fecve . "'> $fecve </label>";
            } else {
                echo "<label class='badge label-success' title='Este producto vence " . $fecve . "'> $fecve </label>";
            }

            echo "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td> <span class='badge label-info'>" . $row['cantidad'] . "</span></td>";
            echo "<td><span class='badge label-primary'> <li class='glyphicon glyphicon-usd '></li> " . number_format($row['preciounitario'], 2) . "</span></td>";
            echo "<td> <span class='badge label-success'><li class='glyphicon glyphicon-usd'></li> " . number_format($row['total'], 2) . "</span></td>";

            $sumarcant += $row['cantidad'];
            $preciou += $row['preciounitario'];
            $totalp += $row['total'];
            ?>

</td>
</tr>
<?php
}

        ?>

<tr class="danger"> <td></td><td></td><td></td><td>Totales por P&aacute;gina:</td>
 <td><span class="badge label-info"><?php echo $sumarcant; ?></span></td>
 <td><span class="badge label-primary"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($preciou, 2); ?></span></td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($totalp, 2); ?></span></td>
 <td></td>
 </tr>

 <tr class="success"> <td></td><td></td><td></td><td>Totales Generales:</td>
 <td><span class="badge label-info"><?php echo $canti; ?></span></td>
 <td><span class="badge label-primary"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($precios, 2); ?></span></td>
<td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($tota, 2); ?></span></td>
 <td></td>
 </tr>





</tbody>

</table>

<!-- Estos php nos sirven para motrar los registros-->
<div class="box-footer clearfix">

    <?php echo "Mostrando  " . $total . " de " . $rowcount . " registros"; ?>



<?php echo paginate($reload, $page, $total_pages, $adjacents) ?>


</div>




<?php
} else {
        ?>
      <!-- Esto no sindica que si todo lo anterior no es verdadero entonces nos dara una alerta de ni existen datos -->
      </table>
      <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4 style="text-align: center;">Aviso!!!</h4><h5 style="text-align: center;">No hay datos para mostrar</h5>
            </div>
      <?php
}

}

?>

