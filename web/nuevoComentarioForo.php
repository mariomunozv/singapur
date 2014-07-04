<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
$idReferenciaComentario = $_REQUEST["idMensaje"];


Conectarse_seg();


?>
<script type="text/javascript">
function ismaxlength(obj){
var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
if (obj.getAttribute && obj.value.length>mlength)
obj.value=obj.value.substring(0,mlength)
}
</script>
 
	
    <input type="hidden" name="idMensaje" class="campos" id="idMensaje" value="<?php echo @$idReferenciaComentario; ?>">
    <textarea maxlength="1000" name="contenidoComentario" cols="52" rows="2" id="contenidoComentario" class="campos" onkeyup="return ismaxlength(this)"></textarea>
	<br />
	<p align="right">
	<?php
	boton("Enviar","enviarComentario(".@$idReferenciaComentario.")");
	?>
    </p>


	