<?php
ini_set("display_errors","on");
require("inc/incluidos.php"); 
require("inc/_bitacora.php"); 
include "inc/_cursoColegio.php";
require ("hd.php");

$idUsuario = $_REQUEST["idUsuario"];
$idCurso = $_SESSION["sesionIdCurso"];

function getNombreSeccion($idSeccionBitacora){
	$sql = "SELECT nombreSeccionBitacora FROM seccionBitacora  WHERE idSeccionBitacora = ".$idSeccionBitacora;
	//echo $sql;
	$res = mysql_query($sql);
   	$row = mysql_fetch_array($res);	
	return $row["nombreSeccionBitacora"];
}
//print_r($_SESSION);
$nombreUsuario = getNombreUsuario($idUsuario);
$cursos = getCursosUsuarioBitacora($idUsuario);
//print_r($cursos);
?>
<style>
.puntos{
	border-bottom: 2px dotted black;

}
</style>
<script>
$(function() {
	$( "#hi" ).tooltip({
		show: {
		effect: "slideDown",
		delay: 250
		}
	});
	
	$( "#hp" ).tooltip({
		show: {
		effect: "slideDown",
		delay: 250
		}
	});
});
</script>
<body>
<div id="principal">
<?php 
require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($idCurso);
$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$idCurso.",Informe Bitacoras*#";
require("_navegacion.php");
?>
	
<div id="lateralIzq">
	<?php require("menuleft.php"); ?>
</div>
    
<div id="lateralDer">
	<?php require("menuright.php"); ?>
<br />
</div>
<div id="columnaCentro">
<?php
foreach($cursos as $curso)
{
	$bitacoras = getBitacoraUsuarioCurso($idUsuario,$curso["idCursoColegio"]); 
?>
<table class="tablesorter" id="tabla2">
<thead>     
	<tr>
    	<th colspan="7">Profesor: <?php echo $nombreUsuario;?> - <?php echo $curso["cursoColegio"]; ?></th>
	</tr>    
  	<tr>
  		<th align="center">Capitulo</th>
  		<th align="center">Apartado </th>
  		<th align="center" title="Horas Implementadas" id="hi"><p class="puntos">H.I*</p></th>
  		<th align="center" title="Horas Propuestas" id="hp"><p class="puntos">H.P*</p></th>
  		<th align="center">Fecha inicio implementación</th>
  		<th align="center">Fecha término implementación</th>
  		<th align="center">Fecha Declaracion</th>
	</tr>
</thead>
<tbody>

<?php 
	if ($bitacoras){
		foreach ($bitacoras as $bit){  
	?>
		<tr>
			<td title="Nombre Capítulo" align="center"><?php echo getNombreSeccion($bit["idPadreSeccionBitacora"]);?></td>
			<td title="Nombre Apartado" align="center"><?php echo $bit["nombreSeccionBitacora"];?></td>
			<td align="center"><?php echo $bit["tiempoBitacora"];//echo cambiaf_a_normal($bit["fechaBitacora"]);?></td>
            <td align="center"><?php echo $bit["tiempoEstimadoSeccionBitacora"]?></td>
			<td align="center" ><?php echo $bit["fechaInicio"];?></td>
			<td align="center"><?php echo $bit["fechaTermino"];?></td>
			<td align="center"><?php echo $bit["fechaCreacionBitacora"];?></td>
		</tr>
	<?php 	}
	}else{ 
		echo "<tr><td colspan='13'>No existen bitacoras para este profesor</td></tr>"; 
	} // Fin if ($bitacoras){
} //Fin foreach($cursos as $cursos)
?>
</tbody> 
</table>
<div align="right">
	<?php boton("Volver","history.back();");?>
</div>
</div><!--columnaCentro-->
<?php 
	require("pie.php");
?>      
</div><!--principal-->
</body>
</html>
