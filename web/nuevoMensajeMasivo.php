<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"];
Conectarse_seg();


if(@$_REQUEST["idMensaje"] != ""){
	
	$respuesta = $_REQUEST["idMensaje"];
	$datosMensaje = getMensaje($_REQUEST["idMensaje"]);
	$datosDeUsuario = getNombreFotoUsuarioProfesor($datosMensaje["deMensaje"]);
	$idPara = $datosMensaje["deMensaje"];
	agregaLista($idPara);
	$datosProfesor = getDatosProfesor($idPara);
	$para = $datosProfesor["nombreProfesor"]." ".$datosProfesor["apellidoPaternoProfesor"]." ".$datosProfesor["apellidoMaternoProfesor"];
	$asunto = $datosMensaje["asuntoMensaje"];
	 
}

if(@$_REQUEST["idUsuarioDestino"] != ""){
	
	if($_REQUEST["idUsuarioDestino"] == 0){ //agregar a todos los usuarios
		//print_r($_SESSION["alumnosCurso"]);
		foreach ($_SESSION["alumnosCurso"] as $participante){
			$idPara = $participante["idUsuario"];
			$para = getNombreUsuario($idPara);
			agregaLista($idPara);
		}
		
	}else{ // agregar un usuario
		$idPara = $_REQUEST["idUsuarioDestino"];
		$para = getNombreUsuario($idPara);
		agregaLista($idPara);
		$respuesta = "NULL";
	
	}
	
	
}
?>

    <p>
        <br />
        <input type="hidden" name="para_id" class="campos" id="para_id" value="<?php echo @$idPara; ?>">
        <input type="hidden" name="respuesta" class="campos" id="respuesta" value="<?php echo @$respuesta; ?>">
        
        <!--<input type="button" onclick="javascript:participantes();" value="Grupos de contactos">-->
    </p>
    <?php 
    boton("Enviar","enviarMsj()");
    ?><br /><br />

    <p>
    	Para<br />
    </p>
        
    <div id="destinatarios"></div>
    
    Asunto
    <br />
    
    <input type="text" name="asunto" size="40" id="asunto" class="campos" 
    value="<?php 
    if(@$asunto != "") echo "Re: ".@$asunto; ?>"/>
    
    <br /> 
    <br />
    <textarea name="mensaje2" cols="40" rows="5" id="mensaje2" class="campos"></textarea>
    
    <br />
   
<script type="text/javascript">
	mostrarDestinatarios();
	
</script>