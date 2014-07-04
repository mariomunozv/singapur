<?php
ini_set("display_errors","on");
include("../inc/_formulario.php");
require("inc/config.php");

$nombre = $_POST['nombreFormulario'];
$descripcion = $_POST['descripcionFormulario'];

if (isset($_POST['idActividadPagina']))
{ 
	$idActividadPagina = $_POST['idActividadPagina'];
}else{
	$idActividadPagina	= "NULL";
}



if(crearformulario($idActividadPagina,$nombre,$descripcion,1)>0)
{
	?>
	<script language="javascript">
		formularioListado();
	</script>
	<?php
}
else
{
	echo "ERROR";
}


?>
