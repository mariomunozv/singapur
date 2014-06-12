<?php
ini_set("display_errors","on");
require("inc/config.php");
include "../inc/_funciones.php";


function getActividades()
{
$sql = "SELECT *";
$sql .= " FROM actividad a";
//$sql .= " FROM actividad a, actividadPagina ap";
//$sql .= " WHERE a.idActividad = ap.idActividad ";
//$sql .= " Group By(a.idActividad)";
//echo $sql;
$res = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($res))
{
	$actividades[$i] = array(
	"idActividad" => $row["idActividad"],
	"tituloActividad" => $row["tituloActividad"],
	"estadoActividad" => $row["estadoActividad"],
	"bienvenidaActividad" => $row["bienvenidaActividad"],
	"linkActividad" => $row["linkActividad"],
	"limiteVecesActividad" => $row["limiteVecesActividad"]
	);
	$i++;
}
return ($actividades);
}

$actividades = getActividades();	

boton("Nueva actividad", "new_actividad();");
?>

<table class="tableSorter" id="tblAc">
	<tr>
		<th>ID</th>
		<th>Título</th>
		<th>Estado</th>
		<th>Editar</th>
		<th>Detalle</th>
	</tr>
<?php 
foreach($actividades as $actividad)
	{
	?>
	<tr class="row">
		<td><?php echo $actividad["idActividad"]; ?></td>
		<td><?php echo $actividad["tituloActividad"]; ?></td>
		<td><?php echo $actividad["estadoActividad"];?></td>
		<td><a href="javascript:edit_actividad(<?php echo $actividad["idActividad"] ?>)">Editar</a></td>
		<td><a id="detalle" href="javascript:detalle_actividad(<?php echo $actividad["idActividad"] ?>)">Ver Detalle</a></td>
	</tr>
	<?php } ?> <!-- //fin foreach -->
</table>
	