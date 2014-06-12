<?php
include("../inc/_detalleSeccionEnunciado.php");
require("inc/config.php");

$idSeccionFormulario = $_POST['seccion'];
$enunciados = $_POST['seleccionados'];
$cuentaErrores = 0;


foreach($enunciados as $enunciado)
{

	if(crearSeccionEnunciado($idSeccionFormulario,$enunciado)>0)
	{
		//nada
	}
	else
	{
		$cuentaErrores++;
	}
}

if($cuentaErrores == 0)
{
	?>
		<script language="javascript">
		   enunciadoListado(1);
		</script>
	<?php
}
else
{
	echo "ERROR";
}

?>
