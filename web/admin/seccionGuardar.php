<?php 

include("../inc/_seccion.php");
require("inc/config.php");


$idFomulario = $_POST['formulario'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];

if($descripcion == "")
{
	$descripcion = "NULL";
}



if(isset($_POST['seccion']))
{
	$idPadre = $_POST['seccion'];
}
else
{
	$idPadre = "NULL";
}




if(crearSeccion($idFomulario,$idPadre,$titulo,$descripcion)>0)
{
	?>
	<script language="javascript">
		listarSecciones();
	</script>
	<?php
}
else
{	
	echo "<br>ERROR<br>";
	echo "ID Formulario: ".$idFomulario."<br>";
	echo "Titulo de Seccion: ".$titulo."<br>";
	echo "Descripción: ".$descripcion."<br>";
}

?>
