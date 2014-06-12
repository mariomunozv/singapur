<?php
//ini_set("display_errors","on");
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
Conectarse_seg(); 

$idUsuario = $_SESSION["sesionIdUsuario"];

// Datos de profesor;
$rut = $_POST["rut"];
$nombre = $_POST["nombre"];
@$apellidoPaterno = $_POST["apellidoPaterno"];
@$apellidoMaterno = $_POST["apellidoMaterno"];
@$sexo = $_POST["sexo"];
@$fechaNacimiento = $_POST["fechaNacimiento"];
@$fechaNacimiento_h = $_POST["fechaNacimiento_h"];
@$telefono = $_POST["telefono"];
@$email = $_POST["email"];
@$anosExperiencia = $_POST["experiencia"];
@$anosExperienciaColegioActual = $_POST["experienciaColegioActual"];
@$asignaturaACargo = $_POST["asignaturaACargo"];
@$coordinadorEnlace = $_POST["coordinadorEnlace"];
@$cursoActualProfesor = $_POST["cursoActual"];
@$especializacion = $_POST['especializacion'];
@$experienciaSingapur  = $_POST['experienciaSingapur'];
@$nivelExperiencia = $_POST['nivelExperiencia'];
if(isset($cursoActualProfesor)){
	$cursoActual = implode(",",$cursoActualProfesor);
}

if(isset($nivelExperiencia)){
	$nivelES = implode(",",$nivelExperiencia);
}


if($coordinadorEnlace == '')
	$coordinadorEnlace = 0;

if($fechaNacimiento == '')
	$fechaNacimiento = $fechaNacimiento_h;


// Datos de usuario
$emailUsuario = $_POST["email"];

if (isset($_POST["password"])){
	$passwordUsuario = md5($_POST["password"]);
	if ($_POST["password"] == "")
		$passwordUsuario = "";
}else{
	$passwordUsuario = "";
}


$acercaDeUsuario = $_POST["acercaDeUsuario"];
//$interesesUsuario = $_POST["interesesUsuario"];
$interesesUsuario = "no se usa";


$tipo = getTipoUsuario($idUsuario);
$okDatos = false;
switch ($tipo){
	case "Profesor": // Actualizar Datos de profesor
	$okDatos = actualizaDatosProfesor($rut,$nombre,$apellidoPaterno,$apellidoMaterno,$sexo,$fechaNacimiento,$telefono,$email,$anosExperiencia,$anosExperienciaColegioActual,$cursoActual,$especializacion,$asignaturaACargo,$experienciaSingapur,$nivelES,$coordinadorEnlace);
	$okDatosUsuario = actualizaDatosUsuario($idUsuario, $emailUsuario,$passwordUsuario,$acercaDeUsuario,$interesesUsuario);
	break;
	

	case "Empleado Klein": // Actualizar Datos de empleado klein
	$okDatos = actualizaDatosEmpleadoKlein($rut,$nombre,$apellidoPaterno,$apellidoMaterno,$sexo,$fechaNacimiento,$telefono,$email);
	$okDatosUsuario = actualizaDatosUsuario($idUsuario, $emailUsuario,$passwordUsuario,$acercaDeUsuario,$interesesUsuario);
	break;
}



// Actualizar Datos de usuario


if ($okDatos && $okDatosUsuario){
	
	$_SESSION["sesionNombreUsuario"] = $nombreProfesor." ".$apellidoPaternoProfesor." ".$apellidoMaternoProfesor;
	registraAcceso($idUsuario, 8, 'NULL');
}


// Actualizar la imagen de Perfil

// Por si No Hay archivo
if($_FILES["file"]["name"] != "" )
{
	if 	(
			( 
				  ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				
			) &&
				($_FILES["file"]["size"] < 1000000)
		)
	 {
	  if ($_FILES["file"]["error"] > 0)
		{
		echo "Error. Codigo error: " . $_FILES["file"]["error"] . "<br/><br/>";
		echo '<input type=button value="Volver" onClick="history.go(-1)">';
		
		}
	  else
		{
			//print_r($_FILES);
			
			move_uploaded_file($_FILES["file"]["tmp_name"],"subir/fotos_perfil/orig_".$idUsuario .".jpg");
			
			$origen="subir/fotos_perfil/orig_".$idUsuario .".jpg";
			
			$datos = getimagesize($origen);
			$anchura=$datos[0];
			$altura = $datos[1];
			
			$destino="subir/fotos_perfil/th_".$idUsuario .".jpg";
			$destino_temporal=tempnam("tmp/","tmp");
						
			// Thumb (50 pix)
			redimensionar_jpeg($origen, $destino_temporal, 50, 50, 100);
			// guardamos la imagen
			$fp=fopen($destino,"w");
			fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
			fclose($fp);
			
			// Perfil (400 pix)
			if ($anchura >= 400 || $altura >= 400){
				$destino2="subir/fotos_perfil/".$idUsuario .".jpg";
				$destino_temporal2=tempnam("tmp/","tmp");
				redimensionar_jpeg($origen, $destino_temporal2, 400, 400, 100);
				// guardamos la imagen
				$fp2=fopen($destino2,"w");
				fputs($fp2,fread(fopen($destino_temporal2,"r"),filesize($destino_temporal2)));
				fclose($fp2);
				
				$archivo = $idUsuario .".jpg";
				
			}else{
				move_uploaded_file("subir/fotos_perfil/orig_".$idUsuario .".jpg","subir/fotos_perfil/".$idUsuario .".jpg");
				$archivo = $idUsuario .".jpg";	
			}
			
			
			
	  
			
	
			$sql_udateUsuario="UPDATE usuario SET imagenUsuario = '$archivo' WHERE idusuario  = '$idUsuario';";
			
			$_SESSION["sesionImagenUsuario"] = $archivo;
	
			//echo $sql_udateUsuario;
			//print_r($_FILES);
			
			
			
			mysql_query($sql_udateUsuario);
			
			dirigirse_a("fichaDocente.php");
		}
		
	}
	else
	{
	  alerta("Archivo invalido. Formato incompatible o tamaño excesivo.");
	  //dirigirse_a("fichaDocente.php");
	//  echo '<input type=button value="Volver" onClick="history.go(-1)">';
	}

}

dirigirse_a("fichaDocente.php");




function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
{

$anchura=$img_nueva_anchura;
$hmax=$img_nueva_altura;
$datos = getimagesize($img_original);
//print_r($datos);


$ratio = ($datos[0] / $anchura);
$altura = ($datos[1] / $ratio);
if($altura>$hmax){
	$anchura2=$hmax*$anchura/$altura;
	$altura=$hmax;
	$anchura=$anchura2;
	}
	

// crear una imagen desde el original
$img = ImageCreateFromJPEG($img_original);
// crear una imagen nueva
$thumb = imagecreatetruecolor($anchura,$altura);
// redimensiona la imagen original copiandola en la imagen
ImageCopyResized($thumb,$img,0,0,0,0,$anchura,$altura,ImageSX($img),ImageSY($img));
// guardar la nueva imagen redimensionada donde indicia $img_nueva
ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
ImageDestroy($img);

} 

?>


