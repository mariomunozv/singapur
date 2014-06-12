<?php
ini_set("display_errors","on");
session_start();
include "inc/conecta.php";
include "inc/_funciones.php";
include "inc/_comentario.php";
include "inc/_usuario.php";
include "inc/_profesor.php";
include "inc/_directivo.php";
include "inc/_empleadoKlein.php";
include "inc/_notificacion.php";
//include "sesion/sesion.php";

$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
Conectarse_seg();

$idActividad = $_REQUEST["idActividad"];
$tablaComentario = $_REQUEST["tablaComentario"];
$idReferenciaComentario = $_REQUEST["idReferenciaComentario"];
$contenidoComentario = $_REQUEST["contenidoComentario"];
$ape = @$_REQUEST["ape"];

$duenoPauta = $_REQUEST["idUsuarioNotificado"];

$resultado = guardaComentario($idUsuario, $tablaComentario, $idReferenciaComentario, $contenidoComentario);

if ($resultado == true)
{

	// Se genera la notificacion para el usuario 
	if ($idUsuario == $_REQUEST["idUsuarioNotificado"]){
		$idUsuarioNotificado = @$ape;
	}else{
		$idUsuarioNotificado = $_REQUEST["idUsuarioNotificado"];
	}
	
	$nombreComentador = getNombreUsuario($idUsuario);
	
	// texto = "Juanito Perez" con link a verPerfil 
	$textoNotificacion = '<a href="verPerfil.php?idUsuario='.$idUsuario.'">'.$nombreComentador.'</a>';
	$textoNotificacion = $textoNotificacion.' ha comentado tu(s) respuesta(s) a una Actividad.';
	
	switch ($_REQUEST["tablaComentario"]){
		
	case "pauta":
		$linkNotificacion = 'informeActividadResultado.php?idPauta='.$idReferenciaComentario.'&idUsuario='.$duenoPauta.'&idActividad='.$idActividad.'&idNotificacion=@';
	break;
	
	case "formulario":
		$linkNotificacion = 'informeActividadDetalleFormulario.php?idPauta='.$idReferenciaComentario.'&idUsuario='.$duenoPauta.'&idActividad='.$idActividad.'&idNotificacion=@';
	break;
	
	case "actividadPagina":
		// La referencia en las actividades 2012 corresponden al indice (variable $j) que permite avanzar entre páginas
		$linkNotificacion = 'actividades.php?idPauta='.$idReferenciaComentario.'&idUsuarioRevisado='.$duenoPauta.'&idActividad='.$idActividad.'&idNotificacion=@';
	break;
	
	
	
	}
		
	
	$idImagenNotificacion = $idUsuario;
	
	setNotificacion($idUsuarioNotificado, 3, $textoNotificacion, $linkNotificacion, $idImagenNotificacion);
	
	
	
?>

<script type="text/javascript">
listado_comentarios();
</script>


<?php
	

}
else{
	info("Ha ocurrido un error al enviar su comentario.");
}
?>




