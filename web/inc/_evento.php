<?php 



function getEventosProximosCurso($idCurso){
	$mes=date("n");
	$dia=date("d");
	$alo=date("Y");
	$hoy=date("Y/n/d",mktime(0,0,0,$mes,$dia,$alo));
	$hasta_30_dias=date("Y/n/d",mktime(0,0,0,$mes,$dia+30,$alo));
	$sql="SELECT * FROM evento WHERE fechaEvento >= '".$hoy."' AND fechaEvento <= '".$hasta_30_dias."' and idCursoCapacitacion = ".$_SESSION["sesionIdCurso"]." ORDER BY fechaEvento ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($res)) {
	
			$eventosProximos[$i] = array(
				"idEvento" => $row["idEvento"],
				"nombreEvento" => $row["nombreEvento"],
				"descripcionEvento" => $row["descripcionEvento"],
				"fechaEvento" => $row["fechaEvento"]
				);	
		$i++;
		}
	if ($i == 0){
		$eventosProximos[$i] = array(
			"nombreEvento" => "No existen Eventos Proximos.",
			);	
	} 
	return ($eventosProximos);
}


function getTodosEventosProximos(){
	$mes=date("n");
	$dia=date("d");
	$alo=date("Y");
	$hoy=date("Y/n/d",mktime(0,0,0,$mes,$dia,$alo));
	$hasta_30_dias=date("Y/n/d",mktime(0,0,0,$mes,$dia+30,$alo));
	$sql="SELECT * FROM evento WHERE fechaEvento >= '".$hoy."' AND fechaEvento <= '".$hasta_30_dias."' ORDER BY fechaEvento ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
		while ($row = mysql_fetch_array($res)) {
	
			$eventosProximos[$i] = array(
				"idEvento" => $row["idEvento"],
				"idCursoCapacitacion" => $row["idCursoCapacitacion"],
				"nombreEvento" => $row["nombreEvento"],
				"descripcionEvento" => $row["descripcionEvento"],
				"fechaEvento" => $row["fechaEvento"]
				);	
		$i++;
		}
	if ($i == 0){
		$eventosProximos[$i] = array(
			"nombreEvento" => "No existen Eventos Proximos.",
			);	
	} 
	return ($eventosProximos);
}
  

?>