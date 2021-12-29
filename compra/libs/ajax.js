$(function(){
	var ENV_WEBROOT = "../";
	
	$(".btn-agregar-producto").off("click");
	$(".btn-agregar-producto").on("click", function(e) {

		var fechav = $("#fechav").val();
		var cantidad = $("#cantidadcompra").val();
		var producto_id = $("#cbo_producto").val();
		var preciocompra= $("#preciocompra").val();
		


		if(producto_id!=0){
		if(preciocompra!=''){
			if(cantidad!=''){
				$.ajax({
					url: 'Controller/ProductoController.php?page=1',
					type: 'post',
					data: {'producto_id':producto_id, 'fechav':fechav,'cantidad':cantidad,'preciocompra':preciocompra},
					dataType: 'json',
					success: function(data) {
						if(data.success==true){
							$("#cantidadcompra").val('');
							$("#preciocompra").val('');
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
					alertify.error('Ingrese un Precio de Compra');
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
			data: {'id':id},
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
		var idproveedor= $("#idproveedor").val();



		if(idusuario!=0){

			if(idproveedor!=0){
		
		$.ajax({
			url: 'Controller/ProductoController.php?page=3',
			type: 'post',
			data: {'idusuario':idusuario,'idproveedor':idproveedor},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					$("#cantidadcompra").val('');
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
			alertify.error('Seleccione un Proveedor');
		}

		}else{
			alertify.error('Seleccione un Usuario');
		}



	});



	$(".btn-guardar-imprimir").off("click");
	$(".btn-guardar-imprimir").on("click", function(e) {

		var idusuario = $("#idusuario").val();
		var idproveedor= $("#idproveedor").val();



		if(idusuario!=0){

			if(idproveedor!=0){
		
		$.ajax({
			url: 'Controller/ProductoController.php?page=3',
			type: 'post',
			data: {'idusuario':idusuario,'idproveedor':idproveedor},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					$("#cantidadcompra").val('');
					alertify.success(data.msj);
					setTimeout('location.href="nuevacompra.php?compraprint=4e8fe0ea1b43e476f0ed0655668f3a7fpos0"', 2500);
				}else{
					alertify.error(data.msj);
				}
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});	

			}else{
			alertify.error('Seleccione un Proveedor');
		}

		}else{
			alertify.error('Seleccione un Usuario');
		}



	});
	
});