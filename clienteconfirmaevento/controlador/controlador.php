<?php
session_start();
if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=0;
}

require_once '../../venta/newconn/conexion.php';
require_once '../modelo/addproduct.php';

switch($page){

	case 1:
		$objProducto = new addproduct();
		$json = array();
		$json['msj'] = 'Producto Agregado';
		$json['success'] = true;
	
		if (isset($_POST['id_venta']) && $_POST['id_venta']!='' &&  isset($_POST['producto_id']) && $_POST['producto_id']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!='') {
			try {
				
				$idventa = $_POST['id_venta'];
				$producto_id = $_POST['producto_id'];
					$cantidadd = $_POST['cantidad'];
							
				$resultado_producto = $objProducto->obtenerid($idventa,$producto_id);
				$producto = $resultado_producto->fetchObject();
				$idproduct = $producto->idproducto;
				$resultado_product = $objProducto->getById($producto_id);
				$product = $resultado_product->fetchObject();
				$precio = $product->preciounitario;
				$cantidades=$product->cantidad;
				



				if ($cantidadd > $cantidades) {
					$cantidad = $cantidades;
					

				}else if($cantidadd <= $cantidades){
					$cantidad = $cantidadd;
					

				}

				$cantidaddd = $cantidad;
				$subtotal= $cantidaddd*$precio;

				if ($idproduct ==$producto_id) {
						$objProducto->actualizardetalle($cantidad,$idventa,$producto_id);
						$objProducto->actualizar($cantidad,$producto_id);
					# code...
				}

				if ($idproduct !==$producto_id){
					


				$objProducto->guardarDetalleVenta($cantidad,$precio,$subtotal,$producto_id,$idventa);				
				$objProducto->actualizar($cantidad,$producto_id);
				}

				
	

				$json['success'] = true;

				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'Ingrese un producto y/o ingrese cantidad';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;


		
		
}
?>