<?php
require("inc/config.php");
require("../inc/_funciones.php");

guardarUsuario();


	
?>
    
<script language="javascript">
	/*location.href="usuarios.php";*/
</script>   



<?php 
function guardarUsuario(){
	$flag = True;
	$sql = "";
	if($_POST['tipoUsuario']=="Profesor" || $_POST['tipoUsuario']=="UTP" ||$_POST['tipoUsuario']=="Directivo"  ){
		if($_POST['rutProfesor']==""){
			$flag=False;
		}else{
			$sql = "INSERT INTO usuario(rutProfesor,";
			$rut = $_POST['rutProfesor'];
		}
	}else{
		if($_POST['rutEmpleadoKlein']==""){
			$flag=False;
		}else{
			$sql = "INSERT INTO usuario(rutEmpleadoKlein,";
			$rut = $_POST['rutEmpleadoKlein'];
		}
	}
	if($flag){
		if($_POST['passwordUsuario']=="" || $_POST['loginUsuario']==""){
			$flag = False;
		}else{
			$sql =  $sql." emailUsuario, loginUsuario, passwordUsuario, estadoUsuario, tipoUsuario, acercaDeUsuario, interesesUsuario, visibleUsuario) 
			VALUES('".$rut."', '".$_POST["emailUsuario"]."', '".$_POST["loginUsuario"]."', '".md5($_POST["passwordUsuario"])."', 1, '".$_POST["tipoUsuario"]."', '".$_POST["acercaDeUsuario"]."', '".$_POST["interesesUsuario"]."', 0)";
		}
	}
	$res = mysql_query($sql);
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}else{
		$idUsuario = mysql_insert_id();
		$tipo = $_POST["tipoUsuario"];

		if($tipo == "Profesor")$tipo = 1;
		else if($tipo == "UTP")$tipo = 3;
		else if($tipo == "Directivo")$tipo = 21;
		else if($tipo == "Relator/Tutor")$tipo = 5;
		else if($tipo == "Asesor")$tipo = 23;
		else if($tipo == "Empleado Klein")$tipo = 20;
		else if($tipo == "Coordinador General")$tipo = 9;
		$sql2 = "INSERT INTO detalleusuarioproyectoperfil(idPerfil ,idProyectoKlein ,idUsuario) VALUES(".$tipo.",  1, ".$idUsuario.")";
		$res2 = mysql_query($sql2);
		//mysql_insert_id();
		if (!$res2) {
    		info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
    		mysql_query("DELETE FROM usuario WHERE idUsuario = ".$idUsuario);
		}else{
			if($tipo == 20 || $tipo == 9 || $tipo == 3){
				$sql3 = "INSERT INTO inscripcioncursocapacitacion(idPerfil ,idProyectoKlein ,idUsuario, idCursoCapacitacion) VALUES(".$tipo.",  1, ".$idUsuario.",28)";
				$res3 = mysql_query($sql3);
				if(!$res3){
					info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
					mysql_query("DELETE FROM usuario WHERE idUsuario = ".$idUsuario);
					mysql_query("DELETE FROM detalleusuarioproyectoperfil WHERE idUsuario = ".$idUsuario);
				}
				else{
					info('El usuario ha sido creado.');
				}
			}else{
				info('El usuario ha sido creado.');
			}
		}
		return ($idUsuario);
	}
}
?>