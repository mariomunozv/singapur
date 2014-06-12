<?php 


function getColegios($idProyecto){
	$sql = "SELECT * FROM detalleColegioProyecto a left join colegio b on a.rbdColegio = b.rbdColegio left join comuna c on b.idComuna = c.idComuna WHERE idProyectoKlein = ".$idProyecto;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$colegios[$i] = array( "rbdColegio" => $row["rbdColegio"],
					  "nombreColegio" => $row["nombreColegio"],
					  "emailColegio" => $row["emailColegio"],
					  "nombreComuna" => $row["nombreComuna"]  );	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($colegios);
	return($colegios);
}


function getColegiosProyecto($idProyecto){
	$sql ="SELECT * FROM `detalleColegioProyecto` a join colegio b on a.rbdColegio = b.rbdColegio where idProyectoKlein = ".$idProyecto." AND estadoColegio = 1 ORDER BY RAND()";
	$res = mysql_query($sql);
	$i=0;
	$datosColegio[$i]=array();
	while($row = mysql_fetch_array($res)){
		
		if(substr_count($row["nombreColegio"],' ') > 2){
			$partes = explode(' ', $row["nombreColegio"], 4);
			$todo = "".$partes[0]." ".$partes[1]." ".$partes[2]."<br>".$partes[3];
		}
		else
			$todo = $row["nombreColegio"];	
				
		$datosColegio[$i]=array(
			"rbdColegio"=> $row["rbdColegio"],
			"nombreColegio" => $todo,
			"paginaWebColegio" => $row["paginaWebColegio"]);
		$i++;	
	}
	return($datosColegio);
}


function getColegioProyecto($idProyecto){
	$sql ="SELECT * FROM `detalleColegioProyecto` a join colegio b on a.rbdColegio = b.rbdColegio where idProyectoKlein = ".$idProyecto." AND estadoColegio = 1 ORDER BY RAND() LIMIT 1";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosColegio=array("rbdColegio"=> $row["rbdColegio"],"nombreColegio" => $row["nombreColegio"]);
	return($datosColegio);
}






?>