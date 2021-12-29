<?php
class Producto
{
	function obteneridcompra($id){
		$sql = "SELECT * FROM compra WHERE idcompra=$id";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getById($id){
		$sql = "SELECT * FROM productocompra WHERE idproductocompra=$id";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function guardarcompra($idusuario,$idproveedor){
		$sql = "INSERT INTO compra (fechacompra,estado,idproveedor,usuario_idusuario) values (now(),'En Proceso',$idproveedor,'$idusuario')";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getUltimacompra()
	{
		$sql = "SELECT LAST_INSERT_ID() as ultimo";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function guardarDetallecompra($fechav,$cantidad, $precio, $subtotal,$idcompra,$idproducto){
		$sql = "INSERT INTO detallecompra (fechav,cantidad,precio,subtotal,idcompra,idproductocompra) values ('$fechav','$cantidad','$precio','$subtotal','$idcompra','$idproducto')";
		global $cnx;
		return $cnx->query($sql);
	}

	function actualizar($cantidad,$precio,$total,$idproducto){

		$sql ="UPDATE productocompra SET cantidad= cantidad+$cantidad,preciounitario = $precio,total = cantidad*$precio  WHERE idproductocompra = '$idproducto'";

		global $cnx;
		return $cnx->query($sql);

	}

	function actualizarcompra($idusuario,$idproveedor,$idcompra){

		$sql ="UPDATE compra SET usuario_idusuario=$idusuario, idproveedor=$idproveedor where idcompra = $idcompra";

		global $cnx;
		return $cnx->query($sql);
	}




	function actualizarproveedor($idproveedor){

		$sql ="UPDATE proveedor WHERE idproveedor = '$idproveedor'";

		global $cnx;
		return $cnx->query($sql);

	}
	function actualizarprovee($idproveedor){

		$sql ="UPDATE proveedor SET  WHERE idproveedor = '$idproveedor'";

		global $cnx;
		return $cnx->query($sql);

	
	}
	
}
?>