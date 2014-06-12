<?php session_start();

include "../inc/incluidos.php";
 
function leerArchivoExcel($archivo){
	
require_once 'phpExcelReader/Excel/reader.php'; 


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

$data->read('upload/'.$archivo);


// $data->sheets[0]['numRows'] - count rows
//$data->sheets[0]['numCols'] - count columns

error_reporting(E_ALL ^ E_NOTICE);
$i=0;
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	$alumnos[$i][$j] =	$data->sheets[0]['cells'][$i][$j];
	}
}

print_r($alumnos);
echo "<br><br>";
return($alumnos);
}

/*
function asignaPerfilProyectoAlumno($idUsuario, $idPerfil, $idProyectoKlein){
	$sql_ = "INSERT INTO `perfil_usuario_proyecto` ( `idUsuario` , `idPerfil` , `idProyectoKlein` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$idUsuario','$idPerfil', '$idProyectoKlein'  ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	echo "<br>aca!!!: ".$sql_."<br>";
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha asignado el perfil Profesor al usuario ".$idUsuario;
		}
}
*/
/*
function updateAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno){
	$sql_ = "UPDATE `alumno` SET `tipoAlumno` = '".$tipoAlumno."',`nombreAlumno` = '".$nombreAlumno."',`apellidoPaternoAlumno` = '".$apellidoPaternoAlumno."',";
	$sql_.=" `apellidoMaternoAlumno` = '".$apellidoMaternoAlumno."',`sexoAlumno` = '".$sexoAlumno."',`fechaNacimientoAlumno` = ".$fechaNacimientoAlumno.",";
    $sql_.=" `estadoAlumno` = ".$estadoAlumno." WHERE CONVERT( `rutAlumno` USING utf8 ) = '".$rutAlumno."'";
	$res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el alumno ".$nombreAlumno." ".$apeliidoPaternoAlumno," con el rut ".$rutAlumno;
		}
}
*/


function guardarProfesor($rutProfesor, $rbdColegio, $idTipoProfesor,$nombreProfesor, $apellidoPaternoProfesor, $apellidoMaternoProfesor, $sexoProfesor, $fechaNacimientoProfesor,$telefonoProfesor ,$emailProfesor,$anosExperienciaProfesor,$asignaturaACargoProfesor,$coordinadorEnlaceProfesor,$implementa,$estadoAlumno){
	
	$sql_ = "INSERT INTO profesor (rutProfesor, rbdColegio, idTipoProfesor, nombreProfesor, apellidoPaternoProfesor, apellidoMaternoProfesor, sexoProfesor, fechaNacimientoProfesor, telefonoProfesor, emailProfesor, anosExperienciaProfesor, asignaturaACargoProfesor, coordinadorEnlaceProfesor, implementaProfesor, estadoProfesor)";
	$sql_ .= "VALUES ('$rutProfesor', '$rbdColegio', '$idTipoProfesor', '$nombreProfesor', '$apellidoPaternoProfesor', '$apellidoMaternoProfesor', ";
	$sql_.= " '$sexoProfesor', '$fechaNacimientoProfesor', '$telefonoProfesor', '$emailProfesor', '$anosExperienciaProfesor', '$asignaturaACargoProfesor', '$coordinadorEnlaceProfesor', '$implementa', 1)";
	$res = mysql_query($sql_);
	echo $sql_;
	
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el alumno ".$nombreProfesor." ".$apellidoPaternoAlumno," con el rut ".$rutProfesor;
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
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado el usuario ".$loginUsuario." con el rut ".$rutAlumno;
		$last_id = mysql_insert_id();
	
		}
	return ($last_id);	
}
 

/*
function insertaUsuarioAlumno($rutAlumno, $emailUsuario, $loginUsuario, $passwordUsuario, $estadoUsuario, $tipoUsuario){
	$sql_ = "INSERT INTO `usuario` ( `rutAlumno` , `emailUsuario` , `loginUsuario` , `passwordUsuario` , `estadoUsuario` , `tipoUsuario` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutAlumno', '$emailUsuario', '$loginUsuario', '$passwordUsuario', '$estadoUsuario','$tipoUsuario'  ";
    $sql_.=")";
	$res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado el usuario ".$loginUsuario." con el rut ".$rutAlumno;
		$last_id = mysql_insert_id();
	
		}
	return ($last_id);	
}
*/
function asignaPerfilProyectoProfesor( $idUsuario, $idProyectoKlein, $idPerfil){
	$sql_ = "INSERT INTO `detalleUsuarioProyectoPerfil` ( `idPerfil` , `idProyectoKlein` , `idUsuario` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$idPerfil','$idProyectoKlein', '$idUsuario'  ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha asignado el perfil Alumno al usuario ".$idUsuario;
		}
}



function inscribirUsuarioCursoCapacitacion( $idPerfil, $idProyectoKlein, $idUsuario, $idCursoCapacitacion ){
	$sql_ = "INSERT INTO `inscripcionCursoCapacitacion` ( `idPerfil` , `idProyectoKlein` , `idUsuario` , `idCursoCapacitacion` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" $idPerfil,$idProyectoKlein, $idUsuario , $idCursoCapacitacion ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	//echo $sql_
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha asignado el perfil Alumno al usuario ".$idUsuario;
		}
}



$rbdColegio = $_REQUEST["rbdColegio"];
$idNivel = $_REQUEST["idNivel"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];

$modo = $_REQUEST["modo"];


$modo = "carga";
switch ($modo){
	case "nuevo":
		$rutProfesor = $_REQUEST["rutAlumno"];
		$emailUsuario = $_REQUEST["nombreAlumno"];
		$apellidoPaternoAlumno = $_REQUEST["apellidoPaternoAlumno"];
		$apellidoMaternoAlumno = $_REQUEST["apellidoMaternoAlumno"];
		$sexoAlumno = $_REQUEST["sexoAlumno"];
		$fechaNacimientoAlumno = $_REQUEST["fechaNacimientoAlumno"];
		$estadoAlumno = $_REQUEST["estadoAlumno"];
		$tipoUsuario = $_REQUEST["tipoUsuario"];
		$emailAlumno = $_REQUEST["emailAlumno"];
		$tipoAlumno = $_REQUEST["tipoAlumno"];
		guardarAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno);
		matriculaAlumno($rutAlumno, $rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio);
		$rut = explode("-",$rutAlumno); 
		$loginUsuario = $rut[0];
		$passwordUsuario = md5($rut[0]);
		$idUsuario = insertaUsuarioProfesor($rutAlumno, $emailAlumno, $loginUsuario, $passwordUsuario, $estadoAlumno, $tipoUsuario);
		asignaPerfilProyectoAlumno($idUsuario, 1, 1);
		//mostrar_alumnosCurso();
	break;
	
	case "editar":
		$rutProfesor = $_REQUEST["rutProfesor"];
		$nombreProfesor = $_REQUEST["nombreProfesor"];
		$apellidoPaternoProfesor = $_REQUEST["apellidoPaternoProfesor"];
		$apellidoMaternoProfesor = $_REQUEST["apellidoMaternoProfesor"];
		$sexoProfesor = $_REQUEST["sexoProfesor"];
		$fechaNacimientoProfesor = $_REQUEST["fechaNacimientoProfesor"];
		$estadoAlumno = $_REQUEST["estadoAlumno"];
		$tipoUsuario = $_REQUEST["tipoUsuario"];
		$emailProfesor = $_REQUEST["emailAlumno"];
		$idTipoProfesor = $_REQUEST["tipoAlumno"];
		updateAlumno($rutProfesor, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno);
		//mostrar_alumnosCurso();
		
	break;
	case "carga":
	echo "CARGA MASIVA"; ?>
    <script>
    alert(<?php echo $_FILES['userfile']['name'];?>+"h");
    </script>
	<?php
	$nombre_archivo = $_FILES['userfile']['name'];
	$tipo_archivo = $_FILES['userfile']['type'];
	$tamano_archivo = $_FILES['userfile']['size'];
	$carpeta = "upload/";
	echo "Carpeta: ".$carpeta."<br>";
	echo "Nombre de Archivo: ".$nombre_archivo."<br>";
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $carpeta.$nombre_archivo)){
		echo "subio correctamente<br>";
		$alumnos = leerArchivoExcel($nombre_archivo);
		print_r($allumnos);
		for ($i=1;$i<count($alumnos);$i++){
			echo $alumnos[$i+1][1]."Alumno<br>";
			$rutProfesor = $alumnos[$i+1][1]."-".$alumnos[$i+1][2];
			$rbdColegio =  $alumnos[$i+1][3];
			$idTipoProfesor = $alumnos[$i+1][4];
			$nombreProfesor = $alumnos[$i+1][5];
			$apellidoPaternoProfesor = $alumnos[$i+1][6];
			$apellidoMaternoProfesor = $alumnos[$i+1][7];
			$sexoProfesor = $alumnos[$i+1][8];
			$fechaNacimientoProfesor = $alumnos[$i+1][9];
			$telefonoProfesor = $alumnos[$i+1][10];
			$emailProfesor = $alumnos[$i+1][11];
			$anosExperienciaProfesor = $alumnos[$i+1][12];
			$asignaturaACargoProfesor = $alumnos[$i+1][13];
			$coordinadorEnlaceProfesor = $alumnos[$i+1][14];
			$implementaProfesor = $alumnos[$i+1][15];
			$tipoUsuario = "Profesor";
			$estadoAlumno = 1;;
			$idCursoCapacitacion = $alumnos[$i+1][16];

			guardarProfesor($rutProfesor, $rbdColegio, $idTipoProfesor,$nombreProfesor, $apellidoPaternoProfesor, $apellidoMaternoProfesor, $sexoProfesor, $fechaNacimientoProfesor,$telefonoProfesor ,$emailProfesor,$anosExperienciaProfesor,$asignaturaACargoProfesor,$coordinadorEnlaceProfesor,$estadoAlumno);
			
			// INSERTAR DATOS USUARIO
			//$rut = explode("-",$rutAlumno); 
			//$loginUsuario = $rut[0];
			//$passwordUsuario = md5($rut[0]);
			$loginUsuario = $alumnos[$i+1][1];
			$passwordUsuario = md5($alumnos[$i+1][1]);
			
			// ASIGNAR UN USUARIO A UN PERFIL DE UN PROYECTO --- INSERTAR DETALLE USUARIO PROYECTO PERFIL
			$idUsuario = insertaUsuarioProfesor($rutProfesor, $emailProfesor, $loginUsuario, $passwordUsuario, $estadoAlumno, $tipoUsuario);
			asignaPerfilProyectoProfesor($idUsuario, 1, 1);
			inscribirUsuarioCursoCapacitacion( 1, 1, $idUsuario, $idCursoCapacitacion);
			
		}
		
	}else{
		echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
	}
	break;
	}

	
?>
   
<script language="javascript">
</script> 