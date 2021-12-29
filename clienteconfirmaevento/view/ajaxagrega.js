$(function(){
	var ENV_WEBROOT = "../";


		$(".btn-agregar-producto").off("click");
	$(".btn-agregar-producto").on("click", function(e) {

		var idbanquete = $("#idbanquete").val();
		var producto_id = $("#cbo_producto").val();
		var existencia = $("#cantidadexistente").val();
		var price = $("#precio").val();
		var cantidad = $("#cantidades").val();

			if(idbanquete!=0){
				if(producto_id!=0){
				if(price !=''){
					if(existencia!=''){

				if(cantidad!=''){

		$.ajax({
			url: 'controlador/controlador.php?page=1',
			type: 'post',
			data: {'id_venta':idbanquete,'producto_id':producto_id,'cantidad':cantidad},
			dataType: 'json',
			success: function(data) {
						if(data.success==true){

						
							alertify.success(data.msj);
							setTimeout("location.href='addproduct.php?idbanquete="+idbanquete+"'", 1000);
						}else{
							alertify.error(data.msj);
						}
					},
					error: function(jqXHR, textStatus, error) {
						alertify.success("Producto Agregado");
						setTimeout("location.href='addproduct.php?idbanquete="+idbanquete+"'", 1000);
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

							}else{
							alertify.error('Id Venta No se capturó,Error');
						}







	});

	

	

	
});