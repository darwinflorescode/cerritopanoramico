<?php
class Producto
{
	function obteneridorden($id){
		$sql = "SELECT * FROM orden WHERE idorden=$id";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getById($id){
		$sql = "SELECT * FROM producto WHERE idproducto=$id";
		global $cnx;
		return $cnx->query($sql);
	}

	function getBydetalle($idorden,$idproducto){
		$sql = "SELECT * FROM detalleorden WHERE idorden='$idorden' and idproducto = '$idproducto' ";
		global $cnx;
		return $cnx->query($sql);
	}

	
	function guardarVenta($idusuario,$idcliente,$idmesa,$idmesero){
		$sql = "INSERT INTO orden (fechaorden,idusuario,idcliente,idmesa,idmesero,estado) values (NOW(),'$idusuario','$idcliente','$idmesa','$idmesero','Pendiente')";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getUltimaVenta()
	{
		$sql = "SELECT LAST_INSERT_ID() as ultimo";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function guardarDetalleVenta($precio, $cantidad, $subtotal,$idorden,$idproducto){
		$sql = "INSERT INTO detalleorden (precioactual,cantidad,subtotal,idorden,idproducto) values ('$precio','$cantidad','$subtotal','$idorden','$idproducto')";
		global $cnx;
		return $cnx->query($sql);
	}

	function actualizar($cantidad,$idproducto){

		$sql ="UPDATE producto SET cantidad= cantidad-$cantidad,salida=salida+$cantidad, total = cantidad*preciounitario WHERE idproducto = '$idproducto'";

		global $cnx;
		return $cnx->query($sql);

	}

		function actualizardetalle($cantidad,$idorden,$idproducto){

		$sql ="UPDATE detalleorden SET cantidad = cantidad+$cantidad, subtotal = cantidad*precioactual where idorden = $idorden and idproducto = $idproducto";

		global $cnx;
		return $cnx->query($sql);

	}

function actualizarorden($idusuario,$idcliente,$idmesa,$idmesero,$idorden){

		$sql ="UPDATE orden SET idusuario = $idusuario, idcliente = $idcliente,idmesa=$idmesa,idmesero=$idmesero where idorden = $idorden";

		global $cnx;
		return $cnx->query($sql);

	}



	function actualizarmesa($idmesa){

		$sql ="UPDATE mesa SET estado= 'Ocupada' WHERE idmesa = '$idmesa'";

		global $cnx;
		return $cnx->query($sql);

	}
	function actualizarmes($idmesa){

		$sql ="UPDATE mesa SET estado= 'Disponible' WHERE idmesa = '$idmesa'";

		global $cnx;
		return $cnx->query($sql);

	}
	function actualizarmesero($idmesero){

		$sql ="UPDATE mesero SET contadormesa= contadormesa+1 WHERE idmesero = '$idmesero'";

		global $cnx;
		return $cnx->query($sql);

	}

	function actualizarmeser($idmesero){

		$sql ="UPDATE mesero SET contadormesa= contadormesa-1 WHERE idmesero = '$idmesero'";

		global $cnx;
		return $cnx->query($sql);

	}
}