<?php
ini_set("display_errors","on");
include("../inc/_formulario.php");
require("inc/config.php");
Conectarse();
?>


<script language="javascript">

function listarSecciones(){
	var division = document.getElementById("seccion");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("seccionListar.php",a,division);
} 

function asociar()
{
	if(val_obligatorio("seccion") == false){ return; }
	var division = document.getElementById("listaEnunciados");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("enunciadoSeccionGuardar.php",a,division);
}

function enunciadoListado()
{
	var division = document.getElementById("listaEnunciados");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("enunciadosListar.php",a,division);
}

</script>


<body>
<table class="tablesorter">
<tr>
<th colspan="2">Relacionar Enunciandos con Secciones</th>
</tr>
<tr>
<td>Seleccione Fromulario </td>
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
<td>Seleccione Sección</td>
<td align="left"><select id="seccion" name="seccion" class="campos">
<option value="">Sin Secciones</option>
</select></td>
</tr>
<tr>
<td>Listar Enunciados</td>
<td align="left"><select name="enunciados" id="enunciados" class="campos" onChange="javascript:enunciadoListado()">
<option value="">Seleccionar</option>
<option value="1">No Relacionados</option>
<option value="2">Relacionados</option>
<option value="3">Todos</option>
</select></td>
</tr>
<tr>
<td colspan="2"><input type="button" value="Asociar" onClick="javascript:asociar()"></td>
</tr>
</table>


<div id="listaEnunciados"></div>
