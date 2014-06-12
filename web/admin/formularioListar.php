<?php
ini_set("display_errors","on");
include("../inc/_formulario.php");
require("inc/config.php");

//$secciones = getSeccionesFormulario($idFormulario);
$formularios = getFormularios();
?>

<table class="tablesorter">
<tr>
<th>ID</th>
<th>Formularios</th>
<th>Página</th>
</tr>

<?php
if(count($formularios) > 0)
{
	foreach ($formularios as $formulario)
	{
		print("<tr>");
		print("<td>".$formulario['idFormulario']."</td>");
		print("<td>".$formulario['nombreFormulario']."</td>");
		print("<td>".$formulario['idActividadPagina']."</td>");
		print("</tr>");
	}
}
else
{
	echo "No existen fornularios";
}
?>

</table>
</body>
</html>

