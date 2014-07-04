<?php
require("inc/config.php");
function asignaPerfilProyectoProfesor($idUsuario, $idPerfil, $idProyectoKlein){
	$sql_ = "INSERT INTO `detalleUsuarioProyectoPerfil` ( `idUsuario` , `idPerfil` , `idProyectoKlein` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$idUsuario','$idPerfil', '$idProyectoKlein'  ";
    $sql_.=" )";
	$res = mysql_query($sql_);
	//echo $sql_;
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha asignado el perfil Profesor al usuario ".$idUsuario;
		}
}

function guardarProfesor($rutProfesor,  $rbdColegio, $nombreProfesor, $apellidoPaternoProfesor, $apellidoMaternoProfesor, $sexoProfesor, $fechaNacimientoProfesor, $estadoProfesor){
	$sql_ = "INSERT INTO `profesor` ( `rutProfesor` , `rbdColegio` , `idTipoProfesor` , `nombreProfesor` , `apellidoPaternoProfesor` , `apellidoMaternoProfesor` , `sexoProfesor` ,`fechaNacimientoProfesor` ,`estadoProfesor` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutProfesor', '$rbdColegio', 2, '$nombreProfesor', '$apellidoPaternoProfesor', '$apellidoMaternoProfesor','$sexoProfesor' ,'$fechaNacimientoProfesor' ,'$estadoProfesor'  ";
    $sql_.=")";
	$res = mysql_query($sql_);
	//echo $sql_;
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el Profesor ".$nombreProfesor." ".$apellidoPaternoProfesor," con el rut ".$rutProfesor;
		}
}
function insertaUsuarioProfesor($rutProfesor, $emailUsuario, $loginUsuario, $passwordUsuario, $estadoUsuario, $tipoUsuario){
	$sql_ = "INSERT INTO `usuario` ( `rutProfesor` , `emailUsuario` , `loginUsuario` , `passwordUsuario` , `estadoUsuario` , `tipoUsuario` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutProfesor', '$emailUsuario', '$loginUsuario', '$passwordUsuario', '$estadoUsuario','$tipoUsuario'  ";
    $sql_.=")";
	$res = mysql_query($sql_);
	//echo $sql_;
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado el usuario ".$loginUsuario." con el rut ".$rutProfesor;
		$last_id = mysql_insert_id();
	
		}
	return ($last_id);	
}


$rbdColegio = $_REQUEST["rbdColegio"];
$rutProfesor = $_REQUEST["rutProfesor"];
$nombreProfesor = $_REQUEST["nombreProfesor"];
$apellidoPaternoProfesor = $_REQUEST["apellidoPaternoProfesor"];
$apellidoMaternoProfesor = $_REQUEST["apellidoMaternoProfesor"];
$sexoProfesor = $_REQUEST["sexoProfesor"];
$fechaNacimientoProfesor = $_REQUEST["fechaNacimientoProfesor"];
$estadoProfesor = $_REQUEST["estadoProfesor"];
$tipoUsuario = $_REQUEST["tipoUsuario"];
$emailProfesor = $_REQUEST["emailProfesor"];



guardarProfesor($rutProfesor,  $rbdColegio, $nombreProfesor, $apellidoPaternoProfesor, $apellidoMaternoProfesor, $sexoProfesor, $fechaNacimientoProfesor, $estadoProfesor);


$rut = explode("-",$rutProfesor); 
$loginUsuario = $rut[0];
$passwordUsuario = md5($rut[0]);

$idUsuario = insertaUsuarioProfesor($rutProfesor, $emailProfesor, $loginUsuario, $passwordUsuario, $estadoProfesor, $tipoUsuario);
asignaPerfilProyectoProfesor($idUsuario, 1, 1);
	
?>
    
    <script language="javascript">

	mostrar_profesorEscuela();
	
</script>                 