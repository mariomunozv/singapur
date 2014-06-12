<?php


function DatosUsuario($idUsuario){
	$sql = "SELECT * from usuario WHERE idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosUsuario = array("rutAlumno" => $row["rutAlumno"],"rutProfesor" => $row["rutProfesor"],"tipoUsuario" => $row["tipoUsuario"]);
	return($datosUsuario);
	
	}

function getNombreUsuarioAlumno($rutAlumno){
	$sql = "SELECT * from alumno WHERE rutAlumno = '".$rutAlumno."'";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$nombreCompletoAlumno = $row["nombreAlumno"]." ".$row["apellidoPaternoAlumno"]." ".$row["apellidoMaternoAlumno"];
	return($nombreCompletoAlumno);
	}
	
function getNombreUsuarioProfesor($rutProfesor){
	$sql = "SELECT * from profesor WHERE rutProfesor = '".$rutProfesor."'";
	
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$nombreCompletoProfesor = $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"];
	return($nombreCompletoProfesor);
	}


function estaUsuario($loginUsuario){
		
		$sql = "SELECT loginUsuario FROM usuario WHERE loginUsuario = "."'$loginUsuario'";
		$res = mysql_query($sql);
	//	echo $sql;
		if (mysql_num_rows($res) > 0 ){
			return (true);
		}else{
			return(false);
		}
}




function loginUsuario($idUsuario){
		
		$sql = "SELECT loginUsuario FROM usuario WHERE idUsuario = "."'$idUsuario'";
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		return($row["loginUsuario"]);
		
	}

function claveCorrectaUsuario($loginUsuario,$claveUsuario){
		
		$sql = "SELECT idUsuario FROM usuario WHERE loginUsuario = "."'$loginUsuario'"." AND passwordUsuario = "."'$claveUsuario'";
		
		$res = mysql_query($sql);
		if (mysql_num_rows($res) > 0 ){
			return (true);
		}else{
			return(false);
		}
		
}
	
// USUARIOS UNICOS
function getDatosUsuario($usuario){
		
		$sql = "SELECT * FROM `usuario` a LEFT JOIN detalleUsuarioProyectoPerfil b ON a.idUsuario = b.idUsuario WHERE loginUsuario = "."'$usuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		if ($row["tipoUsuario"] == "Profesor"){
			$rut = $row["rutProfesor"];
		}
		if ($row["tipoUsuario"] == "Directivo"){
			$rut = $row["rutDirectivo"];
		}
		if ($row["tipoUsuario"] == "Alumno"){
			$rut = $row["rutAlumno"];
		}
		if ($row["tipoUsuario"] == "Empleado Klein"){
			$rut = $row["rutEmpleadoKlein"];
		}
	//	echo "<br>-->".$row["tipoUsuario"]."<--<br>-";
		$usuario=array("idUsuario"=> $row["idUsuario"],"tipoUsuario" => $row["tipoUsuario"],"emailUsuario" => $row["emailUsuario"],"loginUsuario" => $row["loginUsuario"],"passwordUsuario" => $row["passwordUsuario"],"estadoUsuario" => $row["estadoUsuario"],"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],"imagenUsuario" => $row["imagenUsuario"],"idPerfilUsuario" => $row["idPerfil"],"rut" =>@$rut);
		return ($usuario);

}

function idAlumnosCurso($rbdColegio,$idNivel,$letraCursoColegio,$anoCursoColegio,$idSesion){
	
	$sql = " SELECT *";
	$sql .=" FROM `matricula` a left join usuario b on a.rutAlumno = b.rutAlumno ";
	$sql .=" WHERE `rbdColegio` LIKE CONVERT( _utf8 '".$rbdColegio."' ";
	$sql .=" USING latin1 ) ";
	$sql .=" AND `idNivel` =".$idNivel." ";
	$sql .=" AND `anoCursoColegio` =".$anoCursoColegio." ";
	$sql .=" AND `letraCursoColegio` LIKE CONVERT( _utf8 '".$letraCursoColegio."' ";
	$sql .=" USING latin1 ) ";
	$sql .=" ";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($res)) {
			$alumnos[$i] = array(
			"rutAlumno" => $row["rutAlumno"],
			"idUsuario" => $row["idUsuario"]
			);	
		$i++;
		}
	//print_r($alumnos);	
	foreach ($alumnos as $alumno){
		$sql = "INSERT INTO `asignacionSesionUsuario` ( `rbdColegio` , `idNivel` , `anoCursoColegio` , `letraCursoColegio` , `idSesionLaboratorio` , `idUsuario`,`estadoAsignacionSesionUsuario` )";
		$sql.= " VALUES  ";
		$sql.= "(".$rbdColegio.", ".$idNivel.", ".$anoCursoColegio.", '".$letraCursoColegio."',".$idSesion.",".$alumno["idUsuario"].",0 )";
		$res = mysql_query($sql);
		if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
		}
	
		//echo "<br>".$alumno["idUsuario"]."<br>";
	}

}



	
?>