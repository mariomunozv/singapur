<?php
include "inc/conecta.php";
include("inc/_seccionBitacora.php");
Conectarse_seg();
$idCurso = $_REQUEST['idCurso'];
$partes = getPartesLibro($idCurso);
echo "<option value=''>Selecciona un Libro</option>";
foreach($partes as $parte)
{
	echo "<option value='".$parte["parteLibro"]."'>".$parte["parteLibro"]."</option>";
}
?>
