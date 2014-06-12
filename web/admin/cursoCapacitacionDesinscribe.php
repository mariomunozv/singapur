<?php 
 require("inc/config.php"); 

include("../inc/_usuario.php");
include("../inc/_profesor.php");
include("../inc/_directivo.php");
include("../inc/_empleadoKlein.php");
include("../inc/_inscripcionCursoCapacitacion.php");
include("../inc/_funciones.php");



$sel = $_REQUEST["sel2"];
$idCurso = $_REQUEST["curso"];
$idPerfil = $_REQUEST["perfil"];
$idProyecto = 1;



foreach ($sel as $usuario){
	desinscribirUsuarioCursoCapacitacion( $usuario, $idCurso);
	//echo $usuario." ".$idCurso." ".$idPerfil."<br>";
	}

?>