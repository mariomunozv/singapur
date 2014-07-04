<?php 

require("inc/config.php");

require("_head.php"); 
$menu = "pub"; 
require("_menu.php"); 
$navegacion = "Publicaciones*publicacion.php";
require("_navegacion.php");


?>

<script language="javascript">


function new_cursoCapacitacion(){
	var division = document.getElementById("publicacion_nuevo");
	AJAXPOST("publicacionNuevo.php","",division);
} 


class_activo('boton_publicacion','activo');

</script><p>
<span class="titulo_form">Publicaciones</span>

<br />
<br />

<a class="button" href="javascript:new_cursoCapacitacion();">
	<span>
		<?php echo "Nueva publicacion"; ?>
    </span>
</a>

<br />
<br />
<div id="publicacion_nuevo"></div>

