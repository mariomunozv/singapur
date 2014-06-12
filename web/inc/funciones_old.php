<?php
function getUsuariosCurso($idCurso){
	$sql =" SELECT * FROM inscripcionCursoCapacitacion where idCursoCapacitacion = ".$idCurso;
	//echo $sql;
	$res = mysql_query($sql);
	return($res);
	
	}


function getUltimoMensajeTema($idTema){
	$sql =" SELECT * FROM mensajeTema where idTema = ".$idTema." order by idMensajeTema DESC";
	
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["idMensajeTema"]);
	}
function getDatosMensajeTema($idMensajeTema){
	$sql = "SELECT * FROM mensajeTema WHERE idMensajeTema= "."'$idMensajeTema'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosMensajeTema=array("idUsuario"=> $row["idUsuario"],"fechaMensajeTema" => $row["fechaMensajeTema"]);
	return($datosMensajeTema);	
	
	}

function getRespuestaTema($idTema){
	$sql = "SELECT COUNT(idUsuario) FROM mensajeTema WHERE idTema = "."'$idTema'";
	$res = mysql_query($sql);
	$mensajes = mysql_result($res,0);
	echo $mensajes;
	return;
	}

function getTemaCurso($idCurso){
	$sql = "SELECT * FROM tema WHERE idCursoCapacitacion = ".$idCurso." ORDER BY fechaTema DESC";
	$res = mysql_query($sql);
   	return ($res);
	}

function getCursoUsuario($idUsuario){
	$sql = "SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosCursoUsuario = array("idCursoCapacitacion"=> $row["idCursoCapacitacion"],"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"],"nombreCursoCapacitacion" => $row["nombreCursoCapacitacion"]);
	return($datosCursoUsuario);
	}

function getMensaje($idMensaje){
	$sql = "SELECT * FROM mensaje WHERE idMensaje= "."'$idMensaje'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosMensaje=array("deMensaje"=> $row["deMensaje"],"asuntoMensaje" => $row["asuntoMensaje"],"contenidoMensaje" => $row["contenidoMensaje"],"fechaMensaje" => $row["fechaMensaje"]);
	return($datosMensaje);	
	}

function cambiaf_a_normal($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
	echo $lafecha;
    return;
} 
function getNombreFotoUsuarioProfesor($idUsuario){
	$sql = "SELECT * FROM usuario a left join profesor b on a.rutProfesor = b.rutProfesor WHERE idUsuario = "."'$idUsuario'";
	echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$nombreFotoUsuario=array("imagenUsuario"=> $row["imagenUsuario"],"nombreProfesor" => $row["nombreProfesor"],"apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],"apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"]);
	return($nombreFotoUsuario);
	}

function getMensajesUsuario($idUsuario){
	$sql = "SELECT * FROM `mensaje` WHERE paraMensaje = "."'$idUsuario'"." ORDER BY fechaMensaje DESC";
	$res = mysql_query($sql);
   	return ($res);
} 


function alerta($mensaje){
	?><script language="javascript">
	alert("<?php echo $mensaje; ?>");
	</script><?php
}
function getMensajesSinLeerUsuario($idUsuario){
	$sql = "SELECT COUNT(paraMensaje) FROM mensaje WHERE estadoMensaje = 0 AND paraMensaje ="."'$idUsuario'";
	$res = mysql_query($sql);
	$mensajes = mysql_result($res,0);
	echo $mensajes;
	return;
	
	}

function getNombreProfesor($rutProfesor){
	$sql = "SELECT * FROM profesor WHERE rutProfesor ="." '$rutProfesor'";
	$res = mysql_query($sql);
    $row = mysql_fetch_array($res);
	$nombreProfesor = $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"];
	return ($nombreProfesor);
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
		$sql = "SELECT * FROM `usuario` a left join detalleUsuarioProyectoPerfil b on a.idUsuario = b.idUsuario WHERE loginUsuario ="."'$usuario'";
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
		//echo "<br>-->".$row["tipoUsuario"]."<--<br>-";
		$usuario=array("idUsuario"=> $row["idUsuario"],"tipoUsuario" => $row["tipoUsuario"],"emailUsuario" => $row["emailUsuario"],"loginUsuario" => $row["loginUsuario"],"passwordUsuario" => $row["passwordUsuario"],"estadoUsuario" => $row["estadoUsuario"],"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],"imagenUsuario" => $row["imagenUsuario"],"idPerfilUsuario" => $row["idPerfil"],"rut" => $rut);
		return ($usuario);
	}	
		

function getDatosProfesor($idUsuario){
		$sql = "SELECT * FROM `usuario` usuario left join profesor profesor on usuario.rutProfesor = profesor.rutProfesor WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		
		$datosProfesor = array(
			"rutProfesor" => $row["rutProfesor"],
			"loginUsuario" => $row["loginUsuario"],
			"passwordUsuario" => $row["passwordUsuario"],
			"nombreProfesor" => $row["nombreProfesor"],
			"apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
			"apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
			"sexoProfesor" => $row["sexoProfesor"],
			"fechaNacimientoProfesor" => $row["fechaNacimientoProfesor"],
			"telefonoProfesor" => $row["telefonoProfesor"],
			"emailUsuario" => $row["emailUsuario"],
			"anosExperienciaProfesor" => $row["anosExperienciaProfesor"],
			"asignaturaACargoProfesor" => $row["asignaturaACargoProfesor"],
			"coordinadorEnlaceProfesor" => $row["coordinadorEnlaceProfesor"],
			"imagenUsuario" => $row["imagenUsuario"]
		);
		return ($datosProfesor);
}	
	

function dirigirse_a($pagina){
	?><script language="javascript">
	location.href='<?php echo $pagina; ?>';
	</script><?php
}



function mailfrom($fromaddress, $toaddress, $subject, $body, $headers) { 
                 $fp = popen('/usr/sbin/sendmail -t -f '.$fromaddress.' '.$toaddress,"w"); 
                 if(!$fp) return false; 
                 fputs($fp,"From:".$fromaddress."\r\n"); 
                 fputs($fp, "To: $toaddress\r\n"); 
                 fputs($fp, "Subject: ".$subject."\r\n"); 
                 fputs($fp, $headers."\r\n"); 
                 fputs($fp, $body); 
                 fputs($fp, "\r\n"); 
                 pclose($fp); 
                 return true; 
                 }


	
function getAtributo($nombre_id,$id,$atrib,$tabla){
	$sql = "SELECT * FROM ".$tabla." WHERE ".$nombre_id." = ".$id;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return ($row[$atrib]);
	}		
	
function guardaMensaje($idDe, $idPara, $asunto, $mensaje){

	$sql = "INSERT INTO mensaje VALUES ('', '$idDe', '$idPara', '$asunto', '$mensaje', NOW(),'')";
	mysql_query($sql);
	
}
	
?>