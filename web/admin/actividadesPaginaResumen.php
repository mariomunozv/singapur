<?php
require("inc/config.php");

$idActividadPagina = $_REQUEST["idActividadPagina"];

function getActividadPaginaResumen($idActividadPagina)
{
	$sql = "SELECT *";
	$sql .= " FROM actividadPagina";
	$sql .= " WHERE idActividadPagina = ".$idActividadPagina;
	//echo $sql;
	$res = mysql_query($sql);
	while($row = mysql_fetch_array($res))
{
	$actividades[$i] = array(
	"idActividadPagina" => $row["idActividadPagina"],
	"idActividad" => $row["idActividad"],
	"nombreActividadPagina" => $row["nombreActividadPagina"],
	"tipoActividadPagina" => $row["tipoActividadPagina"],
	"ordenActividadPagina" => $row["ordenActividadPagina"]
	);
	$i++;
}
return ($actividades);

}

$actividades = getActividadPaginaResumen($idActividadPagina);


?>

<script>
$("a").click(function () {
	  $("#nuevo").hide("fast");
      $("#paginas").hide("fast");
    });  
</script>

<table class="tablesorter">
<tr>
<th>ID Página</th>
<th>Nombre Actividad Página</th>
</tr>
<?php

foreach($actividades as $actividad)
{
	echo "<tr>";
	echo "<td>".$actividad["idActividadPagina"]."</td>";
	echo "<td>".$actividad["nombreActividadPagina"]."</td>";
	echo "</tr><tr>";
	echo "<td colspan='2'><a href='javascript:detalle_actividad(".$actividad['idActividad'].")'>Volver</a></td>"; //ejecutar funciones de carga de listas
	echo "</tr>";
}
?>
</table>
