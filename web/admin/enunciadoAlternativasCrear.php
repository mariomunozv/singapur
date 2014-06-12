<?php
ini_set("display_errors","on");
include("../inc/_formulario.php");
require("inc/config.php");
Conectarse();
?>


<script language="javascript">

function listarEnunciadosCerrados(){
	var division = document.getElementById("listaEnunciados");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("enunciadosCerradosListar.php",a,division);
} 

function asociar()
{
	var division = document.getElementById("listaEnunciados");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("alternativasGuardar.php",a,division);
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
		print("<select name='formulario' id='formulario' class='campos' onchange='javascript:listarEnunciadosCerrados();'>");
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
<td>Tipo de Alternativas</td>
<td align="left"><select id="tipoAlternativa" name="tipoAlternativa" class="campos">
<option value="">Seleccione un tipo de Alternativa</option>
<option value="1">Escala de 1 a 4</option>
<option value="2">De mal a muy bien</option>
<option value="3">Escala de N/A a 3</option>
<option value="6">Si - No</option>
<option value="4">N/A - SI - NO</option>
<option value="5">De Semanal a Anual + Nunca</option>
<option value="7">De Diario a Anual + Nunca</option>
<option value="8">Menos de un año a 5 años</option>
<option value="9">Casi todos los dias a nunca</option>
<option value="10">Puedo hacerlo muy bien a no se lo que significa</option>
<option value="11">Director, UTP, Coordinador, Docente, Mo se realiza</option>
<option value="12">Corresponde, No corresponde</option>
<option value="13">Tipo de problema segun accion</option>
<option value="14">Tipo de problema segun enunciado</option>
<option value="15">Tipo de problema porcentaje</option>


</select></td> 
</tr>
<!--<tr>
<td>Listar Enunciados</td>
<td align="left"><select name="enunciados" id="enunciados" class="campos" onChange="javascript:enunciadoListado()">
<option value="">Seleccionar</option>
<option value="1">No Relacionados</option>
<option value="2">Relacionados</option>
<option value="3">Todos</option>
</select></td>
</tr>--> 
<tr>
<td colspan="2"><input type="button" value="Asociar" onClick="javascript:asociar()"></td>
</tr>
</table>


<div id="listaEnunciados"></div>
