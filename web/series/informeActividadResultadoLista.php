<?php

session_start();
include "../inc/conectav10.php";
include "../inc/funciones.php";
Conectarse();

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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  	<title>Resultados</title>
  	<meta name="description" content="" />
  	<meta name="keywords" content="" />
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />	
<link rel="stylesheet" href="css/estilo.css" type="text/css" >
<link rel="stylesheet" href="../css/tabla.css" type="text/css" >
<link href="../css/custom-theme/jquery-ui-1.8rc3.custom.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="shadowbox/shadowbox.css">
<script type="text/javascript" src="shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
<script language=javascript>
function closer() {
	var ventana = window.self;
	ventana.opener = window.self;
	ventana.close();
} 
</script>

</head>
<body>
<div id="todo">
<div id="top">&nbsp;</div>
	<div id="contenido">
<table border="0" width="500" align="center" cellpadding="0" cellspacing="0">
<tr><td colspan="4"><h2>Resultados </h2></td></tr>

<tr><td>




<?php 

$respuestas = getRespuestasPautaItemUsuario($idPauta,$idUsuario);

echo '<table class="tablesorter"><tr><th>Numero Item</th><th>Puntos Obtenidos</th><th>Puntaje Total </th><th>Opcion</th></tr>';
$i = 0;
if($respuestas[0]){
foreach($respuestas as $respuesta){

	if($respuesta["puntajeRespuestaItem"]  == ""){
		$respuesta["puntajeRespuestaItem"] = 0;
		}
	
	echo "<tr>";
	echo "<td>".($i+1)."</td>";
	//echo $lista["idItem"]."--ID";
	$totalPuntosItem =  1;
	echo "<td>".$respuesta["puntajeRespuestaItem"]." </td>";
	echo "<td>".$totalPuntosItem." </td><td><a href='verItem.php?idItem=".$respuesta["idItem"]."' rel='shadowbox;height=550;width=1000'>Ver Item</a></td>";
	@$totalObtenidos = $totalObtenidos +$respuesta["puntajeRespuestaItem"];
	@$totalPuntos =$totalPuntos+$totalPuntosItem;
	$i++;
	echo '</tr>';
	}
echo '<tr>    <td>Totales</td> <td>'.$totalObtenidos.' Punto(s) obtenido(s)</td>    <td>'.$totalPuntos .' Puntos en total</td> <td></td> </tr></table>';
$porcentaje = ($totalObtenidos/$totalPuntos);
echo '<tr><th colspan="4">'.(round($porcentaje,2)*100).'% de Logro Obtenido</th> </tr>';
}else{
echo '<tr><th colspan="4">'.'Este Usuario no respondió ningun item en este intento</th> </tr>';	


}
echo '</table>';


//print_r($_SESSION["listaResolucion"] );


?>
</td></tr></table>
</div></div>



</body>
</html>
