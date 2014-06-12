<?php
ini_set("display_errors","ON");
require("inc/incluidos.php");
require("hd.php");
?>

<script language="javascript">
function listaMonitores(){
	var division = document.getElementById("monitores");
	var a = $(".campos").fieldSerialize();
	AJAXPOST("monitores.php",a,division);
}

function listaFormularios(){
	var division = document.getElementById("formulario");
	AJAXPOST("monitorEncuestaFormulariosListado.php","",division);
}

</script>
<style>
.style4 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 28px;
	color: #000033;
	font-weight: bold;
}

p{
	font-size:14px;
}

.txt{ font-size:14pt; font-family:Arial, Helvetica, sans-serif;  text-align:justify; }
</style>


<div align="center">
<table width="923" border="10" align="center" cellpadding="0" cellspacing="0" bordercolor="#004600">
	<tr>
    <td width="901" align="center" valign="top"><div align="center">
		<table width="901" border="5" cellpadding="0" cellspacing="0">	
			<tr>
				<td width="981" align="left" valign="top"><span class="style1"><img src="img/header.jpg" width="950" height="170"> </span></td>
			</tr>
		<tr>
		 <td align="center" valign="top" bgcolor="#FFFFFF"><table border="0" cellpadding="2" cellspacing="6" bgcolor="#FFFFFF">
		<td colspan="2"><p class="style4">Monitor de Cuestionarios<p></td>
	</tr>
    <!-- <tr>
		<td><p>Seleccione la comuna que desea consultar: </p></td>
		<td>
			<select name="comuna" id="comuna" class="campos" onchange="listaFormularios()">
				<option value="">Seleccione Comuna</option>
				<option value="06104">Coltauco</option>
				<option value="06105">Doñihue</option>
				<option value="06101">Rancagua</option>
				<option value="13128">Renca</option>
			</select> 
		</td>
	</tr>-->
	<tr>
    	<td><p>Seleccione el formulario que desea monitorear: </p></td>
		<td>
			<select name="formulario" id="formulario" class="campos" onChange="javascript:listaMonitores()">
				<option value="">Seleccione Formulario</option>
			</select> 
		</td>
	<tr>
</table>
<hr  color="#004400"/>
<div id="monitores"></div>
</div>


<script language="javascript">
listaFormularios();
</script>







