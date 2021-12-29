<?php 

class addproduct{
	
	function obtenerid($id,$idproducto){
		$sql = "SELECT * FROM detalleorden WHERE idorden=$id and idproducto=$idproducto";
		global $cnx;
		return $cnx->query($sql);
	}

	function obteneridcortesia($id,$idproducto){
		$sql = "SELECT * FROM cortesia WHERE idorden=$id and idproducto=$idproducto";
		global $cnx;
		return $cnx->query($sql);
	}


	function actualizardetalle($cantidad,$idorden,$idproducto){

		$sql ="UPDATE detalleorden SET cantidad = cantidad+$cantidad, subtotal = cantidad*precioactual where idorden = $idorden and idproducto = $idproducto";

		global $cnx;
		return $cnx->query($sql);

	}

		function actualizarcortesia($cantidad,$idorden,$idproducto){

		$sql ="UPDATE cortesia SET cantidad = cantidad+$cantidad, subtotal = cantidad*precio where idorden = $idorden and idproducto = $idproducto";

		global $cnx;
		return $cnx->query($sql);

	}

	function guardarDetalleVenta($precio, $cantidad, $subtotal,$idorden,$idproducto){
		$sql = "INSERT INTO detalleorden (precioactual,cantidad,subtotal,idorden,idproducto) values ('$precio','$cantidad','$subtotal','$idorden','$idproducto')";
		global $cnx;
		return $cnx->query($sql);
	}

	function guardarcortesia($precio, $cantidad, $subtotal,$idorden,$idproducto){
		$sql = "INSERT INTO cortesia (precio,cantidad,subtotal,idorden,idproducto,fechacortesia) values ('$precio','$cantidad','$subtotal','$idorden','$idproducto',NOW())";
		global $cnx;
		return $cnx->query($sql);
	}

	function getById($id){
		$sql = "SELECT * FROM producto WHERE idproducto=$id";
		global $cnx;
		return $cnx->query($sql);
	}

	function actualizar($cantidad,$idproducto){

		$sql ="UPDATE producto SET cantidad= cantidad-$cantidad,salida=salida+$cantidad,total = cantidad*preciounitario WHERE idproducto = '$idproducto'";

		global $cnx;
		return $cnx->query($sql);

	}
}

 ?>