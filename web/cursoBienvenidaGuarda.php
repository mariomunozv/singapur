<?php 

require("admin/inc/config.php");
include "inc/_cursoCapacitacion.php";
include "inc/_funciones.php";


$idCursoCapacitacion = $_REQUEST["idCursoCapacitacion"];
$descripcionCursoCapacitacion = $_REQUEST["descripcionCursoCapacitacion"];


$res = actualizaBienvenidaCurso($idCursoCapacitacion, $descripcionCursoCapacitacion);

if ($res){
	echo '<p class="textoBienvenida">'.nl2br($descripcionCursoCapacitacion).'</p>';
}
//dirigirse_a("curso.php?idCurso=".$idCursoCapacitacion);

?>