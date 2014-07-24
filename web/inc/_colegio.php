<?php 
 

function getColegiosTodos(){
	$sql = "SELECT * FROM 
	colegio col 
	left join congregacion con
	on con.id = col.idCongregacion
	join comuna com 
	on col.idComuna = com.idComuna";
	//echo $sql;
	
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$colegios[$i] = array( "rbdColegio" => $row["rbdColegio"],
					  "nombreColegio" => $row["nombreColegio"],
					  "emailColegio" => $row["emailColegio"],
					  "nombreComuna" => $row["nombreComuna"],  
					  "estadoColegio" => $row["estadoColegio"],
					  "nombreCongregacion" => $row["nombre"]
					  );	
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	return($colegios);
}
 function getColegiosNuevo(){
	$sql = "SELECT * FROM colegio WHERE estadoColegio = 1 ORDER BY nombreColegio ";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$colegios[$i] = array("idColegio"=> $row["rbdColegio"],"nombreColegio"=>$row["nombreColegio"] );	
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	return($colegios);
}


function getDatosColegio($rbdColegio){
	$sql = "SELECT * FROM colegio a left join comuna  b on a.idComuna = b.idComuna WHERE rbdColegio = ".$rbdColegio;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosColegio = array( "rbdColegio" => $row["rbdColegio"],
					  "nombreColegio" => $row["nombreColegio"],
					  "emailColegio" => $row["emailColegio"],
					  "nombreComuna" => $row["nombreComuna"],
					  "direccionColegio" => $row["direccionColegio"],
					  "telefonoColegio" => $row["telefonoColegio"],
					  "paginaWebColegio" => $row["paginaWebColegio"],
					 "logoColegio" => $row["logoColegio"] );	
	return($datosColegio);
} 

?>