<?php 

include "../inc/conecta.php";
include "../inc/funciones.php";
Conectarse_seg(); 

/*function estaFija($variable){
	if(isset($_SESSION["$variable"])){
		$idRetorno = $_SESSION["$variable"];
	}
	
	else
		$idRetorno = "";
		
	return $idRetorno;
}*/

$idCursosCapacitacion = $_REQUEST["idCursoCapacitacion"];


$flag = false;
$condicion = "idCursoCapacitacion = ";
foreach ($idCursosCapacitacion as $cadaCurso){
	if($flag == false){
		$condicion = $condicion.$cadaCurso;
		$flag = true;
	}else{
		$condicion = $condicion." OR idCursoCapacitacion = ".$cadaCurso;
	}

}




$arreglo = getIdNombreTablaCondicion("Jornada", $condicion); 



//$idVariableFija = estaFija("fijar_idSeccionBitacora");
//armaSelectActual($arreglo,"SeccionBitacora",$idVariableFija);
armaSelect($arreglo,"Jornada"); 
?>