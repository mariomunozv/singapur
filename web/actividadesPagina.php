<?php 
//include_once("inc/configErrores.php");
session_start();
require("inc/incluidos.php");
include "inc/_actividad.php";
include "inc/_pauta.php";

$editores = array();
$contadorEditor = 0;


function getAlternativasEtiquetas($idItem){
	$sql = "select * from alternativa a join etiqueta b on a.idEtiqueta = b.idEtiqueta WHERE a.idEnunciado = ".$idItem;
	$res = mysql_query($sql);
	//echo $sql;
	$i =0;
	$alternativas = array();
	while ($row = mysql_fetch_array($res)) {
		$alternativas[$i]=array(
			"idEtiqueta"=> $row["idEtiqueta"],
			"nombreEtiqueta"=> $row["nombreEtiqueta"]
		);
	$i++;	
	}
	return($alternativas); 
}


function getAlternativas($idEnunciado){
	$sql = "select * from alternativa WHERE idEnunciado = ".$idEnunciado;
	$res = mysql_query($sql);
	//echo $sql;
	$i =0;
	$alternativas = array();
	while ($row = mysql_fetch_array($res)) {
		$alternativas[$i]=array(
			"idAlternativa"=> $row["idAlternativa"],
			"nombreAlternativa"=> $row["nombreAlternativa"],
			"esCorrectaAlternativa"=> $row["esCorrectaAlternativa"]			
		);
	$i++;	
	}
	return($alternativas);
}




function getContenidosPagina($idPagina){
		
	$sql = "SELECT * FROM contenidoPagina a join tipoContenidoPagina b on a.idTipoContenidoPagina = b.idTipoContenidoPagina WHERE idActividadPagina = '$idPagina' ORDER BY ordenContenidoPagina ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"textoContenidoPagina"=> $row["textoContenidoPagina"],
			"nombreTipoContenidoPagina"=> $row["nombreTipoContenidoPagina"],
			"estiloTipoContenidoPagina"=> $row["estiloTipoContenidoPagina"]
			);
		$i++;
	}
	return($arreglo);
}

function getIdFormularioPagina($idPagina){
	$sql ="SELECT * FROM formulario WHERE idActividadPagina = ".$idPagina;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["idFormulario"]);
}


function getSeccionesFormulario($idFormulario){
		
	$sql = "SELECT * FROM seccionFormulario  WHERE idFormulario = '$idFormulario' ORDER BY idSeccionFormulario ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idSeccionFormulario"=> $row["idSeccionFormulario"],
			"tituloSeccionFormulario"=> $row["tituloSeccionFormulario"]
			);
		$i++;
	}
	return($arreglo);
}


function getItemSeccion($idSeccion){
	
	$sql = "SELECT * FROM detalleSeccionEnunciado  WHERE  idSeccionFormulario  = '$idSeccion' ORDER BY idSeccionFormulario ASC";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idEnunciado"=> $row["idEnunciado"]
		);
		$i++;
	}
	return($arreglo);
}

function getItemsSeccion($idSeccion){
	$sql = "SELECT * FROM detalleSeccionEnunciado a join enunciado b  on a.idEnunciado = b.idEnunciado WHERE  a.idSeccionFormulario  = ".$idSeccion;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$items[$i] = array(
			"idSeccionFormulario"=> $row["idSeccionFormulario"],					   
			"idEnunciado"=> $row["idEnunciado"],
			"textoEnunciado"=> $row["textoEnunciado"],
			"respuestaCorrectaEnunciado" => $row["respuestaCorrectaEnunciado"],
			"esAbiertaEnunciado"=> $row["esAbiertaEnunciado"],
			"tipoInputEnunciado"=> $row["tipoInputEnunciado"]
		);
		$i++;
	}
	return($items);
}


function getDatosSeccion($idSeccion){
	$sql = "SELECT * FROM seccionFormulario  where idSeccionFormulario= ".$idSeccion;
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res)) {
		$datosSeccion = array(
			"idSeccionFormulario"=> $row["idSeccionFormulario"],					   
			"tituloSeccionFormulario"=> $row["tituloSeccionFormulario"],
			"descripcionSeccionFormulario"=> $row["descripcionSeccionFormulario"]
			
		);
	}
	return($datosSeccion);
}



function cuentaPautasFormulario($idFormulario, $idUsuario){
	$sql= "SELECT COUNT(*) AS cont
			FROM pauta
			WHERE idFormulario = $idFormulario
			AND idUsuario = $idUsuario";
			//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}



	
function getDatosPaginaContenido($idPagina){
	$sql ="SELECT * FROM actividadPagina a join contenidosPagina b on a.idActividadPagina = b.idActividadPagina WHERE a.idActividadPagina = ".$idPagina." ORDER BY b.ordenContenidoPagina ASC";
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
			$datosContenidos[$i] = array(
			"textoContenidoPagina"=> $row["textoContenidoPagina"],
			"ordenContenidoPagina"=> $row["ordenContenidoPagina"],
			"nombreTipoContenidoPagina" => $row["nombreTipoContenidoPagina"],
			"idTipoContenidopagina" => $row["idTipoContenidopagina"],
			"estiloTipoContenidoPagina" => $row["estiloTipoContenidoPagina"]);
			
			$i++;	
	}
	if ($i == 0){
		$datosContenidos[$i] = array();	
	} 
	return($datosContenidos);
}



		
function getRespuestaUsuarioIdEnunciado($idEnunciado,$idUsuario){
	$sql = "SELECT * FROM respuesta WHERE idEnunciado = ".$idEnunciado." AND idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuesta = $row["valorSeleccionada"];
	return($respuesta);
}

function getRespuestaUsuarioIdEnunciadoParaFormulario($idEnunciado,$idUsuario,$idFormulario){
	$sql = "SELECT * FROM respuesta WHERE idEnunciado = ".$idEnunciado." AND idUsuario = ".$idUsuario." AND idFormulario = ".$idFormulario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuesta = $row["valorSeleccionada"];
	return($respuesta);
}


function imprimeCodigoFlash4($arch,$datos,$funcionJS,$ancho,$alto){

	echo '
	
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="'.$ancho.'" height="'.$alto.'" id="prueba2" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="'.$arch.'" />
<param name="FlashVars" value="datoEntrada='.$datos.'" />
<param name="FlashVars" value="datoItem='.$funcionJS.'" />
<param name="wmode" value="transparent" />

<param name="quality" value="high" /><embed src="'.$arch.'" FlashVars="datoEntrada='.$datos.'&datoItem='.$funcionJS.'" quality="high"  wmode= "transparent" width="'.$ancho.'" height="'.$alto.'" name="prueba2" align="middle" swLiveConnect="true" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>';
	
}



function muestraInputFraccion($texto,$i, $respuesta, $flagContestada){
	
	
	$numerador = "";
	$denominador = "";
	$flagDisabled = "";
		
	if ($respuesta != ""){
	
		$respuestaSeparada = split(" ",$respuesta);
		
		$parteEntera = $respuestaSeparada[0];
		$parteFraccionaria = $respuestaSeparada[1];
		
		$fraccion = split("/", $parteFraccionaria);
		$numerador = $fraccion[0];
		$denominador = $fraccion[1];

	}
	
	if ($flagContestada == 1){
		$flagDisabled = "disabled='disabled'";
	}
	
	
	
	echo "
		<table border='0' id='tablaFraccion'>
			<tr>
				<td>".$texto."&nbsp;&nbsp;					
				</td>
				<td>
					<table>
						<tr>
							<td>
								<input name='numerador".$i."' id='numerador".$i."' type='text' title='Numerador' size='3' class='numeroFraccion campos' onkeyup='javascript:checkNumber(this);' onchange='contesta()' value='".$numerador."' ".$flagDisabled."/>
							</td>
						</tr>
						<tr>
							<td>
								<hr />
							</td>
						</tr>
						<tr>
							<td>
								<input name='denominador".$i."' id='denominador".$i."' title='Denominador' type='text' size='3' class='numeroFraccion campos' onkeyup='javascript:checkNumber(this);' onchange='contesta()' value='".$denominador."' ".$flagDisabled."/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>";
}	





function muestraInputNumeroMixto($texto,$i, $respuesta, $flagContestada){
	
	$parteEntera = "";
	$numerador = "";
	$denominador = "";
	$flagDisabled = "";
		
	if ($respuesta != ""){
	
		$respuestaSeparada = split(" ",$respuesta);
		
		$parteEntera = $respuestaSeparada[0];
		$parteFraccionaria = $respuestaSeparada[1];
		
		$fraccion = split("/", $parteFraccionaria);
		$numerador = $fraccion[0];
		$denominador = $fraccion[1];

	}
	
	if ($flagContestada == 1){
		$flagDisabled = "disabled='disabled'";
	}
	
	
	echo "
		<table border='0' id='tablaFraccion'>
			<tr>
				<td>".$texto."&nbsp;&nbsp;
				<input name='entero".$i."' id='entero".$i."' title='Parte Entera' type='text' size='1' class='numeroEntero campos' onkeyup='javascript:checkNumber(this);' onchange='contesta()' value='".$parteEntera."' ".$flagDisabled."/>
				</td>
				<td>
					<table>
						<tr>
							<td>
								<input name='numerador".$i."' id='numerador".$i."' type='text' title='Numerador' size='3' class='numeroFraccion campos' onkeyup='javascript:checkNumber(this);' onchange='contesta()' value='".$numerador."' ".$flagDisabled."/>
							</td>
						</tr>
						<tr>
							<td>
								<hr />
							</td>
						</tr>
						<tr>
							<td>
								<input name='denominador".$i."' id='denominador".$i."' title='Denominador' type='text' size='3' class='numeroFraccion campos' onkeyup='javascript:checkNumber(this);' onchange='contesta()' value='".$denominador."' ".$flagDisabled."/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>";


}	
	




//////////////////////////////////////////////////////
//////// COMIENZO DE LA PAGINA
/////////////////////////////////////////////////////



$idCurso = $_SESSION["sesionIdCurso"];


// Revision
if (isset($_SESSION["sesionIdUsuarioRevisado"])){ 
	// Otro usuario esta revisando la actividad, para evitar que se tomo como idUsuario al revisor, se asigna 
	// a $idUsuario la variable de sesion $_SESSION["sesionIdUsuarioRevisado"] que tiene el usuario revisado
	$idUsuario = $_SESSION["sesionIdUsuarioRevisado"];	
}
else{
	$idUsuario = $_SESSION["sesionIdUsuario"];	
}


$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$paginas = $_SESSION["paginasActividad"];

//print_r($paginas);


// En que página estoy actualmente
$j = $_SESSION["j"];

//echo "Pagina: ".$j;


$idActividad = $_SESSION["sesionIdActividad"];

$idPaginaActual = $j;


// Si la pagina actual es un formulario
if($paginas[$j]["tipoActividadPagina"] == "Formulario"){
	
	
	// Obtener el idFormulario
	$idFormulario = getIdFormularioPagina($paginas[$j]["idActividadPagina"]);
	$_SESSION["idFormulario"] = $idFormulario;
	
	// Secciones del formulario
	$seccionFormulario = getSeccionesFormulario($idFormulario);
	

	
	$listaItem = array();
	$i=0;
	
	// Armar la lista con las preguntas
	foreach ($seccionFormulario as $seccion){
		$items = getItemsSeccion($seccion["idSeccionFormulario"]);
		foreach ($items as $item){
			$listaItem[$i] = $item;
			$i++;
		}
	
	}
	
	// Saber si el usuario ya ha contestado el formulario 
	if(cuentaPautasFormulario($idFormulario,$idUsuario)==0){
  		$_SESSION["listaItem"] = $listaItem;
		$contestada = 0;
	}else{
		$datosPautas = getPautasFormulario($idUsuario,$idFormulario);
		//print_r($datosPautas);
		$contestada = 1;
	}
}
	

		




require ("hd3.php");?>


<body>


<script type="text/javascript" src="js/validNum.js"></script>
<script type='text/javascript'>//<![CDATA[ 

$(document).ready(function(ident) {
            $('.area').keyup(function() {
				//alert($(this).attr('id'));
				var numEnun = ($(this).attr('id'));
                var len = this.value.length;
                if (len >= 500) {
                    this.value = this.value.substring(0, 500);
                }
				var idSpan = "quedan_"+numEnun;
                $('#'+idSpan).text(500 - len);
            });
        });

/*function cambiaContenido3(idTextArea) {
	

	var sel = document.getElementById(idTextArea);
	var iframe = document.getElementById("editor_iframe");
	var content = iframe.contentWindow.document.body.innerHTML;
	var a = "texto="+escape(simbolos(content));
	
	AJAXPOST("escribeTexto.php",a,sel);

}*/


// Jquery para Desplazarse hacia el inicio de la página
$(function(){
// Smooth Scroll Snippet
var scrollElement = 'html, body';
$('html, body').each(function () {
   var initScrollTop = $(this).attr('scrollTop');
   $(this).attr('scrollTop', initScrollTop + 1);
   if ($(this).attr('scrollTop') == initScrollTop + 1) {
      scrollElement = this.nodeName.toLowerCase();
      $(this).attr('scrollTop', initScrollTop);
      return false;
   }    
});
$("a[href^='#']").click(function(event) {
   event.preventDefault();
   var $this = $(this),
   target = this.hash,
   $target = $(target);
   $(scrollElement).stop().animate({
      'scrollTop': $target.offset().top
   }, 1000, 'swing', function() {
      window.location.hash = target;
   });
});
// End Smooth Scroll
});//]]>  


function contesta(){
	document.getElementById("contestoAlgo").value = "1";
}	


</script>
<div id="top"></div>
<div id="principal">



<!--Imagen encabezado-->
<?php require("topActividad.php"); ?>
	
 
    
    
    
   
    
<div id="columnaActividad">
	<p class="titulo_actividad"> 
	<?php 
		// Titulo de la página
		echo $paginas[$j]["nombreActividadPagina"]; 
	?>
    </p>
    <hr /> 
 
	 <?php  	  
		// Tipo de Actividad con Contenidos para mostrar
 
		if($paginas[$j]["tipoActividadPagina"] == "Contenido"){
			$contenidos = getContenidosPagina($paginas[$j]["idActividadPagina"]);

			$hayFormulario = 0;
			$contadorSeccion = 0;
			
			// Se escriben todos los contenidos de acuerdo al atributo "ordenContenidoPagina" de la tabla "contenidoPagina"
			foreach($contenidos as $contenido){
				
				// Cada contenido se escribe de distinta forma
				switch($contenido["nombreTipoContenidoPagina"]){
					// Titulo
					case "Titulo1":
					echo "<p class='titulo_actividad'>".$contenido["textoContenidoPagina"]."</p>";
					break;
					
					// Titulo
					case "TituloCentrado":
					echo "<p class='titulo_actividad' style='text-align: center;'>".$contenido["textoContenidoPagina"]."</p>";
					break;
					
					// Texto
					case "textoConSangria":
					echo "<br>";
					echo "<p class='texto_actividad' style='padding-left:20px;'>".nl2br($contenido["textoContenidoPagina"])."</p>";
					echo "<br>";
					break;
					
					// Texto
					case "textoNormal":
					echo "<br>";
					echo "<p class='texto_actividad'>".nl2br($contenido["textoContenidoPagina"])."</p>";
					//echo "<br>";
					break;
					
					// Imagen
					case "Imagen":
					echo "<br>";
					echo "<div align='center'><img src=".$contenido["textoContenidoPagina"]."></img></div>";
					echo "<br>";
					break;
					
					
					// Flash
					case "Flash":
					
					$arch = "interactivos/".$contenido["textoContenidoPagina"];
					$datos = "";
					$funcionJS = "";
					$ancho = 930;
					$alto = 550;
					
					echo '<br><div id="flash" style="text-align: center;">';
					imprimeCodigoFlash4($arch,$datos,$funcionJS,$ancho,$alto);
					echo "</div><br>";
					break;
					
					// RespuestaAnterior
					case "RespuestaAnterior":
					echo "<br>";
								
					$respuesta = getRespuestaUsuarioIdEnunciado($contenido["textoContenidoPagina"],$idUsuario);
					?>   
					<div class="respuestaTexto">
					<?php
					echo $respuesta;
					?>
					</div>                            
					<?php
					echo "<br>";
					break;
					
					
					// RespuestaAnterior Flash
					case "RespuestaAnteriorFlash":

					
					echo "<br>";
					
					
					$parametrosFlash = split(":",$contenido["textoContenidoPagina"]);
								
					$pelicula = $parametrosFlash[0];
					$ancho = $parametrosFlash[1];
					$alto = $parametrosFlash[2];
					$itemFlash = $parametrosFlash[3];
					
					
					$respuesta = getRespuestaUsuarioIdEnunciado($itemFlash,$idUsuario);
					
					$arch = "interactivos/".$pelicula;
					$datos = $respuesta;
					$funcionJS = "";
					

					echo '<br><div id="flash" style="text-align: center;">';
					imprimeCodigoFlash4($arch,$datos,$funcionJS,$ancho,$alto);
					echo "</div><br>";

					break;
					
					
						// RespuestaAnterior Flash
					case "RespuestaPropuestaFlash":

					
					echo "<br>";
					
					
					$parametrosFlash = split(":",$contenido["textoContenidoPagina"]);
								
					$pelicula = $parametrosFlash[0];
					$ancho = $parametrosFlash[1];
					$alto = $parametrosFlash[2];
					$respuesta = $parametrosFlash[3];
					
					
					$arch = "interactivos/".$pelicula;
					$datos = $respuesta;
					$funcionJS = "";
					

					echo '<br><div id="flash" style="text-align: center;">';
					imprimeCodigoFlash4($arch,$datos,$funcionJS,$ancho,$alto);
					echo "</div><br>";

					break;
					
					
					
					
					
					// Formulario
					case "Formulario":
						// Se almacena el idFormualrio en el campo textoContenidoPagina
						$idFormulario = $contenido["textoContenidoPagina"];
						$_SESSION["idFormulario"] = $idFormulario;
						
						// Se obtienen las secciones del formulario 
						$seccionFormulario = getSeccionesFormulario($idFormulario);
					

						$tituloSeccionFormulario = $seccionFormulario[$contadorSeccion]["tituloSeccionFormulario"];
						$contadorSeccion++;
						
						$listaItem = array();
						$i=0;
						
						// Se arma la lista de preguntas
						foreach ($seccionFormulario as $seccion){
							$items = getItemsSeccion($seccion["idSeccionFormulario"]);
							
							foreach ($items as $item){
								
								$listaItem[$i] = $item;
								
								$i++;
							}
						}
						
						if(cuentaPautasFormulario($idFormulario,$idUsuario)==0){
							$_SESSION["listaItem"] = $listaItem;
							$contestada = 0;
							$idPauta = "";
						}
						else{
							$contestada = 1;
							$datosPautas = getPautasFormulario($idUsuario,$idFormulario);

							$idPauta = $datosPautas[0]["idPauta"];
							
							?>
                            <script language="javascript">
								
								function nuevo_comentario(){
	
									 var division = document.getElementById("comentario");
									 a = "tablaComentario=actividadPagina&idReferenciaComentario=<?php echo $idPauta; ?>&idPaginaActual=<?php echo $idPaginaActual; ?>&idUsuarioNotificado=<?php echo $idUsuario; ?>&idActividad=<?php echo $idActividad; ?>";
									 AJAXPOST("informeActividadComentarioNuevo.php",a,division);
									
								}
								
								function listado_comentarios(){
									
									 var division = document.getElementById("listado_comentarios");
									 a = "tablaComentario=actividadPagina&idReferenciaComentario=<?php echo $idPauta; ?>";
									 AJAXPOST("informeActividadComentarioListado.php",a,division);
									
								}
							
							</script>
                            
                            
                            <?php
							
						}
							
						
						
						$hayFormulario = 1;				
						
						
								
						?>
							
							
						<input name="hayFormulario" class="campos" id="hayFormulario" type="hidden" value="<?php echo $hayFormulario;?>">    
						<input name="tipoActividad" class="campos" id="tipoActividad" type="hidden" value="<?php echo $paginas[$j]["tipoActividadPagina"];?>">
                        <input name="idActividadPagina" id="tipoActividad" type="hidden" value="<?php echo $paginas[$j]["idActividadPagina"];?>">
						<input name="contestada" class="campos" id="contestada" type="hidden" value="<?php echo $contestada;?>">
							
						<?php 
		
		// Tipo de Actividad con Formulario para mostrar
		
		if(/*$paginas[$j]["tipoActividadPagina"] == "Formulario" ||*/ $hayFormulario == 1){
			
			
						?>
		
        	
        
                        <input name="idFormulario" class="campos" id="idFormulario" type="hidden" value="<?php echo $idFormulario;?>">
                        <input type="hidden" id="contestoAlgo"  name="contestoAlgo" />
                	
                
                
                
                <?php
					
				
					// Imprimir el titulo de cada seccion del formulario 
					$seccionActual = $listaItem[0]["idSeccionFormulario"];
					$datosSeccion = getDatosSeccion($seccionActual);
					echo "<p class='titulo_actividad'>".$datosSeccion["tituloSeccionFormulario"]."</p><br>";
					?>
					<div id="link_acla" align="right" style="margin-right:50px;"><a href="#top">[Subir]</a></div>
                    <?php
					$flagSeccion = false;
					
					?>
							<div id="textoEnunciado">
                    <?php
					
					
					foreach ($listaItem as $item){
						
						
						if ($item["idSeccionFormulario"] != $seccionActual){
							$flagSeccion = true;
						}else{
							$flagSeccion = false;
						}
						
						// Cambio de se seccion
						if ($flagSeccion){
							$seccionActual = $item["idSeccionFormulario"];
							$datosSeccion = getDatosSeccion($seccionActual);
							?>
							</div>
                            <?php
							echo "<br><p class='titulo_actividad'>".$datosSeccion["tituloSeccionFormulario"]."</p><br>";
							?>
                            <div id="link_acla" align="right" style="margin-right:50px;"><a href="#top">[Subir]</a></div>
                            <div id="textoEnunciado">
							<?php
							
							
							
						}
						
						
						
					
                       	if ($item["tipoInputEnunciado"] == "file"){
                       	
						?>
							<script type="text/javascript">
    
                            $(document).ready(function() {
                               //the simple way, use default alert message and callback
                               $("#my_form_<?php echo $item["idEnunciado"];?>").jqupload();
                               $("#my_form_<?php echo $item["idEnunciado"];?>").jqupload_form();
                            
                            
                            });
                            </script>
                            
                            <div id="demo_message"></div>
                            <form id="my_form_<?php echo $item["idEnunciado"];?>" name="my_form_<?php echo $item["idEnunciado"];?>" method="post" action="actividadesPaginaUpload.php" enctype="multipart/form-data">
                            <fieldset>
                            <legend><?php echo $item["textoEnunciado"];?></legend>
                            <input class="campos" name="item<?php echo $item["idEnunciado"];?>" id="item<?php echo $item["idEnunciado"];?>" type="file">
                            <input name="nombreInputFile" type="hidden" value="item<?php echo $item["idEnunciado"];?>">
                            <input type="submit" value="Adjuntar archivo" >
                            </fieldset>
                            </form>
                            
                            
                            <br><br>
                            <?php 
                           
                        } // fin if tipo "file"
						
						
						// otro tipo de respuesta
						else
						{
									
									
									
									
									
									
									
							/****** Editor Matematico *******/





                            if($item["esAbiertaEnunciado"] == 1 && $item["tipoInputEnunciado"] == "editor"){
								
								?>
                                <p class="texto_actividad">
                                <?php 
                                // escribo el texto de la pregunta
                                echo $item["textoEnunciado"];
                                ?>
                                <br><br>
                                </p>
                                <?php
								
								$flagDisabled = "";
								$respuesta = "";

								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
									
								?>
								<div id="item<?php echo $item["idEnunciado"];?>">      
                       			<div class="respuestaTexto">
                                <?php
								echo $respuesta;
                                ?>
                                </div>                            
                               	</div>
                                
                                <?php

								}
								else{
									
									$editores[] = "new Suim( 'editor".$item["idEnunciado"]."', { enableChangeMode: true } );";
									$contadorEditor++;
									
								?>

                                
                                <div id="item<?php echo $item["idEnunciado"];?>">      
                       			<div align="left" class="editor" id="editor<?php echo $item["idEnunciado"];?>" style="width:480px"></div>                                
                               	</div>

                                
                                <?php
								
								
								
								}
									
								
								
					   		}
							
							
							
							
							// Flash_hidden (Flash Dinámico en mantenedorEncuesta)

                            if($item["tipoInputEnunciado"] == "hidden_flash"){
								
																
								$flagDisabled = "";
								
								if ($contestada == 1){ 
									$flagDisabled = "disabled='disabled'";
								}
								
								$respuesta = "";
								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
								}
								
								

								?>
                                
                                <script>
								
								function registraRespuestaFlash_item<?php echo $item["idEnunciado"]; ?>(respuesta){
						
									
									
									var inputHidden = document.getElementById("item<?php echo $item["idEnunciado"]; ?>");
																		
									inputHidden.value = respuesta; 
									
									contesta();
									
								 }
								
								</script>
                                
                                
                                <?php
								$flagDisabled = "";
								$respuesta = "";
								
								

								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
								}
								
								
								?>
                                
                                
								<input class="campos" name="item<?php echo $item["idEnunciado"]; ?>" id="item<?php echo $item["idEnunciado"]; ?>" type="hidden" value="<?php echo $respuesta;?>">
								<?php
								

								
								$arch = "interactivos/".$item["textoEnunciado"];
								$datos = $respuesta;
								$funcionJS = $item["idEnunciado"];
								
								if ($item["respuestaCorrectaEnunciado"] != ""){
									
									$medidas = split(":",$item["respuestaCorrectaEnunciado"]);
									
									$ancho = $medidas[0];
									$alto = $medidas[1];
								}
								else{
									$ancho = 800;
									$alto = 400;
								}
								
								?>
                                <!--<p class="texto_actividad">-->
                                <?php
								imprimeCodigoFlash4($arch,$datos,$funcionJS,$ancho,$alto);
                                ?>
								<!--</p>-->
                                <?php

								
					   		}
							
							
							
							/*Radio */
							
							
							 if ($item["esAbiertaEnunciado"] == 0 && $item["tipoInputEnunciado"] == "Radio" )
							  {
								  
								$flagDisabled = "";
								
								if ($contestada == 1){ 
									$flagDisabled = "disabled='disabled'";
								}
								  
								?>
                                <p class="texto_actividad">
                                <?php 
                                // escribo el texto de la pregunta
                                echo $item["textoEnunciado"];
                                ?>
                                <br>
                                
                                <?php
								$respuesta = "";
								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
									?>
                                    <div class="respuestaTexto">
									<?php
                                    echo $respuesta;
                                    ?>
                                    </div>   
                                    <?php
								}
								else
								{
								 
									$alternativas = getAlternativasEtiquetas($item["idEnunciado"]);
									$i = 1;
									?>
									<table class="texto_actividad" width="100%" border="0" cellspacing="0" cellpadding="0">
									<?php
									foreach ($alternativas as $alternativa)
									{  
									?>
									  <tr>
										<td  align="right" >
										 <input type="radio" <?php echo $flagDisabled; ?> name="item<?php echo $item["idEnunciado"]; ?>" id="radio<?php echo $i."_item".$item["idEnunciado"]; ?>" value="<?php echo $alternativa['idEtiqueta'] ?>" class="campos"/>
										 </td>
										 <td>&nbsp;
											<?php 
												echo $alternativa["nombreEtiqueta"]; 
												$i++;
											?>
										</td>
									  </tr>
	
									<?php 
									} // foreach
									?>
									</table>
                                    <br><br>
                                    <input name="numRadios_item<?php echo $item["idEnunciado"]; ?>"  id="numRadios_item<?php echo $item["idEnunciado"]; ?>" type="hidden" value="<?php echo $i-1;?>">

                                <?php
								}
								?>
                                
                                 </p>
                                 <?php
								 
							   }
                            
                          
							
							
							
							
							
							
							// Text Area
							
							if($item["esAbiertaEnunciado"] == 1 && $item["tipoInputEnunciado"] == "textArea"){
								
								?>
                                <p class="texto_actividad">
                                <?php 
                                // escribo el texto de la pregunta
                                echo $item["textoEnunciado"];
                                ?>
                                <br><br>
                                </p>
                                <?php
								
								$flagDisabled = "";
								
								if ($contestada == 1){ 
									$flagDisabled = "disabled='disabled'";
								}
								
								$respuesta = "";
								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciadoParaFormulario($item["idEnunciado"],$idUsuario,$idFormulario);
								}
								
								?>
                                
								<div id="textRespuesta" align="center">
								<textarea name="item<?php echo $item["idEnunciado"]; ?>" id="item<?php echo $item["idEnunciado"]; ?>" cols="60" rows="5" class="campos area" <?php echo $flagDisabled; ?>><?php echo $respuesta;?></textarea>
                                <p align="right" style="color:#F00" >Puede ingresar <span id="quedan_<?php echo "item".$item["idEnunciado"]; ?>">500</span> caracteres más</p>
                                </div>
                                
                       			<?php 
					   		}
							
							
							// Input normal (tamaño 3)
							
							if($item["esAbiertaEnunciado"] == 0 && $item["tipoInputEnunciado"] == "input_3"){
								
								?>
                                
                                <div align="center" style="width:850px; font-size:15px">
                                <?php 
                                // escribo el texto de la pregunta
                                echo $item["textoEnunciado"];
                                ?>
                              
                                
                                <?php
								
								$flagDisabled = "";
								
								if ($contestada == 1){ 
									$flagDisabled = "disabled='disabled'";
								}
								
								$respuesta = "";
								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
								}
								
								?>
                                &nbsp;&nbsp;
                                <input name="item<?php echo $item["idEnunciado"]; ?>" id="item<?php echo $item["idEnunciado"]; ?>" onChange="contesta()" type="text" size="100" class="campos" <?php echo $flagDisabled; ?> value="<?php echo $respuesta;?>" onkeyup='javascript:checkDecimal(this);' >

                                </div><br>
   
                                                           
                                
                       			<?php 
					   		}
							
							
							// Fracción
							
							if($item["esAbiertaEnunciado"] == 0 && $item["tipoInputEnunciado"] == "fraccion"  ){
								
								?>
                                <div align="center" style="width:850px; font-size:15px">
                                <?php 
                                // escribo el texto de la pregunta
                            
								
								$flagDisabled = "";
								
								if ($contestada == 1){ 
									$flagDisabled = "disabled='disabled'";
								}
								
								$respuesta = "";
								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
								}
								
								$texto = $item["textoEnunciado"];
								
								
								echo  muestraInputFraccion($texto,$item["idEnunciado"],$respuesta,$contestada); 
								?>
                                                                
                                </div>
                       			<?php 
					   		}
							
							
							// Número Mixto
							
							if($item["esAbiertaEnunciado"] == 0 &&  $item["tipoInputEnunciado"] == "mixto" ){
								
								?>
                                <div align="center" style="width:850px; font-size:15px">
                                <?php 
                                // escribo el texto de la pregunta
                            
								
								$flagDisabled = "";
								
								if ($contestada == 1){ 
									$flagDisabled = "disabled='disabled'";
								}
								
								$respuesta = "";
								if ($contestada == 1){ 
									$respuesta = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
								}
								
								$texto = $item["textoEnunciado"];
								
								
								echo  muestraInputNumeroMixto($texto,$item["idEnunciado"],$respuesta,$contestada); 
								?>
                                                                
                                </div>
                       			<?php 
					   		}
					   } // else tipoInputEnunciado
					   ?>
                       
                       
                <?php } // foreach 
				
				
					if ($contadorEditor > 0){
						
						
					?>
					
						<script type="text/javascript">
                        window.onload = function ()
                        {
                            <?php foreach($editores as $editor){
								echo $editor."\n";	
							} ?>
                        };
                        
                                            
                        </script>	
                                
                    <?php
					}
					
					?>
                    </div>
                    <?php
			
		} // formulario
						
						

					
					break; // case Formulario
					
				}/* switch */
				
			} /* foreach*/
	
		} /* if */

		 if(@$contestada==1){

				
				if (isset($_SESSION["sesionIdUsuarioRevisado"]) ){
					$profe = getNombreUsuario($_SESSION["sesionIdUsuarioRevisado"]);
					info("Estás revisando las respuestas del Profesor(a): <b>".$profe."</b>");
				}
				else{
					info("Ya has enviado esta actividad.");	
				}
		} 
		?>

		<br>

      	
       	<p align="right"><?php 
		
		if ($contestada == 1 || $hayFormulario == 0){
			boton("Avanzar","soloAvanzar();");		
		}
		else{
			boton("Guardar y continuar","continuar();");	
			//boton("Avanzar","soloAvanzar();");
		}
		
		
		?>
        
        </p>
        
		<br>
       
       	
       
       	<div id="carga"></div>
        
        <div id="listado_comentarios"></div>
        <div id="comentario"></div>
        
        
        <?php 
		// Si esta contestada esta página, aparecen los posibles comentarios ya hechos o se puede comentar 
		if(@$contestada==1){
		
		?>
        	<script type="text/javascript">
			listado_comentarios();
			</script>   
            
            
        <?php 
			
			
		}
		
		?>
        
        
		
        
       
      <a href="javascript:soloAvanzar()" style="color:#FFF">.</a>
        
      </div><!--columnaCentro-->
         
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->

<script>

function soloAvanzar(){
	//alert("Atención. La actividad no está guardando respuestas aun.");
	location.href= "actividadesPaginaSiguiente.php";	
}

function continuar(){  
	
		<?php 
		if($paginas[$j]["tipoActividadPagina"] == "Formulario" || $hayFormulario == 1){
		
			?>	

			
			var textosEditor = "";
			<?php
			foreach ($listaItem as $item){?>
				//if ("<?php echo $item["tipoInputEnunciado"];?>" != "file"){
					//if(val_obligatorio("item<?php echo $item["idEnunciado"];?>") == false){ return; } // CAMPOS
					
				//}
				
				/* Editor */
				
				if ("<?php echo $item["tipoInputEnunciado"];?>" == "editor"){
					var divItem = document.getElementById("item<?php echo $item["idEnunciado"];?>");
					
					var iframe = divItem.getElementsByTagName("iframe");
					var content = iframe[0].contentWindow.document.body.innerHTML;
					
					
					if (content == "<br>"){
						alert("Falta completar un cuadro de texto");
						return;
					}
					else{
						document.getElementById("contestoAlgo").value = "1";
					}
					
					textosEditor = textosEditor+"item<?php echo $item["idEnunciado"];?>="+escape(simbolos(content))+"&";

					
				} <!--editor-->
				
				
				/* Radio */
				
				if ("<?php echo $item["tipoInputEnunciado"];?>" == "Radio"){
					
					var numRadios = document.getElementById("numRadios_item<?php echo $item["idEnunciado"];?>");
					var num = numRadios.value;
					
					var flagContestado = false;
					
					var i =1;
					
					for (i=1 ; i <= numRadios.value ; i++ ){
						
						var radio = document.getElementById("radio"+i+"_item<?php echo $item["idEnunciado"]; ?>");	
						var checked = radio.checked;

						if (checked){
							flagContestado = true;
						}
					
					}

					if (flagContestado == false){
						alert("Debe responder alguna alternativa");
						return;
					}
					else{
						document.getElementById("contestoAlgo").value = "1";
					}

				} <!--Radio-->
				
				
				/* Flash dinamico */
				
				if ("<?php echo $item["tipoInputEnunciado"];?>" == "hidden_flash"){

					var inputHidden = document.getElementById("item<?php echo $item["idEnunciado"]; ?>");
													
					 
					
					if (inputHidden.value == ""){
						alert("Debe ingresar una respuesta");
						return;
					}
					else{
						document.getElementById("contestoAlgo").value = "1";
					}

				} <!--Flash dinamico-->
				
				
				
				/* Ingreso valor */
				
				if ("<?php echo $item["tipoInputEnunciado"];?>" == "input_3"){

					var input = document.getElementById("item<?php echo $item["idEnunciado"]; ?>");
													
					 
					
					if (input.value == ""){
						alert("Debe ingresar un resultado");
						return;
					}
					else{
						document.getElementById("contestoAlgo").value = "1";
					}

				} <!--Ingreso valor-->
				
				
				/* Text Area */
				
				if ("<?php echo $item["tipoInputEnunciado"];?>" == "textArea"){

					var input = document.getElementById("item<?php echo $item["idEnunciado"]; ?>");
													
					 
					
					if (input.value == ""){
						alert("Falta completar un cuadro de texto");
						return;
					}
					else{
						document.getElementById("contestoAlgo").value = "1";
					}

				} <!--Text Area-->
				
				

				
			<?php 
			} // foreach
		?>
			var contesta = document.getElementById("contestoAlgo").value;
			
			if( contesta == ""){
				alert("Debe ingresar un valor para responder");
				return;
			}
		<?php
			
		}
		else{
			?>
			var textosEditor = "";	
			<?php
		}
		?>
		
		var division = document.getElementById("carga");
		var a = $(".campos").fieldSerialize(); 
		//alert(a)
		a = a + textosEditor;
		//alert(a)
		AJAXPOST("actividadesPaginaSiguiente.php",a,division);  
	}

</script>
</body>
</html>
