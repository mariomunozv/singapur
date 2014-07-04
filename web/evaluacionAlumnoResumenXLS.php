<?php 
// ini_set('display_errors','On');

ob_start("ob_gzhandler");
require("inc/incluidos.php"); 
require("inc/_item.php"); 
require("inc/_pautaItem.php"); 
require("inc/_respuestaItem.php");

?>

<?php



function getNombreColegio($rbdColegio){
	$sql = "SELECT nombreColegio FROM colegio  WHERE rbdColegio = ".$rbdColegio;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreColegio"]);
} 


function getNombreNivel($idNivel){
	$sql = "SELECT * FROM nivel WHERE idNivel = $idNivel";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreNivel"]);
	}

if(!isset($_SESSION["sesionRbdColegio"])){
		$_SESSION["sesionRbdColegio"] = $_REQUEST["rbdColegio"];
		$_SESSION["sesionIdNivel"] = $_REQUEST["idNivel"];
		$_SESSION["sesionAnoCursoColegio"]  = $_REQUEST["anoCursoColegio"];
		$_SESSION["sesionLetraCursoColegio"]= $_REQUEST["letraCursoColegio"];
		$_SESSION["sesionNombreNivel"]= $_REQUEST["nombreNivel"];
		$_SESSION["sesionIdLista"]= $_REQUEST["idLista"];
		$rbdColegio = $_SESSION["sesionRbdColegio"];
		$idNivel = $_SESSION["sesionIdNivel"];
		$letraCursoColegio = $_SESSION["sesionLetraCursoColegio"];
		$anoCursoColegio = $_SESSION["sesionAnoCursoColegio"];
		$idLista = $_SESSION["sesionIdLista"];
	//	$nombreNivel = $_SESSION["sesionNombreNivel"];
		$escala = 0.5;
		
	
		
		
}else{
		if(@$_REQUEST["rbdColegio"]){
			
				$escala = $_REQUEST["escala"];
				$rbdColegio = $_REQUEST["rbdColegio"];
				$idNivel = $_REQUEST["idNivel"];
				$letraCursoColegio = $_REQUEST["letraCursoColegio"];
				$anoCursoColegio = $_REQUEST["anoCursoColegio"];
				$idLista = $_REQUEST["idLista"];
				$_SESSION["sesionRbdColegio"] = $_REQUEST["rbdColegio"];
				$_SESSION["sesionIdNivel"] = $_REQUEST["idNivel"];
				$_SESSION["sesionAnoCursoColegio"]  = $_REQUEST["anoCursoColegio"];
				$_SESSION["sesionLetraCursoColegio"]= $_REQUEST["letraCursoColegio"];
				$_SESSION["sesionNombreNivel"]= $_REQUEST["nombreNivel"];
				$_SESSION["sesionIdLista"]= $_REQUEST["idLista"];
				
		
			
		}else{
		
				$escala = $_REQUEST["escala"];
				$rbdColegio = $_SESSION["sesionRbdColegio"];
				$idNivel = $_SESSION["sesionIdNivel"];
				$letraCursoColegio = $_SESSION["sesionLetraCursoColegio"];
				$anoCursoColegio = $_SESSION["sesionAnoCursoColegio"];
				$idLista= $_SESSION["sesionIdLista"];
				
				
				
			}
//		$nombreNivel = $_SESSION["sesionNombreNivel"];
		
}


function getDatosLista($idLista){
	$sql = "SELECT * FROM lista WHERE idLista = ".$idLista;
//	echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	$row = mysql_fetch_array($res);
	$datosLista= array( "idLista" =>$row["idLista"],
					  "puntajeTotalLista" => $row["puntajeTotalLista"],
					  "nombreLista" => $row["nombreLista"]
					  );	
	//echo $i." <- <br>";$i++;
	
	return($datosLista);
	}

function getAlumnosCurso2($rbd,$idNivel,$anoCursoColegio,$letraCursoColegio){
	$sql = "SELECT b.loginUsuario,b.rutAlumno,c.nombreAlumno,c.apellidoPaternoAlumno,c.apellidoMaternoAlumno,b.idUsuario,c.estadoAlumno FROM `matricula` a left join usuario b on a.rutAlumno = b.rutAlumno left join alumno c on a.rutAlumno = c.rutAlumno ";
	$sql.= " WHERE a.rbdColegio = '".$rbd."' AND a.idNivel = ".$idNivel." AND a.anoCursoColegio = ".$anoCursoColegio." AND a.letraCursoColegio = '".$letraCursoColegio."' ORDER BY c.apellidoPaternoAlumno,c.nombreAlumno ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$alumnosCurso[$i]= array( "idUsuario" =>$row["idUsuario"],
					  "usuario" => $row["loginUsuario"],
					  "nombreAlumno" => $row["nombreAlumno"],
					  "apellidoPaternoAlumno" => $row["apellidoPaternoAlumno"],
					   "estadoAlumno" => $row["estadoAlumno"],
					   "rutAlumno" => $row["rutAlumno"],
					  "apellidoMaternoAlumno" => $row["apellidoMaternoAlumno"]
					  );	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	
	
	return($alumnosCurso);
	
}

function getSeccionesLista($idLista){
	$sql = "SELECT * FROM lista_Item a join item b on a.idItem = b.idItem join seccionBitacora c on b.idSeccionBitacora = c.idSeccionBitacora WHERE a.idLista =".$idLista." GROUP BY b.idSeccionBitacora ORDER by b.idSeccionBitacora";

	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$seccionesLista[$i]= array( "idSeccionBitacora" =>$row["idSeccionBitacora"],
					  "nombreSeccionBitacora" => $row["nombreSeccionBitacora"]
					 
					  );	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	
	
	return($seccionesLista);
	
}

function getNivelComplejidadLista($idLista){
	$sql = "SELECT * FROM lista_Item a join item b on a.idItem = b.idItem join nivelDeComplejidad c on b.idNivelDeComplejidad = c.idNivelDeComplejidad WHERE a.idLista =".$idLista." GROUP BY b.idNivelDeComplejidad ORDER by b.idNivelDeComplejidad";

	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$nivelesLista[$i]= array( "idNivelDeComplejidad" =>$row["idNivelDeComplejidad"],
					  "nombreNivelDeComplejidad" => $row["nombreNivelDeComplejidad"],
					  "descripcionNivelDeComplejidad" => $row["descripcionNivelDeComplejidad"]
					 
					  );	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	
	
	return($nivelesLista);
	
}






function inicializarPautaAlumno($idUsuario,$idLista){
	$sql ="INSERT INTO `pautaItem` (	";
	$sql.="`idLista` ,`idUsuario` ,`idPautaItem` ,`fechaRespuestaPautaItem` ,`tiempoPautaItem` ,";
	$sql.=" `resultadoListaPautaItem` , `porcentajeLogroPautaItem`";
	$sql.=" ) VALUES ( ";
	$sql.=" ".$idLista.", ".$idUsuario.", NULL , NOW( ) , NULL , '0', '0' );";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    		die('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
		}
	$idPauta = mysql_insert_id();	
	$items = getItemsLista($idLista);
	foreach ($items as $item){
		$sql2 = "INSERT INTO `respuestaItem` (";
		$sql2.="`idItem` , `idLista` , `idUsuario` , `idPautaItem` , `idRespuestaItem` , `valorSeleccionadaItem` ,";
		$sql2.=" `opcionSeleccionadaItem` , `valorCorrectaItem` , `opcionCorrectaItem` , `puntajeRespuestaItem`) ";
		$sql2.=" VALUES ( '".$item['idItem']."', $idLista, $idUsuario, $idPauta, NULL , NULL , NULL , NULL , NULL , '0' ); ";
		$res2 = mysql_query($sql2);
		if (!$res2) {
    		die('Error en la consulta SQL: <br><b>'.$sql2.'</b><br>'. mysql_error());
		}
		}
	}
	

//print_r($_SESSION);
registraAcceso($_SESSION["sesionIdUsuario"], 15, 'NULL'); 
$idLista = $_SESSION["sesionIdLista"]; 
//$idLista = 1;
$items = getItemsLista($idLista);


header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=ResumenCursoMetodoSingapur.xls");
header("Pragma: no-cache");
header("Expires: 0");

$alumnos = getAlumnosCurso2($rbdColegio,$idNivel,$anoCursoColegio,$letraCursoColegio);
//$datosColegio = getDatosColegio($rbdColegio);
$nombreProfesor = $_REQUEST["nombreProfesor"];

?>



<p>





<table><tr valign="top">
<td width="62%">

<table class="tablesorter" id="tabla"> 
   <thead>  
   <tr>
   <th colspan="5"><?php echo getNombreNivel($idNivel)." ".$letraCursoColegio." / ".$nombreProfesor." / ".getNombreColegio($rbdColegio);?></th>
   		
   </tr>
         
  <tr>
    <th>Nº</th>
   
    <th>Nombres</th>
     <th>Puntaje</th>
    <th>%Logro</th>
    <th>Escala
   <?php if ($escala == 0.5){ echo '50%';}?>
     <?php if ($escala == 0.6){ echo '60%';}?>
    <?php if ($escala == 0.7){ echo '70%';}?></th>
   
       
   
  </tr>
  </thead>
  <tbody>

	
  <?php 
  
$datosLista = getDatosLista($idLista);


  if (count($alumnos) > 0){
	  $i = 1;
	 // echo $idLista;

		foreach ($alumnos as $alumno){ 
		//echo $alumno["idUsuario"]."<br>";
		
		$datosPauta = buscaPauta($alumno["idUsuario"],$idLista);
		
		
		if($alumno["estadoAlumno"] == 1){
			$claseTR = "normal";
			$modo = "Deshabilitar";
			$imgCambioEstado = "desactivado.gif";
		}else{
			$modo = "Confirmar";
			$claseTR = "deshabilitado";
			$imgCambioEstado = "activado.gif";
			}
		
		// CALCULO DE NOTA
		
		$referenciaE = $escala;
		$puntajeMaximo = $datosLista["puntajeTotalLista"];
		$puntajeObtenido = $datosPauta["resultadoListaPautaItem"];
		$e = $referenciaE*$puntajeMaximo;
		if($puntajeObtenido <= $e){
			$nota = (((3/$e)*$puntajeObtenido)+1);
			}else{
			$nota = 3*$puntajeObtenido/($puntajeMaximo-$e)-3*$puntajeMaximo/($puntajeMaximo-$e)+7;
			
		}
		$nota = round($nota,1);
		

		// FIN CALCLULO DE NOTA
	  ?>
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='<?php echo $claseTR; ?>'" class="<?php echo $claseTR; ?>">
              <td><?php echo $i;?></td>
                
                <td  style="text-align:left;"><?php echo $alumno["apellidoPaternoAlumno"]." ".$alumno["nombreAlumno"];?></td>
              
               <td style="text-align:center;"><?php echo $datosPauta["resultadoListaPautaItem"];?></td><td style="text-align:center;"><?php echo $datosPauta["porcentajeLogroPautaItem"]." %";?></td><td style="text-align:center;"><?php echo $nota;?></td>
             
                
      
              </tr>
<?php 	$i++;	}
 }else{ 
	 echo "<tr><td colspan='12'>No existen Alumnos en este curso.</td></tr>"; 
  
  }
 
for($i=0;$i<count($items);$i++){
    $totalItem[$i] = 0;
	foreach ($alumnos as $alumno){
		$datosPauta = buscaPauta($alumno["idUsuario"],$idLista);
		$respuesta = getRespuestaUsuarioItem($items[$i]["idItem"],$alumno["idUsuario"],$datosPauta["idPautaItem"]);

		$totalItem[$i] = $totalItem[$i] + $respuesta["puntajeRespuestaItem"];
		
		}
	} 
  

$seccionesLista = getSeccionesLista($idLista);
$nivelesLista = getNivelComplejidadLista($idLista);  

  ?>
   <div id="activa"></div>
 </tbody> 
</table>

</td>
<td valign="top">
<table class="tablesorter">
<tr><th style="text-align:center;">Item</th><th style="text-align:center;">%logro Curso</th></tr>

<?php 
$totalPuntaje = $datosLista["puntajeTotalLista"];
$totalAlumnos = count($alumnos);
//echo count($alumnos)."-".$totalPuntaje;

for($i=0;$i<count($items);$i++){ 
$porcentaje = round(($totalItem[$i]/$totalAlumnos)*100);
$items[$i]["porcentajeLogro"] = $porcentaje;
?>
<tr>
<td style="text-align:center;"><?php echo $items[$i]["enunciadoItem"]; ?></td><td style="text-align:center;"><?php echo $items[$i]["porcentajeLogro"]." %"; ?></td>
</tr>		
<?php } ?> 
</table>
<table class="tablesorter">
<tr><th  style="text-align:left;">Secciones</th><th style="text-align:center;">%logro Curso</th></tr>

<?php 

function calculaPromedioSeccion($idSeccion,$items){
	$n= 0;
	$suma=0;
	foreach($items as $item){
		if($item["idSeccionBitacora"]== $idSeccion ){
			$n++;
			$suma = $suma+$item["porcentajeLogro"];
		}
		
	}
	$porcentaje = round(($suma/$n));	
	
	return ($porcentaje);
}
function calculaPromedioNivelComplejidad($idNivelDeComplejidad,$items){
	$n= 0;
	$suma=0;
	foreach($items as $item){
		if($item["idNivelDeComplejidad"]== $idNivelDeComplejidad ){
			$n++;
			$suma = $suma+$item["porcentajeLogro"];
		}
		
	}
	$porcentaje = round(($suma/$n));	
	
	return ($porcentaje);
}


foreach($seccionesLista as $seccion){ 

$promedioSeccion = calculaPromedioSeccion($seccion["idSeccionBitacora"],$items);



?>
<tr>
<td style="text-align:left;"><?php echo $seccion["nombreSeccionBitacora"]; ?></td><td style="text-align:center;"><?php echo $promedioSeccion." %"; ?></td>
</tr>		
<?php } ?> 
</table>
<table class="tablesorter">
<tr><th style="text-align:left;">Niveles</th><th style="text-align:center;">%logro Curso</th></tr>

<?php 

foreach($nivelesLista as $nivel){ 
$promedioNivel = calculaPromedioNivelComplejidad($nivel["idNivelDeComplejidad"],$items);

?>
<tr>
<td style="text-align:left;"><strong><?php echo $nivel["nombreNivelDeComplejidad"]; ?></strong></td><td style="text-align:center;"><?php echo $promedioNivel." %"; ?></td>
</tr>	

<?php } ?> 
</table>


</td></tr></table>
<?php ob_end_flush();?>