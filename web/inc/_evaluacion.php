<?php 



function getEvaluaciones(){

	$sql = "SELECT * FROM evaluacion where 1 ORDER BY idGrupoEvaluacion,tipoEvaluacion,idNivel, nombreEvaluacion";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$eval[$i]= $row;
		$i++;
	}
	if ($i==0){
		return(NULL);
	}
	return($eval);

}

function getEvaluacionGrupo($idGrupoEvaluacion, $idUsuario){
	$tipoUsuario = getTipoUsuario($idUsuario);
	if($tipoUsuario=="Coordinador General" ||$tipoUsuario=="Asesor" ||$tipoUsuario=="Relator/Tutor" ){
		$preQuery = "SELECT idNivel FROM nivel WHERE 1";
	}
	if($tipoUsuario=="Profesor"){
		$preQuery = "SELECT distinct idNivel 
					 FROM cursoColegio a join usuario b on a.rutprofesor = b.rutprofesor 
					 WHERE idUsuario =".$idUsuario. " AND a.anoCursoColegio=".date('Y');
	}
	if($tipoUsuario =="Directivo" ){
		$preQuery = "SELECT distinct idNivel
					 FROM cursoColegio a join usuarioColegio b on a.rbdColegio = b.rbdColegio
					 WHERE b.idUsuario = ".$idUsuario." AND a.anoCursoColegio =".date('Y');
	}
	if($tipoUsuario =="UTP" ){
		$preQuery = "SELECT distinct idnivel
					 FROM profesor a join usuario b on a.rutProfesor = b.rutProfesor
	 				 left join cursoColegio c  on a.rbdColegio = c.rbdColegio 	
					 WHERE b.idUsuario = ".$idUsuario." AND b.tipoUsuario = 'UTP' AND c.anoCursoColegio=".date('Y');
	}
	//echo $preQuery;
	//para pruebas
	$sql = "SELECT * 
			FROM evaluacion 
			WHERE idGrupoEvaluacion=".$idGrupoEvaluacion." AND anoEvaluacion = ".date('Y')." AND tipoEvaluacion = 'Prueba' AND idNivel IN (".$preQuery.") 
			ORDER BY idGrupoEvaluacion";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$eval[$i]= $row;
		$i++;
	}
	$resp = array();
	$resp[0]= $eval;

	//para pauta
	$sql2 = "SELECT * 
			FROM evaluacion 
			WHERE idGrupoEvaluacion=".$idGrupoEvaluacion." AND anoEvaluacion = ".date('Y')." AND tipoEvaluacion = 'Pauta' AND idNivel IN (".$preQuery.") 
			ORDER BY idGrupoEvaluacion";
	$res2 = mysql_query($sql2);
	$i = 0;
	while ($row2 = mysql_fetch_array($res2)){
		$eval2[$i]= $row2;
		$i++;
	}
	$resp[1]=$eval2;

	//para protocolos
	$sql3 = "SELECT * 
			FROM evaluacion 
			WHERE idGrupoEvaluacion=".$idGrupoEvaluacion." AND anoEvaluacion = ".date('Y')." AND tipoEvaluacion = 'Protocolo' AND idNivel IN (".$preQuery.") 
			ORDER BY idGrupoEvaluacion";
	$res3 = mysql_query($sql3);
	$i = 0;
	while ($row3 = mysql_fetch_array($res3)){
		$eval3[$i]= $row3;
		$i++;
	}
	$resp[2]=$eval3;


	return($resp);

}	

function getGruposEvaluaciones(){
	$sql = "SELECT * FROM grupoEvaluacion where 1 ORDER BY nombreGrupoEvaluacion";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$eval[$i]= $row;
		$i++;
	}
	if ($i==0){
		return(NULL);
	}
	return($eval);
}


function getNombreGrupo($idGrupoEvaluacion){
	$sql = "SELECT nombreGrupoEvaluacion
			FROM grupoEvaluacion
			WHERE idGrupoEvaluacion = ".$idGrupoEvaluacion;
	$row = mysql_fetch_array(mysql_query($sql));
	return $row["nombreGrupoEvaluacion"];
}

?>