<?php 
ini_set("display_errors","on");
require("inc/incluidos.php");

$idCurso = $_SESSION["sesionIdCurso"];


$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$jornadas = getJornadasCurso($idCurso);



$idRecurso = $_REQUEST["idRecurso"];
$datosRecurso = getRecurso($idRecurso);



/* Registro de acceso a un recurso */
$idUsuario = $_SESSION["sesionIdUsuario"];
//registraAcceso($idUsuario, 9, $idRecurso);




$archivo = "subir/docs/".$datosRecurso["urlRecurso"];


$path_parts = pathinfo($archivo);

/* Directory Traversal Prevention */
$directory = $path_parts["dirname"];

$root = explode ( DIRECTORY_SEPARATOR, realpath ( dirname ( __FILE__ ) ) );

if (! is_dir ( $directory )) {
	die ( "Ubicación invalida." );
}

$request = explode ( DIRECTORY_SEPARATOR, realpath ( $directory ) );

empty ( $request [0] ) ? array_shift ( $request ) : $request;
empty ( $root [0] ) ? array_shift ( $root ) : $root;

if (count ( array_diff_assoc ( $root, $request ) ) > 0) {
	die ( "Ubicación invalida." );
} 

downloadFile($archivo);



?>


