<script>
	

	$(document).ready(function() {
			$('#btnActualizarArticulo').click(function() {

				datos = $('#formModalArticulo').serialize(); //No se usa esto porque no manda imagenes
				//var formData = new FormData(document.getElementById("formModalArticulo"));
				$.ajax({
					url: '../procesos/articulos/actualizarArticulos.php',
					type: 'POST',
					data: datos, //aca viene un array
						success:function(r){
							
							if(r==1){
								$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
								alertify.success("Categoria actualizada");
							}else{
								alertify.error("Error al realizar el proceso");
							}
						}
					});


			});

		});




//SCRIPT PARA EL EVENTO CLICK Y AJAX

$('#').click(function(event) {
	/* Act on the event */
	datos =$('#').serialize(); //recoge datos del formulario para mandarlo por metodo ajax
	$.ajax({
		url: '../procesos',
		type: 'POST',
		data: datos,
		success:function(r){

		}

	});
	
});


//FUNCION PARA VALIDAR DATOS VACIOS
</script>