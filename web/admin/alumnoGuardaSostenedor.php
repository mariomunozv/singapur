
<?php session_start();

include "../inc/conecta.php";
Conectarse_Seg();

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

function asignaPerfilProyectoAlumno($idUsuario, $idPerfil, $idProyectoKlein){
	$sql_ = "INSERT INTO `perfil_usuario_proyecto` ( `idUsuario` , `idPerfil` , `idProyectoKlein` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$idUsuario','$idPerfil', '$idProyectoKlein'  ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha asignado el perfil Alumno al usuario ".$idUsuario;
		}
}
function matriculaAlumno($rutAlumno, $rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio ){
	$sql_ = "INSERT INTO `matricula` ( `rutAlumno` , `rbdColegio` , `idNivel` , `anoCursoColegio` , `letraCursoColegio`  ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutAlumno','$rbdColegio', '$idNivel', '$anoCursoColegio', '$letraCursoColegio'  ";
    $sql_.=")";
	$res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha matriculado al alumno ".$rutAlumno." con éxito";
		}
}
function guardarAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno){
	$sql_ = "INSERT INTO `alumno` ( `rutAlumno` , `tipoAlumno` , `nombreAlumno` , `apellidoPaternoAlumno` , `apellidoMaternoAlumno` , `sexoAlumno` ,`fechaNacimientoAlumno` ,`estadoAlumno` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutAlumno', '$tipoAlumno', '$nombreAlumno', '$apellidoPaternoAlumno', '$apellidoMaternoAlumno','$sexoAlumno' ,'$fechaNacimientoAlumno' ,'$estadoAlumno'  ";
    $sql_.=")";
	$res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el alumno ".$nombreAlumno." ".$apellidoPaternoAlumno," con el rut ".$rutAlumno;
		}
}

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

/*
function guardarDirectivo($rutProfesor, $rbdColegio, $idTipoProfesor,$nombreProfesor, $apellidoPaternoProfesor, $apellidoMaternoProfesor, $sexoProfesor, $fechaNacimientoProfesor,$telefonoProfesor ,$emailProfesor,$anosExperienciaProfesor,$asignaturaACargoProfesor,$coordinadorEnlaceProfesor,$estadoAlumno){
	
	$sql_ = "INSERT INTO `directivo` VALUES ('$rutProfesor', '$idTipoProfesor', '$rbdColegio',  '$nombreProfesor', '$apellidoPaternoProfesor', '$apellidoMaternoProfesor', ";
	$sql_.= " '$sexoProfesor', '$fechaNacimientoProfesor', '$telefonoProfesor', '$emailProfesor', '', '' ,'', 1)";
	$res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el alumno ".$nombreAlumno." ".$apellidoPaternoAlumno," con el rut ".$rutAlumno;
		}
}
*/

function guardarSostenedor($rutSostenedor, $nombreSostenedor, $apellidoPaternoSostenedor, $apellidoMaternoSostenedor, $tipoSostenedor, $telefonoSostenedor, $emailSostenedor, $sitioWebSostenedor, $cantidadEstablecimientos, $matriculaTotal, $estadoSostenedor)
{
	$sql_ = "INSERT INTO sostenedor ( rutSostenedor, nombreSostenedor, apellidoPaternoSostenedor, apellidoMaternoSostenedor, tipoSostenedor, telefonoSostenedor, emailSostenedor, paginaWebSostenedor, cantidadEstablecimientosSostenedor, matriculaTotalSostenedor, estadoSostenedor ";
	$sql_ .= " ) VALUES ( ";
	$sql_ .= " '$rutSostenedor' , '$nombreSostenedor', '$apellidoPaternoSostenedor', '$apellidoMaternoSostenedor', '$tipoSostenedor', '$telefonoSostenedor', '$emailSostenedor', '$sitioWebSostenedor', '$cantidadEstablecimientos', '$matriculaTotal', $estadoSostenedor";
	 $sql_ .=")";
	$res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado el usuario con el rut ".$rutSostenedor;
		$last_id = mysql_insert_id();
	
		}
	return ($last_id);	
}








function insertaUsuarioDirectivo($rutProfesor, $emailUsuario, $loginUsuario, $passwordUsuario, $estadoUsuario, $tipoUsuario){
	$sql_ = "INSERT INTO `usuario` ( `rutDirectivo` , `emailUsuario` , `loginUsuario` , `passwordUsuario` , `estadoUsuario` , `tipoUsuario` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutProfesor', '$emailUsuario', '$loginUsuario', '$passwordUsuario', '$estadoUsuario','$tipoUsuario'  ";
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
function asignaPerfilProyectoDirectivo( $idUsuario, $idProyectoKlein, $idPerfil){
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
    $sql_.=" '$idPerfil','$idProyectoKlein', '$idUsuario' , '$idCursoCapacitacion' ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	echo $sql_;
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
		$rutAlumno = $_REQUEST["rutAlumno"];
		$nombreAlumno = $_REQUEST["nombreAlumno"];
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
		$idUsuario = insertaUsuarioAlumno($rutAlumno, $emailAlumno, $loginUsuario, $passwordUsuario, $estadoAlumno, $tipoUsuario);
		asignaPerfilProyectoAlumno($idUsuario, 1, 1);
		//mostrar_alumnosCurso();
	break;
	case "editar":
		$rutAlumno = $_REQUEST["rutAlumno"];
		$nombreAlumno = $_REQUEST["nombreAlumno"];
		$apellidoPaternoAlumno = $_REQUEST["apellidoPaternoAlumno"];
		$apellidoMaternoAlumno = $_REQUEST["apellidoMaternoAlumno"];
		$sexoAlumno = $_REQUEST["sexoAlumno"];
		$fechaNacimientoAlumno = $_REQUEST["fechaNacimientoAlumno"];
		$estadoAlumno = $_REQUEST["estadoAlumno"];
		$tipoUsuario = $_REQUEST["tipoUsuario"];
		$emailAlumno = $_REQUEST["emailAlumno"];
		$tipoAlumno = $_REQUEST["tipoAlumno"];
		updateAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno);
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
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $carpeta.$nombre_archivo)){
		echo "subio correctamente<br>";
		$alumnos = leerArchivoExcel($nombre_archivo);
		print_r($allumnos);
		for ($i=1;$i<count($alumnos);$i++){
			echo $alumnos[$i+1][1]."Alumno<br>";
			$rutSostenedor = $alumnos[$i+1][1]."-".$alumnos[$i+1][2];
			$nombreSostenedor = $alumnos[$i+1][3];
			$apellidoPaternoSostenedor = $alumnos[$i+1][4];
			$apellidoMaternoSostenedor = $alumnos[$i+1][5];
			$tipoSostenedor = $alumnos[$i+1][6];
			$telefonoSostenedor = $alumnos[$i+1][7];
			$emailSostenedor = $alumnos[$i+1][8];
			$sitioWebSostenedor = $alumnos[$i+1][9];
			$cantidadEstablecimientos = $alumnos[$i+1][10];
			$matriculaTotal = $alumnos[$i+1][11];
			$estadoSostenedor = 1;
			$idCurso = $alumnos[$i+1][13];	
			$tipoUsuario = "Sostenedor";
			guardarSostenedor($rutSostenedor, $nombreSostenedor, $apellidoPaternoSostenedor, $apellidoMaternoSostenedor, $tipoSostenedor, $telefonoSostenedor, $emailSostenedor, $sitioWebSostenedor, $cantidadEstablecimientos, $matriculaTotal, $estadoSostenedor);
			
			// INSERTAR DATOS USUARIO
			
			//$rut = explode("-",$rutSostenedor);
			$loginUsuario = $alumnos[$i+1][1];
			$passwordUsuario = md5($alumnos[$i+1][2]);
			

			

			/***** EL SOSTENEDOR NO NECESITA USUARIO EN EL SISTEMA 
			
						$idUsuario = insertaUsuarioAlumno($rutSostenedor, $emailSostenedor, $loginUsuario, $passwordUsuario, $estadoSostenedor,"Sostenedor");
			*****/
			
			
			// 9 es el ID de Sostenedor
			$idPerfil = 9;
			//asignaPerfilProyectoDirectivo($idUsuario, 1, $idPerfil);
			
			// INSCRIBIR EN UN CUROS INSCRIPCIONCURSOCAPACITACION
			
			$idProyecto = 1;			
			//inscribirUsuarioCursoCapacitacion($idPerfil, 1, $idUsuario, $idCurso);
			//guardarAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno);
			//matriculaAlumno($rutAlumno, $rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio);
			 
			
			//$idUsuario = insertaUsuarioAlumno($rutAlumno, $emailAlumno, $loginUsuario, $passwordUsuario, $estadoAlumno, $tipoUsuario);
			//asignaPerfilProyectoAlumno($idUsuario, 1, 1);
		}
		
	}else{
		echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
	}
	break;
	}

	
?>
    
                <script language="javascript">
</script> 