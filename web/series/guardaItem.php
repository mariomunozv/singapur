<?php
ini_set("display_errors","on");
session_start();
include "../inc/conectav10.php";
include "../inc/_funciones.php";
Conectarse();

?>
<link rel="stylesheet" href="css/estilo.css" type="text/css" >
<?php



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
$idItem = $lista[$j];
//print_r($idItem);
$puntaje=0;
echo "<br><br><br>";
//echo "hola";
// EVALUA TIPO DE PREGUNTA
	@$respuesta = "";
	if ($esAbierto == 1){ 
			for ($i=0;$i<$cantidadRespuestasItem;$i++){
				
				if ($_REQUEST["tipoR".$i] == "F" || $_REQUEST["tipoR".$i] == "FI"){ 
					$campo = "respuesta".$i;
					$campo2 = "Entero".$i;
					if ($_REQUEST[$campo2] == ""){
						$entero = 0;
					}else{
						$entero = $_REQUEST[$campo2];	
					}
					
					$campo3 = "Denominador".$i;
					if ($i<$cantidadRespuestasItem-1){
						@$respuesta .= $entero." ".$_REQUEST[$campo]."/".$_REQUEST[$campo3]."***";
					}else{
						@$respuesta .= $entero." ".$_REQUEST[$campo]."/".$_REQUEST[$campo3];
					}
											
				}
				if ($_REQUEST["tipoR".$i] == "D" || $_REQUEST["tipoR".$i] == "DecEq" || $_REQUEST["tipoR".$i] == "Digito" || $_REQUEST["tipoR".$i] == "DI" ){ 
					$campo = "respuesta".$i;
					@$respuesta .= $_REQUEST["respuesta".$i]."***";
					alerta($respuesta);
				}
			}
			
			/// EVALUA RESPUESTAS
			//echo "<br>br>".$idItem["cantidadRespuestasItem"]."<br><br><br>".$idItem["puntajeItem"]."PUNTAJE";
			$respuestaAbierta = getRespuestaAbiertaItem($idItem["idItem"]);
			$valorCorrecta = $respuestaAbierta;
			$opcionCorrecta = NULL;
			$opcionSeleccionada = NULL;
			@$valorSeleccionada = $respuesta;
			
			$respuestas = explode("***",$respuesta);
			$respuestasCorrectas = explode(";",$idItem["respuestaCorrectaItem"]);
			$puntajesCorrectas = explode(";",$idItem["puntajeItem"]);
			
			//print_r($respuestas);
			//print_r($respuestasCorrectas);
			//echo $_REQUEST["tipoR1"];
			
			$minimo = 0;
			$maximo = 0;
			$respuestaDecimal = 0;
			$respuestaCorrectaDecimal =0;
			
			// Variables para concatener la respuesta que se arma de varios digitos
			$valorDigitoCorrecto = "";
			$respuestaDigito = "";
			
			for ($i=0;$i<$cantidadRespuestasItem;$i++){ // PARA CADA RESPUESTA
				
				if($_REQUEST["tipoR".$i] == "FI"){ //caso fraccion intervalo
					$intervalo = explode("*",$respuestasCorrectas[$i]);
					echo "<br><br>";
					$valoresIntervalo = explode("-",$intervalo[1]);
					$fraccionMinimo = $valoresIntervalo[0];
					$fraccionMaximo = $valoresIntervalo[1];
					$minimo = cambiarFraccionADecimal($fraccionMinimo);
					$respuestaDecimal = cambiarFraccionADecimal($respuestas[$i]);
					$maximo = cambiarFraccionADecimal($fraccionMaximo);
					//echo $minimo."Minimo<br>".$maximo."MAXIMO<br>".$respuestaDecimal."DECIMAL<br>";
					if (evaluaIntervalo($minimo,$maximo, $respuestaDecimal)){
						//echo $puntajesCorrectas[$i]."puntaje : sub(".$i."<br>";
						$puntaje = $puntaje+$puntajesCorrectas[$i];
						}

				}
				if($_REQUEST["tipoR".$i] == "F"){ //caso fraccion equivalente
					$fraccion = explode("*",$respuestasCorrectas[$i]);
					echo "<br><br>";
					$valoresFraccion = $fraccion[1];
					
					$respuestaDecimal = cambiarFraccionADecimal($respuestas[$i]);
					$respuestaCorrectaDecimal = cambiarFraccionADecimal($valoresFraccion);
					//echo $minimo."Minimo<br>".$maximo."MAXIMO<br>".$respuestaDecimal."DECIMAL<br>";
					if ($respuestaDecimal == $respuestaCorrectaDecimal){
//						echo $puntajesCorrectas[$i]."puntaje : sub(".$i."<br>";
																   
						$puntaje = $puntaje+$puntajesCorrectas[$i];
						//alerta("Respuesta Buena : ".$respuestaDecimal);
						}else{
					//alerta("Respuesta Mala : ".$respuestaDecimal);	
							}

				}
				
				if($_REQUEST["tipoR".$i] == "D"){ //caso Decimal: el mismo guardado y los equivalentes
					$decimalesCorrecto = explode("*",$respuestasCorrectas[$i]);
					
					$valorDecimalesCorrecto = $decimalesCorrecto[1];
					
					$respuestaDecimal = cambiarDecimalComaADecimalPunto($respuestas[$i]);
					$respuestaCorrectaDecimal = $valorDecimalesCorrecto;
					
					
					//echo $minimo."Minimo<br>".$maximo."MAXIMO<br>".$respuestaDecimal."DECIMAL<br>";
					if ($respuestaDecimal == $respuestaCorrectaDecimal){
//						echo $puntajesCorrectas[$i]."puntaje : sub(".$i."<br>";
						//alerta("B: ".$respuestaDecimal);										   
						$puntaje = $puntaje+$puntajesCorrectas[$i];
						//alerta("Respuesta Buena : ".$respuestaDecimal);
						}else{
					//alerta("Respuesta Mala : ".$respuestaDecimal);	
						//alerta("M: ".$respuestaDecimal);										   
							}

				}
				
				if($_REQUEST["tipoR".$i] == "DecEq"){ //caso: solamente los Decimales equivalentes (no se incluye el guardado)
					$decimalesCorrecto = explode("*",$respuestasCorrectas[$i]);
					
					$valorDecimalesCorrecto = $decimalesCorrecto[1];
					
					$respuestaDecimal = cambiarDecimalComaADecimalPunto($respuestas[$i]);
					$respuestaCorrectaDecimal = $valorDecimalesCorrecto;
					
					
					//echo $minimo."Minimo<br>".$maximo."MAXIMO<br>".$respuestaDecimal."DECIMAL<br>";
					if ($respuestaDecimal == $respuestaCorrectaDecimal && strcmp($respuestaDecimal,$respuestaCorrectaDecimal) != 0 ){
//						echo $puntajesCorrectas[$i]."puntaje : sub(".$i."<br>";
						//alerta("B: ".$respuestaDecimal);										   
						$puntaje = $puntaje+$puntajesCorrectas[$i];
						//alerta("Respuesta Buena : ".$respuestaDecimal);
						}else{
					//alerta("Respuesta Mala : ".$respuestaDecimal);	
						//alerta("M: ".$respuestaDecimal);										   
							}

				}
				
				if($_REQUEST["tipoR".$i] == "DI"){ //caso fraccion intervalo
					
					alerta("Responido: ".$respuestas[$i]); 
					$intervalo = explode("*",$respuestasCorrectas[$i]);
					
					$valoresIntervalo = explode("-",$intervalo[1]);
					$decimalMinimo = $valoresIntervalo[0];
					$decimalMaximo = $valoresIntervalo[1];
					$minimo = $decimalMinimo;
					$maximo = $decimalMaximo;
					$respuestaDecimal = cambiarDecimalComaADecimalPunto($respuestas[$i]);
					
					//echo $minimo."Minimo<br>".$maximo."MAXIMO<br>".$respuestaDecimal."DECIMAL<br>";
					if (evaluaIntervalo($minimo,$maximo, $respuestaDecimal)){
						//echo $puntajesCorrectas[$i]."puntaje : sub(".$i."<br>";
						$puntaje = $puntaje+$puntajesCorrectas[$i];
						}

				}
				
				if($_REQUEST["tipoR".$i] == "Digito"){ //caso Decimal: el mismo guardado y los equivalentes
					$digitoCorrecto = explode("*",$respuestasCorrectas[$i]);
					
					$valorDigitoCorrecto = $valorDigitoCorrecto.$digitoCorrecto[1];
					
					if ($respuestas[$i] == ""){
						$respuestas[$i] = 0;	
					}
					$respuestaDigito = $respuestaDigito.$respuestas[$i];
					$respuestaCorrectaDigito = $valorDigitoCorrecto;
					
					//alerta($i." -- ".$respuestaDigito);
					//echo $minimo."Minimo<br>".$maximo."MAXIMO<br>".$respuestaDecimal."DECIMAL<br>";
					if ( ($i == $cantidadRespuestasItem-1) && ($respuestaDigito == $respuestaCorrectaDigito) ){
//						echo $puntajesCorrectas[$i]."puntaje : sub(".$i."<br>";
																   
						$puntaje = $puntaje+$puntajesCorrectas[$i];
						//alerta("Respuesta Buena : ".$respuestaDigito);
						}else{
					//alerta("Respuesta Mala : ".$respuestaDecimal);	
						//alerta("M: ".$respuestaDigito);										   
							}

				}
				
				
				
			}
			
			
			
			// FIN EVALUA RESPUESTA
			
			
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
				$puntaje= 1;
				//alerta("Respuesta Buena ");
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
	echo "<br><br>";
	//EVALUA FIN DE LA LISTA
	$total = $_SESSION["puntajeTotal"];
	$_SESSION["listaResolucion"] =$lista;
	$total = $total + $puntos;
	$_SESSION["puntajeTotal"] = $total;
	//echo $_SESSION["puntajeTotal"]." <--TOTAL-<br>";
	$idsListas = $_SESSION["idsListas"];
	 
	
	if ($j == $_SESSION["maximoLista"]){ 
	
		//$porcentaje = $_SESSION["puntajeTotal"]/(($j)*2);
		//actualizaPauta($idPauta,$tiempo,@$resultado,$porcentaje);
        dirigirse_a("fin.php");
	}	
	
 	dirigirse_a("item.php");
//	echo '<a href="item.php">Siguiente</a>';
	
	
	
	// FIN EVALUA FIN DE LA LISTA
//print_r($lista);
?>

<a href="item.php">item</a>  
