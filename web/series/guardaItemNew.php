<?php
ini_set("display_errors","on");
session_start();
include "../inc/conecta.php";
include "../inc/_funciones.php";
Conectarse_seg();

?>
<link rel="stylesheet" href="css/estilo.css" type="text/css" >
<?php

function getPuntajeByItem ($idItem) {
	print_r($idItem);
	$sql = "select puntajeItem from item WHERE idItem = ".$idItem["idItem"];
	echo $sql;
	$res = mysql_query($sql);
	$puntaje = 1; // Predeterminado
	while ($row = mysql_fetch_array($res)) {
		$puntaje = $row["puntajeItem"];
	}
	return $puntaje;
}

function getAlternativasByItem($idItem){
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
								"esImagenAlternativaItem"=> $row["esImagenAlternativaItem"],
								"tipoCampo"=> $row["tipoCampo"],
								"funcionEvaluadora"=> $row["funcionEvaluadora"],
								"entero"=> $row["entero"],
								"entero2"=> $row["entero2"],
								"numerador"=> $row["numerador"],
								"numerador2"=> $row["numerador2"],
								"denominador"=> $row["denominador"],
								"denominador2"=> $row["denominador2"],
								"puntaje"=> $row["puntaje"]
								);
	$i++;
	}
	return($alternativas);
}




function getRespuestaAbiertaItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuestaCorrectaAbierta = $row["respuestaCorrectaItem"];
	return($respuestaCorrectaAbierta);
}

function getSeleccionada($respuesta){
	$sql = "select * from alternativaItem WHERE idAlternativaItem = ".$respuesta;
	//echo $sql;
	$res = mysql_query($sql);
	@$row = mysql_fetch_array($res);
	$valorSeleccionada = $row["nombreAlternativaItem"];
	return($valorSeleccionada);
}



function getCorrecta($idItem){
	$sql = "SELECT * FROM alternativaItem";
	$sql.= " WHERE idItem = ".$idItem." and esCorrectaAlternativaItem = 1";
//	echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$alternativaCorrecta= array( "idAlternativaItem" =>$row["idAlternativaItem"],
								"nombreAlternativaItem" => $row["nombreAlternativaItem"]);

	return($alternativaCorrecta);
}


function getRespuestaCerradaItem($idItem){
	$sql = "select * from item WHERE idItem = ".$idItem;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$etiquetaCorrecta = getCorrecta($idItem);
	return($etiquetaCorrecta);
}


function setRespuesta($idItem,$idUsuario,$idLista,$idPauta,$opcionSeleccionada,$valorSeleccionada,$opcionCorrecta,$valorCorrecta,$puntos){

	$sql_insert = "INSERT INTO `respuestaItem` ( `idItem` , `idRespuestaItem`, `idLista` ,  `idPautaItem` , `idUsuario` ,`valorSeleccionadaItem` ,  `opcionSeleccionadaItem`  , `valorCorrectaItem`,`opcionCorrectaItem` , `puntajeRespuestaItem` )";
	$sql_insert .= " VALUES ( '$idItem', '' , '$idLista', '$idPauta', '$idUsuario',  '$valorSeleccionada', '$opcionSeleccionada',  '$valorCorrecta',  '$opcionCorrecta', '$puntos')";
	$res = mysql_query($sql_insert);
	if (!$res) {
    	die('Error en la consulta SQL: <br><b>'.$sql_insert.'</b><br>'. mysql_error());
	}
	//echo $sql_insert;
}

function cambiarFraccionADecimal($fraccion){ // fraccion 0 1/2
    //echo "<br>".$fraccion."<------FR";
	$numeros = explode(" ",$fraccion);  // $numeros[0] = Entero
	$numeroEntero = $numeros[0];
	$fraccion = explode("/",$numeros[1]);
	@$decimal = (($numeroEntero*$fraccion[1])+$fraccion[0])/$fraccion[1];
	return($decimal);
	}

function cambiarDecimalComaADecimalPunto($decimalComa){ // fraccion 0 1/2
    //echo "<br>".$fraccion."<------FR";
	$decimalPunto = str_replace(",",".",$decimalComa);
	return($decimalPunto);
	}

function muestraFraccion($fraccion){
	//echo $fraccion;
	$numeros = explode(" ",$fraccion);  // $numeros[0] = Entero
	$numeroEntero = $numeros[0];
	//print_r($numeros);

	$fraccion = explode("/",$numeros[1]);
	if($numeroEntero == 0){
		$numeroEntero = " ";
		}
	echo "<table border='0' id='tablaFraccion'><tr><td class='numeroEntero'>".$numeroEntero."</td><td><table><tr><td class='numeroFraccion'>".$fraccion[0]."</td></tr><tr><td><hr /></td></tr><tr><td class='numeroFraccion'>".$fraccion[1]."</td></tr></td></tr></table></td></tr></table>";


	}

function muestraInputFraccion(){
	//echo $fraccion;
	$numeros = explode(" ",$fraccion);  // $numeros[0] = Entero
	$numeroEntero = $numeros[0];
	//print_r($numeros);

	$fraccion = explode("/",$numeros[1]);
	if($numeroEntero == 0){
		$numeroEntero = " ";
		}
	echo "<table border='0' id='tablaFraccion'><tr><td><input name='Entero' type='text' size='1'  class='numeroEntero'  /></td><td><table><tr><td><input name='Num' type='text' size='3'  class='numeroFraccion'/></td></tr><tr><td><hr /></td></tr><tr><td><input name='Den' type='text' size='3' class='numeroFraccion'/></td></tr></td></tr></table></td></tr></table>";


	}




function evaluaIntervalo($minimo,$maximo, $numero){
	if (($numero > $minimo) && ($numero < $maximo)){
		//alerta("Respuesta buena".$numero);
		return(true);

	}else{
		//alerta("Respuesta mala".$numero);
		return(false);
	}

}


function igualNormal($correct, $response) {
	$return = true;
	if ($correct['entero'] != $response['entero']) {
		$return = false;
	}
	return $return;
}

function igualFraccion($correct, $response) {
	$return = true;
	if ($correct['numerador'] != $response['numerador']) {
		$return = false;
	}
	if ($correct['denominador'] != $response['denominador']) {
		$return = false;
	}
	return $return;

}

function igualMixto($correct, $response) {
	$return = true;
	if ($correct['numerador'] != $response['numerador']) {
		$return = false;
	}
	if ($correct['denominador'] != $response['denominador']) {
		$return = false;
	}
	if ($correct['entero'] != $response['entero']) {
		$return = false;
	}
	return $return;
}

function intervaloNormal($correct, $response) {
	$return = 0;
	if ($correct['entero'] < $response['entero'] && $correct['entero2'] > $response['entero']) {
		$return = 1;
	}
	echo "<br>min: ".$correct['entero']." max: ".$correct['entero2'] ." res: ".$response['entero']."<br>";
	return $return;
}

function intervaloFraccion($correct, $response) {
	$return = 0;
	$min = $correct['numerador'] / $correct['denominador'];
	$max = $correct['numerador2'] / $correct['denominador2'];
	$res = $response['numerador'] / $response['denominador'];

	if ($min < $res && $max > $res) {
		$return = 1;
	}
	echo "<br>min: ".$min." max: ".$max." res: ".$res."<br>";
	return $return;
}

function intervaloMixto($correct, $response) {
	$return = 0;
	$min = $correct['entero'] + ($correct['numerador'] / $correct['denominador']);
	$max = $correct['entero2'] + ($correct['numerador2'] / $correct['denominador2']);
	$res = $response['entero'] + ($response['numerador'] / $response['denominador']);

	if ($min < $res && $max > $res) {
		$return = 1;
	}
	echo "<br>min: ".$min." max: ".$max." res: ".$res."<br>";

	return $return;
}



function valoEquivalenteNormal($correct, $response) {
	$return = 0;
	if ($correct['entero'] == $response['entero']) {
		$return = 1;
	}
	return $return;
}

function valoEquivalenteFraccion($correct, $response) {
	$return = 0;
	$cor = $correct['numerador'] / $correct['denominador'];
	$res = $response['numerador'] / $response['denominador'];

	if ($cor == $res) {
		$return = 1;
	}

	return $return;
}

function valoEquivalenteMixto($correct, $response) {
	$return = 0;
	$cor = $correct['entero'] + ($correct['numerador'] / $correct['denominador']);
	$res = $response['entero'] + ($response['numerador'] / $response['denominador']);

	if ($cor == $res) {
		$return = 1;
	}
	return $return;
}



//echo cambiarFraccionADecimal("5 1/2");


//echo muestraFraccion("5 1/2");

//echo muestraInputFraccion();





$idUsuario = $_SESSION["sesionIdUsuario"];
$lista = $_SESSION["listaResolucion"];
$idLista = $_SESSION["idLista"];
$idPauta = $_SESSION["idPauta"];

//print_r($lista);
echo "<br>";
echo "<br>";
echo "<br>";


$j = $_SESSION["indice"];



//echo "-->".$idPauta."<-----------IDPAUTA--------";
//echo "--->".$_POST["omite"]."<---";
$cantidadRespuestasItem = $_REQUEST["cantidadRespuestasItem"];
$esAbierto = $_REQUEST["esAbierto"];
$tiempo = $_REQUEST["tiempo"];
$_SESSION["tiempo"] = $tiempo;
$idItem = $lista[$j];
//print_r($idItem);
$puntaje=0;
echo "<br><br><br>";
//echo "hola";
// EVALUA TIPO DE PREGUNTA
	@$respuesta = "";
	if ($esAbierto == 1){
		$opcionSeleccionada = '';
		$valorSeleccionada = '{';
		$opcionCorrecta = '';
		$valorCorrecta = '';
		$respuestas = $_REQUEST;
		// echo '<pre>';
		// print_r($_REQUEST);
		// echo '</pre>';
		//Acá evaluo la respuesta
		$alternativas = getAlternativasByItem($idItem["idItem"]);
		$pr = 0;
		foreach ($alternativas as $key => $alternativa) {
			// echo '<pre>';
			// print_r($alternativa);
			// echo '</pre>';
			$correcto = true;
			if ($alternativa['funcionEvaluadora'] == 'igual') {
				switch ($alternativa['tipoCampo']) {
					case 'normal':
						$respuesta = array('entero' => $respuestas['entero'][$pr]);
						$correcto = igualNormal($alternativa, $respuesta);
						break;

					case 'numerico':
						$respuesta = array('entero' => $respuestas['entero'][$pr]);
						$correcto = igualNormal($alternativa, $respuesta);
						break;

					case 'fraccion':
						$respuesta = array('numerador' => $respuestas['numerador'][$pr], 'denominador' => $respuestas['denominador'][$pr]);
						$correcto = igualFraccion($alternativa, $respuesta);
						break;

					case 'numeroMixto':
						$respuesta = array('numerador' => $respuestas['numerador'][$pr], 'denominador' => $respuestas['denominador'][$pr], 'entero' => $respuestas['entero'][$pr]);
						$correcto = igualMixto($alternativa, $respuesta);
						break;
				}
			}
			if ($alternativa['funcionEvaluadora'] == 'intervalo') {
				switch ($alternativa['tipoCampo']) {
					case 'normal':
						$respuesta = array('entero' => $respuestas['entero'][$pr]);
						$correcto = intervaloNormal($alternativa, $respuesta);
						break;

					case 'numerico':
						$respuesta = array('entero' => $respuestas['entero'][$pr]);
						$correcto = intervaloNormal($alternativa, $respuesta);
						break;

					case 'fraccion':
						$respuesta = array('numerador' => $respuestas['numerador'][$pr], 'denominador' => $respuestas['denominador'][$pr]);
						$correcto = intervaloFraccion($alternativa, $respuesta);
						break;

					case 'numeroMixto':
						$respuesta = array('numerador' => $respuestas['numerador'][$pr], 'denominador' => $respuestas['denominador'][$pr], 'entero' => $respuestas['entero'][$pr]);
						$correcto = intervaloMixto($alternativa, $respuesta);
						break;
				}
			}
			if ($alternativa['funcionEvaluadora'] == 'valorEquivalente') {
				switch ($alternativa['tipoCampo']) {
					case 'normal':
						$respuesta = array('entero' => $respuestas['entero'][$pr]);
						$correcto = valoEquivalenteNormal($alternativa, $respuesta);
						break;

					case 'numerico':
						$respuesta = array('entero' => $respuestas['entero'][$pr]);
						$correcto = valoEquivalenteNormal($alternativa, $respuesta);
						break;

					case 'fraccion':
						$respuesta = array('numerador' => $respuestas['numerador'][$pr], 'denominador' => $respuestas['denominador'][$pr]);
						$correcto = valoEquivalenteFraccion($alternativa, $respuesta);
						break;

					case 'numeroMixto':
						$respuesta = array('numerador' => $respuestas['numerador'][$pr], 'denominador' => $respuestas['denominador'][$pr], 'entero' => $respuestas['entero'][$pr]);
						$correcto = valoEquivalenteMixto($alternativa, $respuesta);
						break;
				}
			}
			if ($correcto) {
				$puntaje += $alternativa['puntaje'];
			}
			$pr++;

			if ($key != 0) {
				$valorSeleccionada .= ", ";
			}

			$valorSeleccionada .= "preg".$key.": {";

			$coma = false;
			foreach ($respuesta as $n => $v) {
				if (!$coma) {
					$coma = true;
				} else {
					$valorSeleccionada .= ", ";
				}
				$valorSeleccionada .= $n.": ".$v."";
			}

			$valorSeleccionada .= "}";

			// echo $puntaje." R:";
			// echo $correcto." correcto  o no <br>";
		}
		$valorSeleccionada .= "}";


	}else{ // RESPUESTA CERRADA
		$respuesta = $_REQUEST["respuesta"];
		$respuestaCerrada = getRespuestaCerradaItem($idItem["idItem"]);
		$valorCorrecta = $respuestaCerrada["nombreAlternativaItem"];
		$opcionCorrecta = $respuestaCerrada["idAlternativaItem"];
		//echo $opcionCorrecta;
		$opcionSeleccionada = $respuesta;
		$valorSeleccionada = getSeleccionada($respuesta);
		if (@$opcionCorrecta == $respuesta){
			$correcta = 1;
			$puntaje= getPuntajeByItem($idItem);
			// alerta("Respuesta Buena ".$puntaje);
		}else{
		    $correcta = 0;
			//alerta("Respuesta Mala ");
			$puntaje = 0;
		}
	} // FIN RESPUESTA ABIERTA O CERRADA

	//echo $puntaje." : Punto(s)";
	//Evalua Nº de item y respuesta


	$_SESSION["puntajes"][$j] = $puntaje;

	$j++;
	$puntos = $puntaje; // rescatar puntaje pregunta get puntaje.
	//echo "---------------------->".$puntos;
	setRespuesta($idItem["idItem"],$idUsuario,$idLista,$idPauta,$opcionSeleccionada,$valorSeleccionada,$opcionCorrecta,$valorCorrecta,$puntos);
	$_SESSION["indice"] = $j;
	// FIN EVALUA RESPUESTA
	// echo "<br><br>";
	//EVALUA FIN DE LA LISTA
	$total = $_SESSION["puntajeTotal"];
	$_SESSION["listaResolucion"] =$lista;
	$total = $total + $puntos;
	$_SESSION["puntajeTotal"] = $total;
	//echo $_SESSION["puntajeTotal"]." <--TOTAL-<br>";
	$idsListas = $_SESSION["idsListas"];

	// echo $_SESSION["maximoLista"];
	if ($j == $_SESSION["maximoLista"]){

		//$porcentaje = $_SESSION["puntajeTotal"]/(($j)*2);
		//actualizaPauta($idPauta,$tiempo,@$resultado,$porcentaje);
        dirigirse_a("finNew.php");
	}

 	dirigirse_a("itemNew.php");
	echo '<a href="item.php">Siguiente</a>';



	// FIN EVALUA FIN DE LA LISTA
//print_r($lista);
?>

<a href="itemNew.php">item</a>
