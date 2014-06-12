<?php

function getItemsTodos(){
		
	$sql = "SELECT * FROM item ORDER BY idItem DESC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	$arreglo[$i] = array();
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idItem"=> $row["idItem"],
			"enunciadoItem"=> $row["enunciadoItem"],
			"fondoItem"=> $row["fondoItem"],
			"esAbiertoItem"=> $row["esAbiertoItem"]
			);
		$i++;
	}
	return($arreglo);

	
}

function getItemsBusqueda($query){
		
	$sql = "SELECT * FROM item WHERE enunciadoItem LIKE CONVERT( _utf8 '%$query%'USING latin1 )";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idItem"=> $row["idItem"],
			"idIdeaClave"=> $row["idIdeaClave"],
			"enunciadoItem"=> $row["enunciadoItem"],
			"fondoItem"=> $row["fondoItem"],
			"esAbiertoItem"=> $row["esAbiertoItem"]
			);
		$i++;
	}
	return($arreglo);

	
}


function getItemsLista($idLista){
		
	$sql = "SELECT * FROM item it JOIN lista_Item li ON it.idItem = li.idItem WHERE idLista = '$idLista' ORDER BY li.idItem ASC";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idItem"=> $row["idItem"],
			//"idIdeaClave"=> $row["idIdeaClave"],
			"enunciadoItem"=> $row["enunciadoItem"],
			"fondoItem"=> $row["fondoItem"],
			"esAbiertoItem"=> $row["esAbiertoItem"],
			"idLista"=> $row["idLista"],
			"idSeccionBitacora" => $row["idSeccionBitacora"],
			"idNivelDeComplejidad" => $row["idNivelDeComplejidad"],
			"idCompetencia" => $row["idCompetencia"],
			"puntajeItem" => $row["puntajeItem"]
			);
		$i++;
	}
	return($arreglo);

	
}


	


function getItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$item=array("idItem"=> $row["idItem"],
					"enunciadoItem"=> $row["enunciadoItem"],
					"esAbiertoItem"=> $row["esAbiertoItem"],
					"fondoItem"=> $row["fondoItem"]	,
					"cantidadRespuestasItem"=> $row["cantidadRespuestasItem"]	,
			"puntajeItem"=> $row["puntajeItem"]	,
			"respuestaCorrectaItem"=> $row["respuestaCorrectaItem"]	
			
					
					 
					);	
	return($item);
}
	
function getCorrecta($idItem){
	$sql = "SELECT * FROM alternativaItem";
	$sql.= " WHERE idItem = ".$idItem." and esCorrectaAlternativaItem = 1";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$alternativaCorrecta= array( "idAlternativa" =>$row["idAlternativaItem"],
								"nombreAlternativa" => $row["nombreAlternativaItem"]);				  
	//print_r($EtiquetaCorrecta);
	return($alternativaCorrecta);
}


function getHerramienta($idItem){
		$sql = "SELECT * FROM item_Herramienta a ";
        $sql .=" LEFT JOIN herramienta b ON a.idHerramienta = b.idHerramienta ";
        $sql .=" WHERE idItem = ".$idItem;
		//echo $sql."--";
	    $res = mysql_query($sql);
		$i = 0;
		while ($row = mysql_fetch_array($res)){
				$herramientas[$i] = array(
										  "idHerramienta" => $row["idHerramienta"],
  										  "nombreHerramienta" => $row["nombreHerramienta"],
  										  "archivoHerramienta" => $row["archivoHerramienta"],	
										  "idDominio" => $row["idDominio"],
										  "xmlConfiguracion"=> $row["xmlConfiguracion"]
										  );
			$i++;
			}
			if ($i == 0){
						$herramientas[$i] = array();				
			} 
			
		return($herramientas);	
	
	}
	

function getHerramientaItem($idItem){
		$sql = "SELECT * FROM item_Herramienta a ";
        $sql .=" LEFT JOIN herramienta b ON a.idHerramienta = b.idHerramienta ";
        $sql .=" WHERE idItem = ".$idItem;
		//echo $sql."--";
	    $res = mysql_query($sql);
		$i = 0;
		while ($row = mysql_fetch_array($res)){
				$herramientas[$i] = array(
										  "idHerramienta" => $row["idHerramienta"],
  										  "nombreHerramienta" => $row["nombreHerramienta"],
  										  "archivoHerramienta" => $row["archivoHerramienta"],	
										  "idDominio" => $row["idDominio"],
										  "xmlConfiguracion"=> $row["xmlConfiguracion"]
										  );
			$i++;
			}
			if ($i == 0){
						$herramientas[$i] = array();				
			} 
			
		return($herramientas);	
	
}
	
	
function getAlternativas($idItem){
	$sql = "select * from alternativaItem WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	//echo $sql;
	$i =0;
	$alternativas = array();
	while ($row = mysql_fetch_array($res)) {
		$alternativas[$i]=array("idAlternativaItem"=> $row["idAlternativaItem"],
								"nombreAlternativaItem"=> $row["nombreAlternativaItem"],
								"esCorrectaAlternativaItem"=> $row["esCorrectaAlternativaItem"]		,
								"imagenAlternativaItem"=> $row["imagenAlternativaItem"]		,
								"esImagenAlternativaItem"=> $row["esImagenAlternativaItem"]		
								);
	$i++;	
	}
	return($alternativas);
}



function getRespuestaAbiertaItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuestaCorrectaAbierta = $row["respuestaCorrectaItem"];
	return($respuestaCorrectaAbierta);
}



function getRespuestaCerradaItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$etiquetaCorrecta = getCorrecta($idItem);
	return($etiquetaCorrecta);
}



function getSeleccionada($respuesta){
	$sql = "select * from alternativa WHERE idAlternativa = ".$respuesta;
	//echo $sql;
	$res = mysql_query($sql);
	@$row = mysql_fetch_array($res);
	$valorSeleccionada = $row["nombreAlternativa"];
	return($valorSeleccionada);
}


function setItem($idCompetencia, $idNivelDeComplejidad, $idSeccionBitacora, $idTareaMatematica, $enunciadoItem, $puntajeItem){
	
	$sql_insert = "INSERT INTO item (idCompetencia, idNivelDeComplejidad, idSeccionBitacora, idTareaMatematica, enunciadoItem, puntajeItem ,estadoItem)
	VALUES ($idCompetencia, $idNivelDeComplejidad, $idSeccionBitacora, $idTareaMatematica, '$enunciadoItem',$puntajeItem, 1)";
	//echo $sql_insert;
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
	$idItem = mysql_insert_id();
	return ($idItem);
}

function setCondicion($idVariableDidactica, $idInstanciaVariableDidactica, $idItem){
	$sql_insert = "INSERT INTO condicion VALUES ($idVariableDidactica, $idInstanciaVariableDidactica, $idItem)";
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
		
}

function setAlternativa($idItem, $nombreAlternativa, $esCorrectaAlternativa){
	$sql_insert = "INSERT INTO alternativaItem (idItem, nombreAlternativaItem, esCorrectaAlternativaItem, imagenAlternativaItem, esImagenAlternativaItem )
	VALUES ($idItem, '$nombreAlternativa', $esCorrectaAlternativa, NULL, NULL)";
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
		
}

function setHerramienta($idItem, $idHerramienta){
	$sql_insert = "INSERT INTO item_Herramienta VALUES ($idHerramienta, $idItem, NULL)";
	$res_insert = mysql_query($sql_insert);
	if (!$res_insert) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
		
}


function setRespuesta($idItem,$idUsuario,$idSesion,$idLista,$idPauta,$opcionSeleccionada,$valorSeleccionada,$opcionCorrecta,$valorCorrecta,$puntos){
	
	$sql_insert = "INSERT INTO `respuesta` ( `idItem` , `idUsuario` , `idSesionLaboratorio` , `idLista`, `idPauta` , `idRespuesta` ,  `opcionSeleccionada` ,`valorSeleccionada`  , `opcionCorrecta` , `valorCorrecta`,`puntajeRespuesta` )";
	$sql_insert .= " VALUES ( '$idItem', '$idUsuario', '$idSesion', '$idLista','$idPauta', '', '$opcionSeleccionada', '$valorSeleccionada', '$opcionCorrecta', '$valorCorrecta', '$puntos')";
	$res = mysql_query($sql_insert);
	//echo $sql_insert;
}


function setRespuestaEvaluacion($idPauta,$idItem,$idUsuario,$respuesta,$idSesion,$valorSeleccionada,$opcionCorrecta,$valorCorrecta,$idLista){
	
	$sql_insert = "INSERT INTO `respuesta` ( `idItem` , `idUsuario` , `idSesionLaboratorio` , `idPauta` , `idLista` , `idRespuesta` , `valorSeleccionada` , `opcionSeleccionada` , `valorCorrecta` , `opcionCorrecta` )";
	$sql_insert .= " VALUES ( '$idItem', '$idUsuario', '$idSesion', '$idPauta', '$idLista','', '$valorSeleccionada' , '$respuesta', '$valorCorrecta' , '$opcionCorrecta')";
	$res = mysql_query($sql_insert);
	//echo $sql_insert;
}


function actualizaItem($idItem, $idTareaMatematica, $idAprendizajeEsperadoCurriculo, $idCompetencia, $idNivelDeComplejidad, $idNivel, $idIdeaClave, $enunciadoItem, $fondoItem, $esAbiertoItem, $respuestaCorrectaItem ){
	
	$sql = "UPDATE item SET 
	idTareaMatematica = $idTareaMatematica, 
	idAprendizajeEsperadoCurriculo = $idAprendizajeEsperadoCurriculo, 
	idCompetencia = $idCompetencia, 
	idNivelDeComplejidad = $idNivelDeComplejidad, 
	idNivel = $idNivel, 
	idIdeaClave = $idIdeaClave, 
	enunciadoItem = '$enunciadoItem', 
	fondoItem = '$fondoItem', 
	esAbiertoItem = $esAbiertoItem, 
	respuestaCorrectaItem = '$respuestaCorrectaItem' 
	WHERE idItem = $idItem";
	
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
}


function actualizaAlternativa($idAlternativa, $nombreAlternativa, $esCorrectaAlternativa){
	$sql = "UPDATE alternativa SET  
	nombreAlternativa = '$nombreAlternativa', 
	esCorrectaAlternativa = $esCorrectaAlternativa
	WHERE idAlternativa = '$idAlternativa'";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
		
}

function eliminaAlternativas($idItem){
	$sql = "DELETE FROM alternativa WHERE idItem = '$idItem'";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
	
}

function eliminaHerramientas($idItem){

	$sql = "DELETE FROM item_Herramienta WHERE idItem = '$idItem'";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}

}

function eliminaCondiciones($idItem){

	$sql = "DELETE FROM condicion WHERE idItem = '$idItem'";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}

}


	
?>