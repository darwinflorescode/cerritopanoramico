function editartipo(id){
			var nombre_cliente = $("#nombre"+id).val();
			
	
			$("#mod_nombre").val(nombre_cliente);
			$("#mod_id").val(id);
			
		
		}


		function editarusuario(id){
			var nombre = $("#nombre"+id).val();
			var apellido = $("#apellido"+id).val();
			var email = $("#email"+id).val();
			var usuario = $("#usuario"+id).val();
			var pregunta = $("#pregunta"+id).val();
			var respuesta = $("#respuesta"+id).val();
			var nombreusuario = $("#nombreusuario"+id).val();
			
	
			$("#mod_nombre").val(nombre);
			$("#mod_apellido").val(apellido);
			$("#mod_email").val(email);
			$("#mod_usuario").val(usuario);
			$("#mod_pregunta").val(pregunta);
			$("#mod_respuesta").val(respuesta);
			$("#mod_tipo").val(nombreusuario);

			$("#mod_id").val(id);
			
		
		}

		function activar(id){

			var nombre = $("#nombrec"+id).val();
			var razon = $("#razon"+id).val();
			var estado = $("#estado"+id).val();


			
			
	
			$("#mod_razon").val(razon);
			$("#mod_estado").val(estado);
			$("#mod_nombres").val(nombre);

			$("#mod_aid").val(id);

		}

			function cambiarpass(id){

			var nombre = $("#nombrec"+id).val();


			
			$("#mod_passnombre").val(nombre);

			$("#mod_passid").val(id);

		}

		function editarcliente(id){

			var nombre = $("#nombre"+id).val();
			var apellido = $("#apellido"+id).val();
			var dui = $("#dui"+id).val();
			var telefono = $("#telefono"+id).val();
			var direccion = $("#direccion"+id).val();
			var email = $("#email"+id).val();
			var whatsapp = $("#whatsapp"+id).val();


			
			$("#modal_nombre").val(nombre);
			$("#modal_apellido").val(apellido);
			$("#modal_dui").val(dui);
			$("#modal_tel").val(telefono);
			$("#modal_direccion").val(direccion);
			$("#modal_email").val(email);
			$("#modal_whatsapp").val(whatsapp);

			$("#modal_id").val(id);

		}


function editarproveedor(id){

			var nombre = $("#nombre"+id).val();
			var codigo = $("#codigo"+id).val();
			var telefono = $("#telefono"+id).val();
			var email = $("#email"+id).val();
			var direccion = $("#direccion"+id).val();
			var nombrecontacto = $("#nombrecontacto"+id).val();
			var telefonocontacto = $("#telefonocontacto"+id).val();


			
			$("#mod_nomedit").val(nombre);
			$("#mod_codedit").val(codigo);
			$("#mod_teledit").val(telefono);
			$("#mod_emailedit").val(email);
			$("#mod_direccionedit").val(direccion);
			$("#mod_nombredit").val(nombrecontacto);
			$("#mod_telecedit").val(telefonocontacto);

			$("#id").val(id);

		}




		function activarproveedor(id){

			var nombre = $("#nombre"+id).val();
			var razon = $("#razon"+id).val();
			var estado = $("#estado"+id).val();


			
			
	
			$("#modrazon").val(razon);
			$("#modestado").val(estado);
			$("#modnombre").val(nombre);

			$("#modid").val(id);

		}


		function editartipoproducto(id){
			var nombre_cliente = $("#nombretipoproducto"+id).val();
			
	
			$("#mod_nombrep").val(nombre_cliente);
			$("#mod_idp").val(id);
			
		
		}


		function editarproducto(id){
			var nombre_cliente = $("#nombre"+id).val();
			var tipomenu = $("#tipomenu"+id).val();
			var idtipo = $("#idtipo"+id).val();
			var descripcion = $("#descripcion"+id).val();
			
	
			$("#modal_nombre").val(nombre_cliente);
			$("#modal_tipomenu").val(tipomenu);
			$("#modal_tipoproducto").val(idtipo);
			$("#modal_descripcion").val(descripcion);

			$("#idp").val(id);
			
		
		}


		function activarproducto(id){

			var nombre = $("#nombre"+id).val();
			var razon = $("#razon"+id).val();
			var estado = $("#estado"+id).val();


			
			
			$("#mod_nombrep").val(nombre);
			$("#mod_razonp").val(razon);
			$("#mod_estadop").val(estado);
			

			$("#mod_aid").val(id);

		}

		function editarproductocompra(id){
			var nombre = $("#nombre"+id).val();
			var estado = $("#estadonn"+id).val();
			var descripcion = $("#descripcion"+id).val();
		
			
	
			$("#modal_nombre").val(nombre);
			$("#modal_estadop").val(estado);
			$("#modal_descripcion").val(descripcion);
			

			$("#idp").val(id);
			
		
		}
	
		function editarproduccion(id){

			var fechav = $("#fechavencimiento"+id).val();
			var nombrep = $("#idpro"+id).val();
			var cantidad = $("#cantidad"+id).val();
			var preciounitario = $("#preciounitario"+id).val();
			var total = $("#total"+id).val();


			
			
			$("#modal_fecha").val(fechav);
			$("#modal_producto").val(nombrep);
			$("#modal_cantidad").val(cantidad);
			$("#modal_precio").val(preciounitario);
			$("#modal_total").val(total);
			

			$("#modal_id").val(id);

		}

		function agregarcantidad(id){

			var nombrep = $("#nombrep"+id).val();
			var cantidad = $("#cantidad"+id).val();
			var preciounitario = $("#preciounitario"+id).val();
			var total = $("#total"+id).val();
				var idpro = $("#idpro"+id).val();


			
			
			$("#modalnombre").val(nombrep);
			$("#modalcantidad").val(cantidad);
			$("#modalprecio").val(preciounitario);
			$("#modaltotala").val(total);
			$("#modalnuevacantidad").val("");
			$("#nuevo").val("");
			$("#modalnuevacant").val("");
			$("#modalnuevototal").val("");


			$("#modalidd").val(id);
			$("#modalpro").val(idpro);


		}

			function editarmesero(id){
			var codigo = $("#codigo"+id).val();
			var nombre = $("#nombre"+id).val();
			var apellido = $("#apellido"+id).val();
			var telefono = $("#telefono"+id).val();
			var direccion = $("#direccion"+id).val();
			var estado = $("#estado"+id).val();
		
			$("#mod_codigo").val(codigo);
			$("#mod_nombre").val(nombre);
			$("#mod_apellido").val(apellido);
			$("#modal_tel").val(telefono);
			$("#modal_direccion").val(direccion);
			$("#mod_estado").val(estado);		

			$("#modal_id").val(id);

		}


			
			function editarmesa(id){

			var numeromesa = $("#numeromesa"+id).val();
			var imagen = $("#imagen"+id).val();
			var descripcion = $("#descripcion"+id).val();
			var estado = $("#estado"+id).val();
			
		
			
			$("#modal_numeromesa").val(numeromesa);
			$("#modal_imagen").val(imagen);
			$("#modal_descripcion").val(descripcion);
			$("#modal_estado").val(estado);	

			$("#modal_id").val(id);

		}

		function caja(id){

			var nombrecliente = $("#nombreclient"+id).val();
			var totalpaga = $("#totalpaga"+id).val();
			
			
		
			
			$("#nombrecliente").val(nombrecliente);
			$("#totalpagar").val(totalpaga);
			$("#clientepaga").val('');
			$("#cambio").val('');
			

			$("#modal_id").val(id);

		}

function editarcondiciones(id){

			var descripcion= $("#descripcion"+id).val();
			var eventosespeciales= $("#eventoes"+id).val();
			

			$("#modal_descripcion").val(descripcion);
			$("#modal_eventosespeciales").val(eventosespeciales);
			

			$("#idc").val(id);
		}


		function editarentradas(id){
			
			var descripcion = $("#descripcion"+id).val();
			var eventosespeciales= $("#eventoes"+id).val();

			$("#modal_descripcion").val(descripcion);
			$("#modal_eventosespeciales").val(eventosespeciales);

			$("#id").val(id);
			
		
		}

		function editartipoadicional(id){
			
			var descripcion = $("#descripcion"+id).val();
			var eventosespeciales= $("#eventoes"+id).val();
			

			$("#modal_descripcion").val(descripcion);
			$("#modal_eventosespeciales").val(eventosespeciales);

			$("#id").val(id);
			
		
		}

		function editartipoplatillofuerte(id){
			
			var nombreplatillo = $("#nombreplatillo"+id).val();
			var descripcion = $("#descripcion"+id).val();
			var eventosespeciales= $("#eventoes"+id).val();
			

			$("#modal_nombre").val(nombreplatillo);
			$("#modal_descripcion").val(descripcion);
			$("#modal_eventosespeciales").val(eventosespeciales);

			$("#id").val(id);
			
		
		}

		function editareventosespeciales(id){
			
			var opcion = $("#opcion"+id).val();
			var pastel= $("#pastel"+id).val();
			var postre = $("#postre"+id).val();
			
			var preciopersona= $("#preciopersona"+id).val();
			

			$("#modal_opcion").val(opcion);
			$("#modal_pastel").val(pastel);
			$("#modal_postre").val(postre);
			
			$("#modal_preciopersona").val(preciopersona);

			$("#id").val(id);
			
		
		}

		function editarclienteconfirmaevento(id){

			var cliente= $("#cliente"+id).val();
			var eventosespeciales= $("#eventoes"+id).val();			
			var preciopersona= $("#precioporpersona"+id).val();
			var cantidadpersona = $("#cantidadpersona"+id).val();
			var preciototal= $("#preciototal"+id).val();
			var fechaevento= $("#fecha"+id).val();
			var horainicio= $("#horainicios"+id).val();
			var horafin= $("#horafin"+id).val();
			var adelanto= $("#adelanto"+id).val();
			var pendiente= $("#pendiente"+id).val();
			
			
			$("#modal_cliente").val(cliente);
			$("#modal_eventosespeciales").val(eventosespeciales);
			$("#modal_precio").val(preciopersona);
			$("#modal_cantidad").val(cantidadpersona);
			$("#modal_preciototal").val(preciototal);
			$("#modal_fecha").val(fechaevento);
			$("#modal_horainicio").val(horainicio);
			$("#modal_horafin").val(horafin);
			$("#modal_adelanto").val(adelanto);
			$("#modal_pendiente").val(pendiente);
			
		

			$("#idconfirmar").val(id);
			
		
		}

				function cancelarevento(id){

		
			var preciototal= $("#preciototal"+id).val();
			var adelanto= $("#adelanto"+id).val();
		
	
			$("#cancelartotal").val(preciototal);
			$("#aplicaradelanto").val(adelanto);
		
			
		

			$("#idconfirmarcancelacion").val(id);
			
		
		}


