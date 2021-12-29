	$(function(){
	var ENV_WEBROOT = "../";

	$(".btn-editar").off("click");
	$(".btn-editar").on("click", function(e) {
		var idorden = $("#idorden").val();
		var idusuario = $("#idusuario").val();
		var idcliente= $("#idcliente").val();
		var idmesa= $("#idmesa").val();
		var idmesero= $("#idmesero").val();
		
		if((idorden!=0) || (idorden!="")) {
		if(idcliente!=0){
			if(idmesa!=0){
				if(idmesero!=0){
		
		$.ajax({
			url: 'Controller/ProductoController.php?page=4',
			type: 'post',
			data: {'idorden':idorden,'idusuario':idusuario,'idcliente':idcliente,'idmesa':idmesa,'idmesero':idmesero},
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
			alertify.error('Seleccione un Mesero');

		}

			}else{
			alertify.error('Seleccione una Mesa');

		}




	}else{
			alertify.error('Seleccione un Cliente');

	}
	}else{
			alertify.error('No puede guardar');

	}

	});
		});