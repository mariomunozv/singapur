<?php
require("inc/config.php");

$idActividadPagina = $_REQUEST["idActividadPagina"];
$idContenidoPagina = $_REQUEST["idContenidoPagina"];

function getContenido()
{
	$sql = "SELECT * FROM tipoContenidoPagina";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
		$contenidos[$i] = array(
			"idTipoContenidoPagina" => $row["idTipoContenidoPagina"],
			"nombreTipoContenidoPagina" => $row["nombreTipoContenidoPagina"]);
			$i++;
	}
	return $contenidos;
}

function getContenidoResumen($idContenidoPagina)
{
	$sql = " SELECT * FROM contenidoPagina WHERE idContenidoPagina = ".$idContenidoPagina;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
	$contenidos[$i] = array(
		"idContenidoPagina" => $row["idContenidoPagina"],
		"idActividadPagina" => $row["idActividadPagina"],
		"idTipoContenidoPagina" => $row["idTipoContenidoPagina"],
		"textoContenidoPagina" => $row["textoContenidoPagina"],
		"ordenContenidoPagina" => $row["ordenContenidoPagina"]
	);
	$i++;
}
return ($contenidos);
}

$contenidos = getContenido();
$contPag = getContenidoResumen($idContenidoPagina);
?>

<script language="javascript">
function guarda_contenido(){
	var division = document.getElementById("nuevo");
	var a =  $(".campos").fieldSerialize();
	AJAXPOST("actividadesPaginaContenidoGuardar.php",a,division);
} 

$("#cancelar").click(function () {
      $("#nuevo").hide("fast");
    });  

</script>

<table class="tablesorter">
    <tr>
	    <th colspan="2">Nuevo Contenido P&aacute;gina</th>
    </tr>
    <tr>
        <td>idActividadPagina</td>
        <td><input type="text" name="idActividadPagina" id="idActividadPagina" class="campos" size="100px" readonly="readonly" value="<?php echo $idActividadPagina; ?>"/></td>
    </tr>
	<?php if(isset($idContenidoPagina)) { ?>
    <tr>
	    <td>idContenidoPagina</td>
    	<td><input type="text" name="idContenidoPagina" id="idContenidoPagina" class="campos" size="100px" readonly="readonly" value="<?php echo $idContenidoPagina?>"/></td>
    </tr>
    <?php 
	} 
	?>
    
    <tr>
	    <td>Tipo Contenido</td>
        <td><select name="tipoContenido" id="tipoContenido" class="campos"> 
        <?php foreach($contenidos as $contenido)
		{
			echo "<option value=".$contenido['idTipoContenidoPagina'].">".$contenido["nombreTipoContenidoPagina"]."</option>";
		}
		?>
        </td> 
        
    </tr> 
    <tr>
    	<td>Contenido</td> 
	    <td><textarea cols="100" rows="5" name="contenido" id="contenido" class="campos"><?php echo $contPag[0]["textoContenidoPagina"]; ?></textarea></td> 
    </tr> 
    <tr>
    	<td>Orden</td>
	    <td><input type="text" name="ordenContenido" id="ordenContenido" class="campos" size="100px" value="<?php echo $contPag[0]["ordenContenidoPagina"]; ?>"/></td>
    </tr>
    <tr>
    	<td colspan="2" align="center">
            <?php
                if(isset($idContenidoPagina))
                { ?>
                <input type="button" name="enviar" id="enviar" value="Actualizar" onclick="guarda_contenido()"/>				
                <input type="hidden" name="orden" id="orden" value="actualizar" class="campos" />
                <input type="hidden" name="idActividadPagina" id="idActividadPagina" value="<?php echo $idActividadPagina ?>" class="campos"/>
                <?php 
                }else{ ?>
                <input type="button" name="enviar" id="enviar" value="Guardar" onclick="guarda_contenido()"/>				
                <input type="hidden" name="orden" id="orden" value="guardar" class="campos"/>
                <?php }	?>
            <input type="button" name="cancelar" id="cancelar" value="Cancelar"/>
        </td>
    </tr>
</table>