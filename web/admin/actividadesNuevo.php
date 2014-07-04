<?php
require("inc/config.php");

$idActividad = $_REQUEST["idActividad"];




function getActividadResumen($idActividad)
{
	$sql = "SELECT *";
	$sql .= " FROM actividad";
	$sql .= " WHERE idActividad = ".$idActividad;
	echo $sql;
	$res = mysql_query($sql);
	$i = 0;
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

if(isset($idActividad))
{
	$actividades = getActividadResumen($idActividad);
}


?>

<script language="javascript">
function guarda_actividad(){
	var division = document.getElementById("nuevo");
	var a =  $(".campos").fieldSerialize();
	AJAXPOST("actividadesGuardar.php",a,division);
} 

$("#cancelar").click(function () {
      $("#nuevo").hide("fast");
    });   


</script>

<table class="tablesorter">
<tr>
	<th colspan="2">Nueva Actividad</th>
</tr>
<tr>
	<td>Título de la actividad</td>
	<td><input type="text" name="titulo" id="titulo" class="campos" value="<?php echo $actividades[0]["tituloActividad"] ?>" size="100px"/></td>
</tr>
<tr>
	<td>Bienvenida a la Actividad</td>
	<td><textarea name="bienvenida" id="bienvenida" class="campos" cols="75" rows="15"><?php echo $actividades[0]["bienvenidaActividad"] ?></textarea></td>
</tr>
<tr>
	<td>link de la actividad</td>
    <td><input type="text" name="link" id="link" value="actividadesPagina.php" class="campos" size="100px"/></td>
</tr>
<tr>
	<td>limite</td>
    <td><input type="text" name="limite" id="limite" class="campos" size="100px" value="0"/></td>
</tr>
<tr>
	<td colspan="2" align="center">
    	<?php
			if(isset($idActividad))
			{ ?>
            <input type="button" name="enviar" id="enviar" value="Actualizar" onclick="guarda_actividad()"/>				
            <input type="hidden" name="orden" id="orden" value="actualizar" class="campos" />
            <input type="hidden" name="idActividad" id="idActividad" value="<?php echo $idActividad ?> " class="campos"/>
			<?php 
			}else{ ?>
			<input type="button" name="enviar" id="enviar" value="Guardar" onclick="guarda_actividad()"/>				
			<input type="hidden" name="orden" id="orden" value="guardar" class="campos"/>
			<?php }	?>
		<input type="button" name="cancelar" id="cancelar" value="Cancelar"/>
	</td>

</tr>

</table>