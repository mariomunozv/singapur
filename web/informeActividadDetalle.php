<?php 
ini_set("display_errors","On");
require("inc/incluidos.php");
include "inc/_actividad.php";

function getIdListaActividad($idActividad){
	$sql= "SELECT *	FROM lista WHERE idActividad = $idActividad";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["idLista"];
	
	}
function getIdFormularioActividad($idActividad){
	$sql= "SELECT *	FROM formulario WHERE idActividadPagina = $idActividad";
	echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["idFormulario"];
	
	}
	
function getPautasItemLista($idUsuario,$idLista){
	$sql = "SELECT * FROM pautaItem where idUsuario = ".$idUsuario." AND idLista = ".$idLista;
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$pautasUsuario[$i] = array(
			"idLista"=> $row["idLista"],
			"idUsuario" => $row["idUsuario"],
			"idPautaItem" => $row["idPautaItem"],
			"fechaRespuestaPauta" => $row["fechaRespuestaPautaItem"],
			"porcentajeLogroPautaItem" => $row["porcentajeLogroPautaItem"]
					
			);
		$i++;
	}
	if ($i == 0){
		$pautasUsuario[$i] = array();	
	} 
	return($pautasUsuario);
	}	
	





$idCurso = $_SESSION["sesionIdCurso"];
$idUsuario = $_REQUEST["idUsuario"];
$nombreUsuario = getNombreUsuario($idUsuario);
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$idActividad = $_REQUEST["idActividad"];
$datosActividad = getDatosActividad($idActividad);
print_r($datosActividad);

$alumnos = getAlumnosCurso($idCurso);
$_SESSION["sesionIdActividad"] = $idActividad;


// Menor que APE y idUsuario de GET es distinto a idUsuario de SESSION
if ($_SESSION["sesionPerfilUsuario"] < 5 && $_REQUEST["idUsuario"] != $_SESSION["sesionIdUsuario"]){ 
	
	alerta("Por favor no intente hacer cosas que no debe.");
	session_destroy();
	dirigirse_a("../index.php");
}




require ("hd.php");

if($datosActividad["linkActividad"] == "actividadesPagina.php"){
	echo "pasa por acá";
	$idFormulario = getIdFormularioActividad($datosActividad["idActividad"]);	
	$tipo = "F";
}else{
	$idLista = getIdListaActividad($datosActividad["idActividad"]);
	$tipo = "L";
}


$pautas = getPautasItemLista($idUsuario,$idLista);



?>
<link rel="stylesheet" type="text/css" href="series/shadowbox/shadowbox.css">
<script type="text/javascript" src="series/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
<body>
<div id="principal">
<?php 
require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
//$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"].",Actividades*informeActividad.php,Informe Curso*informeActividadCurso.php?idActividad=".$idActividad.",Informe Usuario*informeActividadDetalle.php?idUsuario=".$idUsuario."&idActividad=".$idActividad;
//require("_navegacion.php");

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
       <table border="0" align="center" width="100%" class="tablesorter">

    <tr  align="center">
        <th width="90">N&deg; Intento</th>
        <th width="470">Fecha Respuesta</th>
        <th width="287">Porcentaje Obtenido </th>
        <th width="255">Respuestas</th>
    </tr>
  <?php $i = 1; 
  	foreach ($pautas as $pauta){?>
   <tr  align="center">
        <td ><?php echo $i;?></td>
        <td ><?php echo fechaConFormato($pauta["fechaRespuestaPauta"]);?></td>
        <td ><?php echo $pauta["porcentajeLogroPautaItem"]." %";?> </td>
        <td ><a href="informeActividadResultado.php?idPauta=<?php echo $pauta["idPautaItem"];?>&idUsuario=<?php echo $pauta["idUsuario"]."&idActividad=".$idActividad;?>"  >Ver Respuestas</a></td>
    </tr>
  
  
  <?php 
  $i++;
  }?>
</table>
        
        <?php boton("Volver","history.back();");?>

   
    
       
        
      </div><!--columnaCentro-->
         
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
