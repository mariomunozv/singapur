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

function guardaColegio($rbdColegio, $rutSostenedor, $idComuna,$nombreColegio, $direccionColegio, $telefonoColegio,$emailColegio, $webColegio,$matriculaTotal,$estadoColegio){
	
	$sql_ = "INSERT INTO colegio (rbdColegio, rutSostenedor, idComuna, nombreColegio , direccionColegio, telefonoColegio, emailColegio, paginaWebColegio, matriculaTotalColegio, estadoColegio)";
	$sql_ .= "VALUES ('$rbdColegio', '$rutSostenedor', '$idComuna','$nombreColegio', '$direccionColegio', '$telefonoColegio','$emailColegio', '$webColegio','$matriculaTotal','$estadoColegio')";
	$res = mysql_query($sql_);
	echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el colegio ".$nombreColegio;
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
			$rbdColegio =  $alumnos[$i+1][1];
			$rutSostenedor = $alumnos[$i+1][2]."-".$alumnos[$i+1][3];
			$idComuna = $alumnos[$i+1][4];
			$nombreColegio = $alumnos[$i+1][5];
			$direccionColegio = $alumnos[$i+1][6];
			$telefonoColegio = $alumnos[$i+1][7];
			$emailColegio = $alumnos[$i+1][8];
			$webColegio = $alumnos[$i+1][9];
			$matriculaTotal = $alumnos[$i+1][10];
			$estadoColegio = 1;;

			guardaColegio($rbdColegio, $rutSostenedor, $idComuna,$nombreColegio, $direccionColegio, $telefonoColegio,$emailColegio, $webColegio,$matriculaTotal,$estadoColegio);
		
	}
		
	}else{
		echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
	}
	break;
	}

	
?>
   
<script language="javascript">
</script> 