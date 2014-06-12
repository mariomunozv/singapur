<?php
ini_set("display_errors","on");
require("inc/config.php");
include("../inc/_formulario.php");
include("../inc/_seccion.php");

?>
<script language="javascript">

function listarSecciones(){
	var division = document.getElementById("seccion");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("seccionListar.php",a,division);
} 

function creaSeccion()
{
	if(val_obligatorio("formulario") == false){ return; }
	if(val_obligatorio("seccion") == false){ return; }
	if(val_obligatorio("titulo") == false){ return; }
	var division = document.getElementById("resultado");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("seccionGuardar.php",a,division);
}
</script>


<table class="tablesorter">
	<tr>
		<th colspan="2">Crear Secciones</th>
	</tr>

	<tr>
		<td>Seleccionar Formulario: </td>
		<td align="left">
		<?php
		
		$formularios = getFormularios();
		print("<select name='formulario' id='formulario' class='campos' onchange='javascript:listarSecciones();'>");
		print("<option value=''>Seleccione Formulario</option>");
		foreach ($formularios as $formulario)
		{
			
			print("<option value='".$formulario['idFormulario']."'>".$formulario['nombreFormulario']."</option>");
		
		
		}
		print("</select>");
		?>
		</td>
	</tr>

	<tr>
		<td>Seleccionar Sección: </td>
		<td align="left">
		<select id="seccion" name="seccion" class="campos">
		<option value="">Sin Secciones</option>
		</select>
		</td>
	</tr>

	<tr>
		<td>Título de la seccion:</td>
		<td align="left"><input type="text" name="titulo" id="titulo" class="campos" size="50px"></td>
	</tr>

	<tr>
		<td>Descripción de la sección:</td>
		<td align="left"><input type="text" name="descripcion" id="descripcion" class="campos" size="50px"></td>
	</tr>

	<tr>
		<td colspan="2" align="right"><input type="button" name="btnGuardar" value="Guardar" onClick="javascript:creaSeccion()"></td>
	</tr>

</table>

<div id="resultado"></div>
