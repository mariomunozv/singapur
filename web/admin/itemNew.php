<?php
ini_set("display_errors","on");
require("inc/config.php");
//require("inc/sesionAdmin.php");
require("_head.php");
$menu = "pub";
require("_menu.php");
?>

<script src="../js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="../js/jquery.numeric.js"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/blueimp/style.css">
<link rel="stylesheet" href="../css/blueimp/jquery.fileupload-ui.css">
<style type="text/css">
input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
	cursor: not-allowed;
	background-color: #645858;
}
</style>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<div class="container">
	<br>
	<div class="well" style="background-color: #dceaf4; font-size: 100%;">
		<h3 id="tituloForm">Crear Nuevo Item</h3>
		<div id="imagen">
			<span class="btn btn-success fileinput-button">
		        <i class="icon-plus icon-white"></i>
		        <span>Agregar foto</span>
		        <!-- The file input field used as target for the file upload widget -->
		        <input id="fileupload" type="file" name="files[]" multiple>
		    </span>
		    <br>
		    <br>

		    <!-- The container for the uploaded files -->
		    <div class="span12">
		    	<div class="span3">
				    <div id="files" class="files"></div>
				    <div id="removeIMG-button" style="display:none"><input id="removeIMG" type="button" class="btn btn-danger" value="remover"></div>
		    	</div>
		    	<div class="span3">
			    	<div id="imagenActual" class="files"></div>
			    </div>
		    </div>

		</div>

		<form id="formItem">
			<div class="row" style="display:none">
				<div class="span2">
					Image:
				</div>
				<div class="span2">
					<input type="text" name="foto" id="foto">
					<input type="hidden" name="id" id="id">
				</div>
			</div>

		    <div class="row">
				<div class="span2">
			    	Tema:
			    </div>
				<div class="span2">
				    <select name="tema" id="tema">
		                <option value="didactica">Didáctica</option>
	                	<option value="matematica">Matemática</option>
	                </select>
                </div>
			</div>

		    <div class="row">
				<div class="span2">
			    	Nivel:
			    </div>
				<div class="span2">
				    <select name="nivel" id="nivel"></select>
                </div>
			</div>

		    <div class="row">
				<div class="span2">
			    	Capitulos:
			    </div>
				<div class="span2">
				    <select name="capitulo" id="capitulo"></select>
                </div>
			</div>

		    <div class="row">
				<div class="span2">
			    	Apartados:
			    </div>
				<div class="span2">
				    <select name="apartado" id="apartado"></select>
                </div>
			</div>

		    <div class="row">
				<div class="span2">
			    	Competencias:
			    </div>
				<div class="span2">
				    <select name="idCompetencia" id="competencia">
				    </select>
                </div>
			</div>

		    <div class="row">
				<div class="span2">
			    	Enunciado:
			    </div>
				<div class="span2">
				    <textarea name="enunciado" id="enunciado" cols="50" rows="10"></textarea>
                </div>
			</div>


			<div class="well" style="background-color: #A0FFA4; font-size: 100%;">
				<center>
					<h3>Respuestas</h3>
				</center>
			    <div class="row">
					<div class="span2">
				    	Tipo Respuesta:
				    </div>
					<div class="span2">
					    <select name="tipoRespuesta" id="tipoRespuesta">
							<option value="seleccionUnica">Selección Unica</option>
							<option value="respuestaAbierta">respuesta abierta</option>
						</select>
						<input type="hidden" name="esAbierto" id="esAbierto">
	                </div>
				</div>
				<div class="row">
					<div class="span2">
						<input class="btn  btn-primary" type="button" id="addAlternativa" value="Agregar Alternativa">
					</div>
				</div>
				<br>
				<div id="alternativas">
					<div class="row" id='selectionFirst'>
						<div class="span3">
							<textarea cols='50' rows='4' name='alternativa[]' id='alternativa[]'></textarea>
						</div>
						<div class="span2">
							<input checked type='checkbox' id='checkAlternativa' name='altCheck[]' value='1' class='checkAlternativa'>
						</div>
					</div>
				</div>
			</div>

			<div class="row" id='divPuntajeItem'>
				<div class="span2">
			    	puntaje Item:
			    </div>
				<div class="span2">
				    <input type="text" name="puntaje" id="puntajeTotalItem" class="positive">
                </div>
			</div>


			<div class="row">
				<div class="span2">
					<input type="hidden" name="idActividad" id="idActividad" value="<?php echo $_GET['idActividad']; ?>" onclick="">
					<input class="btn  btn-success" type="button" name="enviar" id="enviar" value="Guardar" onclick="">
			    </div>
				<div class="span2">
					<a href='itemNew.php?idActividad=<?php echo $_GET['idActividad'] ?>' id="cancelar" class='btn btn-danger'>Cancelar</a>
			    </div>
			</div>

			<div class="row">
				<!-- The global progress bar -->
				<br>
				<div id="progress" class="progress progress-success progress-striped">
				    <div class="bar"></div>
				</div>
			</div>

		</form>

		<div id="mensaje"></div>

		<div id="tablaItems" class="well"></div>
	</div>
</div>


<div id='selection' style="display:none">
	<div class='row'>
		<div class='span3'>
			<textarea cols='50' rows='4' name='alternativa[]' id='alternativa[]'></textarea>
		</div>
		<div class='span3'>
			<input type='checkbox' id='checkAlternativa' name='altCheck[]' value='1' class='checkAlternativa'>
			<br><br>
			<input class='btn btn-danger' type='button' id='removeAlternative' value='eliminar'>
		</div>
	</div>
</div>

<div id='openFirst' style="display:none">
	<div class="row">
		<div class="span2">
			<b>Indicación</b>
		</div>
		<div class="span2">
			<b>campo respuesta</b>
		</div>
		<div class="span2">
			<b>Función Evaluadora</b>
		</div>
		<div class="span3">
			<b>parametros</b>
		</div>
		<div class="span1">
			<b>puntaje</b>
		</div>
	</div>
	<div class="row">
		<div class="span2">
			<input type='text' name='alternativa[]' id='alternativa[]' value='' style="width: 120px;">
		</div>
		<div class="span2">
			<select name="tipoCampo[]" id="tipoCampo" style="width: 120px;">
				<option value="normal">normal</option>
				<option value="numerico">numerico</option>
				<option value="fraccion">fracción</option>
				<option value="numeroMixto">numeroMixto</option>
			</select>
		</div>
		<div class="span2">
			<select name="funcionEvaluadora[]" id='funcionEvaluadora' style="width: 150px;">
				<option value="igual">igual</option>
				<option value="intervalo">intervalo</option>
				<option value="valorEquivalente">valorEquivalente</option>
			</select>
		</div>
		<div class="span3" id="parametro">
			<table>
				<tr>
					<td rowspan="2">
						<input type='text' name='entero[]' value='' style="width: 30px;" placeholder="" class='entero minimo'>
					</td>
					<td>
						<input type='text' name='numerador[]' value='' style="width: 30px;" placeholder="Num" class='numerador minimo'>
					</td>
					<td rowspan="2">
						<b class="maximo">-</b>
					</td>
					<td rowspan="2">
						<input type='text' name='entero2[]' value='' style="width: 30px;" placeholder="" class='entero maximo'>
					</td>
					<td>
						<input type='text' name='numerador2[]' value='' style="width: 30px;" placeholder="Num" class='numerador maximo'>
					</td>
				</tr>
				<tr>
					<td>
						<input type='text' name='denominador[]' value='' style="width: 30px;" placeholder="Den" class='denominador minimo'>
					</td>
					<td>
						<input type='text' name='denominador2[]' value='' style="width: 30px;" placeholder="Den" class='denominador maximo'>
					</td>
				</tr>
			</table>
		</div>
		<div class="span1">
			<input type='text' name='puntajeRespuesta[]' value='' class="positive  puntajeItem" style="width: 50px;">
		</div>
	</div>
</div>

<div id='open' style="display:none">
	<div class="row">
		<div class="span2">
			<input type='text' name='alternativa[]' id='alternativa[]' value='' style="width: 120px;">
		</div>
		<div class="span2">
			<select name="tipoCampo[]" id="tipoCampo" style="width: 120px;">
				<option value="normal">normal</option>
				<option value="numerico">numerico</option>
				<option value="fraccion">fracción</option>
				<option value="numeroMixto">numeroMixto</option>
			</select>
		</div>
		<div class="span2">
			<select name="funcionEvaluadora[]" id='funcionEvaluadora' style="width: 150px;">
				<option value="igual">igual</option>
				<option value="intervalo">intervalo</option>
				<option value="valorEquivalente">valorEquivalente</option>
			</select>
		</div>
		<div class="span3" id="parametro">
			<table>
				<tr>
					<td rowspan="2">
						<input type='text' name='entero[]' value='' style="width: 30px;" placeholder="" class='entero minimo'>
					</td>
					<td>
						<input type='text' name='numerador[]' value='' style="width: 30px;" placeholder="Num" class='numerador minimo'>
					</td>
					<td rowspan="2">
						<b class="maximo"></b>
					</td>
					<td rowspan="2">
						<input type='text' name='entero2[]' value='' style="width: 30px;" placeholder="" class='entero maximo'>
					</td>
					<td>
						<input type='text' name='numerador2[]' value='' style="width: 30px;" placeholder="Num" class='numerador maximo'>
					</td>
				</tr>
				<tr>
					<td>
						<input type='text' name='denominador[]' value='' style="width: 30px;" placeholder="Den" class='denominador minimo'>
					</td>
					<td>
						<input type='text' name='denominador2[]' value='' style="width: 30px;" placeholder="Den" class='denominador maximo'>
					</td>
				</tr>
			</table>
		</div>
		<div class="span1">
			<input type='text' name='puntajeRespuesta[]' value='' class="positive  puntajeItem" style="width: 50px;">
		</div>
		<div class="span1">
			<input class='btn btn-danger' type='button' id='removeAlternative' value='eliminar'>
		</div>
	</div>
</div>


<div id="respuestaAjax"></div>

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

<script src="../js/blueimp/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="../js/blueimp/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="../js/blueimp/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="../js/blueimp/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="../js/blueimp/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="../js/blueimp/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="../js/blueimp/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="../js/blueimp/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="../js/blueimp/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="../js/blueimp/jquery.fileupload-validate.js"></script>

<script charset="UTF-8">
	class_activo('boton_actividadNew','activo');


	var seleccionFirst = $("#selectionFirst");
	var seleccion = $("#selection").find('.row');
	var respuestaAbiertaFirst = $("#openFirst").find('.row');
	var respuestaAbierta = $("#open").find('.row');
	var action = "guardarItem";


	var decodeHTML = function (s) {
		return $("<div/>").html(s).text();
	};

	$(document).ready(function(){
		jQuery.ajax({
			url: 'inc/funcionesItem.php',
			type: 'POST',
			dataType: 'json',
			data: {action:"getNiveles"},
			complete: function(xhr, textStatus) {
			//called when complete
			},
			success: function(data, textStatus, xhr) {
				$.each(data, function(k,v){
					$("#nivel").append("<option value='"+v.id+"'>"+unescape(encodeURIComponent(v.nombre))+"</option>");
				});

				getCapitulos();
			},
			error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
			}
		});

		jQuery.ajax({
			url: 'inc/funcionesItem.php',
			type: 'POST',
			dataType: 'json',
			data: {action:"getCompetencias"},
			complete: function(xhr, textStatus) {
			//called when complete
			},
			success: function(data, textStatus, xhr) {
				$.each(data, function(k,v){
					console.log(v);
					$("#competencia").append("<option value='"+v.id+"'>"+v.nombre+"</option>");
				});
			},
			error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
			}
		});

		getItems();

	});

	function getCapitulos(cb){
		jQuery.ajax({
			url: 'inc/funcionesItem.php',
			type: 'POST',
			dataType: 'json',
			data: {action:"getCapitulosByNivel",idNivel:$("#nivel").val()},
			complete: function(xhr, textStatus) {
			//called when complete
			},
			success: function(data, textStatus, xhr) {
				$('#capitulo').find('option').remove();
				$.each(data, function(k,v){
					$("#capitulo").append("<option value='"+v.id+"'>"+v.nombreSeccionBitacora+"</option>");
				});

				if (cb != undefined) {
					cb();
				} else {
					getApartados();
				}
			},
			error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
			}
		});
	}

	function getApartados(cb){
		jQuery.ajax({
			url: 'inc/funcionesItem.php',
			type: 'POST',
			dataType: 'json',
			data: {action:"getApartadosByCapitulo",idCapitulo:$("#capitulo").val()},
			complete: function(xhr, textStatus) {
			//called when complete
			},
			success: function(data, textStatus, xhr) {
				$('#apartado').find('option').remove();
				$.each(data, function(k,v){
					$("#apartado").append("<option value='"+v.id+"'>"+v.nombreSeccionBitacora+"</option>");
				});

				if (cb != undefined) {
					cb();
				}
			},
			error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
			}
		});

	}

	function getItems() {
		jQuery.ajax({
			url: 'inc/funcionesItem.php',
			type: 'POST',
			dataType: 'json',
			data: {action:"getAllByIdActividad",idActividad:$("#idActividad").val()},
			complete: function(xhr, textStatus) {
			},
			success: function(data, textStatus, xhr) {
				$("#tablaItems").html("<table class='table table-striped .table-bordered' id='tableItems'><tr><td>ID</td><td>Titulo</td><td>Estado</td><td style='width: 250px;'>Acciones</td><tr></table>");
				$.each(data, function(k,v){
					if (v != null) {
						$("#tableItems").append("<tr><td>"+v.id+"</td><td>"+decodeHTML(v.enunciadoItem)+"</td><td>"+v.estadoItem+"</td><td><a href='../series/verItem.php?idItem="+v.id+"' class='btn btn-primary' target='_blank'>Ver</a>   <input type='button' id='"+v.id+"' value='Editar Item' class='btn btn-success editItem'> <input type='button' class='btn btn-danger removeItem' id='"+v.id+"' value='Eliminar'> </td><tr>");
					}
				});
			},
			error: function(xhr, textStatus, errorThrown) {
			}
		});
	}

	$("#nivel").on("change", function() {
		getCapitulos();
	});

	$("#capitulo").on("change", function() {
		getApartados();
	});

	$("#addAlternativa").on("click", function() {

		if ($('#tipoRespuesta').val() == 'respuestaAbierta') {
			$('#alternativas').append(respuestaAbierta.clone());
			$(".positive").numeric({ negative: false });
		}

		if ($('#tipoRespuesta').val() == 'seleccionUnica') {
			$("#alternativas").append(seleccion.clone());
		}
	});

	$("div").on("click", "#removeAlternative", function() {
		$(this).closest(".row").remove();
		checkBox();
	});

	function checkBox(){
		if ($( "input:checked" ).length === 0) {
			$("#checkAlternativa").prop('checked', true);
		}
	}

	$("#alternativas").on("click", ".checkAlternativa", function() {
		removeAllChecked();
		$(this).prop('checked', true);
	});

	function removeAllChecked() {
		$(".checkAlternativa").removeAttr('checked');
	}

	$("#enviar").on("click", function() {
		var uploadIMG = $("#uploadButton");
		if (action == "edit") {
			if (uploadIMG.length == 0) {
        		sendForm();
			} else {
				$("#uploadButton").click();
			}
		} else {
			if (validateForm()) {
				if (uploadIMG.length == 0) {
					alert("debe subir un a imagen");
				} else {
					$("#uploadButton").click();
				}
			}
		}
	});


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

	var validateForm = function () {
		console.log("validando");

		if ($("#tipoRespuesta").val() == 'respuestaAbierta') {
			var puntajeTotal = 0;
			$("#alternativas").find(".puntajeItem").each(function(i, v){
				puntajeTotal += parseFloat($(v).val().replace(",", "."));
				console.log($(v).val());
			});
			$("#puntajeTotalItem").val(puntajeTotal);
			console.log("puntaje", puntajeTotal);
		}

		var notNull = [
			{name:"enunciado", msg: "el campo enunciado no puede ser nulo"},
			{name:"puntaje", msg: "el campo puntaje no puede ser nulo"}
		];

		var resultValidation = validateNotNull(notNull);

		if (action == "guardarItem") {
			var uploadIMG = $("#uploadButton");
			if (uploadIMG.length == 0) {
				resultValidation.error = true;
				resultValidation.msg += "Debe subir una imagen<br>";
			}
		}

		$.each($("#alternativas").find("input,textarea"), function (i, v) {
			if (!($(v).prop("id") == "alternativa[]" && $("#tipoRespuesta").val() == 'respuestaAbierta')) {
				if ($(v).css('display') != 'none' && $(v).val() == "") {
					resultValidation.error = true;
					resultValidation.msg += "Debe ingresar todos los datos de las respuestas, solo Indicación puede ser vacio en el caso de las preguntas abiertas";
					return false;
				}
			}
		});

		if (resultValidation.error) {
			$('#modalHeader').html("Por favor revise los siguiente errores:");
			$('#modalBody').html(resultValidation.msg);
			$('#modal').modal('show');
			return false;
		} else {
			return true;
		}
	};


	var sendForm = function () {
		console.log("enviando formulario");
		var i = 0;
		var correct = '';


		$("#alternativas").find(".row").each(function(i, v){
			var row = $(v);
			row.find("input").prop('disabled', false);
			if($(row.find("#checkAlternativa")[0]).is(":checked")){
				correct += "&correct[]="+i;
			}
			i++;
		});
		var data = $("#formItem").serialize();

		data += correct;
		$("#alternativas").find(".row").each(function(i, v){
			activaParametros($(v));
		});

		jQuery.ajax({
			url: 'inc/funcionesItem.php',
			type: 'POST',
			// dataType: 'json',
			data: data + "&action="+action,
			complete: function(xhr, textStatus) {
			},
			success: function(data, textStatus, xhr) {
				$("#respuestaAjax").html(data);
				alert("guardado correcto");
				location.href = $("#cancelar").attr('href');
				getItems();
			},
			error: function(xhr, textStatus, errorThrown) {
			}
		});
	};

	$("#tipoRespuesta").on("change", function() {
		changeTipoRespuesta();
	});

	var changeTipoRespuesta = function () {
		if ($("#tipoRespuesta").val() == 'respuestaAbierta') {

			$('#alternativas').html(respuestaAbiertaFirst);
			$('#esAbierto').val(1);
			$(".positive").numeric({ negative: false });
			$("#divPuntajeItem").hide();
		}

		if ($("#tipoRespuesta").val() == 'seleccionUnica') {
			$('#esAbierto').val(0);
			$("#divPuntajeItem").show();
			$('#alternativas').html(seleccionFirst);
		}
	}

	$(".positive").numeric({ negative: false });

	var activaParametrosMinMax = function (divContenedor) {
		var funcionEvaluadora = divContenedor.find("#funcionEvaluadora");
		if (funcionEvaluadora.val() == 'intervalo') {
			// divContenedor.find('.maximo').prop('disabled', false);
			divContenedor.find('.maximo').show();
		} else {
			// divContenedor.find('.maximo').prop('disabled', true);
			divContenedor.find('.maximo').hide();
		}
	};

	var activaParametros = function (divContenedor) {
		var tipoCampo = divContenedor.find('#tipoCampo');
		console.log(divContenedor.find('input[name=entero]')[0]);
		switch(tipoCampo.val()){
			case "fraccion":
				// divContenedor.find('.numerador').prop('disabled',false);
				// divContenedor.find('.denominador').prop('disabled',false);
				divContenedor.find('.numerador').show();
				divContenedor.find('.denominador').show();
				activaParametrosMinMax(divContenedor);
				// divContenedor.find('.entero').prop('disabled','disabled');
				divContenedor.find('.entero').hide();
			break;
			case "numerico":
				// divContenedor.find('.entero').prop('disabled',false);
				divContenedor.find('.entero').show();
				activaParametrosMinMax(divContenedor);
				divContenedor.find('.numerador').hide();
				divContenedor.find('.denominador').hide();
			break;
			case "normal":
				divContenedor.find('.entero').show();
				activaParametrosMinMax(divContenedor);
				divContenedor.find('.numerador').hide();
				divContenedor.find('.denominador').hide();
			break;
			case "numeroMixto":
				divContenedor.find('.entero').show();
				divContenedor.find('.numerador').show();
				divContenedor.find('.denominador').show();
				activaParametrosMinMax(divContenedor);
			break;
		}
	};

	$("#alternativas").on('change', "#tipoCampo", function() {
		var divContenedor = $(this).closest('.row');
		activaParametros(divContenedor);
	});

	$('#alternativas').on('change', "#funcionEvaluadora", function() {
		var divContenedor = $(this).closest('.row');
		activaParametros(divContenedor);
	});

	activaParametros($("#open"));
	activaParametros($($("#openFirst .row")[1]));

	$("#tablaItems").on("click", ".removeItem", function () {
		var r = confirm("Seguro que desea eliminar el item?");
		if (r == true) {
			console.log($(this).prop("id"));
			var data = "idItem="+$(this).prop("id");
			jQuery.ajax({
				url: 'inc/funcionesItem.php',
				type: 'POST',
				// dataType: 'json',
				data: data + "&action=removeItem",
				complete: function(xhr, textStatus) {
				},
				success: function(data, textStatus, xhr) {
					$("#respuestaAjax").html(data);
					getItems();
				},
				error: function(xhr, textStatus, errorThrown) {
				}
			});
		}
	});

	$("#tablaItems").on("click", ".editItem", function () {
		console.log($(this).prop("id"));
		var data = "idItem="+$(this).prop("id");
		jQuery.ajax({
			url: 'inc/funcionesItem.php',
			type: 'POST',
			dataType: 'json',
			data: data + "&action=getItem",
			complete: function(xhr, textStatus) {
			},
			success: function(data, textStatus, xhr) {
				console.log(data);
				action = "edit";
				if(data.esAbiertoItem == 1) {
					$("#tipoRespuesta").val('respuestaAbierta');
				} else {
					$("#tipoRespuesta").val('seleccionUnica');
				}
				changeTipoRespuesta();
				$("#respuestaAjax").html(data);
				console.log(decodeHTML(data.enunciadoItem));
				$('#nivel').val(data.nivel);
				getCapitulos(function () {
					$('#capitulo').val(data.idPadreSeccionBitacora);
					console.log("cargando apartados del capitulo: "+data.idPadreSeccionBitacora);
					getApartados(function () {
						$('#apartado').val(data.idSeccionBitacora);
					});
				});
				$('#id').val(data.id);
				$('#foto').val(data.fondoItem);
				$('textarea[name=enunciado]').val(decodeHTML(data.enunciadoItem));
				$('#tema').val(data.tema);
				$('#competencia').val(data.idCompetencia);
				$('#puntajeTotalItem').val(data.puntajeItem);
				$('#tituloForm').html("Editar Item: "+data.id);
				$('#imagenActual').html("<img width='150px' src='"+data.fondoItem+"'>");

				for (var i = 0; i < data.alternativas.length; i++) {
					if(data.esAbiertoItem == 1) {
						if (i != 0) {
							$("#addAlternativa").click();
						}
						var row = $($("#alternativas").find(".row")[i + 1]);
						row.find("#alternativa\\[\\]").val(decodeHTML(data.alternativas[i].nombreAlternativaItem));
						row.find("#tipoCampo").val(data.alternativas[i].tipoCampo);
						row.find("#funcionEvaluadora").val(data.alternativas[i].funcionEvaluadora);
						row.find(".puntajeItem").val(data.alternativas[i].puntaje);
						row.find(".entero.minimo").val(data.alternativas[i].entero);
						row.find(".entero.maximo").val(data.alternativas[i].entero2);
						row.find(".numerador.minimo").val(data.alternativas[i].numerador);
						row.find(".numerador.maximo").val(data.alternativas[i].numerador2);
						row.find(".denominador.minimo").val(data.alternativas[i].denominador);
						row.find(".denominador.maximo").val(data.alternativas[i].denominador2);
						var divContenedor = $(row).closest('.row');
						activaParametros(divContenedor);
					} else {
						if (i == 0) {
							$("#selectionFirst").find("textarea").val(decodeHTML(data.alternativas[i].nombreAlternativaItem));
						} else {
							$("#addAlternativa").click();
							var row = $($("#alternativas").find(".row")[i]);
							$(row).find("textarea").val(decodeHTML(data.alternativas[i].nombreAlternativaItem));
						}
					}
				};
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log(textStatus);
			}
		});
	});


</script>


<script>

$("#removeIMG").on("click", function () {
	$("#files").html("");
	$(".fileinput-button").show();
	$("#removeIMG-button").hide();
});

/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '../uploadImg.php',
        uploadButton = $('<button/>')
            .addClass('btn')
            .prop('disabled', true)
            .prop('id', 'uploadButton')
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    console.log(url);
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
    	$(".fileinput-button").hide();
    	$("#removeIMG-button").show();
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append(file.error);
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .hide()
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
    	console.log(data.result);
        $.each(data.result.files, function (index, file) {
            var link = $('<a>')
                .attr('target', '_blank')
                .prop('href', file.url);
            $(data.context.children()[index])
                .wrap(link);
            console.log(file);
            console.log(file.url);
            var filename = file.url.substring(file.url.lastIndexOf('/')+1);
            $("#foto").val(filename);
			console.log(filename);
        });
        sendForm();
    }).on('fileuploadfail', function (e, data) {
    	console.log(data);
        $.each(data.result.files, function (index, file) {
            var error = $('<span/>').text(file.error);
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>

