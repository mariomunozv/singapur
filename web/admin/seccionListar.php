<?php
ini_set("display_errors","on");
include("../inc/_seccion.php");
require("inc/config.php");
Conectarse();

$idFormulario = $_POST['formulario'];
$secciones = getSeccionesFormulario($idFormulario);

if($secciones != null)
{
	?><option value="NULL">Seleccione Sección</option><?php
	foreach ($secciones as $seccion)
	{?>
		<option value="<?php echo $seccion['idSeccionFormulario']; ?>"><?php echo $seccion['tituloSeccionFormulario']; ?></option>
	<?php
	}
}
else
{?>
	<option value="NULL">Sin Secciones</option>
<?php 
}
?>