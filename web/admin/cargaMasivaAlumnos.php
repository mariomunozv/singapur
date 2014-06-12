<?php
ini_set('display_errors','On');
require("inc/config.php");
$modo = $_REQUEST["modo"];

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
	$sql_ = "INSERT INTO `detalleUsuarioProyectoPerfil` ( `idUsuario` , `idPerfil` , `idProyectoKlein` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$idUsuario','$idPerfil', '$idProyectoKlein'  ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
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
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha matriculado al alumno ".$rutAlumno." con éxito";
		}
}
function guardarAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno){
	$sql_ = "INSERT INTO `alumno` ( `rutAlumno` , `tipoAlumno` , `nombreAlumno` , `apellidoPaternoAlumno` , `apellidoMaternoAlumno` , `sexoAlumno` ,`fechaNacimientoAlumno` ,`estadoAlumno` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutAlumno', '$tipoAlumno', '$nombreAlumno', '$apellidoPaternoAlumno', '$apellidoMaternoAlumno','$sexoAlumno' ,'$fechaNacimientoAlumno' ,'$estadoAlumno'  ";
    $sql_.=")";
	echo $sql;
	$res = mysql_query($sql_);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el alumno ".$nombreAlumno." ".$apellidoPaternoAlumno," con el rut ".$rutAlumno;
		}
}

function updateAlumno($rutAntiguoAlumno,$rutAlumno,$tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno){
	$sql_ = "UPDATE `alumno` SET `tipoAlumno` = '".$tipoAlumno."',`nombreAlumno` = '".$nombreAlumno."',`apellidoPaternoAlumno` = '".$apellidoPaternoAlumno."',";
	$sql_.=" `apellidoMaternoAlumno` = '".$apellidoMaternoAlumno."',`sexoAlumno` = '".$sexoAlumno."',`fechaNacimientoAlumno` = ".$fechaNacimientoAlumno.",";
	$sql_.=" `rutAlumno` = '".$rutAlumno."',";
    $sql_.=" `estadoAlumno` = ".$estadoAlumno." WHERE CONVERT( `rutAlumno` USING utf8 ) = '".$rutAntiguoAlumno."'";
	$res = mysql_query($sql_);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado con éxito el alumno ".$nombreAlumno." ".$apeliidoPaternoAlumno," con el rut ".$rutAlumno;
	 }
}


function insertaUsuarioAlumno($rutAlumno, $emailUsuario, $loginUsuario, $passwordUsuario, $estadoUsuario, $tipoUsuario){
	$sql_ = "INSERT INTO `usuario` ( `rutAlumno` , `emailUsuario` , `loginUsuario` , `passwordUsuario` , `estadoUsuario` , `tipoUsuario` ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" '$rutAlumno', '$emailUsuario', '$loginUsuario', '$passwordUsuario', '$estadoUsuario','$tipoUsuario'  ";
    $sql_.=")";
	$res = mysql_query($sql_);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha insertado el usuario ".$loginUsuario." con el rut ".$rutAlumno;
		$last_id = mysql_insert_id();
	
		}
	return ($last_id);	
}

function actualizaLoginUsuario($idUsuario,$loginUsuario,$passwordUsuario)
{
$sql_="UPDATE `kleinomat`.`usuario` SET `loginUsuario` = '".$loginUsuario."',";
$sql_.="`passwordUsuario` = '".$passwordUsuario."',";
$sql_.="`ultimoAccesoUsuario` = NOW( ) WHERE `usuario`.`idUsuario` =".$idUsuario;

	//$sql_ = "UPDATE usuario set loginUsuario =  '".$loginUsuario."'";
	//$sql_.=", passwordUsuario = '$passwordUsuario'";
    //$sql_.=" WHERE 	rutAlumno = '".$rutAlumno."'";
	$res = mysql_query($sql_);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha actualizado el login del usuario ".$loginUsuario;
		$last_id = mysql_insert_id();
	}
	return ($last_id);	
}

function cambiaEstadoAlumno($rut,$modo){
	if($modo == "Activar"){
	$sql_="UPDATE alumno SET `estadoAlumno` = 1 WHERE rutAlumno = '".$rut."'";
		}else{
		$sql_="UPDATE alumno SET `estadoAlumno` = 0 WHERE rutAlumno = '".$rut."'";
	}
	echo $sql_;
	$res = mysql_query($sql_);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha actualizado el estado del usuario ".$loginUsuario;
		
	}
}

function promoverAlumno($rutAlumno, $rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio )
{
	$sql = "UPDATE matricula SET idNivel = ".$idNivel.", ";
	$sql .= "letraCursoColegio = '".$letraCursoColegio."', ";
	$sql .= "anoCursoColegio = ".$anoCursoColegio;
	$sql .= " WHERE rutAlumno = '".$rutAlumno."'";
	$sql .= " AND rbdColegio = '".$rbdColegio."'";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha promovido al estado del usuario ".$rutAlumno;
		
	}
}

function existeUsuario($rutAlumno)
{
	$sql = "SELECT Count(*) FROM alumno WHERE rutAlumno = '$rutAlumno'";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row[0]);
}

$rbdColegio = $_REQUEST["rbdColegio"];
$idNivel = $_REQUEST["idNivel"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];



echo "antes de modo";



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
		mostrar_alumnosCurso();
	break;
	case "editar":
		$rutAlumno = $_REQUEST["rutAlumno"];
		$rutAntiguoAlumno = $_REQUEST["rutAlumno2"];
		$nombreAlumno = $_REQUEST["nombreAlumno"];
		$apellidoPaternoAlumno = $_REQUEST["apellidoPaternoAlumno"];
		$apellidoMaternoAlumno = $_REQUEST["apellidoMaternoAlumno"];
		$sexoAlumno = $_REQUEST["sexoAlumno"];
		$fechaNacimientoAlumno = $_REQUEST["fechaNacimientoAlumno"];
		$estadoAlumno = $_REQUEST["estadoAlumno"];
		$tipoUsuario = $_REQUEST["tipoUsuario"];
		$emailAlumno = $_REQUEST["emailAlumno"];
		$tipoAlumno = $_REQUEST["tipoAlumno"];
		//updateAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno);
		updateAlumno($rutAntiguoAlumno, $rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno);
		$rut = explode("-",$rutAlumno); 
		$loginUsuario = $rut[0];
		$passwordUsuario = md5($rut[0]);
		if(actualizaLoginUsuario($idUsuario,$loginUsuario,$passwordUsuario))
		{
					mostrar_alumnosCurso();
	    }
		
	break;
	case "Activar":
		$rut = $_REQUEST["rut"];
		cambiaEstadoAlumno($rut,$modo); ?>
<script>mostrar_alumnosCurso();</script>
<?php	break;
	case "Desactivar":

		$rut = $_REQUEST["rut"];
		echo $rut."dasdasjd asjd ajdk";
		cambiaEstadoAlumno($rut,$modo); ?>
<script>mostrar_alumnosCurso();</script>
<?php	break;
	
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
				for ($i=1;$i<count($alumnos);$i++){
					//print_r($alumnos[$i]);
					//echo $alumnos[$i+1][1]."Alumno<br>";
					$rutAlumno = $alumnos[$i+1][1]."-".$alumnos[$i+1][2];
					$tipoAlumno = " ";//$alumnos[$i+1][8];
					$tipoUsuario = "Alumno";//$alumnos[$i+1][9];
					$rbdColegio = $alumnos[$i+1][3];
					$nombreAlumno = $alumnos[$i+1][4];
					$apellidoPaternoAlumno = $alumnos[$i+1][5];
					$apellidoMaternoAlumno = $alumnos[$i+1][6];
					$sexoAlumno = $alumnos[$i+1][7];
					$fechaNacimientoAlumno = $alumnos[$i+1][8];
					$idNivel = $alumnos[$i+1][9];
					$letraCursoColegio = $alumnos[$i+1][10];
					$estadoAlumno = 1;
					$emailAlumno = "";//$alumnos[$i+1][5];
					if(existeUsuario($rutAlumno)==0)
					{
						guardarAlumno($rutAlumno, $tipoAlumno, $nombreAlumno, $apellidoPaternoAlumno, $apellidoMaternoAlumno, $sexoAlumno, $fechaNacimientoAlumno, $estadoAlumno);
						matriculaAlumno($rutAlumno, $rbdColegio, $idNivel, 2013, $letraCursoColegio);
						$rut = explode("-",$rutAlumno); 
						$loginUsuario = $alumnos[$i+1][1];
						$passwordUsuario = md5($alumnos[$i+1][1]);
						$idUsuario = insertaUsuarioAlumno($rutAlumno, $emailAlumno, $loginUsuario, $passwordUsuario, $estadoAlumno, $tipoUsuario);
						asignaPerfilProyectoAlumno($idUsuario, 1, 1);
					}
					else
					{
						promoverAlumno($rutAlumno, $rbdColegio, $idNivel, 2013, $letraCursoColegio);
					}
				}
				
			}else{
				echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
			}
	break;
	}


?>
    
          