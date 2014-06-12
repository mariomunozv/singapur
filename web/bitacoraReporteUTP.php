<?php require("inc/incluidos.php"); ?>
<?php require ("hd.php");

$idUsuario = $_REQUEST["idUsuario"];
$tipoBitacora = $_REQUEST["instancia"];
$idCurso = $_SESSION["sesionIdCurso"];
$nombreCurso = getNombreCortoCurso($idCurso);



function getBitacoraUsuarioTipo($idUsuario,$tipoBitacora){
	$sql = "SELECT * FROM bitacora  WHERE idUsuario = ".$idUsuario." AND tipoBitacora = '".$tipoBitacora."'";
	//echo $sql."<BR>";
	$res = mysql_query($sql);
   	$i = 0;
	while($row = mysql_fetch_array($res)){		
	$bitacora[$i]=array("nombreBitacora"=> $row["nombreBitacora"],
					"fechaBitacora" => $row["fechaBitacora"],
					"tiempoBitacora" => $row["tiempoBitacora"],
					"idBitacora" => $row["idBitacora"],
					"comentariosBitacora" => $row["comentariosBitacora"],
								
					"idUsuario" => $row["idUsuario"]
				
				);
		$i++;
	}
	if($i==0){
		$bitacora = array();
	}
	
	return($bitacora);
	
}

function getNivelesBitacora($idBitacora){
	$sql = "SELECT b.nombreNivel FROM detalleBitacoraNivel a join nivel b on a.idNivel = b.idNivel WHERE idBitacora = ".$idBitacora;
	//echo $sql."<BR>";
	$res = mysql_query($sql);
   	$i = 0;
	while($row = mysql_fetch_array($res)){		
	$niveles[$i]=array("nombreNivel"=> $row["nombreNivel"]
					
				
				);
		$i++;
	}
	if($i==0){
		$niveles = array();
	}
	
	return($niveles);
	
}



?>

   
  

	<?php 
	//print_r($_SESSION);

    $bitacoras = getBitacoraUsuarioTipo($idUsuario,$tipoBitacora); 
	$datosProfesor = getDatosProfesor2($idUsuario);
//	print_r($datosUsuario);
	?>
    
    
<table class="tablesorter" id="tabla2">


   <thead>     
   <tr><th colspan="4"> <?php echo $datosProfesor["nombreParaMostrar"];?> <?php echo $datosProfesor["nombreColegio"]; ?><br /> Curso: <?php echo $nombreCurso; ?></th></tr>    
  <tr>
  <th width="80">Fecha</th>
  <th width="15">Minutos </th>
    <th width="40">Nivel(es) </th>
	<th>Comentario</th>


   
  </tr>
  </thead>
  <tbody>
  

  <?php 
    
  if ($bitacoras){
		foreach ($bitacoras as $bit){  
		$nivelesBitacora = getNivelesBitacora($bit["idBitacora"]);
		
	//	print_r($bit);
 ?>
              <tr>
                <td title="Fecha "><?php echo cambiaf_a_normal($bit["fechaBitacora"]);?></td>
                <td title="Minutos"><?php echo $bit["tiempoBitacora"];?></td>
				 <td title="Niveles"><?php foreach($nivelesBitacora as $nivel){ echo $nivel["nombreNivel"]."<br>";};?></td>
				<td><?php echo $bit["comentariosBitacora"];?></td>
			
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='12'>No existen bitacoras para este profesor</td></tr>"; 
  
  }
 
  
  ?>
  
  
 </tbody> 
</table>
	  
                   
                     
