<?php
ini_set("display_errors","on");
require("inc/config.php");
//require("inc/sesionAdmin.php");
require("_head.php");
$menu = "pub";
require("_menu.php");
?>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

<script src="../js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.numeric.js"></script>

<div class="container">
	<br>
	<div class="well" style="background-color: #dceaf4;">
		<h3 id="tituloForm">Crear nueva Actividad</h3>

		<div id="form">
			<form id="formActividad">
				<input type="hidden" name="id">
				<table>
					<tr>
						<td>Titulo: </td>
						<td><input name="titulo" type="text"></td>
					</tr>
					<tr>
						<td>Bienvenida a la actividad: </td>
						<td><textarea name="bienvenida" id="" cols="30" rows="10"></textarea></td>
					</tr>
					<tr>
						<td>Maximo de intentos: </td>
						<td><input name="limiteIntentos" class="positive" type="text"></td>
					</tr>
					<tr>
						<td>Cantidad de preguntas: </td>
						<td><input name="cantidadPreguntas" class="positive" type="text"></td>
					</tr>
					<tr>
						<td>Porcentaje minimo para aprobar: </td>
						<td><input name="porcentajeAprobacion" class="positive" type="text"></td>
					</tr>
					<tr>
						<td><input class="btn btn-success" type="button" name="enviar" id="enviar" value="Guardar" onclick=""></td>
						<td><a href='actividadNew.php' class='btn btn-danger'>Cancelar</a></td>
					</tr>
				</table>
			</form>
		</div>

		<div id="mensaje"></div>


		<div id="tablaActividades"></div>
	</div>

</div>
<div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="modalHeader"></h3>
  </div>
  <div class="modal-body">
    <p id="modalBody"></p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">ok</button>
  </div>
</div>

<script>
	var app = function() {
		var action = "add";

		var initialize = function() {
			getActividades();
			event.init();
			$(".positive").numeric({decimal: false, negative: false });

			class_activo('boton_actividadNew','activo');
		};

		var getActividades = function () {
			jQuery.ajax({
				url: 'inc/funcionesActividad.php',
				type: 'POST',
				dataType: 'json',
				data: "action=getAll",
				complete: function(xhr, textStatus) {
				},
				success: function(data, textStatus, xhr) {
					$("#tablaActividades").html("<table id='tableActividades'><tr><td>ID</td><td>Titulo</td><td>Estado</td><td>Acciones</td><tr></table>");
					$.each(data.data, function(k,v){
						$("#tableActividades").append("<tr><td>"+v.id+"</td><td>"+v.titulo+"</td><td>"+v.estado+"</td><td><a href='itemNew.php?idActividad="+v.id+"' class='btn btn-primary'>Agregar/Editar Items</a> <input type='button' id='"+v.id+"' value='Editar Actividad' class='btn btn-success editActividad'> <input type='button' class='btn btn-danger removeActividad' id='"+v.id+"' value='Eliminar'></td><tr>");
					});
				},
				error: function(xhr, textStatus, errorThrown) {
				}
			});
		};

		var decodeHTML = function (s) {
			return $("<div/>").html(s).text();
		};

		var validateNotNull = function (data) {
			var result = { error: false, msg:""};
			for (var i = 0; i < data.length; i++) {
				if ($('form [name='+data[i].name+']').val() == "") {
					result.error = true;
					result.msg += data[i].msg+"<br>";
				}
			}
			return result;
		};

		var validation = function () {
			var notNull = [
				{name:"titulo", msg: "el campo titulo no puede ser nulo"}, 
				{name:"bienvenida", msg: "el campo bienvenida no puede ser nulo"}, 
				{name:"limiteIntentos", msg: "el campo maximo de intentos no puede ser nulo"}, 
				{name:"cantidadPreguntas", msg: "el campo cantidad de preguntas no puede ser nulo"}, 
				{name:"porcentajeAprobacion", msg: "el campo porcentaje minimo para aprobar no puede ser nulo"}
			];
			var resultValidation = validateNotNull(notNull);
			if (resultValidation.error) {
				$('#modalHeader').html("Por favor revise los siguiente errores:");
				$('#modalBody').html(resultValidation.msg);
				$('#modal').modal('show');
				return false;
			} else {
				return true;
			}
		};


		var event = function() {

			var onEnviar = function() {
				$("#enviar").on("click", function() {
					if(validation()){
						var data = $("#formActividad").serialize() + "&action=" + action;
						jQuery.ajax({
							url: 'inc/funcionesActividad.php',
							type: 'POST',
							data: data,
							complete: function(xhr, textStatus) {
							},
							success: function(data, textStatus, xhr) {

								$('#modalHeader').html("Agregada");
								$('#modalBody').html("La actividad se ha almacenado correctamente:");
								$('#modal').modal('show');
								// $("#mensaje").html(data);
								getActividades();
							},
							error: function(xhr, textStatus, errorThrown) {
							}
						});
					}
				});
			};

			var onDeleteActividad = function() {
				$("#tablaActividades").on("click", ".removeActividad", function () {
					var r = confirm("Seguro que desea eliminar la actividad?");
					if (r == true) {
						console.log($(this).prop("id"));
						var data = "id="+$(this).prop("id");
						jQuery.ajax({
							url: 'inc/funcionesActividad.php',
							type: 'POST',
							// dataType: 'json',
							data: data + "&action=removeActividad",
							complete: function(xhr, textStatus) {
							},
							success: function(data, textStatus, xhr) {
								$("#respuestaAjax").html(data);
								getActividades();
							},
							error: function(xhr, textStatus, errorThrown) {
							}
						});
					}
				});
			};

			var onEditActividad = function() {
				$("#tablaActividades").on("click", ".editActividad", function () {
					console.log($(this).prop("id"));
					var data = "id="+$(this).prop("id");
					jQuery.ajax({
						url: 'inc/funcionesActividad.php',
						type: 'POST',
						dataType: 'json',
						data: data + "&action=getActividad",
						complete: function(xhr, textStatus) {
						},
						success: function(data, textStatus, xhr) {
							console.log(data);
							action = "edit";
							$("#respuestaAjax").html(data);
							$('textarea[name=bienvenida]').val(decodeHTML(data.bienvenida));
							$('input[name=titulo]').val(decodeHTML(data.titulo));
							$('input[name=limiteIntentos]').val(data.limiteIntentos);
							$('input[name=cantidadPreguntas]').val(data.cantidadPreguntas);
							$('input[name=porcentajeAprobacion]').val(data.porcentajeAprobacion);
							$('input[name=id]').val(data.id);
							$('#tituloForm').html("Editar actividad: "+data.id);
						},
							error: function(xhr, textStatus, errorThrown) {
						}
					});
				});
			};

			return {
				init : function() {
					onEnviar();
					onDeleteActividad();
					onEditActividad();
				}
			}
		}();

		initialize();

	}();

</script>

