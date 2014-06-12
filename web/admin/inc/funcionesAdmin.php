<?php 
// FUNCIONES INFORME RESULTADOS POR CURSO Y SESION




 



function getIdCursoSesion($idSesion){
	$sql = "SELECT * from asignacionSesionCurso WHERE idSesionLaboratorio = ".$idSesion." ORDER BY rbdColegio DESC";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$cursos[$i]= array( "rbdColegio" =>$row["rbdColegio"],
					  "idNivel" => $row["idNivel"],
					  "anoCursoColegio" => $row["anoCursoColegio"],
					  "letraCursoColegio" => $row["letraCursoColegio"]);	
	//echo $i." <- <br>";$i++;
	$i++;
	} 
	if($i==0){
		$cursos = 0;
		}
	//print_r($idListas);
	return($cursos);
	
	}
	
	
function getUsuariosCurso($rbd,$idNivel,$anoCursoColegio,$letraCursoColegio){
	$sql = "SELECT b.loginUsuario,b.rutAlumno,c.nombreAlumno,c.apellidoPaternoAlumno,b.idUsuario FROM `matricula` a left join usuario b on a.rutAlumno = b.rutAlumno left join alumno c on a.rutAlumno = c.rutAlumno ";
	$sql.= " WHERE a.rbdColegio = ".$rbd." AND a.idNivel = ".$idNivel." AND a.anoCursoColegio = ".$anoCursoColegio." AND a.letraCursoColegio = "."'$letraCursoColegio'"." ORDER BY c.apellidoPaternoAlumno DESC";
	//secho $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$usuariosCurso[$i]= array( "idUsuario" =>$row["idUsuario"],
					  "usuario" => $row["loginUsuario"],
					  "nombreAlumno" => $row["nombreAlumno"],
					  "apellidoPaternoAlumno" => $row["apellidoPaternoAlumno"]);	
	//echo $i." <- <br>";$i++;
	$i++;
	} 
	//print_r($idListas);
	return($usuariosCurso);
	
	}	
	
function getUsuariosAsignacionSesion($rbd,$idNivel,$anoCursoColegio,$letraCursoColegio,$idSesion){
	$sql = "SELECT b.loginUsuario,b.rutAlumno,c.nombreAlumno,c.apellidoPaternoAlumno,b.idUsuario,a.estadoAsignacionSesionUsuario,a.idSesionLaboratorio FROM asignacionSesionUsuario a left join usuario b on a.idUsuario = b.idUsuario left join alumno c on b.rutAlumno = c.rutAlumno ";
	$sql.= " WHERE a.idSesionLaboratorio = ".$idSesion." AND a.rbdColegio = ".$rbd." AND a.idNivel = ".$idNivel." AND a.anoCursoColegio = ".$anoCursoColegio." AND a.letraCursoColegio = "."'$letraCursoColegio'"." ORDER BY c.apellidoPaternoAlumno ASC";
//	echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$usuariosCurso[$i]= array( "idUsuario" =>$row["idUsuario"],
					  "usuario" => $row["loginUsuario"],
					  "nombreAlumno" => $row["nombreAlumno"],
					  "apellidoPaternoAlumno" => $row["apellidoPaternoAlumno"],
					  "estadoAsignacionSesionUsuario" => $row["estadoAsignacionSesionUsuario"]);	
	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	//print_r($idListas);
	return($usuariosCurso);
	
	}		
	
function getNivel($idNivel){
	$sql = "SELECT * from nivel WHERE idNivel = ".$idNivel;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$nombreNivel = $row["nombreNivel"];
	return($nombreNivel);
	}	



function getResultadoNivelUsuario($idUsuario,$idLista,$idSesion){
	$sql = "SELECT resultadoListaPauta,porcentajeLogroPauta from pauta WHERE idUsuario = ".$idUsuario." AND idLista = ".$idLista." AND idSesionLaboratorio = ".$idSesion;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$resultado = array("resultadoListaPauta" => $row["resultadoListaPauta"],
			             "porcentajeLogroPauta" => $row["porcentajeLogroPauta"]);
	return($resultado);
	}

function getColorResultado2($resultadoListaPauta){
	$rojo = ' class="colorRojo"';
			$amarillo = ' class="colorAmarillo"';
			$verde = " class='colorVerde'";
	switch($resultadoListaPauta){
						case "Rojo":
						$color = $rojo;
						break;
						case "Amarillo":
						$color = $amarillo;
						break;
						case "Verde":
						$color = $verde;
						break;
						default:
						$color = "";
						break;
						
	}
	return($color);
	}




function getItemsRespuestas($idUsuario, $idLista){
	
	$sql = 	"SELECT * FROM respuesta WHERE idUsuario = '$idUsuario' AND idLista = '$idLista' ORDER BY idRespuesta";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	if (mysql_num_rows($res) >0 ){
		while ($row = mysql_fetch_array($res)){
			
			if(is_null($row["puntajeRespuesta"]))
				$row["puntajeRespuesta"] = -1;
			
			$itemsRespuestas[$i]= array( 
				"idItem" =>$row["idItem"],
				"idPauta" =>$row["idPauta"],
				"idRespuesta" =>$row["idRespuesta"],
				"valorCorrecta" =>$row["valorCorrecta"],
				"valorSeleccionada" =>$row["valorSeleccionada"],
				"puntajeRespuesta" => $row["puntajeRespuesta"]);	
		$i++;
		}
		return $itemsRespuestas;
	
	}else
		return 0;
	
	
	
}

function getIdsTareasLista($idLista){
	$sql = "SELECT b.idTareaMatematica FROM `item` a left join tareaMatematica b on a.idTareaMatematica = b.idTareaMatematica ";
	$sql.= " left join lista_Item c on a.idItem = c.idItem ";
	$sql.= " WHERE c.idLista = ".$idLista." GROUP BY b.idTareaMatematica";	
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$tareasItem[$i]= array( "idTareaMatematica" => $row["idTareaMatematica"]);	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	return($tareasItem);
	
	}
	
function getNombreTareaMatematica($idTarea){
	$sql = "select nombreTareaMatematica FROM tareaMatematica WHERE idTareaMatematica = ".$idTarea;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreTareaMatematica"]);
	}
	
function getNombreVariableDidactica($idVariable){
	$sql = "select nombreVariableDidactica FROM variableDidactica WHERE idVariableDidactica = ".$idVariable;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreVariableDidactica"]);
	}
	
	
function getVariableDidacticaListaTareaMatematica($idLista,$idTareaMatematica){
	$sql = "SELECT d.idVariableDidactica FROM `item` a left join tareaMatematica b on a.idTareaMatematica = b.idTareaMatematica ";
	$sql.= " left join lista_Item c on a.idItem = c.idItem ";
	$sql.= " left join condicion d on a.idItem = d.idItem ";
	$sql.= " WHERE c.idLista = ".$idLista." AND b.idTareaMatematica = ".$idTareaMatematica." GROUP BY d.idVariableDidactica";	
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$idsVariableDidacticaTareaLista[$i]= array( "idVariableDidactica" => $row["idVariableDidactica"]);	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	return($idsVariableDidacticaTareaLista);
	
	}	

	
function getIdsInstanciaVariableDidacticaListaTareaMatematica($idVariable,$idLista,$idTareaMatematica){
	$sql = "SELECT d.idVariableDidactica,d.idInstanciaVariableDidactica FROM `item` a left join tareaMatematica b on a.idTareaMatematica = b.idTareaMatematica ";
	$sql.= " left join lista_Item c on a.idItem = c.idItem ";
	$sql.= " left join condicion d on a.idItem = d.idItem ";
	$sql.= " WHERE c.idLista = ".$idLista." AND b.idTareaMatematica = ".$idTareaMatematica." AND d.idVariableDidactica = ".$idVariable." GROUP BY d.idInstanciaVariableDidactica";	
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$idsInstanciaVariableDidacticaTareaLista[$i] = array( "idInstanciaVariableDidactica" =>$row["idInstanciaVariableDidactica"],
					  "idVariableDidactica" => $row["idVariableDidactica"]);	
		$i++;
	}
	return($idsInstanciaVariableDidacticaTareaLista);
	
	}

function getNombreInstanciaVariableDidactica($idInstanciaVariable,$idVariable){
	$sql = "select valorInstanciaVariableDidactica FROM instanciaVariableDidactica WHERE idVariableDidactica = ".$idVariable." AND idInstanciaVariableDidactica = ".$idInstanciaVariable;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["valorInstanciaVariableDidactica"]);
	}
	
function getCuentaItemCondicion($idLista,$idInstanciaVariableDidactica,$idVariableDidactica){
	$sql = "SELECT count(*) as cantidad FROM `condicion` a ";
	$sql.="left join lista_Item b on a.idItem=b.idItem ";
	$sql.="WHERE idLista = ".$idLista." and idVariableDidactica = ".$idVariableDidactica." and idInstanciaVariableDidactica = ".$idInstanciaVariableDidactica;
	//echo $sql."<br>";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["cantidad"]);

	}
	
function getItemCondicion($idLista,$idInstanciaVariableDidactica,$idVariableDidactica){
	$sql = "SELECT * FROM `condicion` a ";
	$sql.="left join lista_Item b on a.idItem=b.idItem ";
	$sql.="WHERE idLista = ".$idLista." and idVariableDidactica = ".$idVariableDidactica." and idInstanciaVariableDidactica = ".$idInstanciaVariableDidactica;
	//echo $sql."<br>";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$itemCondicion[$i] = array( "idItem" =>$row["idItem"]);	
		$i++;
	}
	
	return($itemCondicion);
	}
	
function getContestadasBuenasItem($idItem,$idLista){
	$sql = "SELECT COUNT(*) as totalBuena FROM respuesta WHERE idItem = ".$idItem." AND idLista = ".$idLista." AND puntajeRespuesta = 2";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["totalBuena"];
}

function getContestadasOtrasItem($idItem,$idLista){
	$sql = "SELECT COUNT(*) as totalBuena FROM respuesta WHERE idItem = ".$idItem." AND idLista = ".$idLista." AND puntajeRespuesta <> 2";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["totalBuena"];
}

function getContestadasTodasItem($idItem,$idLista){ //no suman todas las respuestas de los distintos itemes
	$sql = "SELECT COUNT(*) as total FROM respuesta WHERE idItem = ".$idItem." AND idLista = ".$idLista;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["total"];
}

function getContestadaUsuarioItemLista($idItem,$idLista,$idUsuario){
	$sql = "SELECT puntajeRespuesta as total FROM respuesta WHERE idItem = ".$idItem." AND idLista = ".$idLista." AND idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["total"];
}

function getRespuestaUsuario($idUsuario,$idPauta,$idItem){
	$sql = "SELECT * FROM respuesta WHERE idItem = ".$idItem." AND idPauta = ".$idPauta." AND idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["total"];
	}
	
	
function getColumnas($idColumna){
	$sql = "SELECT * FROM variableDidactica WHERE idVaribaleDidactica =".$idColumna;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$columnas[$i] = array( "idVariableDidactica" =>$row["idVariableDidactica"],
					  "nombreVariableDidactica" => $row["nombreVariableDidactica"]);	
		$i++;
	}
	return($columnas);
	}	
function getFilas($idFila){
	$sql = "SELECT * FROM variableDidactica WHERE idVaribaleDidactica =".$idFila;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$filas[$i] = array( "idVariableDidactica" =>$row["idVariableDidactica"],
					  "nombreVariableDidactica" => $row["nombreVariableDidactica"]);	
		$i++;
	}
	return($filas);
	}	


function getCondicionLista($idLista, $idVariableDidactica){
	$sql = "SELECT * FROM `condicion` a ";
	$sql.="left join lista_Item b on a.idItem=b.idItem left join instanciaVariableDidactica c on a.idInstanciaVariableDidactica = c.idInstanciaVariableDidactica ";
	$sql.="WHERE idLista = ".$idLista." and a.idVariableDidactica = ".$idVariableDidactica." GROUP BY a.idInstanciaVariableDidactica";
	//echo $sql."<br>";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$itemCondicion[$i] = array( "idInstanciaVariableDidactica" =>$row["idInstanciaVariableDidactica"], 
									"valorInstanciaVariableDidactica" =>$row["valorInstanciaVariableDidactica"]									  
																		  );	
		$i++;
	}
	
	return($itemCondicion);
	}	


function getCuentaMatrizXY($idLista,$idVariableDidacticaX, $idVariableDidacticaY){
	$rbd = $_REQUEST["rbd"];
	$idNivel = $_REQUEST["idNivel"];
	$anoCursoColegio = $_REQUEST["anoCursoColegio"];
	$letraCursoColegio = $_REQUEST["letraCursoColegio"];
	$sql = "SELECT * FROM `condicion` a ";
	$sql.="left join lista_Item b on a.idItem=b.idItem left join instanciaVariableDidactica c on a.idInstanciaVariableDidactica = c.idInstanciaVariableDidactica ";
	$sql.="WHERE idLista = ".$idLista." and (a.idInstanciaVariableDidactica = ".$idVariableDidacticaX." or a.idInstanciaVariableDidactica = ".$idVariableDidacticaY.")";
	//echo $sql."<br>";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$itemCondicion[$i] = array( "idInstanciaVariableDidactica" =>$row["idInstanciaVariableDidactica"], 
									"valorInstanciaVariableDidactica" =>$row["valorInstanciaVariableDidactica"],
									"idItem" => $row["idItem"]			  );	
		$i++;
	}
	//print_r($itemCondicion);
	$i = 0;
	foreach($itemCondicion as $item){
//		print_r($itemes);
		$itemes[$i] = $item["idItem"];
		//echo $item["idItem"]."<br>";
		$i++;
		}
	$i = 0;	
	$j=0;
	for ($i=0;$i<count($itemes);$i++){
		//print_r($itemes);
		//echo $i."--i-";
		$buscar = (array_keys($itemes, $itemes[$i]));
		//echo print_r($buscar)."·BUSACA";
    	$contador = count($buscar);
		if($contador == 2){
			
			$itemCondiciones[$j] = $itemes[$i];
			$j++;
			}
	//	echo $contador."-".$item[$i]."<------------<br>";
		
		}	
		$itemCondiciones = array_unique($itemCondiciones);
		//print_r($itemCondiciones);
		//print_r($itemCondiciones2);
		//echo "<hr>";
	foreach($itemCondiciones as $item){
        $cuentaBuenas = cuentaBuenasItemCurso($rbd,$idNivel,$anoCursoColegio,$item,$idLista,$letraCursoColegio);
		$cuentaTotal = cuentaTotalItemCurso($rbd,$idNivel,$anoCursoColegio,$item,$idLista,$letraCursoColegio);
		echo $item."BUENAS ->".$cuentaBuenas." TODAS ->".$cuentaTotal."<br>";
		}
	
	
	return($row);
	}

function matrizXY($columna,$fila,$idLista){
   // $condiciones = getItemCondicion2();
	//print_r($condiciones);
	$ejeX = getCondicionLista($idLista,$columna);
	$ejeY = getCondicionLista($idLista,$fila);
	//print_r($ejeX);
	echo "<br>";
	//print_r($ejeY);
	$i = 0;
	foreach ($ejeX as $x){
		foreach ($ejeY as $y){
			echo $x["valorInstanciaVariableDidactica"]."-";
			echo $y["valorInstanciaVariableDidactica"]." ";
			$cuenta = getCuentaMatrizXY($idLista,$x["idInstanciaVariableDidactica"],$y["idInstanciaVariableDidactica"]);
			echo "<hr>";
			//echo $cuenta."XY".$i++."<br>";
			}
		}
	
	
	}	
	
function getCuentaMatrizXY2($idListas,$idVariableDidacticaX, $idVariableDidacticaY){
	$rbd = $_REQUEST["rbd"];
	$idNivel = $_REQUEST["idNivel"];
	$anoCursoColegio = $_REQUEST["anoCursoColegio"];
	$letraCursoColegio = $_REQUEST["letraCursoColegio"];
	$i = 0;
	foreach($idListas as $idLista){
		$sql = "SELECT * FROM `condicion` a ";
		$sql.="left join lista_Item b on a.idItem=b.idItem left join instanciaVariableDidactica c on a.idInstanciaVariableDidactica = c.idInstanciaVariableDidactica ";
		$sql.="WHERE idLista = ".$idLista["idLista"]." and (a.idInstanciaVariableDidactica = ".$idVariableDidacticaX." or a.idInstanciaVariableDidactica = ".$idVariableDidacticaY.")";
		//echo $sql."<br>";
		$res = mysql_query($sql);
		
		while ($row = mysql_fetch_array($res)){
			$itemCondicion[$i] = array( "idInstanciaVariableDidactica" =>$row["idInstanciaVariableDidactica"], 
										"valorInstanciaVariableDidactica" =>$row["valorInstanciaVariableDidactica"],
										"idItem" => $row["idItem"]			  );	
			$i++;
		}
	}	
	//print_r($itemCondicion);
	$i = 0;
	foreach($itemCondicion as $item){
//		print_r($itemes);
		$itemes[$i] = $item["idItem"];
		//echo $item["idItem"]."<br>";
		$i++;
		}
	$i = 0;	
	$j=0;
	for ($i=0;$i<count($itemes);$i++){
		//print_r($itemes);
		//echo $i."--i-";
		$buscar = (array_keys($itemes, $itemes[$i]));
		//echo print_r($buscar)."·BUSACA";
    	$contador = count($buscar);
		if($contador == 2){
			
			$itemCondiciones[$j] = $itemes[$i];
			$j++;
			}
	//	echo $contador."-".$item[$i]."<------------<br>";
		
		}	
		$itemCondiciones = array_unique($itemCondiciones);
		//print_r($itemCondiciones);
		//print_r($itemCondiciones2);
		//echo "<hr>";
		$totalBuenas = 0;
		$totalTotal = 0;
	foreach($itemCondiciones as $item){
	//	echo $item;
			$cuentaBuenas = cuentaBuenasItemCurso2($rbd,$idNivel,$anoCursoColegio,$item,$letraCursoColegio);
			$cuentaTotal = cuentaTotalItemCurso2($rbd,$idNivel,$anoCursoColegio,$item,$letraCursoColegio);
			
			
			$totalBuenas = $cuentaBuenas + $totalBuenas;
			$totalTotal = $cuentaTotal + $totalTotal;
		
		}
	//	echo "BUENAS ->".$totalBuenas." TODAS ->".$totalTotal."<br>";
		$porcentajeLogro = ($totalBuenas/$totalTotal)*100;
		//echo round($porcentajeLogro)."% Logro";
	
	
	return(round($porcentajeLogro)."% ");
	}	
	
function getCondicionesSesion($idSesion, $idVariableDidactica){
	$idListas =	getIdListasResolucion($idSesion);
	$listasComparadas = "";
	$k =1;
	$largo = count($idListas);
	foreach ($idListas as $idLista){
		$texto = " idLista = ".$idLista["idLista"];
		if($k <= $largo-1){
			$texto = $texto." OR ";
			}
		$k++;	
		$listasComparadas = $listasComparadas." ".$texto." ";
		}
	
	$listasComparadas = $listasComparadas." ) ";	
	$sql = "SELECT * FROM `condicion` a ";
	$sql.="left join lista_Item b on a.idItem=b.idItem left join instanciaVariableDidactica c on a.idInstanciaVariableDidactica = c.idInstanciaVariableDidactica ";
//	$sql.="WHERE ( idLista = ".$idLista." )and a.idVariableDidactica = ".$idVariableDidactica." GROUP BY a.idInstanciaVariableDidactica";
    $sql.="WHERE (".$listasComparadas." and a.idVariableDidactica = ".$idVariableDidactica." GROUP BY a.idInstanciaVariableDidactica";
	
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$itemCondicion[$i] = array( "idInstanciaVariableDidactica" =>$row["idInstanciaVariableDidactica"], 
									"valorInstanciaVariableDidactica" =>$row["valorInstanciaVariableDidactica"]									  
																		  );	
		$i++;
	}
	
	return($itemCondicion);
	}		
	
function getNombreVaribleDidactica($idInstanciaVariableDidactica){
	$sql = "SELECT * FROM instanciaVariableDidactica a left join variableDidactica b on a.idVariableDidactica = b.idVariableDidactica WHERE a.idInstanciaVariableDidactica = ".$idInstanciaVariableDidactica;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreVariableDidactica"]);
	
	}	
	
function matrizXY2($columna,$fila,$idSesion){
   // $condiciones = getItemCondicion2();
	//print_r($condiciones);
    $idListas =	getIdListasResolucion($idSesion);
	//echo $idListas[0]["idLista"]."<-<---";
	$ejeX = getCondicionesSesion($idSesion,$columna);
	$ejeY = getCondicionesSesion($idSesion,$fila);
	//print_r($ejeX);
	$cuentaX = count($ejeX);
	$cuentaY = count($ejeY);
//	echo $cuentaX." ".$cuentaY."<br>";
	//print_r($ejeY);
	$i = 0; ?>
<?php    foreach ($ejeX as $x){ ?>
<?php		foreach ($ejeY as $y){ ?>
			<?php //echo $x["valorInstanciaVariableDidactica"]."-";
			//echo $y["valorInstanciaVariableDidactica"]." <br>";
			$cuenta = getCuentaMatrizXY2($idListas,$x["idInstanciaVariableDidactica"],$y["idInstanciaVariableDidactica"]);
			$datosMatrizXY[$i] = array("cuenta" => $cuenta, "idInstanciaVariableDidacticaX"  => $x["idInstanciaVariableDidactica"], "idInstanciaVariableDidacticaY"  => $y["idInstanciaVariableDidactica"]);
			//echo "<hr>"; 
			$i++;
			//echo $cuenta."XY".$i++."<br>";
			?>
	<?php		} ?>
<?php		} 
?>
	
 <table class="tablesorter">
    <tr>
    <th width="300"><?php 
	$variableX = getNombreVaribleDidactica($ejeX[0]["idInstanciaVariableDidactica"]);
	$variableY = getNombreVaribleDidactica($ejeY[0]["idInstanciaVariableDidactica"]);
	echo $variableX." / ".$variableY;
	?></th>
<?php  
	$k = 0;
	foreach ($ejeY as $y){ // TITULO TABLA EJE X
		echo "<th>".$y['valorInstanciaVariableDidactica']."</th>";
		}
		
	echo "<th>Total</th></tr>";	
	$i = 0;
	
	  foreach ($ejeX as $x){ // CADA CELDA EN VALOR X
		  $j = 0;
		 echo" <tr><th>".$ejeX[$i]["valorInstanciaVariableDidactica"]."</th>";
		
		  foreach ($ejeY as $y){
//			  echo "<td>".$ejeX[$i]["valorInstanciaVariableDidactica"].$ejeY[$j]["valorInstanciaVariableDidactica"].$datosMatrizXY[$k]["cuenta"]."</td>";
			  echo "<td>".$datosMatrizXY[$k]["cuenta"]."</td>";
			  $k++;
			   $j++;
			  }
			  $totalEjeX = getTotalInstanciaDidacticaSesionCurso($ejeX[$i]["idInstanciaVariableDidactica"],$idSesion);
			  
			   echo "<td>".$totalEjeX."</td>"; 
			  $i++;
			
			echo  "</tr>";
		  }
	?>
	</tr>
    <tr>
    <th>Total</th>
    <?php 
	
	foreach ($ejeY as $y){ // TITULO TABLA EJE X
		$totalEjeY = getTotalInstanciaDidacticaSesionCurso($y["idInstanciaVariableDidactica"],$idSesion);	
		echo "<td>".$totalEjeY."</td>";
		}
	?>
    <td>&nbsp;</td>
	   </table>
	
	
<?php	}	

function getTotalInstanciaDidacticaSesionCurso($idInstanciaVariableDidactica,$idSesion){ // recibe una instacia de variable didactica deseada y una sesion y devuelve el % de logro de un curso
	$rbd = $_REQUEST["rbd"];
	$idNivel = $_REQUEST["idNivel"];
	$anoCursoColegio = $_REQUEST["anoCursoColegio"];
	$letraCursoColegio = $_REQUEST["letraCursoColegio"];
	$idListas =	getIdListasResolucion($idSesion);
	$listasComparadas = "";
	$k =1;
	$largo = count($idListas);
	foreach ($idListas as $idLista){
		$texto = " idLista = ".$idLista["idLista"];
		if($k <= $largo-1){
			$texto = $texto." OR ";
			}
		$k++;	
		$listasComparadas = $listasComparadas." ".$texto." ";
		}
	$listasComparadas = $listasComparadas." ) ";	
	$sql = "SELECT * FROM `condicion` a ";
	$sql.="left join lista_Item b on a.idItem=b.idItem left join instanciaVariableDidactica c on a.idInstanciaVariableDidactica = c.idInstanciaVariableDidactica ";
    $sql.="WHERE (".$listasComparadas." and a.idInstanciaVariableDidactica = ".$idInstanciaVariableDidactica;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){ // GUARDO TODOS LOS ITEMES CON ESA INSTANVIA DE VARIABLE DIDACTICA EN EL ARREGLO ITEMCONDICION de todas las listas
		$listaItemCondicion[$i] = array( "idInstanciaVariableDidactica" =>$row["idInstanciaVariableDidactica"], 
									"valorInstanciaVariableDidactica" =>$row["valorInstanciaVariableDidactica"]	,
									"idItem" => $row["idItem"]
																		  );	
		$i++;
	}
	$totalBuenas = 0;
	$totalTotal = 0;
	foreach($listaItemCondicion as $item){
			$cuentaBuenas = cuentaBuenasItemCurso2($rbd,$idNivel,$anoCursoColegio,$item["idItem"],$letraCursoColegio);
			$cuentaTotal = cuentaTotalItemCurso2($rbd,$idNivel,$anoCursoColegio,$item["idItem"],$letraCursoColegio);
			$totalBuenas = $cuentaBuenas + $totalBuenas;
			$totalTotal = $cuentaTotal + $totalTotal;
		
		}
	
		$porcentajeLogro = ($totalBuenas/$totalTotal)*100;
		return(round($porcentajeLogro)."%");
	
	
	
	
	}

function cuentaBuenasItemCurso2($rbd,$idNivel,$anoCursoColegio,$item,$letraCursoColegio){
	$sql = "SELECT count(puntajeRespuesta) as total FROM `asignacionSesionUsuario` a left join respuesta b on a.idUsuario = b.idUsuario ";
	$sql.= " WHERE rbdColegio = ".$rbd." AND idNivel = ".$idNivel." AND anoCursoColegio = ".$anoCursoColegio."  AND  puntajeRespuesta = 2 AND letraCursoColegio = '";
	$sql.= $letraCursoColegio."' AND (idItem = ".$item.")";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["total"];
	
	}
function cuentaTotalItemCurso2($rbd,$idNivel,$anoCursoColegio,$item,$letraCursoColegio){
	$sql = "SELECT count(puntajeRespuesta) as total FROM `asignacionSesionUsuario` a left join respuesta b on a.idUsuario = b.idUsuario ";
	$sql.= " WHERE rbdColegio = ".$rbd." AND idNivel = ".$idNivel." AND anoCursoColegio = ".$anoCursoColegio."  AND letraCursoColegio = '";
	$sql.= $letraCursoColegio."' AND (idItem = ".$item.")";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["total"];
	
	}	

function cuentaBuenasItemCurso($rbd,$idNivel,$anoCursoColegio,$item,$idLista,$letraCursoColegio){
	$sql = "SELECT count(puntajeRespuesta) as total FROM `asignacionSesionUsuario` a left join respuesta b on a.idUsuario = b.idUsuario ";
	$sql.= " WHERE rbdColegio = ".$rbd." AND idNivel = ".$idNivel." AND anoCursoColegio = ".$anoCursoColegio." AND idLista = ".$idLista." AND  puntajeRespuesta = 2 AND letraCursoColegio = '";
	$sql.= $letraCursoColegio."' AND (idItem = ".$item.")";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["total"];
	
	}
function cuentaTotalItemCurso($rbd,$idNivel,$anoCursoColegio,$item,$idLista,$letraCursoColegio){
	$sql = "SELECT count(puntajeRespuesta) as total FROM `asignacionSesionUsuario` a left join respuesta b on a.idUsuario = b.idUsuario ";
	$sql.= " WHERE rbdColegio = ".$rbd." AND idNivel = ".$idNivel." AND anoCursoColegio = ".$anoCursoColegio." AND idLista = ".$idLista."  AND letraCursoColegio = '";
	$sql.= $letraCursoColegio."' AND (idItem = ".$item.")";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["total"];
	
	}



////FIN INFORME RESULTADOS///////////////////////////////////////////////


function getDatosSesion($idSesion){
	$sql = "SELECT * FROM sesionLaboratorio WHERE idSesionLaboratorio = ".$idSesion;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if(count($row)>0){
						$sesion = array( "idLaboratorio" => $row["idLaboratorio"],
										  "nombreSesionLaboratorio" => $row["nombreSesionLaboratorio"],
										  "anteriorSesionLaboratorio" => $row["ses_idSesionLaboratorio"],
										  "idSesionLaboratorio" => $row["idSesionLaboratorio"],
										  "tipoSesionLaboratorio" => $row["tipoSesionLaboratorio"] );
			 }else{
				 $sesion = 0; 
				 
				 
				 }
			
	
	return($sesion);
	
}


	

function getLaboratorios(){
	$sql = "SELECT * FROM laboratorio";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$laboratorios[$i] = array( "idLaboratorio" =>$row["idLaboratorio"],
					  "nombreLaboratorio" => $row["nombreLaboratorio"]);	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($laboratorios);
	
}

function getDatosLaboratorio($idLaboratorio){
	$sql = "SELECT * FROM laboratorio WHERE idLaboratorio = ".$idLaboratorio;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$laboratorios[$i] = array( "idLaboratorio" =>$row["idLaboratorio"],
					  "nombreLaboratorio" => $row["nombreLaboratorio"]);	
	$i++;
	}
	
	//print_r($idListas);
	return($laboratorios);
	
}




// Table Colegio

function getAlumnosCurso($rbd,$idNivel,$anoCursoColegio,$letraCursoColegio){
	$sql = "SELECT b.loginUsuario,b.rutAlumno,c.nombreAlumno,c.estadoAlumno,c.apellidoPaternoAlumno,c.apellidoMaternoAlumno,b.idUsuario FROM `matricula` a join usuario b on a.rutAlumno = b.rutAlumno join alumno c on a.rutAlumno = c.rutAlumno ";
	$sql.= " WHERE a.rbdColegio = ".$rbd." AND a.idNivel = ".$idNivel." AND a.anoCursoColegio = ".$anoCursoColegio." AND a.letraCursoColegio = "."'$letraCursoColegio'"." ORDER BY c.apellidoPaternoAlumno DESC";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$alumnosCurso[$i]= array( "idUsuario" =>$row["idUsuario"],
					  "usuario" => $row["loginUsuario"],
					  "rutAlumno" => $row["rutAlumno"],
					  "nombreAlumno" => $row["nombreAlumno"],
					  "apellidoPaternoAlumno" => $row["apellidoPaternoAlumno"],
					  "estadoAlumno" => $row["estadoAlumno"],
					  "apellidoMaternoAlumno" => $row["apellidoMaternoAlumno"]
					  );	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	
	
	return($alumnosCurso);
	
	}
	
function getUsuarios(){
	$sql = "SELECT * FROM usuario ";
	//secho $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$usuarios[$i]= array( "idUsuario" =>$row["idUsuario"],
					  "usuario" => $row["loginUsuario"],
					  "tipoUsuario" => $row["tipoUsuario"],
					  "ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"]);	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($usuarios);
	
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



////

function getCursosColegio($rbdColegio){
	$sql = "SELECT * FROM cursoColegio a left join profesor b on a.rutProfesor = b.rutProfesor left join nivel c on a.idNivel = c.idNivel WHERE a.rbdColegio = ".$rbdColegio." AND a.anoCursoColegio = YEAR(NOW())";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	
	$cursos[$i] = array( 
						"rbdColegio" => $row["rbdColegio"],
						"anoCursoColegio" => $row["anoCursoColegio"],
					  "letraCursoColegio" => $row["letraCursoColegio"],
					  "idNivel" => $row["idNivel"],
					  "rutProfesor" => $row["rutProfesor"],
					  "nombreNivel" => $row["nombreNivel"],
					  "nombreProfesor" => $row["nombreProfesor"],
					   "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"]
						);	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	
	//print_r($idListas);
	return($cursos);
	
	}
function getCursos(){
	$sql = "SELECT * FROM cursoColegio a left join profesor b on a.rutProfesor = b.rutProfesor left join nivel c on a.idNivel = c.idNivel ";
	
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	
	$cursos[$i] = array( "anoCursoColegio" => $row["anoCursoColegio"],
					  "letraCursoColegio" => $row["letraCursoColegio"],
					  "idNivel" => $row["idNivel"],
					  "rutProfesor" => $row["rutProfesor"],
					  "nombreNivel" => $row["nombreNivel"],
					  "nombreProfesor" => $row["nombreProfesor"],
					   "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
					   "rbdColegio" => $row["rbdColegio"]
						);	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($cursos);
	
	}
		
	
	
function getProfesoresColegio($rbdColegio){
	$sql = "SELECT * FROM profesor WHERE rbdColegio = ".$rbdColegio;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	
	$profesores[$i] = array( "nombreProfesor" => $row["nombreProfesor"],
					  "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
					  "apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
					  "sexoProfesor" => $row["sexoProfesor"],
					  "fechaNacimientoProfesor" => $row["fechaNacimientoProfesor"],
					  "telefonoProfesor" => $row["telefonoProfesor"],
					   "emailProfesor" => $row["emailProfesor"],
					   "anosExperienciaProfesor" => $row["anosExperienciaProfesor"],
					   "asignaturaACargoProfesor" => $row["asignaturaACargoProfesor"],
					   "coordinadorEnlaceProfesor" => $row["coordinadorEnlaceProfesor"],
					   "rutProfesor" => $row["rutProfesor"]
						);	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($profesores);
	
	}	




function getDatosAlumnoUsuario($idUsuario){
		$sql = "SELECT * FROM `usuario` usuario left join alumno alumno on usuario.rutAlumno = alumno.rutAlumno WHERE usuario.idUsuario ='$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		
		$datos = array(
			"rutAlumno" => $row["rutAlumno"],
			"tipoAlumno" => $row["tipoAlumno"],
			"nombreAlumno" => $row["nombreAlumno"],
			"apellidoPaternoAlumno" => $row["apellidoPaternoAlumno"],
			"apellidoMaternoAlumno" => $row["apellidoMaternoAlumno"],
			"sexoAlumno" => $row["sexoAlumno"],
			"fechaNacimientoAlumno" => $row["fechaNacimientoAlumno"],
			"estadoAlumno" => $row["estadoAlumno"],
			"emailUsuario" => $row["emailUsuario"],
			"imagenUsuario" => $row["imagenUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"]
		);
		return ($datos);
}	


function getDatosAlumno($rutAlumno){
	
	$sql = "SELECT * FROM  alumno a LEFT JOIN matricula b ON a.rutAlumno = b.rutAlumno WHERE a.rutAlumno = "."'$rutAlumno'";
	//echo $sql;
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res)){
	$alumno = array( "nombreAlumno" => $row["nombreAlumno"],
					  "apellidoPaternoAlumno" => $row["apellidoPaternoAlumno"],
					  "apellidoMaternoAlumno" => $row["apellidoMaternoAlumno"],
					  "sexoAlumno" => $row["sexoAlumno"],
					  "fechaNacimientoAlumno" => $row["fechaNacimientoAlumno"],
					   "rutAlumno" => $row["rutAlumno"],
					   "tipoAlumno" => $row["tipoAlumno"],
					   "anoCursoColegio" => $row["anoCursoColegio"],
					      "rbdColegio" => $row["rbdColegio"],
						     "idNivel" => $row["idNivel"],
							    "anoCursoColegio" => $row["anoCursoColegio"],
								   "letraCursoColegio" => $row["letraCursoColegio"]
					   
	

					   );	
	}
	return($alumno);
}

function getDatosProfesor($rutProfesor){
	$sql = "SELECT * FROM profesor WHERE rutProfesor = "."'$rutProfesor'";
//	echo $sql;
	$res = mysql_query($sql);
	
	while ($row = mysql_fetch_array($res)){
	$profesor = array( "nombreProfesor" => $row["nombreProfesor"],
					  "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
					  "apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
					  "sexoProfesor" => $row["sexoProfesor"],
					  "fechaNacimientoProfesor" => $row["fechaNacimientoProfesor"],
					  "telefonoProfesor" => $row["telefonoProfesor"],
					   "emailProfesor" => $row["emailProfesor"],
					   "anosExperienciaProfesor" => $row["anosExperienciaProfesor"],
					   "asignaturaACargoProfesor" => $row["asignaturaACargoProfesor"],
					   "coordinadorEnlaceProfesor" => $row["coordinadorEnlaceProfesor"],
					   "rutProfesor" => $row["rutProfesor"]
						);	
		
	}
	//print_r($idListas);
	return($profesor);
	
	}		
	
function getProfesores(){
	$sql = "SELECT * FROM profesor ";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	
	$profesores[$i] = array( "nombreProfesor" => $row["nombreProfesor"],
					  "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
					  "apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"],
					  "sexoProfesor" => $row["sexoProfesor"],
					  "fechaNacimientoProfesor" => $row["fechaNacimientoProfesor"],
					  "telefonoProfesor" => $row["telefonoProfesor"],
					   "emailProfesor" => $row["emailProfesor"],
					   "anosExperienciaProfesor" => $row["anosExperienciaProfesor"],
					   "asignaturaACargoProfesor" => $row["asignaturaACargoProfesor"],
					   "coordinadorEnlaceProfesor" => $row["coordinadorEnlaceProfesor"],
					   "rutProfesor" => $row["rutProfesor"]
						);	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($profesores);
	
	}





function getNiveles(){
	$sql = "SELECT * FROM nivel ";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	
	$niveles[$i] = array( "idNivel" => $row["idNivel"],
					  "nombreNivel" => $row["nombreNivel"]
						);	
	$i++;
	
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($niveles);
	
	}

?>
