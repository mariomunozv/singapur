<?php
ini_set("display_errors","ON");
require("inc/_formulario.php");
require("inc/incluidos.php");
//require("hd.php");

$formularios = getEncuestas();

?>
	<option value="">Seleccione un Formulario</option>
<?php foreach($formularios as $encuesta) {?>
	<option value="<?php echo $encuesta["idFormulario"];?>"><?php echo $encuesta["nombreFormulario"];?></option>
<?php } ?>
