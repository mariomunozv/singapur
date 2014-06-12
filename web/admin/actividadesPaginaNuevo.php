<?php
require("inc/config.php");
$idActividad = $_REQUEST["idActividad"];
$idActividadPagina = $_REQUEST["idActividadPagina"];

function getActividadPaginaResumen($idActividadPagina)
{
	$sql = "SELECT *";
	$sql .= " FROM actividadPagina";
	$sql .= " WHERE idActividadPagina = ".$idActividadPagina;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
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

if(isset($idActividadPagina))
{
	$actividades = getActividadPaginaResumen($idActividadPagina);
}

?>



<script language="javascript">
function guarda_actividadPagina(){
	var division = document.getElementById("nuevo");
	var a =  $(".campos").fieldSerialize();
	AJAXPOST("actividadesPaginaGuardar.php",a,division);
} 

$("#cancelar").click(function () {
      $("#nuevo").hide("fast");
    });   

</script>


<table id="actPag" class="tablesorter">
<tr>
	<th colspan="2">Nueva P&aacute;gina</th>
</tr>
<tr>
	<td>idActividad</td>
    <td><input type="text" name="idActividad" id="idActividad" class="campos" readonly="readonly" value="<?php echo $idActividad ?>" required="required" size="100px">
</tr>
<?php
if(isset($idActividadPagina))
{ ?>
<tr>
	<td>idActividadPagina</td>
    <td><input type="text" name="idActividadPagina" id="idActividadPagina" class="campos" readonly="readonly" value="<?php echo $idActividadPagina ?>" required="required" size="100px">
</tr>
<?php }?>
<tr>
	<td>Nombre</td>
    <td><input type="text" name="titulo" id="titulo" class="campos"  value="<?php echo $actividades[0]["nombreActividadPagina"];?>" size="100px">
</tr>
<tr>
	<td>Tipo</td>
    <td><input type="text" name="tipoActividad" id="tipoActividad" class="campos" value="Contenido" size="100px">
</tr>
<tr>
	<td>Orden</td>
    <td><input type="text" name="ordenPagina" id="ordenPagina" class="campos" value="<?php echo $actividades[0]["ordenActividadPagina"];?>" size="100px"></td>
</tr>
<tr>
	<td colspan="2" align="center">
    	<?php
			if(isset($idActividadPagina))
			{ ?>
            <input type="button" name="enviar" id="enviar" value="Actualizar" onclick="guarda_actividadPagina()"/>				
            <input type="hidden" name="orden" id="orden" value="actualizar" class="campos" />
            <input type="hidden" name="idActividad" id="idActividad" value="<?php echo $idActividad ?> " class="campos"/>
            <input type="hidden" name="idActividadPagina" id="idActividadPagina" value="<?php echo $idActividadPagina ?> " class="campos"/>
			<?php 
			}else{ ?>
			<input type="button" name="enviar" id="enviar" value="Guardar" onclick="guarda_actividadPagina()"/>				
			<input type="hidden" name="orden" id="orden" value="guardar" class="campos"/>
			<?php }	?>
		<input type="button" name="cancelar" id="cancelar" value="Cancelar"/>
	</td>

</tr>

</table>