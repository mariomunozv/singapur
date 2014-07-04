<?php
require("inc/config.php");


function guardarCurso($rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio, $rutProfesor,$estadoCursoColegio){
	$sql_ = "INSERT INTO `cursoColegio` ( `rbdColegio` , `idNivel` , `anoCursoColegio` , `letraCursoColegio` , `rutProfesor` , `estadoCursoColegio` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rbdColegio', '$idNivel', '$anoCursoColegio', '$letraCursoColegio', '$rutProfesor','$estadoCursoColegio'  ";
    $sql_.=")";
	$res = mysql_query($sql_);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "bien";
		}
}


$rbdColegio = $_POST["rbdColegio"];
$idNivel = $_POST["idNivel"];
$anoCursoColegio = $_POST["anoCursoColegio"];
$letraCursoColegio = $_POST["letraCursoColegio"];
$rutProfesor = $_POST["rutProfesor"];
$estadoCursoColegio = $_POST["estadoCursoColegio"];


guardarCurso($rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio, $rutProfesor,$estadoCursoColegio);
	
?>
    
 <script language="javascript">

	mostrar_cursosEscuela();
	
</script>   