<?php

session_start();
include "../inc/conectav10.php";
include "../inc/funciones.php";
Conectarse();


function actualizaPauta($idPauta,$porcentaje){
   // echo "porcentaje funcion ----> ".$porcentaje;

	$sql_insert = "UPDATE `pautaItem` SET `fechaRespuestaPautaItem` = NOW( ) , ";
	$sql_insert .=" `porcentajeLogroPautaItem` = '$porcentaje' WHERE `idPautaItem` = '$idPauta'";					   
	$res_insert = mysql_query($sql_insert);
	//echo "<br> actualiza : ".$sql_insert;
	return;
}


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
<tr><td colspan="4"><h2>Ha finalizado la serie de problemas, a continuaci&oacute;n puede ver sus resultados</h2></td></tr>

<tr><td>




<?php 
//print_r($_SESSION);
echo '<table class="tablesorter"><tr><th>Numero Item</th><th colspan="2">Puntos Obtenidos</th><th>Puntaje Total </th><th>Opcion</th></tr>';
$i = 0;
foreach($_SESSION["listaResolucion"] as $lista){
	$imagen = "";

	
	if($_SESSION["puntajes"][$i] >= 1){
		$imagen = '<img src="../img/ok.jpg"  />';
		}
	if($_SESSION["puntajes"][$i] < 1 && $_SESSION["puntajes"][$i] > 0){
		$imagen = '<img src="../img/okMedio.jpg"  />';
		}	
	if($_SESSION["puntajes"][$i] == 0){
		$imagen = '<img src="../img/malo.jpg"  />';
		}		
			
		
		
	echo "<tr>";
	echo "<td>".($i+1)."</td>";
	//echo $lista["idItem"]."--ID";
	$totalPuntosItem =  1;
	echo "<td>"." (".$_SESSION["puntajes"][$i].") </td><td>".$imagen."</td>";
	echo "<td>".$totalPuntosItem." </td><td><a href='verItem.php?idItem=".$lista["idItem"]."' rel='shadowbox;height=550;width=1000'>Ver Item</a></td>";
	@$totalObtenidos = $totalObtenidos +$_SESSION["puntajes"][$i];
	@$totalPuntos =$totalPuntos+$totalPuntosItem;
	$i++;
	echo '</tr>';
	}
echo '<tr>    <td>Totales</td> <td colspan="2">'.$totalObtenidos.' Punto(s) obtenido(s)</td>    <td>'.$totalPuntos .' Puntos en total</td> <td></td> </tr></table>';
$porcentaje = ($totalObtenidos/$totalPuntos);
echo '<tr><th colspan="4">'.(round($porcentaje,2)*100).'% de Logro Obtenido</th> </tr>';
if((round($porcentaje,2)*100) < 80){
	$mensaje = "Debes conseguir un porcentaje mayor a 80% para continuar con la siguiente actividad";
}else{
	$mensaje = "Felicitaciones!, haz logrado el porcentaje de logro para pasar a la siguiente actividad. Vuelve a la pagina de inicio y continua con la siguiente actividad";	
}
echo '<tr><th colspan="4"><p >'.$mensaje.'</p></th> </tr></table>';
boton("Finalizar Actividad","closer();");

//print_r($_SESSION["listaResolucion"] );


?>
</td></tr></table>
</div></div>
<?php actualizaPauta($_SESSION["idPauta"],(round($porcentaje,2)*100)); 


?> 


</body>
</html>
