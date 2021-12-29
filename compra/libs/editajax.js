
$(function(){
	var ENV_WEBROOT = "../";

	$(".btn-editar").off("click");
	$(".btn-editar").on("click", function(e) {
		var idcompra = $("#idcompra").val();
		var idusuario = $("#idusuario").val();
		var idproveedor= $("#idproveedor").val();
		
		if((idcompra!=0) || (idcompra!="")) {
		
				if(idproveedor!=0){ 
		
		$.ajax({
			url: 'Controller/ProductoController.php?page=4',
			type: 'post',
			data: {'idcompra':idcompra,'idusuario':idusuario,'idproveedor':idproveedor},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
				
					alertify.success(data.msj);
					setTimeout("location.href='mostrar.php'", 1000);
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
			alertify.error('No puede guardar');

	}

	});
		});



