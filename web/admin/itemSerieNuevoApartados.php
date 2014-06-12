<?php 
ini_set("display_errors","on");
require("../inc/_seccionBitacora.php");
require("../inc/conecta.php");
Conectarse_seg();
$idSeccion = $_REQUEST['idSeccion'];
$apartados = getSeccionBitacoraCapitulo($idSeccion);
echo "<option value=''>Seleccione un apartado</option>";
foreach($apartados as $apartado)
{
	echo "<option value=".$apartado["idSeccionBitacora"].">".$apartado["nombreSeccionBitacora"]."</option>";
}


?>