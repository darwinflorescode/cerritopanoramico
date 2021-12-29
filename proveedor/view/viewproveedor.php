<?php

//conexion();
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';




	if($action == 'ajax'){


			// escaping, additionally removing everything that could be (html/javascript-) code
    //la variable para que traiga los valores de columnas desde la base de datos
         $q = addslashes(strip_tags($_REQUEST['q'], ENT_QUOTES));
		 $aColumns = array('idproveedor','nombre','codigo','telefono','email','direccion','nombrecontacto','telefonocontacto','estado');//Columnas de busqueda
		 $sTable = "proveedor";
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
      $porpagina=5;
    }
    


    $per_page = $porpagina; //la cantidad de registros que desea mostrar
    $adjacents  = 2; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
    //Cuenta el número total de filas de la tabla*/



  include '../../conexion/conexion.php';  
$connection = conexion();
$count_query = "SELECT * FROM $sTable $sWhere  order by idproveedor desc";
$query = $connection->prepare($count_query);




if ($query->execute()) {

  $rowcount = $query->rowcount();
  
}

$total_pages = ceil($rowcount/$per_page);
    $reload = '../mostrar.php';




//esta es la consulta para ver los datos de la base de datos.
$sql = "SELECT * FROM $sTable $sWhere ORDER BY idproveedor desc LIMIT $offset,$per_page";

$q = $connection->prepare($sql);
$q->execute();
$total = $q->rowcount();
$model = array();
while($rows = $q->fetch())
{
    $model[] = $rows;
}


		
include '../modales.php';

?>



<script type="text/javascript" src="../lib/delete.js"></script>
<script type="text/javascript" src="../js/editar.js"></script>


<table class="table table-condensed table-hover table-striped">

<tbody>
	<tr>
<th>ID</th>
<th>Empresa</th>
<th>Cód.</th>
<th>Teléfono</th>
<th>Email</th>
<th>Dirección</th>
<th>Nombre Contacto</th>
<th>Teléfono Contacto</th>
<th>Estado</th>
<th>Agregado</th>

<th></th>
	</tr>

<?php
if ($rowcount !=0){
	?>
<?php
//Este foreach hace que imprima todos los campos de una tabla y de la misma manera los recorra.
foreach($model as $row)
    {
       
        echo "<tr>";
        echo "<td>".$row['idproveedor']."</td>";
        echo "<td>".$row['nombre']."</td>";
         echo "<td>".$row['codigo']."</td>";
          $cel =$row['telefono'];
          $correo =$row['email'];
          $direc =$row['direccion'];

        echo "<td>"; 
//este if nos sirve para cuando no existe un registro colocar la palabra'Sin registro' en el campo vacio.
          if ($cel!="") {
            echo "<span class='fa fa-phone'> </span> ".$cel;

          }else{
            echo '<label class="btn btn-xs btn-info">Sin registro</label>';
          }


        


        echo "</td>";
         echo "<td>"; 

          if ($correo!="") {
            echo "<span class='fa fa-envelope'> </span> ".$correo;

          }else{
            echo '<label class="btn btn-xs btn-info">Sin registro</label>';
          }


        


        echo "</td>";
         echo "<td>"; 

          if ($direc!="") {
            echo $direc;

          }else{
            echo '<label class="btn btn-xs btn-info">Sin registro</label>';
          }


        


        echo "</td>";







        echo "<td>".$row['nombrecontacto']."</td>";
        echo "<td> <span class='fa fa-phone'> </span> ".$row['telefonocontacto']."</td>";




     


        $esta = $row['estado'];
        echo "<td>";

//Esta if sirve para l activar y desactivar el proveedor
      if ($esta =="Activo") {
          echo "<span class='btn btn-xs btn-success' data-toggle='modal' data-target='#modal_activar' onclick='activarproveedor(".$row['idproveedor'].");'>".$esta."</span>";
        }elseif($esta =="Inactivo"){
          echo "<span class='btn btn-xs btn-danger' data-toggle='modal' data-target='#modal_activar' onclick='activarproveedor(".$row['idproveedor'].");'>".$esta."</span>";

        }



      /*  echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/
 
  echo "<td>".$row['fecha']."</td>";

       /*echo "<td>".date("d-m-Y H:i:s", strtotime($row['fecha']))."</td>";*/

        ?>
        <!-- Estos son los input para imprimir los campos de la base de datos a la hora de modificarlos   -->
       <input type="hidden" value="<?php echo $row['idproveedor'];?>" id="idproveedor<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['nombre'];?>" id="nombre<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['codigo'];?>" id="codigo<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['telefono'];?>" id="telefono<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['email'];?>" id="email<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['direccion'];?>" id="direccion<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['nombrecontacto'];?>" id="nombrecontacto<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['telefonocontacto'];?>" id="telefonocontacto<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['razon'];?>" id="razon<?php echo $row['idproveedor'];?>">
      <input type="hidden" value="<?php echo $row['estado'];?>" id="estado<?php echo $row['idproveedor'];?>">




        
        <?php

        echo "</td>";

        
        echo "<td>";
        //Esto sirve para llamar los enlaces de formularios para editar un registro
        echo "

<div class='btn-group pull-right'>
<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>Acciones <span class='fa fa-caret-down'></span></button>
<ul class='dropdown-menu'>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_update' data-placement='bottom' title='Editar Registro' onclick='editarproveedor(".$row['idproveedor'].");'><i class='fa fa-edit'></i> Editar</a></li>";


?>

<!-- Este <li> sirve para llamar en enlace para borrar un registro -->
<li><a style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Registro!" onclick='eliminarproveedor(<?php echo $row['idproveedor'];?>)'><i class='fa fa-trash'></i> Borrar</a></li>


<?php
  $estado = $row['estado'];
//Esta funcion sirve parapoder cambiar el estado de activo a inactivo en la base de datos
  if ($estado =="Activo") {
    # code...
  
?>
<li><a style="cursor:pointer;" data-toggle='modal' data-target='#modal_activar' data-placement="left" title="Desactivar Registro!" onclick='activarproveedor(<?php echo $row['idproveedor'];?>);'><i class='fa fa-close'></i> Desactivar</a></li>

<?php

}elseif ($estado =="Inactivo") {
  ?>
<li><a style='cursor:pointer;' data-toggle='modal' data-target='#modal_activar' onclick='activarproveedor(<?php echo $row['idproveedor'];?>);'><i class='fa fa-check-circle'></i> Activar</a></li>

  <?php
}else{
  ?>

<li><a style='cursor:pointer;' ><i class='fa fa-exclamation'></i> Error</a></li>

  <?php




}

?>
</ul>
</div> 
</td>
 

<?php
    }
 
    ?>




</tr>
</tbody>

</table>


<div class="box-footer clearfix">

		<?php echo "Mostrando  ".$total." de ".$rowcount." registros";?>



<?php echo paginate($reload, $page, $total_pages, $adjacents)?>


</div>




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

