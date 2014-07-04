<?php 

//ini_set('display_errors','On');

require("inc/incluidos.php");

include "inc/_actividad.php";
include "inc/_alternativa.php";




function creaPauta($idFormulario,$idUsuario){
	$sql_insert = "INSERT INTO `pauta` ( `idFormulario` , `idUsuario` , `idPauta` , `fechaRespuestaPauta`  )";
	$sql_insert .=" VALUES (";
   	$sql_insert .=" '$idFormulario', '$idUsuario', '',NOW( )";
	$sql_insert .=" )";					   
//	echo $sql_insert;
	$res_insert = mysql_query($sql_insert);
	$idPauta = mysql_insert_id();
	return ($idPauta);
}





function setRespuesta($idEnunciado,$idFormulario,$idUsuario,$idPauta,$opcionSeleccionada,$valorSeleccionada){
	
	$sql_insert = "INSERT INTO `respuesta` ( `idEnunciado` , `idFormulario` , `idUsuario` , `idPauta` , `idRespuesta` ,  `opcionSeleccionada` ,`valorSeleccionada`   )";
	$sql_insert .= " VALUES ( '$idEnunciado', '$idFormulario', '$idUsuario', '$idPauta','','$opcionSeleccionada', '$valorSeleccionada')";
	$res = mysql_query($sql_insert);
	echo $sql_insert;
}






$j = $_SESSION["j"];
$j++;
$_SESSION["j"]=$j;

$tipoActividad = $_REQUEST["tipoActividad"];





if ($tipoActividad == "Formulario" || $hayFormulario ==1){
	

	$idFormulario = $_SESSION["idFormulario"];
	$idUsuario = $_SESSION["sesionIdUsuario"];
	$listaItem = $_SESSION["listaItem"];
	$contestada = $_REQUEST["contestada"];
	if ($contestada ==0){
		$idPauta = creaPauta($idFormulario,$idUsuario);
		
		foreach ($listaItem as $item){
			/* Abierto */
			if($item["esAbiertaEnunciado"] == 1){
							
				switch ($item["tipoInputEnunciado"])
				{
					
				/* Editor	*/
				case "editor":
				
					if ($_REQUEST["item".$item["idEnunciado"]] == ""){
						$respuesta = "";
					}
					else{
						//echo "Respuesta: ".$_REQUEST["item".$item["idEnunciado"]];
						
						$respuesta = reemplaza($_REQUEST["item".$item["idEnunciado"]]);
					}
			
					
					$opcionSeleccionada = "";
					$valorSeleccionada = $respuesta; 
				break;
				  
	  
				  
				default:
					$respuesta = @$_REQUEST["item".$item["idEnunciado"]];
					$opcionSeleccionada = "";
					$valorSeleccionada = $respuesta;
				} 
				

				
				
				
			}
			else{ // No es abierto
				
				
				switch ($item["tipoInputEnunciado"])
				{
					
					/* Archivo adjunto	*/
					case "file":
										
						if ($_REQUEST["item".$item["idEnunciado"]] == "")
							$respuesta = "";
						else
							$respuesta = $_SESSION["sesionIdUsuario"]."_".@$_REQUEST["item".$item["idEnunciado"]];
	
						$opcionSeleccionada = $respuesta;
						$valorSeleccionada = $respuesta;
						
					break;
					
					/* Flash dinamico */
					case "hidden_flash":
						
						if ($_REQUEST["item".$item["idEnunciado"]] == "")
							$respuesta = "";
						else
							$respuesta = @$_REQUEST["item".$item["idEnunciado"]];
	
						$opcionSeleccionada = $respuesta;
						$valorSeleccionada = $respuesta;
										
	
						
					break;
					
					
					/* Input número */
					case "input_3":
						
						if ($_REQUEST["item".$item["idEnunciado"]] == "")
							$respuesta = "";
						else
							$respuesta = @$_REQUEST["item".$item["idEnunciado"]];
							
						$opcionSeleccionada = $respuesta;
						$valorSeleccionada = $respuesta;
										
	
						
					break;
					
					
					/* Fracción */
					case "fraccion":
						
						if ($_REQUEST["numerador".$item["idEnunciado"]] == ""){
							$respuesta = "";
						}
							
						else{
							$numerador = @$_REQUEST["numerador".$item["idEnunciado"]];
							$denominador = @$_REQUEST["denominador".$item["idEnunciado"]];
							
							$respuesta = "0 ".$numerador."/".$denominador;
						}
							
							
							
						$opcionSeleccionada = $respuesta;
						$valorSeleccionada = $respuesta;
							
					break;
					
					
					/* Numero Mixto */
					case "mixto":
						
						
						if ($_REQUEST["numerador".$item["idEnunciado"]] == "" && $_REQUEST["denominador".$item["idEnunciado"]] == "" && $_REQUEST["entero".$item["idEnunciado"]] == ""){
							$respuesta = " /";
						}
							
						else{
							$entero = @$_REQUEST["entero".$item["idEnunciado"]];
							$numerador = @$_REQUEST["numerador".$item["idEnunciado"]];
							$denominador = @$_REQUEST["denominador".$item["idEnunciado"]];
							
							$respuesta = $entero." ".$numerador."/".$denominador;
						}
							
							
							
						$opcionSeleccionada = $respuesta;
						$valorSeleccionada = $respuesta;
							
					break;
					
					
					
					/* Input número */
					case "input_3":
						
						if ($_REQUEST["item".$item["idEnunciado"]] == "")
							$respuesta = "";
						else
							$respuesta = @$_REQUEST["item".$item["idEnunciado"]];
							
						$opcionSeleccionada = $respuesta;
						$valorSeleccionada = $respuesta;
										
	
						
					break;
					
					
					/* Radio */
					case "Radio":
						if ($_REQUEST["item".$item["idEnunciado"]] == "")
							$respuesta = "";
						else
							$respuesta = @$_REQUEST["item".$item["idEnunciado"]];
							
						$opcionSeleccionada = $respuesta;
						$datosEtiqueta = getEtiqueta($respuesta);
						$valorSeleccionada = $datosEtiqueta["nombreEtiqueta"];
						
					break;
					  
					  
					
		  
					  
					default:
						$respuesta = @$_REQUEST["item".$item["idEnunciado"]];
						$opcionSeleccionada = $respuesta;
						$valorSeleccionada = $respuesta;
						break;
						
						
				} //fin switch
				

			
				
			} // else (No es abierto)
			
			
			
			if ($respuesta != ""){
				setRespuesta($item["idEnunciado"],$idFormulario,$idUsuario,$idPauta,$opcionSeleccionada,$valorSeleccionada);
			}
			
	 	}
	}
		
}



if(count($_SESSION["paginasActividad"])<=$j){
	dirigirse_a("actividadesPaginaFin.php");		
	}
	else{
	//echo '<a href="actividadesPagina.php">Avanzar</a>';	
	dirigirse_a("actividadesPagina.php");	
	}





?>