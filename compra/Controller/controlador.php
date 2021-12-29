<?php
session_start();
if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=0;
}

require_once '../newconn/conexion.php';
require_once '../Model/addproduct.php';

switch($page){

	case 1:
		$objProducto = new addproduct();
		$json = array();
		$json['msj'] = 'Producto Agregado';
		$json['success'] = true;
	
		if (isset($_POST['id_compra']) && $_POST['id_compra']!='' &&  isset($_POST['producto_id']) && $_POST['producto_id']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!='' && isset($_POST['precio']) && $_POST['precio']!='') {
			try {
				
				$idcompra = $_POST['id_compra'];
				$producto_id = $_POST['producto_id'];
					$cantidadd = $_POST['cantidad'];
						$precio = $_POST['precio'];
							
				$resultado_producto = $objProducto->obtenerid($idcompra,$producto_id);
				$producto = $resultado_producto->fetchObject();
				$idproduct = $producto->idproductocompra;
			
				

				
				$subtotal= $cantidadd*$precio;

				if ($idproduct==$producto_id) {
						$objProducto->actualizardetalle($cantidadd,$precio,$idcompra,$producto_id);
						$objProducto->actualizar($cantidadd,$precio,$producto_id);
					# code...
				}

				if ($idproduct !==$producto_id){
					


				$objProducto->guardarDetallecompra($precio,$cantidadd,$subtotal,$idcompra,$producto_id);				
				$objProducto->actualizar($cantidadd,$precio,$producto_id);
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