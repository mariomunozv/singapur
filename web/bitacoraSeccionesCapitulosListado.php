<?php 
session_start();
include "inc/conecta.php";
include "inc/_bitacora.php";
include "inc/_usuario.php";
include "inc/_profesor.php";
include "sesion/sesion.php";
$idUsuario = $_REQUEST["idUsuario"];
$idCurso = $_REQUEST["idCurso"];
Conectarse_seg();
//$idPadre = $_REQUEST["idPadre"];
//$secciones = getSeccionesHijas($idPadre);
//print_r($secciones);
$hayBitacora = 0;
$bitacoras = getBitacorasUsuarioCurso($idUsuario,$idCurso);
//print_r($bitacoras);
$hayBitacora = count($bitacoras);
if($hayBitacora > 0){
?>
<table width="10%" border="0" align="center" class="tablesorter">
	<tr>
	    <th>Usuario que ingresó Bitácora</th>
        <th>Profesor</th>
	    <th>Capítulo</th>
        <th>Apartado</th>
        <th align="left">Horas de implementación</th>
        <th align="left">Fecha inicio</th>
        <th align="left">Fecha término</th>
        <th>Estado</th>
    </tr>
    <?php foreach($bitacoras as $bitacora){?>
    <tr>
		<td align="center" valign="top">
        	<?php echo getNombreUsuario($bitacora["usuarioIngresa"]);?>
        </td>
		<td align="center" valign="top">
        	<?php echo getNombreUsuario($bitacora["idUsuario"]);?>
        </td>
		<td align="center" valign="top">
        	<?php echo getNombreCapituloBitacora($bitacora["idSeccionBitacora"]);?>
        </td>
        <td align="center" valign="top">
        	<?php echo $bitacora["nombreBitacora"];?>
        </td>
		<td align="center" valign="top">
        	<?php echo $bitacora["tiempoBitacora"];?>
        </td>
		<td align="center" valign="top">
        	<?php echo $bitacora["fechaInicio"];?>
        </td>
		<td align="center" valign="top">
        	<?php echo $bitacora["fechaTermino"];?>
        </td>        
		<td align="center" valign="top">
        	<?php echo $bitacora["estadoBitacora"];?>
        </td>        
	<?php } ?>
    </tr>
</table>

<?php
}else{
	echo "No hay Bitacoras Ingresadas";
}

?>

