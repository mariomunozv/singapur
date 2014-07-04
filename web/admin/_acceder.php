<?php
require("inc/config.php");
include("../inc/_usuario.php");
include("../inc/_funciones.php");

?>

<?php
	
$usuario = $_REQUEST["usuario"];	
$password = $_REQUEST["clave"];	
	if(estaUsuario($usuario))
	{
		 //echo "esta ";
		if(claveCorrectaUsuario($usuario,md5($password)))
		{ 	   
		//echo "claveCorrecta";
			$datosUsuario = getDatosUsuario($usuario);
//print_r($datosUsuario);
			if($datosUsuario["estadoUsuario"] == 0){
				
				//echo "<br>";
				alerta("Ud. no puede ingresar al sistema.");
				session_destroy();

				//dirigirse_a("../ingreso.php");
			}
			$datosUsuario = getDatosUsuario($_REQUEST["usuario"]);
			//print_r($datosUsuario);
				switch ($datosUsuario["tipoUsuario"]){
					case "Alumno":
						$nombre = getNombreUsuarioAlumno($datosUsuario["rut"]);
						$pagina = "../inicioAlumno.php";
					break;
					case "Profesor":
						$nombre = getNombreUsuarioProfesor($datosUsuario["rut"]);
						$pagina = "../inicioProfesor.php";
					break;
					case "Administrador":
					
						$nombre = "Terrible Administrador";
						$pagina = "inicio.php";
					break;
					case "Empleado Klein":
						$nombre = getNombreUsuarioKlein($datosUsuario["rut"]);
						
						$pagina = "inicio.php";
					break;
					
				}
			$_SESSION["nombreCompletoUsuario"] = $nombre;	
			$_SESSION["sesionTipoUsuario"] = $datosUsuario["tipoUsuario"];
			$_SESSION["sesionPerfilUsuario"] = $datosUsuario["idPerfilUsuario"];				   
			$_SESSION["sesionIdUsuario"] = $datosUsuario["idUsuario"];
			$_SESSION["sesionRutUsuario"] = $datosUsuario["rut"];
			$_SESSION["sesionUsuario"] = $_REQUEST["usuario"];
			
			
			
			
			$idUsuario = $datosUsuario["idUsuario"];
			//print_r($datosUsuario);
			
		//	$_SESSION["idTipoSesion"] = $datosSesionLaboratorio["idTipoSesion"];
			//print_r($datosSesionLaboratorio);
	
	        acualizaUltimoAcceso($idUsuario);
			
			/* Se registra el acceso al sistema = 1*/
			//registraAcceso($idUsuario, 1, 'NULL', 'NULL');
		 dirigirse_a($pagina);
//	  echo "<a href='../sesionResolucionProblemas/presentacionProblemas.php'>pulento</a>";

			
		
			
		
		}
		else
		{
			echo "Su clave es Incorrecta"; 

		}
	}
	else
	{
		echo "Usuario incorrecto"; 


	}
	
	
	?>