<?php 

require("inc/incluidos.php"); 

function buscaPautaItem($idUsuario, $idLista)
{
	$sql = "SELECT idPautaItem FROM pautaItem WHERE idUsuario = ".$idUsuario." AND idLista = ".$idLista;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return $row[0];
}


function actualizaPuntaje($idUsuario,$idItem,$puntaje,$idLista) {
	$execute = true;
	$sql = "SELECT puntajeRespuestaItem FROM respuestaItem WHERE idUsuario = ".$idUsuario." AND idItem = ".$idItem;
	$res = mysql_query($sql);
	if($row = mysql_fetch_row($res)){
		if ($puntaje == "") {
			$sql = "UPDATE `respuestaItem` SET `puntajeRespuestaItem` = NULL WHERE `idItem` = '$idItem' AND `idUsuario` = '$idUsuario';";
		}else {
			$sql = "UPDATE `respuestaItem` SET `puntajeRespuestaItem` = $puntaje WHERE `idItem` = '$idItem' AND `idUsuario` = '$idUsuario';";			
		}
		if ($row[0] == $puntaje) {
			return false;
		}
	} else {
		if ($puntaje != "") {
			$pauta = buscaPautaItem($idUsuario,$idLista);
			$sql = "INSERT INTO respuestaItem(idItem, idLista, idUsuario, idPautaItem, 	puntajeRespuestaItem)VALUES($idItem,$idLista,$idUsuario,$pauta,$puntaje) ";
		} else {
			return false;			
		}
	}
	
	if ($execute) {
		$res = mysql_query($sql);
		if (!$res) {
	    		die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
		} 
		return true;
	}
}
	
function actualizaPuntajeTotal($idUsuario,$puntaje,$idPauta,$porcentajeLogro)
{
	if($puntaje !== NULL || $puntaje != 'NULL')
	{
		$sql = "UPDATE pautaItem"; 
		$sql .= " SET `resultadoListaPautaItem` = '$puntaje', porcentajeLogroPautaItem = $porcentajeLogro"; 
		$sql .= " WHERE `idUsuario` = '$idUsuario' and idPautaItem = $idPauta;";
	} else {
		$sql = "UPDATE pautaItem"; 
		$sql .= " SET `resultadoListaPautaItem` = NULL, porcentajeLogroPautaItem = NULL"; 
		$sql .= " WHERE `idUsuario` = '$idUsuario' and idPautaItem = $idPauta;";
	}

	$res = mysql_query($sql);
	if (!$res) {
		die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}
}
	
function getPuntajeItem($idItem)
{
	$sql = "SELECT puntajeItem FROM item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$puntajeItem = mysql_fetch_row($res);
	return($puntajeItem[0]);
}

function saveResultCourse($rbdColegio, $idNivel, $anoCurso, $letra, $idLista, $ptTotal, $ptObtenido) {
	$sql = "SELECT id FROM  resultadosCurso WHERE rbdColegio = '".$rbdColegio."' AND idNivel = ". $idNivel." AND anoCurso = ". $anoCurso." AND letra = '". $letra."' AND idLista = ". $idLista.";";
	$res = mysql_query($sql);
	
	if($row = mysql_fetch_row($res)){
		$sql = "UPDATE  resultadosCurso"; 
		$sql .= " SET puntosTotal = $ptTotal, puntosObtenidos = $ptObtenido"; 
		$sql .= " WHERE id =".$row[0];
	}else {
		$sql = "INSERT INTO  resultadosCurso(rbdColegio, idNivel, anoCurso, letra, idLista, puntosTotal, puntosObtenidos)VALUES('$rbdColegio', $idNivel, $anoCurso, '$letra', $idLista, $ptTotal, $ptObtenido) ";
	}
	
	$res = mysql_query($sql);
	if (!$res) {
    		die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	} 
	return true;
}
	
$idItems = $_REQUEST["itemes"];
$usuarios = $_REQUEST["usuarios"];
$pautas = $_REQUEST["pauta"];
$idLista = $_REQUEST["idLista"];
$rbdColegio = $_REQUEST["rbdColegio"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$idNivel = $_REQUEST["idNivel"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];


$puntajeTotal = 0;
foreach ($idItems as $idItem) {
	$puntajeTotal = $puntajeTotal + getPuntajeItem($idItem);
}

$flag = 0;
$puntajeTotalCurso = $puntajeTotal * count($usuarios);
$puntajeObtenidoCurso = 0;

for($i=0;$i<count($usuarios);$i++){
	$j = 0;
	$cambioPuntaje = false;
	$puntajeNulo = false;
	$item = $_REQUEST["sel".$usuarios[$i]];
	$puntajeAlumno = 0;
	foreach($idItems as $idItem){
		if ($item[$j] == '') {
			$puntajeNulo = true;
		}
		if(actualizaPuntaje($usuarios[$i],$idItem,$item[$j],$idLista)){
			$cambioPuntaje = true;
		}
		$puntajeAlumno = $puntajeAlumno+$item[$j];
		$j++;
	}
	$puntajeObtenidoCurso += $puntajeAlumno;
	if ($cambioPuntaje) {		
		if ($puntajeNulo) {
			actualizaPuntajeTotal($usuarios[$i], 'NULL', $pautas[$i], 'NULL');
		} else {
			$porcentajeLogro = (($puntajeAlumno/$puntajeTotal)*100);
			actualizaPuntajeTotal($usuarios[$i],$puntajeAlumno,$pautas[$i],round($porcentajeLogro));
		}
	}
}


$inputEmpty = $_REQUEST["inputEmpty"];

if ($inputEmpty == 1) {
	info("Sus puntajes han sido guardados, aún faltan puntajes por ingresar.");
	// saveResultCourse($rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio, $idLista, 'NULL', 'NULL');
} else {
	saveResultCourse($rbdColegio, $idNivel, $anoCursoColegio, $letraCursoColegio, $idLista, $puntajeTotalCurso, $puntajeObtenidoCurso);
	if (isset($_REQUEST['finaliza'])) {
		?>
		<script type="text/javascript">
			location.href="./informeEvaluacion.php";
		</script>
		<?php
	}
	info("Todos los puntajes han sido guardados con éxito, en la opción ver informes encontrará los resultados.");	
}

?>