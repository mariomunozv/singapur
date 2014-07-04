<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
Conectarse_seg();

$tablaComentario = "mensajeTema";
$idMensaje = $_REQUEST["idMensaje"];
$contenidoComentario = $_REQUEST["contenidoComentario"];
$idTema = $_REQUEST["idTema"];


function guardaComentarioForo($idUsuario, $tablaComentario, $idReferenciaComentario, $textoComentario){
	$sql = "INSERT INTO comentario ( idUsuario , tablaComentario , idReferenciaComentario , textoComentario  , estadoComentario)";
	$sql.= "VALUES (";
	$sql.= "'$idUsuario', '$tablaComentario', '$idReferenciaComentario', '$textoComentario', 0);";
	$result = mysql_query($sql);
	//echo $sql;
	if (!$result) {
		// No se ejecuto correctamente el sql
		return false;
	}
	else
		return true;
	
}


$resultado = guardaComentarioForo($idUsuario, $tablaComentario, $idMensaje, $contenidoComentario);

if ($resultado == true)
{
	/* Registra Participación en un Foro */
	registraAcceso($idUsuario, 12, $idTema);
	
	info("Su comentario se ha enviado correctamente.");
	
	/* Se genera la notificacion para el usuario */
	$datosMsje = getDatosMensajeTema($idMensaje);
	$idUsuarioNotificado = $datosMsje["idUsuario"];
	$nombreComentador = getNombreUsuario($idUsuario);
	
	// texto = "Juanito Perez" con link a verPerfil 
	$textoNotificacion = '<a href="verPerfil.php?idUsuario='.$idUsuario.'">'.$nombreComentador.'</a>';
	$textoNotificacion = $textoNotificacion.' ha comentado tu respuesta en el foro.';
	$linkNotificacion = 'temaDetalle.php?idForo='.$idTema.'&amp;flag=1&idNotificacion=@#mensaje_'.$idMensaje;
	$idImagenNotificacion = $idUsuario;
	
	setNotificacion($idUsuarioNotificado, 2, $textoNotificacion, $linkNotificacion, $idImagenNotificacion);
	
	dirigirse_despues("temaDetalle.php?idForo=".$idTema."&flag=1",1000);
}
else{
	info("Ha ocurrido un error al enviar su comentario.");
}
?>




