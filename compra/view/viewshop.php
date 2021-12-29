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
  		 $aColumns = array('compra.idcompra','compra.fechacompra','proveedor.nombre','usuario.nombre','usuario.apellido');//Columnas de busqueda
  		 $sTable = "compra"; // nombre de la tabla
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
  		$per_page = 6; //la cantidad de registros que desea mostrar
  		$adjacents  = 2; //brecha entre páginas después de varios adyacentes
  		$offset = ($page - 1) * $per_page;
  		//Cuenta el número total de filas de la tabla*/


  //Incluimos la conexion para instanciarla
  	include '../../conexion/conexion.php';	
  $connection = conexion();
  //Query con la tabla y hacer el respectivo inner join
  $count_query = "SELECT compra.idcompra,compra.fechacompra,proveedor.nombre as nombreproveedor ,concat(usuario.nombre,' ',usuario.apellido) nombreusuario,compra.estado FROM $sTable inner join proveedor on compra.idproveedor=proveedor.idproveedor INNER JOIN usuario on compra.usuario_idusuario = usuario.idusuario $sWhere order by compra.idcompra desc";
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
  $sql = "SELECT compra.idcompra,compra.fechacompra,proveedor.nombre as nombreproveedor ,concat(usuario.nombre,' ',usuario.apellido) nombreusuario,compra.estado FROM $sTable inner join proveedor on compra.idproveedor=proveedor.idproveedor INNER JOIN usuario on compra.usuario_idusuario = usuario.idusuario $sWhere order by compra.idcompra desc LIMIT $offset,$per_page";

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



    $qgr = $connection->prepare("SELECT sum(cantidad) as cant,sum(subtotal) as tot FROM detallecompra");
         $qgr->execute();

      $data = $qgr->fetch(PDO::FETCH_ASSOC);
      $canti = $data['cant'];
      $tota = $data['tot']; 

  ?>

  <script type="text/javascript" src="../js/editar.js"></script>
  <!-- tabla dond mostramos los datos-->
  <table class="table table-condensed table-hover table-striped">

  <tbody>
  	<tr>
    <!-- Encabezado de la tablas-->
  <th>ID</th>
  <th>Fecha</th>
  <th>Nombre Proveedor</th>
  <th>Nombre Usuario</th>
  <th>Cantidad Productos</th>
  <th>Total a Pagar</th>
  <th>Estado</th>

  <th></th>
  	</tr>

  <?php
  //Si es mayor a cero hacemos el foreach para recorrer los datos almacenados
  if ($rowcount !=0){
  	?>
  <?php
  $totalpcant=0;
  $totaldiner=0;

  foreach($model as $row)
      {
        //Mostrar los datos en celdas y filas
          echo "<tr>";
          date_default_timezone_set('America/El_Salvador'); 

               $fech = date('Y-m-d');
      		$fecve =$row['fechacompra'];




          echo "<td>".$row['idcompra']."</td>";

    echo "<td>";
          if (($fecve <= $fech)) {
            echo "<span class='badge label-danger' title='Este producto vence ".$fecve."'> $fecve </span>";
          }else{
             echo "<span class='badge label-success' title='Este producto vence ".$fecve."'> $fecve </span>";
          }

          echo "</td>";

        
          echo "<td>".$row['nombreproveedor']."</td>";
         echo "<td>".$row['nombreusuario']."</td>";
        


          include_once('../../conexion/conexion.php');
      $conn = conexion();

           $consult = $conn->prepare("SELECT sum(subtotal) as totales,sum(cantidad) as cant FROM detallecompra where idcompra = ".$row['idcompra']."");
         $consult->execute();

      $daa = $consult->fetch(PDO::FETCH_ASSOC);


      $totalas = $daa['totales'];
      $cant = $daa['cant'];

      $totaldiner +=$totalas;
      $totalpcant +=$cant;
      echo "<td><span class='badge label-info'>".$cant."</span></td>";
      
          echo "<td><span class='badge label-primary'>".$totalas."</span></td>";
           
            $esta = $row['estado'];
          echo "<td>";


          if (($fecve < $fech) || ($esta=="Finalizada")) {

            echo "<a><span class='btn btn-xs btn-success' >".$esta."</a></span>";
          }else if($esta=="En Proceso"){
            echo "<a href='view/updatestatus.php?idcompra=".$row['idcompra']."'><span class='btn btn-xs btn-danger' >".$esta."</a></span>";

          }
          echo "</td>";



               
        

          echo "</td>";

          
          echo "<td>";
          //botton de acciones
          echo "
  <div class='btn-group pull-right'>
  <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
  <ul class='dropdown-menu'>";

  if (($fecve < $fech) || ($esta=="Finalizada")) {
  	?>
     <li><a style='cursor:pointer;' target='_blank' href="../pdf/generatefacturacompra.php?idcompra=<?php echo $row['idcompra']; ?>"><i class='fa fa-print'></i> Imprimir</a></li>
          <?php 
          }else{
          	?>
           <li><a style='cursor:pointer;' href="./editcompra.php?id_compra=<?php echo $row['idcompra']; ?>"><i class='fa fa-edit'></i> Editar</a></li>
  <li><a style='cursor:pointer;'   href="./productadd.php?id_compra=<?php echo $row['idcompra']; ?>"><i class=' fa fa-plus'></i> Agregar Productos</a></li>
            <?php

          }
          echo "</td>";


  ?>





  <?php

   } ?>
  </ul>
  </div> 
  </td>







  </tr>
  <tr class="danger"> <td></td><td></td ><td></td><td>Totales por P&aacute;gina:</td>
   <td><span class="badge label-info"><?php echo $totalpcant; ?></span></td>
   <td><span class="badge label-primary"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($totaldiner,2); ?></span></td>

   <td></td><td></td>
   </tr>
    <tr class="success"> <td></td><td></td><td></td><td>Totales Generales:</td>
   <td><span class="badge label-info"><?php echo $canti; ?></span></td>

  <td><span class="badge label-success"><li class='glyphicon glyphicon-usd '></li> <?php echo number_format($tota,2); ?></span></td>
   <td></td> <td></td>
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

