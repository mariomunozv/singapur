<?php 
ini_set("display_errors","on");
require("../inc/_seccionBitacora.php");
require("../inc/conecta.php");
Conectarse_seg();
$idNivel = $_REQUEST['idNivel'];
$capitulos = getCapituloByNivel($idNivel);
echo "<option value=''>Seleccione un cap&iacute;tulo</option>";
foreach($capitulos as $capitulo)
{
	echo "<option value=".$capitulo["idSeccionBitacora"].">".$capitulo["nombreSeccionBitacora"]."</option>";
}


?>