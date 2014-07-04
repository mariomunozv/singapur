<?php
require("inc/config.php");
$idActividad = $_REQUEST["idActividad"];

function getActividadResumen($idActividad)
{
	$sql = "SELECT *";
	$sql .= " FROM actividad";
	$sql .= " WHERE idActividad = ".$idActividad;
	//echo $sql;
	$res = mysql_query($sql);
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

$actividades = getActividadResumen($idActividad);


?>

<script>
$("a").click(function () {
	  $("#nuevo").hide("fast");
      $("#paginas").hide("fast");
    });  
</script>

<table class="tablesorter">
<tr>
<th>ID</th>
<th>Nombre Actividad</th>
</tr>
<?php

foreach($actividades as $actividad)
{
	echo "<tr>";
	echo "<td>".$actividad["idActividad"]."</td>";
	echo "<td>".$actividad["tituloActividad"]."</td>";
	echo "</tr><tr>";
	echo "<td colspan='2'><a href='actividades.php'>Volver</a></td>";
	echo "</tr>";
}
?>
</table>
