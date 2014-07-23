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

	//se ingresa la nueva evaluacion
	$sql2 = "INSERT INTO evaluacion(nombreEvaluacion, tipoEvaluacion, idNivel, idGrupoEvaluacion, estadoEvaluacion, anoEvaluacion,urlEvaluacion)
			 		VALUES('".$_POST['nombreEvaluacion']."','".$_POST['tipoEvaluacion']."',".$_POST['idNivel'].",".$idGrupoEvaluacion.",".$_POST['estadoEvaluacion'].",".$_POST['anoEvaluacion'].",'".$_POST['urlEvaluacion']."')";
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
?>