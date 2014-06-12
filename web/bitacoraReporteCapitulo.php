<?php require("inc/incluidos.php"); ?>
<?php require ("hd.php");

$idSeccionPadre = $_REQUEST["idCapitulo"];
$idCurso = $_SESSION["sesionIdCurso"];
$nombreCurso = getNombreCortoCurso($idCurso);





function getNombreSeccion($idSeccionBitacora){
	$sql = "SELECT nombreSeccionBitacora FROM seccionBitacora  WHERE idSeccionBitacora = ".$idSeccionBitacora;
	//echo $sql;
	$res = mysql_query($sql);
   	$row = mysql_fetch_array($res);	
	return $row["nombreSeccionBitacora"];
	
}

function getBitacoraSeccion($idSeccionBitacora){
	$sql = "SELECT * FROM bitacora  WHERE idSeccionBitacora = ".$idSeccionBitacora;
	//echo $sql."<BR>";
	$res = mysql_query($sql);
   	$i = 0;
	while($row = mysql_fetch_array($res)){		
	$bitacora[$i]=array(
					"fechaBitacora" => $row["fechaBitacora"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
					"fechaCreacionBitacora" => $row["fechaCreacionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"idUsuario" => $row["idUsuario"]
				
				);
		$i++;
	}
	if($i==0){
		$bitacora = array();
	}
	
	return($bitacora);
	
}

function getSeccionesCapitulo($idSeccionPadre){
	$sql = "SELECT * FROM seccionBitacora WHERE idPadreSeccionBitacora = ".$idSeccionPadre;
	//echo $sql."<BR>";
	$res = mysql_query($sql);
   	$i = 0;
	while($row = mysql_fetch_array($res)){		
	$secciones[$i]=array("nombreSeccionBitacora"=> $row["nombreSeccionBitacora"],
					"idSeccionBitacora" => $row["idSeccionBitacora"],
					"tiempoEstimadoSeccionBitacora" => $row["tiempoEstimadoSeccionBitacora"]
					
				
				);
		$i++;
	}
	if($i==0){
		$secciones = array();
	}
	
	return($secciones);
	
}



?>

   
  

	<?php 
	//print_r($_SESSION);

    $secciones = getSeccionesCapitulo($idSeccionPadre);
	$nombreSeccion = getNombreSeccion($idSeccionPadre)
	
//	print_r($datosUsuario);
	?>
    
    
<table class="tablesorter" id="tabla2">


   <thead>     
   <tr><th colspan="8">CAPITULO: <?php echo $nombreSeccion;?> - <?php echo $nombreCurso; ?></th></tr>    
  <tr>
    <th width="80">Sección</th>
  <th width="40">Docente</th>
  <th width="40">Escuela </th>
    <th width="55">Fecha Inicio </th>
    <th width="10" title="Horas Realizadas">HR </th>
	<th width="10" title="Horas Propuestas">HP</th>
    <th width="10" title="Razón">HR/HP</th>
	<th>Comentario</th>


   
  </tr>
  </thead>
  <tbody>
  

  <?php 
    
 
		foreach ($secciones as $seccion){ 
		$bitacoras = getBitacoraSeccion($seccion["idSeccionBitacora"]);
		 if ($bitacoras){?>
		<tr><th colspan="8"><?php echo $seccion["nombreSeccionBitacora"]?></th></tr>	 
		  <?php  foreach($bitacoras as $bit){
		
				$datosProfesor = getDatosProfesor2($bit["idUsuario"]);
			
			
		//	print_r($bit);
	 ?>
				  <tr>
                  <td width="80" title="Nombre Sección"><?php echo $seccion["nombreSeccionBitacora"]; ?></td>
				  <td title="Nombre Profesor"><b><?php echo $datosProfesor["nombreParaMostrar"];?></b></td>
					<td title="Escuela"><?php echo $datosProfesor["nombreColegio"];?></td>
					<td title="Fecha Clase"><?php echo cambiaf_a_normal($bit["fechaBitacora"]);?></td>
					<td title="Horas Realizadas"><?php echo $bit["tiempoBitacora"];?></td>
					<td title="Horas Propuestas"><?php echo $seccion["tiempoEstimadoSeccionBitacora"];?></td>
                    <td title="Razón HR/HP"><?php echo round(($bit["tiempoBitacora"]/$seccion["tiempoEstimadoSeccionBitacora"]),1);?></td>
					<td><?php echo $bit["comentariosBitacora"];?></td>
				
				   
				  </tr>
                  
<?php 		}	
			
 }else{ 
	 echo "<tr><td colspan='13'>No existen bitacoras en la seccion <b>".$seccion["nombreSeccionBitacora"]."</b></td></tr>"; 
  
  }
		}
 
  
  ?>
  
  
 </tbody> 
</table>
	  
                   
                     
