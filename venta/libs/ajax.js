$(function(){
	var ENV_WEBROOT = "../";
	
	$(".btn-agregar-producto").off("click");
	$(".btn-agregar-producto").on("click", function(e) {
		var cantidad = $("#cantidades").val();
		var producto_id = $("#cbo_producto").val();
		var existencia = $("#cantidadexistente").val();
		var price = $("#precio").val();

				

			if(producto_id!=0){
				if(price !=''){
					if(existencia!=''){

				if(cantidad!=''){
					


				$.ajax({
					url: 'Controller/ProductoController.php?page=1',
					type: 'post',
					data: {'producto_id':producto_id, 'cantidad':cantidad },
					dataType: 'json',
					success: function(data) {
						if(data.success==true){
							$("#cantidades").val('1');
							

						
							alertify.success(data.msj);
							$(".detalle-producto").load('detalle.php');
						}else{
							alertify.error(data.msj);
						}
					},
					error: function(jqXHR, textStatus, error) {
						alertify.error(error);
					}
				});				
							

							}else{
								alertify.error('Ingrese una cantidad');
							}
						}else{
							alertify.error('No existe Cantidad En el producto');
						}
					}else{
						alertify.error('Ingrese un Precio Del Producto');
					}
						
				
				}else{
							alertify.error('Seleccione un producto');
						}

						});
	
	$(".eliminar-producto").off("click");
	$(".eliminar-producto").on("click", function(e) {
		var id = $(this).attr("id");
		$.ajax({
			url: 'Controller/ProductoController.php?page=2',
			type: 'post',
			data: {'ide':id},
			dataType: 'json'
		}).done(function(data){
			if(data.success==true){
				alertify.success(data.msj);
				$(".detalle-producto").load('detalle.php');
			}else{
				alertify.error(data.msj);
			}
		})
	});
	
	$(".guardar-carrito").off("click");
	$(".guardar-carrito").on("click", function(e) {
		
		var idusuario = $("#idusuario").val();
		var idcliente= $("#idcliente").val();
		var idmesa= $("#idmesa").val();
		var idmesero= $("#idmesero").val();

		if(idcliente!=0){
			if(idmesa!=0){
				if(idmesero!=0){
		
		$.ajax({
			url: 'Controller/ProductoController.php?page=3',
			type: 'post',
			data: {'idusuario':idusuario,'idcliente':idcliente,'idmesa':idmesa,'idmesero':idmesero},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					$("#cantidades").val('1');
					alertify.success(data.msj);
					setTimeout("location.href='generarventa.php'", 1000);
				}else{
					alertify.error(data.msj);
				}
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});

			}else{
			alertify.error('Seleccione un Mesero');

		}

			}else{
			alertify.error('Seleccione una Mesa');

		}




	}else{
			alertify.error('Seleccione un Cliente');

	}









	});










		$(".btn-guardar-imprimir").off("click");
	$(".btn-guardar-imprimir").on("click", function(e) {
		
		var idusuario = $("#idusuario").val();
		var idcliente= $("#idcliente").val();
		var idmesa= $("#idmesa").val();
		var idmesero= $("#idmesero").val();

		if(idcliente!=0){
			if(idmesa!=0){
				if(idmesero!=0){
		
		$.ajax({
			url: 'Controller/ProductoController.php?page=3',
			type: 'post',
			data: {'idusuario':idusuario,'idcliente':idcliente,'idmesa':idmesa,'idmesero':idmesero},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					$("#cantidades").val('1');
					alertify.success(data.msj);
				setTimeout('location.href="generarventa.php?ventaprint=4e8fe0ea1b43e476f0ed0655668f3a7fpos0save10d"', 2500);
				}else{
					alertify.error(data.msj);
				}
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});

			}else{
			alertify.error('Seleccione un Mesero');

		}

			}else{
			alertify.error('Seleccione una Mesa');

		}




	}else{
			alertify.error('Seleccione un Cliente');

	}









	});
	
});