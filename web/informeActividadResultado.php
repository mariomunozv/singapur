
<?php 
require("inc/incluidos.php");

include "inc/_actividad.php";


require ("hd.php");


function getRespuestasPautaItemUsuario($idPauta,$idUsuario){
	$sql = "SELECT * FROM respuestaItem where idUsuario = ".$idUsuario." AND idPautaItem = ".$idPauta;
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$respuestasUsuario[$i] = array(
			"idItem"=> $row["idItem"],
			
			"idUsuario" => $row["idUsuario"],
			"idPautaItem" => $row["idPautaItem"],
			"idRespuestaItem" => $row["idRespuestaItem"],
			"valorSeleccionadaItem" => $row["valorSeleccionadaItem"],
			"opcionSeleccionadaItem" => $row["opcionSeleccionadaItem"],
			"valorCorrectaItem" => $row["valorCorrectaItem"],
			"opcionCorrectaItem" => $row["opcionCorrectaItem"],
			"puntajeRespuestaItem" => $row["puntajeRespuestaItem"]
			);
		$i++;
	}
	if ($i == 0){
		$respuestasUsuario[$i] = array();	
	} 
	return($respuestasUsuario);
	
}	
$idPauta = $_REQUEST["idPauta"];
$idUsuario = $_REQUEST["idUsuario"];
$idActividad = $_REQUEST["idActividad"];
$nombreUsuario = getNombreUsuario($idUsuario);
$datosActividad = getDatosActividad($idActividad);


///////// SEGURIDAD ////////////////
// Menor que APE y idUsuario de GET es distinto a idUsuario de SESSION
if ($_SESSION["sesionPerfilUsuario"] < 5 && $_REQUEST["idUsuario"] != $_SESSION["sesionIdUsuario"]){ 
	
	alerta("No puedes acceder a esta página.");
	dirigirse_a("../home.php");
}


////// ACTUALIZACION NOTIFICACION
/* Se actualiza el estado de notificacion en caso de entrar a traves de las notificaciones */
if (isset($_REQUEST["idNotificacion"])){
	$idNotificacion = $_REQUEST["idNotificacion"];
	actualizaEstadoNotificacion($idNotificacion);
}

?>
<link rel="stylesheet" type="text/css" href="series/shadowbox/shadowbox.css">
<script type="text/javascript" src="series/shadowbox/shadowbox.js"></script>


<script type="text/javascript">
Shadowbox.init();
</script>
<script language=javascript>
function closer() {
	var ventana = window.self;
	ventana.opener = window.self;
	ventana.close();
} 


function nuevo_comentario(){
	
	 var division = document.getElementById("comentario");
	 a = "tablaComentario=pauta"+"&idReferenciaComentario="+<?php echo $idPauta; ?>+"&idUsuarioNotificado="+<?php echo $idUsuario; ?>+"&idActividad="+<?php echo $idActividad; ?>;
	 AJAXPOST("informeActividadComentarioNuevo.php",a,division);
	
}

function listado_comentarios(){
	
	 var division = document.getElementById("listado_comentarios");
	 a = "tablaComentario=pauta"+"&idReferenciaComentario="+<?php echo $idPauta; ?>;
	 AJAXPOST("informeActividadComentarioListado.php",a,division);
	
}
</script>

<body>
<div id="principal">
<?php 
require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"].",Actividades*informeActividad.php,Informe Curso*informeActividadCurso.php?idActividad=".$idActividad.",Informe Usuario*informeActividadDetalle.php?idUsuario=".$idUsuario."&idActividad=".$idActividad.",Respuestas*informeActividadResultado.php?idPauta=".$idPauta."&idUsuario=".$idUsuario;
require("_navegacion.php");

?>
	
    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
		
		require("caja_participantes.php");
		 
		require("caja_mensajes.php");
		
		?>
    

    </div>
    
    
    
     <div id="lateralDer">
      <?php 
	  require("caja_bienvenida.php");
		require("caja_calendario.php");
	  ?>
         <br />
    
                      
   		
          
  </div>
    
	<div id="columnaCentro">
     
        <p class="titulo_curso">Informe de <?php echo $nombreUsuario; ?></p>
        <hr />
        <br />
   <p class="titulo_curso"><?php echo $datosActividad["tituloActividad"]; ?></p>
   <input name="idPauta" type="hidden" value="<?php echo $idPauta; ?>">
       <?php 
	   
	   $respuestas = getRespuestasPautaItemUsuario($idPauta,$idUsuario);

echo '<table class="tablesorter"><tr><th>Numero Item</th><th colspan="2">Puntos Obtenidos</th><th>Puntaje Total </th><th>Opcion</th></tr>';
$i = 0;
if($respuestas[0]){
foreach($respuestas as $respuesta){
	$imagen = "";

	
	if($respuesta["puntajeRespuestaItem"] >= 1){
		$imagen = '<img src="../img/ok.jpg"  />';
		}
	if($respuesta["puntajeRespuestaItem"] < 1 && $respuesta["puntajeRespuestaItem"] > 0){
		$imagen = '<img src="../img/okMedio.jpg"  />';
		}	
	if($respuesta["puntajeRespuestaItem"] == 0){
		$imagen = '<img src="../img/malo.jpg"  />';
		}	
	
	if($respuesta["puntajeRespuestaItem"]  == ""){
		$respuesta["puntajeRespuestaItem"] = 0;
		}
	
	

	
	echo "<tr>";
	echo "<td>".($i+1)."</td>";
	//echo $lista["idItem"]."--ID";
	$totalPuntosItem =  1;
	
	if ($_SESSION["sesionPerfilUsuario"] < 5){ // Menor que APE
		$link = "series/verItem.php";
	}else{
		$link = "series/verItemContestado.php";	
	}
	
	echo "<td>".$respuesta["puntajeRespuestaItem"]." </td><td>".$imagen."</td>";
	echo "<td>".$totalPuntosItem." </td><td><a href='".$link."?idItem=".$respuesta["idItem"]."&idUsuario=".$idUsuario."&idPauta=".$idPauta."&puntajeRespuestaItem=".$respuesta["puntajeRespuestaItem"]."' rel='shadowbox;height=880;width=1690'>Ver Item</a></td>";
	@$totalObtenidos = $totalObtenidos +$respuesta["puntajeRespuestaItem"];
	@$totalPuntos =$totalPuntos+$totalPuntosItem;
	$i++;
	echo '</tr>';
	}
echo '<tr>    <td>Totales</td> <td colspan="2">'.$totalObtenidos.' Punto(s) obtenido(s)</td>    <td>'.$totalPuntos .' Puntos en total</td> <td></td> </tr></table>';
$porcentaje = ($totalObtenidos/$totalPuntos);
echo '<tr><th colspan="4" ><h2>'.(round($porcentaje,2)*100).'% de Logro Obtenido</h2></th> </tr>';
}else{
echo '<tr><th colspan="4">'.'Este Usuario no respondió ningun item en este intento</th> </tr>';	


}
echo '</table><br>';

?>
<div id="listado_comentarios"></div>
<div id="comentario"></div>


<script type="text/javascript">
listado_comentarios();
</script>
<br>




       
        
      </div><!--columnaCentro-->
         
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
