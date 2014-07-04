<?php session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
Conectarse_seg();
$idPadre = $_REQUEST["idPadre"];

function getNombreSeccionBitacora($idSeccion){
	$sql ="SELECT * FROM seccionBitacora where idSeccionBitacora = ".$idSeccion;
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreSeccionBitacora"]);
}


function getSeccionesHijas($idPadre){
	$sql = "SELECT * from seccionBitacora WHERE idPadreSeccionBitacora = ".$idPadre." ORDER BY idSeccionBitacora ASC";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$seccionesHijas[$i]=array("idSeccionBitacora"=> $row["idSeccionBitacora"],"nombreSeccionBitacora" => $row["nombreSeccionBitacora"]);
		$i++;
	}
	if ($i == 0){
		$seccionesHijas = NULL;				
	} 
	return($seccionesHijas);
	
	}

function getBitacoraSeccionUsuario($idSeccion,$idUsuario){
	$sql = "SELECT * FROM bitacora WHERE idUsuario = ".$idUsuario." AND idSeccionBitacora =".$idSeccion;
	//echo $sql."<BR>";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
    $num_rows = mysql_num_rows($res);
	
	if($num_rows>0){
		$bitacora=array("nombreBitacora "=> $row["nombreBitacora"],
					"fechaBitacora" => $row["fechaBitacora"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"]
					);
	}else{
		$bitacora = array();
	}
	
	return($bitacora);
	
}


$secciones = getSeccionesHijas($idPadre);

//print_r($secciones);

?>








<?php 
$hayBitacora = 0;
foreach ($secciones as $seccion){
	
	
	$bitacora = getBitacoraSeccionUsuario($seccion["idSeccionBitacora"],$idUsuario);

if($bitacora){
		$nombreSeccionBitacora = getNombreSeccionBitacora($bitacora["idSeccionBitacora"]);
		
	?>
    <br>
<h3>Bitacoras completadas - <?php echo $nombreSeccionBitacora;?></h3>
<br>
<table width="88%" border="0" align="center" class="tablesorter">



    <tr >
        <th width="50%">Seccion</th>
        <th width="20%">Fecha inicio</th>
        <th width="20%">Horas pedagógicas</th>                 
        </tr>
  
    <tr>
  
        <td align="center" valign="top">
        	<?php echo $nombreSeccionBitacora;?>
        </td>

		<td align="center" valign="top">
        	<?php echo $bitacora["fechaBitacora"];?>
        </td>
        
        <td align="center" valign="top">
            <?php echo $bitacora["tiempoBitacora"];?>
        </td>
	
    </tr>
    
	<tr>
    	<th colspan="4">Principales aspectos detectados en la implementación de la sección:</th>
	</tr>
    
	<tr >
    	<td colspan="4">
          <?php echo nl2br($bitacora["comentariosBitacora"]);?>
        </td>
    </tr>
    
</table>
<?php $hayBitacora++;
	}else{
		
	
	}
	



}

if ($hayBitacora == 0){
	
	echo "No hay Bitacoras Ingresadas";
	}

?>

