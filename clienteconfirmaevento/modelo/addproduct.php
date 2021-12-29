<?php 

class addproduct{
	
	function obtenerid($id,$idproducto){
		$sql = "SELECT * FROM detallevento WHERE idclienteconfirmaevento=$id and idproducto=$idproducto";
		global $cnx;
		return $cnx->query($sql);
	}




	function actualizardetalle($cantidad,$idorden,$idproducto){

		$sql ="UPDATE detallevento SET cantidad = cantidad+$cantidad, subtotal = cantidad*precio where idclienteconfirmaevento = $idorden and idproducto = $idproducto";

		global $cnx;
		return $cnx->query($sql);

	}

	

	function guardarDetalleVenta($cantidad, $precio, $subtotal,$idproducto,$idorden){
		$sql = "INSERT INTO detallevento (cantidad,precio,subtotal,idproducto,idclienteconfirmaevento) values ('$cantidad','$precio','$subtotal','$idproducto','$idorden')";
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