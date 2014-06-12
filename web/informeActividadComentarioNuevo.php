<?php
ini_set("display_errors","on");
require("inc/incluidos.php");
//include "inc/_funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"];


$idReferenciaComentario = $_REQUEST["idReferenciaComentario"];		  
$tablaComentario = $_REQUEST["tablaComentario"];
$idActividad = $_REQUEST["idActividad"];



?>
<script type="text/javascript">

function enviarComentario(){
	
	if(val_obligatorio("contenidoComentario") == false){ return; } 
	if(confirm("¿Enviar ahora?")){
		var a = jQuery(".campos").fieldSerialize(); 
		var division = document.getElementById("comentario");
		AJAXPOST("informeActividadComentarioGuarda.php",a,division);  
	}
}


function ismaxlength(obj){
var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
if (obj.getAttribute && obj.value.length>mlength)
obj.value=obj.value.substring(0,mlength)
}

</script>
 

	<input type="hidden" name="tablaComentario" class="campos" id="tablaComentario" value="<?php echo $tablaComentario; ?>">
    <input type="hidden" name="idReferenciaComentario" class="campos" id="idReferenciaComentario" value="<?php echo @$idReferenciaComentario; ?>">
    <input type="hidden" name="idUsuarioNotificado" class="campos" id="idUsuarioNotificado" value="<?php echo $_REQUEST["idUsuarioNotificado"]; ?>">
    <input type="hidden" name="idActividad" class="campos" id="idActividad" value="<?php echo $idActividad; ?>">
    
    <textarea title="Máximo 600 caracteres" maxlength="600" name="contenidoComentario" cols="69" rows="10" id="contenidoComentario" class="campos" onkeyup="return ismaxlength(this)"></textarea>
	<br />
    <br />
	<p align="center">
	<?php
	boton("Enviar Comentario","enviarComentario();");
	?>
    </p>


	