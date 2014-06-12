<?php 
$idUsuario = @$_SESSION["sesionIdUsuario"];
//$idPerfil = getIdPerfilUsuario($idUsuario);

if( (@$_SESSION["sesionNombreUsuario"] == "") ){
	alerta("Ud. a perdido su sesión o a ingresado de manera incorrecta a la Intranet.");
	@session_destroy();
	dirigirse_a("index.php");
}
?>