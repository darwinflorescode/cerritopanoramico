<?php
session_start();
if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=0;
}

require_once '../newconn/conexion.php';
require_once '../Model/Producto.php';

switch($page){

	case 1:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Producto Agregado';
		$json['success'] = true;
	
		if (isset($_POST['producto_id']) && $_POST['producto_id']!='' && !empty($_POST['fechav']) && $_POST['fechav']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!='' && isset($_POST['preciocompra']) && $_POST['preciocompra']!='') {
			try {

				$fechav = $_POST['fechav'];
				$cantidad = $_POST['cantidad'];
				$producto_id = $_POST['producto_id'];
				$preciocompra=$_POST['preciocompra'];
				
				$resultado_producto = $objProducto->getById($producto_id);
				$producto = $resultado_producto->fetchObject();
				$nombre = $producto->nombre;
			


				
				$subtotal = $cantidad * $preciocompra;
				
				
				$_SESSION['detalle'][$producto_id] = array('id'=>$producto_id, 'producto'=>$nombre, 'fechav'=>$fechav, 'cantidad'=>$cantidad, 'precio'=>$preciocompra, 'subtotal'=>$subtotal);

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

	case 2:
		$json = array();
		$json['msj'] = 'Producto Eliminado';
		$json['success'] = true;
	
		if (isset($_POST['id'])) {
			try {
				unset($_SESSION['detalle'][$_POST['id']]);
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}
		break;
		
	case 3:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Guardado correctamente';
		$json['success'] = true;
	
		if (count($_SESSION['detalle'])>0  && isset($_POST['idusuario']) && $_POST['idusuario']!='' && isset($_POST['idproveedor']) && $_POST['idproveedor']!='') {
			try {
		
				$idusuario=$_POST['idusuario'];
				$idproveedor=$_POST['idproveedor'];


				$objProducto->guardarcompra($idusuario,$idproveedor);
				$registro_ultima_venta = $objProducto->getUltimacompra();
				$result_ultima_venta = $registro_ultima_venta->fetchObject();
				$idcompra = $result_ultima_venta->ultimo;
				foreach($_SESSION['detalle'] as $detalle):
					$idproducto = $detalle['id'];
				$fechav = $detalle['fechav'];
					$cantidad = $detalle['cantidad'];
					$precio = $detalle['precio'];
					$subtotal = $detalle['subtotal'];
					$objProducto->guardarDetallecompra($fechav,$cantidad, $precio, $subtotal,$idcompra,$idproducto);
					$objProducto->actualizar($cantidad,$precio,$subtotal,$idproducto);
				endforeach;
				
				$_SESSION['detalle'] = array();
						
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'No hay productos agregados';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;

		case 4:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Modificado correctamente';
		$json['success'] = true;
	
		if ( isset($_POST['idcompra']) && $_POST['idcompra']!='' &&  isset($_POST['idusuario']) && $_POST['idusuario']!='' && isset($_POST['idproveedor']) && $_POST['idproveedor']!='') {
			try {
				$idcompra=$_POST['idcompra'];
				$idusuario=$_POST['idusuario'];
				$idproveedor=$_POST['idproveedor'];
				

				$resultado_compra = $objProducto->obteneridcompra($idcompra);
				$compra= $resultado_compra->fetchObject();
				$idprovee = $compra->idproveedor;
				
				$objProducto->actualizarcompra($idusuario,$idproveedor,$idcompra);
				
				
				
						
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'Error al modificar';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;



}
?>