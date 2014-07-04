<?php 
ini_set("display_errors","ON");
require("inc/incluidos.php");

include_once("inc/_actividad.php");
include_once("inc/_pauta.php");
include_once("inc/_formulario.php");


function segToMin($segundos) {
	$minutos = floor($segundos/60);
	$seg = ((integer)$segundos - ((integer)$minutos * 60));
	if ($seg < 10) {
		$seg = "0" . $seg;
	}
	if ($minutos < 10) {
		$minutos = "0" . $minutos;
	}

	return $minutos . ":" . $seg;
}
 
function getIdsTipoPaginasActividad($idActividad){
	$sql ="SELECT * FROM actividadPagina WHERE idActividad = ".$idActividad." ORDER BY ordenActividadPagina ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
			$paginasActividad[$i] = array(
			"idActividadPagina"=> $row["idActividadPagina"],
			"idActividad"=> $row["idActividad"],
			"nombreActividadPagina" => $row["nombreActividadPagina"],
			"tipoActividadPagina" => $row["tipoActividadPagina"],
			"ordenActividadPagina" => $row["ordenActividadPagina"]);
			$i++;	
	}
	if ($i == 0){
		$paginasActividad[$i] = array();	
	} 
	return($paginasActividad);
}

function isActividad($idActividad){

	$sql ="SELECT * FROM lista WHERE idActividad = ".$idActividad." ";
	$res = mysql_query($sql);
	$isActividad = false;

	while($row = mysql_fetch_array($res)){
		$isActividad = true;
	}

	return $isActividad;
}


function getIntentos($idActividad,$idUsuario){
	//$sql ="SELECT * FROM pautaItem as PI inner join lista as L on PI.idLista = L.idLista WHERE idActividad = ".$idActividad." and idUsuario = ".$idUsuario." ORDER BY porcentajeLogroPautaItem DESC limit 3";
	$sql ="SELECT * FROM pautaItem as PI inner join lista as L on PI.idLista = L.idLista WHERE idActividad = ".$idActividad." and idUsuario = ".$idUsuario." ORDER BY fechaRespuestaPautaItem ASC limit 3";

	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
			$intentos[] = array(
			"idPautaItem"=> $row["idPautaItem"],
			"porcentajeLogroPautaItem" => $row["porcentajeLogroPautaItem"],
			"tiempoPautaItem" => $row["tiempoPautaItem"]);	
	}
	
	return $intentos;

}
	
// Curso
$idCurso = $_SESSION["sesionIdCurso"];

// Usuario
if (isset($_REQUEST["idUsuarioRevisado"])){
	// Alguien esta revisando la actividad (un asesor), viene un idusuario por GET
	$_SESSION["sesionIdUsuarioRevisado"] = $_REQUEST["idUsuarioRevisado"];
}
else{
	// Para que no se mantenga la variable de sesion si se utilizó antes
	unset($_SESSION["sesionIdUsuarioRevisado"]);
}


$idUsuario = $_SESSION["sesionIdUsuario"];	

$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$idActividad = $_REQUEST["idActividad"];

$datosActividad = getDatosActividad($idActividad);
//print_r($datosActividad);


$_SESSION["sesionIdActividad"] = $idActividad;


//registraAcceso($_SESSION["sesionIdUsuario"], 13, $idActividad);


require ("hd.php");?>

<body>

<style type="text/css">
	table.tablesorter {
		width: 60%;
	}

</style>

<div id="principal">
<?php require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
//$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"].",".$datosActividad["tituloActividad"]."*#";
//require("_navegacion.php");

?>
	
<div id="lateralIzq">
	<?php 	require("menuleft.php") ?>
</div>
    
    
<div id="lateralDer">
	<?php 	require("menuright.php") ?>
</div>
    
	<div id="columnaCentro">
	
    <p class="titulo_curso">Resultados Obtenidos:<?php echo  $datosActividad["tituloActividad"]; ?></p>

        <hr />
        <br />

    <center>
	    <table class="tablesorter">
	   	<thead>
	    <tr class="ui-state-active">
			<th width="20px"> Intento </th>
			<th width="100px"> <center>Porcentaje Logro</center></th>
			<th width=""> <center>Tiempo</center></th>
			<th width=""> </th>
		</tr>
		</thead>
		<tbody>
		<?php $intentos = getIntentos($idActividad,$idUsuario);
		   
		   $i = 1;
		   $maxPorcentaje = 0; 
		   foreach($intentos as $row){
		   	$porcentaje = $row["porcentajeLogroPautaItem"];
		   	$tiempo = $row["tiempoPautaItem"];
		   	?>
		   		<tr>
		   			<td><center> <?php echo $i; ?></center></td>
		   			<td><center> <?php echo $porcentaje."%"; ?></center></td>
		   			<td><center> <?php echo segToMin($tiempo); ?></center></td>
		   			<td><center> <a href="<?php echo "actividaditems.php?idPautaItem=".$row["idPautaItem"]."&idActividad=".$idActividad; ?>" >Ver Items</a></center></td>
		   		</tr>
		   	<?php

		   	if($maxPorcentaje < $porcentaje){
		   		$maxPorcentaje = $porcentaje;
		   	}

		   	$i++;
		   }   
		?>

		</tbody>
	    </table>  

	    <br><br>
	    <h2>Su porcentaje de logro final es <?php echo $maxPorcentaje."%";?>.</h2> <br><h3>Éste fue calculado considerando el mayor puntaje de sus tres primeros intentos</h3>
		<br>
		<?php boton("Volver","history.back();"); ?>
	</center>
        
    </div><!--columnaCentro-->
     
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
