<script language="javascript">

function formularioListado(){
	var division = document.getElementById("listaFormularios");
	AJAXPOST("formularioListar.php","",division);
}

function formularioGuardar()
{
	if(val_obligatorio("nombreFormulario") == false){ return; }
	var division = document.getElementById("listaFormularios");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("formularioGuardar.php",a,division);
}

</script>

<table class="tablesorter">
	<tr>
		<th colspan="2">Crear un Formulario</th>
	</tr>
	<tr>
		<td>Nombre de Formulario</td>
		<td><input type="text" name="nombreFormulario"  id="nombreFormulario" class="campos" size="100px"></td>
	</tr>
	<tr>
		<td>Descripcion de Formulario</td>
		<td><input type="text" name="descripcionFormulario" id="descripcionFormulario" class="campos" size="100px"></td>
	</tr>
    <tr>
		<td>Pagina de la actividad</td>
		<td><input type="text" name="idActividadPagina"  id="idActividadPagina" class="campos" size="100px"></td>
	</tr>
	<tr>
		<td colspan="2" align="right"><input type="button" name="Enviar" id="Enviar" value="Enviar" onclick="javascript:formularioGuardar()"></td>
	</tr>
</table>

<div id="listaFormularios"></div>


<script language="javascript">
	formularioListado();
</script>