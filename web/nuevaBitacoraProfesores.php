<?php
include "inc/conecta.php";
include("inc/_profesor.php");

Conectarse_seg();
$RBDColegio = $_REQUEST['RBDColegio'];
$profesores = getProfesoresColegio($RBDColegio);
print_r ($profesores);
echo "<option value=''>Selecciona un Profesor</option>";
if(count($profesores)>0){
	foreach($profesores as $profesor){
		echo "<option value=".$profesor['idUsuario'].">".$profesor['nombreProfesor']." ".$profesor['apellidoPaternoProfesor']."</option>";
	}
}


?>
