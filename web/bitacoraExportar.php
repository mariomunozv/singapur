<?php
ini_set("display_errors","on");
include("inc/_bitacora.php");
include("inc/_profesor.php");
include("inc/_seccionBitacora.php");
include("inc/_inscripcionCursoCapacitacion.php");
include("inc/conecta.php");
Conectarse_seg();
$bitacoras = getBitacorasParaExportar();
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=datos.xls");
?>
<meta charset="iso-8859-1">
<table border="1">
<tr>
<th>ID</th>
<th>RBD</th>
<th>Rut profesor</th>
<th>Nivel</th>
<th>Curso</th>
<th>Libro</th>
<th>Cap&iacute;tulo</th>
<th>Apartado</th>
<th>Horas implmentadas</th>
<th>Fecha inicio</th>
<th>Fecha t&eacute;rmino</th>
<th>Fecha ingreso de Bit&aacute;cora</th>
</tr>
<?php foreach($bitacoras as $bitacora){ 
$profesor = getDatosProfesor($bitacora['idUsuario']);
?>
<tr>
<td><?php echo $bitacora['idBitacora']; ?></td>
<td><?php echo $profesor['rbdColegio']; ?></td>
<td><?php echo $profesor['rutProfesor']; ?></td>
<td><?php echo getNivelUsuario($bitacora['idUsuario']);?></td>
<td><?php echo $bitacora['idCursoColegio'];?></td>
<td><?php echo getParteByCapitulo($bitacora['idSeccionBitacora']);?></td>
<td><?php echo getNombreCapitulo(getCapituloBySeccion($bitacora['idSeccionBitacora']));?></td>
<td><?php echo $bitacora['nombreSeccionBitacora'];?></td>
<td><?php echo $bitacora['tiempoBitacora'];?></td>
<td><?php echo $bitacora['fechaInicio'];?></td>
<td><?php echo $bitacora['fechaTermino'];?></td>
<td><?php echo $bitacora['fechaCreacionBitacora'];?></td>
</tr>
<?php } ?>
</table>