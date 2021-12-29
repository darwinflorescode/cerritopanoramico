$(function(){
	var ENV_WEBROOT = "../";


		$(".btn-agregar-producto").off("click");
	$(".btn-agregar-producto").on("click", function(e) {

		var idcompra = $("#idcompra").val();
		var producto_id = $("#cbo_producto").val();
		var price = $("#preciocompra").val();
		var cantidad = $("#cantidades").val();

			if(idcompra!=0){
				if(producto_id!=0){
				if(price !=''){
				

				if(cantidad!=''){

		$.ajax({
			url: 'Controller/controlador.php?page=1',
			type: 'post',
			data: {'id_compra':idcompra,'producto_id':producto_id,'cantidad':cantidad,'precio':price},
			dataType: 'json',
			success: function(data) {
						if(data.success==true){

						
							alertify.success(data.msj);
							setTimeout("location.href='productadd.php?id_compra="+idcompra+"'", 1000);
						}else{
							alertify.error(data.msj);
						}
					},
					error: function(jqXHR, textStatus, error) {
						alertify.success("Producto Agregado");
						setTimeout("location.href='productadd.php?id_compra="+idcompra+"'", 1000);
					}
			
		});


							}else{
								alertify.error('Ingrese una cantidad');
							}
					
					}else{
						alertify.error('Ingrese un Precio Del Producto');
					}
						
				
				}else{
							alertify.error('Seleccione un producto');
						}

							}else{
							alertify.error('Id Compra No se capturó,Error');
						}



	});

	
});