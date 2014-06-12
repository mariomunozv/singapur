<?php

require("inc/config.php");
include "../inc/_item.php";
include "../inc/_funciones.php";

function fijar($variable, $idVariable){
	if(isset($_REQUEST["$variable"])) 
		$_SESSION["$variable"] = $idVariable;
}


/* Valores capturados en el formulario */

$enunciadoItem = $_REQUEST["enunciadoItem"];

$idTareaMatematica = $_REQUEST["idTareaMatematica"];
fijar("fijar_idTareaMatematica",$idTareaMatematica);

$idCompetencia = $_REQUEST["idCompetencia"];
fijar("fijar_idCompetencia",$idCompetencia);

$idNivelDeComplejidad = $_REQUEST["idNivelDeComplejidad"];
fijar("fijar_idNivelDeComplejidad",$idNivelDeComplejidad);

$idSeccionBitacora = $_REQUEST["idSeccionBitacora"];
fijar("fijar_idSeccionBitacora",$idSeccionBitacora);

$idCapitulo = $_REQUEST["idCapitulo"];
fijar("fijar_idCapitulo",$idCapitulo);


$puntajeItem = $_REQUEST["puntajeItem"];





/* Inserta el item */
if ($_REQUEST["modo"] == "nuevo"){

	//$idItem = setItem($idCompetencia, $idNivelDeComplejidad, $idSeccionBitacora, $idTareaMatematica, $enunciadoItem, $puntajeItem);
	$idItem = setItem($idCompetencia, $idNivelDeComplejidad, $idCapitulo, $idTareaMatematica, $enunciadoItem, $puntajeItem);	
		
}






/* Actualizar el item */
if($_REQUEST["modo"] == "editar"){
	
	$idItem = $_REQUEST["idItem"];
	
	$idAlternativa1 = $_REQUEST["idAlternativa1"];
	$idAlternativa2 = $_REQUEST["idAlternativa2"];
	$idAlternativa3 = $_REQUEST["idAlternativa3"];
	$idAlternativa4 = $_REQUEST["idAlternativa4"];
	
	actualizaItem($idItem, $idTareaMatematica, $idAprendizajeEsperadoCurriculo, $idCompetencia, $idNivelDeComplejidad, $idNivel, 'NULL', $enunciadoItem, $fondoItem, $esAbiertoItem, $respuestaCorrectaItem);
	
	// Se actualizaron las alternativas o se transformo a uno con alternativas
	if ($esAbiertoItem == 0){
		
		$etiqueta1 = $_REQUEST["etiqueta1"];
		$etiqueta2 = $_REQUEST["etiqueta2"];
		$etiqueta3 = $_REQUEST["etiqueta3"];
		$etiqueta4 = $_REQUEST["etiqueta4"];
		if(isset($_REQUEST["esCorrecta"])) 
			$esCorrecta = $_REQUEST["esCorrecta"];

		$array_correcta = array(0, 0, 0, 0);
		$array_correcta[$esCorrecta] = 1;
		
		$alternativas = getAlternativas($idItem);
		
		if ($alternativas){ // tenia alternativas antes
		
			actualizaAlternativa($idAlternativa1, $etiqueta1, $array_correcta[0]);
			actualizaAlternativa($idAlternativa2, $etiqueta2, $array_correcta[1]);
			actualizaAlternativa($idAlternativa3, $etiqueta3, $array_correcta[2]);
			actualizaAlternativa($idAlternativa4, $etiqueta4, $array_correcta[3]);
		}else{ // no tenia alternativas antes
		
			setAlternativa($idItem, $etiqueta1, $array_correcta[0]);
			setAlternativa($idItem, $etiqueta2, $array_correcta[1]);
			setAlternativa($idItem, $etiqueta3, $array_correcta[2]);
			setAlternativa($idItem, $etiqueta4, $array_correcta[3]);
		}
		
		
	}else{ // No tiene alternativas o dejó de tener alternativas ($esAbiertoItem == 1)
		
		$alternativas = getAlternativas($idItem);
		
		if ($alternativas){ // tenia alternativas antes
			eliminaAlternativas($idItem);
		}
		
	}
	
	// Se borran las herramientas por si van a cambiar, disminuir o quitar
	eliminaHerramientas($idItem);
	
	// Se borran las condiciones por si van a cambiar, disminuir o quitar
	eliminaCondiciones($idItem);
	

} // Actualizar



/*
if($idVariableDidactica_2 != "")
	setCondicion(2, $idVariableDidactica_2, $idItem);
if($idVariableDidactica_3 != "")
	setCondicion(3, $idVariableDidactica_3, $idItem);
if($idVariableDidactica_4 != "")
	setCondicion(4, $idVariableDidactica_4, $idItem);
if($idVariableDidactica_5 != "")
	setCondicion(5, $idVariableDidactica_5, $idItem);
if($idVariableDidactica_6 != "")
	setCondicion(6, $idVariableDidactica_6, $idItem);
if($idVariableDidactica_7 != "")
	setCondicion(7, $idVariableDidactica_7, $idItem);
if($idVariableDidactica_8 != "")
	setCondicion(8, $idVariableDidactica_8, $idItem);*/


/* Pasó todo */
if (isset($idItem) && $_REQUEST["modo"] == "nuevo"){
	echo '<br>Item creado, ID: '.$idItem.'<br>';
	$_SESSION["idSiguiente"]=($idItem+1);
}

if (isset($idItem) && $_REQUEST["modo"] == "editar"){
	echo '<br>Item Actualizado, ID: '.$idItem.'<br>';
}

	
?>
    
            