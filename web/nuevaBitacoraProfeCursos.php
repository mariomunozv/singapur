<?php
include "inc/conecta.php";
include("inc/_cursoColegio.php");
Conectarse_seg();
$idUsuario = $_REQUEST['idUsuario'];
$cursos = getCursosUsuarioBitacora($idUsuario);
echo "<option value=''>Selecciona un Curso</option>";
if(count($cursos)>0){
	foreach($cursos as $curso){
		echo "<option value='".$curso["idNivel"].$curso["letraCursoColegio"]."'>".$curso["cursoColegio"]."</option>";
	}
}else{
		echo "<option value=''>No tiene cursos</option>";
}


?>
