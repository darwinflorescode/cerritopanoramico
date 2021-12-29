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
	
		if (isset($_POST['producto_id']) && $_POST['producto_id']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!='') {
			try {
			$cantidadd = $_POST['cantidad'];
				$producto_id = $_POST['producto_id'];
							
				$resultado_producto = $objProducto->getById($producto_id);
				$producto = $resultado_producto->fetchObject();
				$nombre = $producto->nombre;
				$descripcion = $producto->descripcion;
				$precio = $producto->preciounitario;
				$cantidades = $producto->cantidad;

				if ($cantidadd > $cantidades) {
					$cantidad = $cantidades;
					

				}else if($cantidadd <= $cantidades){
					$cantidad = $cantidadd;
					

				}

				$cantidad = $cantidad;
				
			

     			
				
				$subtotal = $cantidad * $precio;

				if (count($_SESSION['detalle'])>0) {//comprobamos si existe la session carrito 
          //comprobamos si existe la variable id_p que es con la que validamos 
                      $arreglo=$_SESSION['detalle'];//si existe la guardo
                      $encontro = false;
                      $numero=0;
                    
                      //recorremos ese arreglo
                      for ($i=0;$i<count($arreglo);$i++) {
                        //comprobamos existe Id del arreglo y lo comparamos con el id_p que mandamos por el metodo get 
                        if ($arreglo[$i]['id']==$producto_id) {
                          //si la condicion se cumple nuestra variable 
                          $encontro = true;
                          //capturaremos el numero y sera igual a $i para saber la posicion del arregloen donde estaba ese id
                          $numero=$i;

                        }
                      }
                    //si encontro algun registro haremos otra condicion
                      if ($encontro==true) {
                        //si es verdadero pues sumamos lo queteniamos+1



                        if ($arreglo[$numero]['cantidad']+$cantidad  > $cantidades){
                        	$arreglo[$numero]['cantidad']=$cantidades;
                        	$arreglo[$numero]['subtotal']=$arreglo[$numero]['cantidad']*$precio;;
                        }else{
                        	$arreglo[$numero]['cantidad']=$arreglo[$numero]['cantidad']+$cantidad;
                        	$arreglo[$numero]['subtotal']=$arreglo[$numero]['cantidad']*$precio;
                        }
                        
                        //y volvemos a almacenar en nuestra session carrito
                        $_SESSION['detalle']=$arreglo;
                      }else{
                           
                          //hacemos nuestro arreglo con los datos que necesitamos aqui  los dejamos sin corchetes 
                              //porque es solo para un registro
                        $datosNuevos = array('id'=>$producto_id, 'producto'=>$nombre,'descripcion'=>$descripcion, 'cantidad'=>$cantidad,  'stock'=>$cantidades,'precio'=>$precio, 'subtotal'=>$subtotal);
                              //añadimos lo datos nuevos a nuestro original
                              array_push($arreglo, $datosNuevos);
                              //volvemos a almacenar el arreglo a nuestra session carrito
                              $_SESSION['detalle']=$arreglo;
                  }
                
            }else{
               //si no creamos una
                   //hacemos nuestro arreglo con los datos que necesitamos
                      $arreglo[] =array('id'=>$producto_id, 'producto'=>$nombre,'descripcion'=>$descripcion, 'cantidad'=>$cantidad,  'stock'=>$cantidades, 'precio'=>$precio, 'subtotal'=>$subtotal);
                      $_SESSION['detalle'] = $arreglo;
               
            }
			
				
				
		

				$json['success'] = true;

				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'Debe completar los datos';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;

	case 2:
		$json = array();
		$json['msj'] = 'Producto Eliminado';
		$json['success'] = true;
	
		if (isset($_POST['ide'])) {
			try {
				unset($_SESSION['detalle'] [$_POST['ide']]);
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
	
		if (count($_SESSION['detalle'])>0 && isset($_POST['idusuario']) && $_POST['idusuario']!='' && isset($_POST['idcliente']) && $_POST['idcliente']!=''&& isset($_POST['idmesa']) && $_POST['idmesa']!='' && isset($_POST['idmesero']) && $_POST['idmesero']!='') {
			try {
			
				$idusuario=$_POST['idusuario'];
				$idcliente=$_POST['idcliente'];
				$idmesa=$_POST['idmesa'];
				$idmesero=$_POST['idmesero'];


				$objProducto->guardarVenta($idusuario,$idcliente,$idmesa,$idmesero);
				$objProducto->actualizarmesa($idmesa);
				$objProducto->actualizarmesero($idmesero);
				$registro_ultima_venta = $objProducto->getUltimaVenta();
				$result_ultima_venta = $registro_ultima_venta->fetchObject();
				$idorden = $result_ultima_venta->ultimo;
				foreach($_SESSION['detalle'] as $detalle):
					$idproducto = $detalle['id'];
					$cantidad = $detalle['cantidad'];
					$precio = $detalle['precio'];
					$subtotal = $detalle['subtotal'];
					$objProducto->guardarDetalleVenta($precio, $cantidad, $subtotal,$idorden,$idproducto);
					$objProducto->actualizar($cantidad,$idproducto);


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
	
		if ( isset($_POST['idorden']) && $_POST['idorden']!='' &&  isset($_POST['idusuario']) && $_POST['idusuario']!='' && isset($_POST['idcliente']) && $_POST['idcliente']!=''&& isset($_POST['idmesa']) && $_POST['idmesa']!='' && isset($_POST['idmesero']) && $_POST['idmesero']!='') {
			try {
				$idorden=$_POST['idorden'];
				$idusuario=$_POST['idusuario'];
				$idcliente=$_POST['idcliente'];
				$idmesa=$_POST['idmesa'];
				$idmesero=$_POST['idmesero'];

				$resultado_orden = $objProducto->obteneridorden($idorden);
				$orden = $resultado_orden->fetchObject();
				$idmeser = $orden->idmesero;
				$idmes=$orden->idmesa;
				$objProducto->actualizarmeser($idmeser);
				$objProducto->actualizarmesero($idmesero);
				$objProducto->actualizarmes($idmes);
				$objProducto->actualizarmesa($idmesa);
				$objProducto->actualizarorden($idusuario,$idcliente,$idmesa,$idmesero,$idorden);
				
				
				
						
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