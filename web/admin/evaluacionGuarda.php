<?php

require("inc/config.php");
require("../inc/_funciones.php");
require("../inc/_evaluacion.php");

$r = guardarUsuario();
$string = "<tr>
			<td></td>
        	<td>".$r."</td>
        	<td>".getNombreGrupo($idGrupoEvaluacion)."</td>
        	<td>".$_POST['nombreEvaluacion']."</td>
        	<td>".$_POST['tipoEvaluacion']."</td>
        	<td>".$_POST['idNivel']."</td>
        	<td>".$_POST['anoEvaluacion']."</td>
        	<td>".$_POST['estadoEvaluacion']."</td>
        	<td>".$_POST['urlEvaluacion']."</td>
        	</tr>";
?>
<?php 
/*if($r !=0){ 
	echo "<script language='javascript'>";
	echo "$('#tabla > tbody').append('<tr></tr>');";
	echo "</script>";
}  */ 
?>



<?php 
function guardarUsuario(){
	$flag = True;
	$sql = "";
	$idGrupoEvaluacion=0;
	if(isset($_POST['check_nuevo'])){
		//se ingresa un nuevo grupo al sistema
		$sql = "INSERT INTO grupoEvaluacion(nombreGrupoEvaluacion) VALUES ('".$_POST['nombreNuevoGrupo']."')";
		$res = mysql_query($sql);
		if(!$res){
			info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
		}else{
			$idGrupoEvaluacion = mysql_insert_id();
		}
	}else{
		$idGrupoEvaluacion = $_POST['idGrupoEvaluacion'];
	}
	
	$tipo_archivo = $_FILES['urlEvaluacion']['type'];
	$tamano_archivo = $_FILES['urlEvaluacion']['size'];
	$_FILES['urlEvaluacion']['tmp_name'];
	$carpeta = "../subir/docs/";
	
	if($_FILES['urlEvaluacion']['name'] != ""){
		$nombre_archivo = $_FILES['urlEvaluacion']['name'];
		$nombre_archivo_arreglado = limpiar_caracteres_especiales($nombre_archivo);
		
			if (move_uploaded_file($_FILES['urlEvaluacion']['tmp_name'], $carpeta.$nombre_archivo_arreglado)){
				
				$urlEvaluacion = "subir/docs/".$nombre_archivo_arreglado;
				
				
			}else{
				
				info("Ocurrió un problema con el archivo.");
				break;
			}
			
		
	}
	
	
	//se ingresa la nueva evaluacion
	$sql2 = "INSERT INTO evaluacion(nombreEvaluacion, tipoEvaluacion, idNivel, idGrupoEvaluacion, estadoEvaluacion, anoEvaluacion,urlEvaluacion)
			 		VALUES('".$_POST['nombreEvaluacion']."','".$_POST['tipoEvaluacion']."',".$_POST['idNivel'].",".$idGrupoEvaluacion.",".$_POST['estadoEvaluacion'].",".$_POST['anoEvaluacion'].",'".$urlEvaluacion."')";
	$res2 = mysql_query($sql2);
	if(!$res2){
		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
		return 0;
	}else{
		info("Se ha creado el nuevo recurso.");
		$idEvaluacionNuevo = mysql_insert_id();
	}
	return $idEvaluacionNuevo;
	
}



function limpiar_caracteres_especiales($s) {

	$s = utf8_encode($s);

	$s = preg_replace("/á|à|â|ã|ª/","a",$s);
	$s = preg_replace("/Á|À|Â|Ã/","A",$s);
	$s = preg_replace("/é|è|ê/","e",$s);
	$s = preg_replace("/É|È|Ê/","E",$s);
	$s = preg_replace("/í|ì|î/","i",$s);
	$s = preg_replace("/Í|Ì|Î/","I",$s);
	$s = preg_replace("/ó|ò|ô|õ|º/","o",$s);
	$s = preg_replace("/Ó|Ò|Ô|Õ/","O",$s);
	$s = preg_replace("/ú|ù|û/","u",$s);
	$s = preg_replace("/Ú|Ù|Û/","U",$s);
	$s = str_replace(" ","_",$s);
	$s = str_replace("ñ","n",$s);
	$s = str_replace("Ñ","N",$s);
	//para ampliar los caracteres a reemplazar agregar lineas de este tipo:
	//$s = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$s);
	return $s;
}

dirigirse_despues("evaluaciones.php",20);

?>