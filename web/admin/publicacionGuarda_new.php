<? 

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";
include "../inc/_notificacion.php";
include "../inc/_profesor.php";
include "../inc/_directivo.php";
include "../inc/_empleadoKlein.php";
include "../inc/_publicacion.php";
include "../inc/_recurso.php";
include "../inc/_usuario.php";
include "../inc/_inscripcionCursoCapacitacion.php";
include "../inc/_detalleActividadCursoCapacitacion.php";



Conectarse_seg(); 


$idTipoRecurso = $_REQUEST["idTipoRecurso"];
$nombreRecurso = $_REQUEST["nombreRecurso"];
$urlRecurso = $_REQUEST["urlRecurso"];
$jornadas = $_REQUEST["idJornada"];
$idPerfil = $_REQUEST["idPerfil"];



if ($idTipoRecurso == 1){
	

	$tipo_archivo = $_FILES['userfile']['type'];
	$tamano_archivo = $_FILES['userfile']['size'];
	$_FILES['userfile']['tmp_name'];
	$carpeta = "../subir/docs/";
	
	if($_FILES['userfile']['name'] != ""){
		$nombre_archivo = $_FILES['userfile']['name'];
		$nombre_archivo_arreglado = limpiar_caracteres_especiales($nombre_archivo);
		
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $carpeta.$nombre_archivo_arreglado)){
				
				$urlRecurso = $nombre_archivo_arreglado;
				
			}else{
				
				alerta("Ocurrió un problema con el archivo.");
				break;
			}
			
		
	}

}






if (isset($_REQUEST["notificarPublicacion"])){

	$notificarPublicacion = $_REQUEST["notificarPublicacion"];
}
else{
	$notificarPublicacion = 0;
}




$idRecurso = setRecurso($idTipoRecurso, $nombreRecurso, $urlRecurso, '');

if ($idRecurso){
	foreach ($jornadas as $idJornada){
		setPublicacion($idRecurso, $idJornada, $idPerfil, 'NULL');	
	}
	
}


// a los cursos en donde se encuentran los usuarios de la publicacion
@$idsCursos = $_REQUEST["idCursoCapacitacion"];

// Obtener usuarios de cada curso
	$i = 0;
	$usuarios[$i] = array();
	$arr_usuarios = array();
	foreach($idsCursos as $idCursoCapacitacion){
		
		// Cuando sean actividades
		if ($idTipoRecurso == 5){

			// Agregar a detalleActividadCursoCapacitacion
			asignaActividadCurso( $idCursoCapacitacion, $urlRecurso);
			
		}
		
		$alumnosCurso = getAlumnosCurso($idCursoCapacitacion);
		foreach ($alumnosCurso as $alumno){
			
			if (array_search($alumno["idUsuario"], $arr_usuarios) == FALSE){
				$arr_usuarios[] = $alumno["idUsuario"];
				$usuarios[$i] = array(
								"idUsuario" => $alumno["idUsuario"],
								"idCurso" => $idCursoCapacitacion
									  );
				$i++;

			}
			
		}
		
		
		
	}

	
	// Notificaciones de la publicacion 
 
	if ($notificarPublicacion == 1){ // Si se marcó el checkbox de notificacion

		foreach ($usuarios as $usuario){
	
			$idImagenNotificacion = $usuario["idUsuario"];
			$idUsuarioNotificado = $usuario["idUsuario"];
			$idCurso = $usuario["idCurso"];
			
			switch ($idTipoRecurso){
	
				case 1: // Archivo
				$textoNotificacion = "Se ha publicado un archivo: <br>".htmlentities($nombreRecurso);
				$idTipoNotificacion = 4;
				// Concatenar $idImagenNotificacion=@ al link
				$linkNotificacion = "curso.php?idCurso=".$idCurso."&idNotificacion=@"."#rec_".$idRecurso;
				break;
				
				case 4: // Foro
				$textoNotificacion = "Se ha abierto una nueva actividad de Foro.<br> ".htmlentities($nombreRecurso);
				$idTipoNotificacion = 6;
				// Concatenar $idImagenNotificacion=@ al link
				$linkNotificacion = "curso.php?idCurso=".$idCurso."&idNotificacion=@"."#rec_".$idRecurso;
				break;
				
				case 5: // Actividad
				$textoNotificacion = "Se ha publicado una actividad en tu grupo.<br> ".htmlentities($nombreRecurso);
				$idTipoNotificacion = 3;
				// Concatenar $idImagenNotificacion=@ al link
				$linkNotificacion = "curso.php?idCurso=".$idCurso."&idNotificacion=@"."#rec_".$idRecurso;
				break;
				
				
				
			}
			
			
			// Guardar la notificacion
			setNotificacion($idUsuarioNotificado, $idTipoNotificacion, $textoNotificacion, $linkNotificacion, $idImagenNotificacion);	
			
		}
	
	}// fin Notificaciones a usuarios
	





dirigirse_despues("publicacion.php",5);


?>