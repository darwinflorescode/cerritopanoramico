<?php 

class addproduct{
	
	function obtenerid($id,$idproducto){
		$sql = "SELECT * FROM detallecompra WHERE idcompra=$id and idproductocompra=$idproducto";
		global $cnx;
		return $cnx->query($sql);
	}

	

	function actualizardetalle($cantidad,$precio,$idcompra,$idproducto){

		$sql ="UPDATE detallecompra SET cantidad = cantidad+$cantidad,precio=$precio, subtotal = cantidad*precio where idcompra = $idcompra and idproductocompra = $idproducto";

		global $cnx;
		return $cnx->query($sql);

	}

		

	function guardarDetallecompra($precio, $cantidad, $subtotal,$idcompra,$idproducto){
		$sql = "INSERT INTO detallecompra (precio,cantidad,subtotal,idcompra,idproductocompra) values ('$precio','$cantidad','$subtotal','$idcompra','$idproducto')";
		global $cnx;
		return $cnx->query($sql);
	}

	
	function getById($id){
		$sql = "SELECT * FROM productocompra WHERE idproductocompra=$id";
		global $cnx;
		return $cnx->query($sql);
	}

	function actualizar($cantidad,$precio,$idproducto){

		$sql ="UPDATE productocompra SET cantidad= cantidad+$cantidad,preciounitario=$precio,total = cantidad*preciounitario WHERE idproductocompra = '$idproducto'";

		global $cnx;
		return $cnx->query($sql);

	}
}

 ?>