<?php 
@session_start();




?>

<?php if(count($_SESSION['detalle'])>0){?>
	<table class="table table-stripped table-hoverntable-bordered">
	    <thead>
	        <tr>
	             <th>Nombre</th>
	            <th>Cantidad</th>
	            <th>Precio Producto</th>
				<th>Total /Producto</th>
	            <th>Eliminar</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    	
	    	$total = 0;
	    	foreach($_SESSION['detalle'] as $k => $detalle){ 
			$total += $detalle['subtotal'];
		
	    	?>
	        <tr>
	        	<td><?php echo $detalle['producto']."<b>&nbsp;&nbsp;Descripci&oacute;n:&nbsp;</b>".$detalle['descripcion'];?></td>
	            <td><?php echo $detalle['cantidad'];

	            $stock=$detalle['stock'];
	            if ($detalle['cantidad'] >=$stock) {
	            	echo "<font color='green'>&nbsp;&nbsp;Solo puede vender&nbsp;</font><label class='badge label-danger'>".$stock."</label>";
	            }

	            	            ?></td>

	            <td><?php echo "$ ".number_format($detalle['precio'],2);?></td>
	            
	            
				<td><?php echo "$ ".number_format($detalle['subtotal'],2);?></td>
	            <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar</button></td>
	        </tr>
	        <?php }?>
	        <tr><td colspan="3" class="text-right">Subtotal $:</td>
	        	<td><?php echo number_format($total,2);?></td>
	        	<td></td></tr>
	        	<?php $aportenmesero = $total*0.1; ?>
	        	<tr><td colspan="3" class="text-right">Mesero (10%) $:</td>
	        	<td><?php echo number_format($aportenmesero,2);?></td>
	        	<td></td></tr>
	       
	        <tr><td colspan="3" class="text-right">Total $:</td>
	        	<td><?php echo number_format($total+$aportenmesero,2);?></td>
	        	<td></td></tr>
	    </tbody>
	</table>
<?php }else{?>
<div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay Productos Agregados
            </div>
<?php }?>

<script type="text/javascript" src="libs/ajax.js"></script>