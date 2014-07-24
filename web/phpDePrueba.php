<?

function getCursoUs($idUsuario){
	echo "entro a funcion ";
	$sql_user = "SELECT * FROM usuario WHERE idUsuario=".$idUsuario;
	$res_user = mysql_query($sql_user);
	$tipoUsuario = mysql_fetch_array($res_user["tipoUsuario"]);
	if($tipoUsuario=="Directivo"){
		$sql = "SELECT idCursoCapacitacion 
				FROM cursoCapacitacion 
				where estadoCursoCapacitacion = 1
				AND tipoCursoCapacitacion = 'directivos'
				AND idCursoCapacitacion in (SELECT idCursoCapacitacion 
					                        FROM cursocapacitacioncolegio a JOIN usuariocolegio b
					                        ON a.rbdColegio = b.rbdColegio
					                        WHERE b.idUsuario = ".$idUsuario."  )
				ORDER BY(nombreCortoCursoCapacitacion)";
	}else{
		if($tipoUsuario=="Empleado Klein" || $tipoUsuario=="Coordinador General"){
			$sql = "SELECT idCursoCapacitacion 
					FROM v35.cursoCapacitacion
					where estadoCursoCapacitacion = 1
					ORDER BY(nombreCortoCursoCapacitacion)";
		}else{
			$sql ="SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where b.estadoCursoCapacitacion > 0 AND idUsuario = ".$idUsuario;
		}
	}
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$cursoUsuario = $row["idCursoCapacitacion"];
	return($cursoUsuario);
}

?>