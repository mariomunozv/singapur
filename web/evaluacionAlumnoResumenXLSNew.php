<?php 
// ini_set('display_errors','On');

ob_start("ob_gzhandler");
require("inc/incluidos.php"); 
require("inc/_item.php"); 
require("inc/_tareaMatematica.php"); 
require("inc/_pautaItem.php"); 
require("inc/_respuestaItem.php");

function getNombreNivel($idNivel){
	$sql = "SELECT * FROM nivel WHERE idNivel = $idNivel";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreNivel"]);
}

function calculaNotaPorEscala($escala, $puntajeMaximo, $puntajeObtenido) {
	$e = $escala*$puntajeMaximo;
	if($puntajeObtenido <= $e){
		$nota = (((2/$e)*$puntajeObtenido)+2);
	}else{
		$nota = (3*$puntajeObtenido/($puntajeMaximo-$e))+((4*$puntajeMaximo-7*$e)/($puntajeMaximo-$e));
	}
	$nota = round($nota,1);
	return $nota;
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
				// echo "hay sesion";
				$escala = $_REQUEST["escala"];
				$rbdColegio = $_SESSION["sesionRbdColegio"];
				$idNivel = $_SESSION["sesionIdNivel"];
				$letraCursoColegio = $_SESSION["sesionLetraCursoColegio"];
				$anoCursoColegio = $_SESSION["sesionAnoCursoColegio"];
				$idLista= $_SESSION["sesionIdLista"];
				// echo $idLista;
			}
//		$nombreNivel = $_SESSION["sesionNombreNivel"];		
}

//echo $idLista."<------------!";
function getDatosLista($idLista){
	$sql = "SELECT * FROM lista WHERE idLista = ".$idLista;
	//echo $sql;
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

function getAlumnosCurso2($rbd, $idNivel, $anoCursoColegio, $letraCursoColegio, $idLista){
	$sql = "SELECT u.loginUsuario,u.rutAlumno,a.nombreAlumno,a.apellidoPaternoAlumno,a.apellidoMaternoAlumno,u.idUsuario,a.estadoAlumno, pi.asistio as asistio
                FROM `matricula` as m
                left join usuario as u on m.rutAlumno = u.rutAlumno
                left join alumno as a on m.rutAlumno = a.rutAlumno
                left join pautaItem as pi on pi.idUsuario = u.idUsuario
                WHERE m.rbdColegio = '". $rbd."'
                AND m.idNivel = ".$idNivel."
                AND m.anoCursoColegio = ".$anoCursoColegio."
                AND m.letraCursoColegio = "."'$letraCursoColegio'"."
                AND pi.idLista = ". $idLista ."
                ORDER BY a.apellidoPaternoAlumno ASC";
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
					  "apellidoMaternoAlumno" => $row["apellidoMaternoAlumno"],
					  "asistio" => $row["asistio"]
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

function getTareasLista($idLista){
	$sql = "SELECT * FROM lista_Item a JOIN item b ON a.idItem = b.idItem";
	$sql .= " JOIN tareaMatematica c ON b.idTareaMatematica= c.idTareaMatematica WHERE a.idLista = ".$idLista;
	$sql .= " GROUP BY b.idTareaMatematica ORDER by b.idTareaMatematica";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$tareasLista[$i]= array( "idTareaMatematica" =>$row["idTareaMatematica"],
					  "nombreTareaMatematica" => $row["nombreTareaMatematica"]
					 
					  );	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	return($tareasLista);
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

function getNivelComplejidadItem($idItem){
	$sql = "SELECT nombreNivelDeComplejidad";
	$sql .= " FROM nivelDeComplejidad n, item i";
	$sql .= " WHERE n.idNivelDeComplejidad = i.idNivelDeComplejidad";
	$sql .= " AND i.idItem = ".$idItem;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return($row[0]);
}


function getCompetenciaMatematicaLista($idLista){
	$sql = "SELECT *"; 
	$sql .= " FROM lista_Item a JOIN item b";
	$sql .= " ON a.idItem = b.idItem JOIN competencia c"; 
	$sql .= " ON b.idCompetencia= c.idCompetencia";
	$sql .= " WHERE a.idLista =".$idLista;
	$sql .= " GROUP BY b.idCompetencia";
	$sql .= " ORDER by b.idCompetencia";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$nivelesLista[$i]= array( "idCompetencia" =>$row["idCompetencia"],
					  "nombreCompetencia" => $row["nombreCompetencia"],
					  "descripcionCompetencia" => $row["descripcionCompetencia"]
					  );	
	//echo $i." <- <br>";$i++;
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	return($nivelesLista);
}

function getCompetenciaMatematicaItem($idItem){
	$sql = "SELECT nombreCompetencia";
	$sql .= " FROM competencia c, item i";
	$sql .= " WHERE c.idCompetencia = i.idCompetencia";
	$sql .= " AND i.idItem = ".$idItem;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return($row[0]);
}
	
function calculaPromedioSeccion($idSeccion,$par_items){
	$n= 0;
	$suma=0;
	foreach($par_items as $item){
		if($item["idSeccionBitacora"] == $idSeccion ){
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
		if($item["idNivelDeComplejidad"] == $idNivelDeComplejidad ){
			$n++;
			$suma = $suma+$item["porcentajeLogro"];
		}
	}
	$porcentaje = round(($suma/$n));	
	return ($porcentaje);
}


function getColegioByRBD($rbdColegio) {
	$sql = "SELECT nombreColegio, con.nombre as nombreCongregacion, idCongregacion, gse.nombre as nombreGrupoSocioEconomico, idGrupoSocioEconomico, colegio.idComuna as comuna
		FROM colegio
		LEFT JOIN congregacion AS con ON con.id = colegio.idCongregacion
		LEFT JOIN grupoSocioEconomico AS gse ON gse.id = colegio.idGrupoSocioEconomico
		WHERE rbdColegio = $rbdColegio";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row;
}

function getCursosByColegio($rbdColegio, $ano, $nivel) {
	$sql = "SELECT * 
		FROM cursoColegio cu join nivel ni 
		on cu.idNivel = ni.idNivel 
		WHERE cu.rbdColegio = $rbdColegio
		AND cu.idNivel = $nivel
		AND cu.anoCursoColegio = $ano";

	$res = mysql_query($sql);
	$i = 0;
	$cursos = array();
	while ($row = mysql_fetch_array($res)){
	
		$cursos[$i] = array( 
			"rbdColegio" => $row["rbdColegio"],
			"anoCursoColegio" => $row["anoCursoColegio"],
			"letraCursoColegio" => $row["letraCursoColegio"],
			"idNivel" => $row["idNivel"],
			"rutProfesor" => $row["rutProfesor"],
			"nombreNivel" => $row["nombreNivel"],
			"nombreCurso" => $row["nombreNivel"]." ".$row["letraCursoColegio"]." - ".$row["anoCursoColegio"]
			);	
			$i++;
	}
	return($cursos);
}

function porcentajeLogro($puntosObtenidos, $puntosTotal) {
	return round(($puntosObtenidos / $puntosTotal) * 100, 1)." %";
}

function getLogroByCursoAndIdLista($curso, $idLista) {
	$sql = "SELECT * 
		FROM resultadosCurso
		WHERE rbdColegio = ".$curso['rbdColegio']."
		AND idNivel = ".$curso['idNivel']."
		AND anoCurso = ".$curso['anoCursoColegio']."
		AND letra = '".$curso['letraCursoColegio']."'
		AND idLista = $idLista";
	$res = mysql_query($sql);
	if($row = mysql_fetch_array($res)){
		return porcentajeLogro($row['puntosObtenidos'], $row['puntosTotal']);
	} else {
		return "sin registro";
	}

}

function getLogroCongregacion($idCongregacion, $ano) {
	$sql = "SELECT puntosTotal, puntosObtenidos
		FROM resultadosCurso
		INNER JOIN colegio
		ON colegio.rbdColegio = resultadosCurso.rbdColegio
		WHERE colegio.idCongregacion = $idCongregacion
		AND anoCurso = $ano";

	$res = mysql_query($sql);
	
	$puntosTotal = 0;
	$puntosObtenidos = 0;

	while ($row = mysql_fetch_array($res)){
		$puntosTotal += $row['puntosTotal'];
		$puntosObtenidos += $row['puntosObtenidos'];
	}

	return porcentajeLogro($puntosObtenidos, $puntosTotal);

}


function getLogroColegio($rbdColegio, $ano, $idLista, $idNivel) {
	$sql = "SELECT * 
		FROM resultadosCurso
		WHERE rbdColegio = $rbdColegio
		AND anoCurso = $ano
		AND idNivel = $idNivel
		AND idLista = $idLista";

	$res = mysql_query($sql);
	
	$puntosTotal = 0;
	$puntosObtenidos = 0;

	while ($row = mysql_fetch_array($res)){
		$puntosTotal += $row['puntosTotal'];
		$puntosObtenidos += $row['puntosObtenidos'];
	}

	return porcentajeLogro($puntosObtenidos, $puntosTotal);
}

function getLogroGrupoSocioEconomico($idGrupoSocioEconomico, $ano, $idLista, $idNivel) {
	$sql = "SELECT puntosTotal, puntosObtenidos
		FROM resultadosCurso
		INNER JOIN colegio
		ON colegio.rbdColegio = resultadosCurso.rbdColegio
		WHERE colegio.idGrupoSocioEconomico = $idGrupoSocioEconomico
		AND anoCurso = $ano
		AND idNivel = $idNivel
		AND idLista = $idLista";

	$res = mysql_query($sql);
	
	$puntosTotal = 0;
	$puntosObtenidos = 0;

	while ($row = mysql_fetch_array($res)){
		$puntosTotal += $row['puntosTotal'];
		$puntosObtenidos += $row['puntosObtenidos'];
	}

	return porcentajeLogro($puntosObtenidos, $puntosTotal);
}

function getLogroGeneralByNivel($idNivel, $ano, $idLista) {
	$sql = "SELECT puntosTotal, puntosObtenidos
		FROM resultadosCurso
		INNER JOIN colegio
		ON colegio.rbdColegio = resultadosCurso.rbdColegio
		WHERE resultadosCurso.idNivel = $idNivel
		AND anoCurso = $ano
		AND idLista = $idLista";

	$res = mysql_query($sql);
	
	$puntosTotal = 0;
	$puntosObtenidos = 0;

	while ($row = mysql_fetch_array($res)){
		$puntosTotal += $row['puntosTotal'];
		$puntosObtenidos += $row['puntosObtenidos'];
	}

	return porcentajeLogro($puntosObtenidos, $puntosTotal);
}

function calculaPromedioCompetenciaMatematica($idCompetencia,$items){
	$n= 0;
	$suma=0;
	foreach($items as $item){
		if($item["idCompetencia"] == $idCompetencia ){
			$n++;
			$suma = $suma+$item["porcentajeLogro"];
		}
	}
	$porcentaje = round(($suma/$n));
	return ($porcentaje);
}

function getAlumnosConPauta($alumnos,$idLista){
	$alumnosConPauta = 0;
	foreach($alumnos as $alumno)
	{
		if ($alumno['asistio'] == 1) {
			$alumnosConPauta += 1;
		}
	}
	return($alumnosConPauta);
}


header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=ResumenCursoMetodoSingapur.xls");
header("Pragma: no-cache");
header("Expires: 0");


$nombreNivel = getNombreNivel($idNivel);

 

$items = getItemsLista($idLista);
$al = getAlumnosCurso2($rbdColegio,$idNivel,$anoCursoColegio,$letraCursoColegio, $idLista);
$seccionesLista = getSeccionesLista($idLista);
$nivelesLista = getNivelComplejidadLista($idLista);  
$competencias = getCompetenciaMatematicaLista($idLista);
$tareasMatematicas = getTareasLista($idLista);
$datosLista = getDatosLista($idLista);
$totalPuntaje = $datosLista["puntajeTotalLista"];
$totalAlumnos = count($al);
$totalAlumnosConPauta = getAlumnosConPauta($al,$idLista);
$alumnos = array();

$ingresoCompletado = true;
if (count($al) > 0) {
	foreach ($al as $alumno) {
		if ($alumno['asistio']) {
			$datosPauta = buscaPauta($alumno["idUsuario"],$idLista);
			if ($datosPauta["resultadoListaPautaItem"] === NULL) {
				$ingresoCompletado = false;
			}
			$nota = calculaNotaPorEscala($escala, $datosLista["puntajeTotalLista"], $datosPauta["resultadoListaPautaItem"]);
			$alumno["nota"] = $nota;
			$alumno["datosPauta"] = $datosPauta;
		}
		$alumnos[] = $alumno;
	}
} else {
	$ingresoCompletado = false;
}

if ($ingresoCompletado) {
	for($i=0;$i<count($items);$i++){
	    $totalItem[$i] = 0;
		foreach ($alumnos as $alumno){
			if ($alumno['asistio']) {
				$respuesta = getRespuestaUsuarioItem($items[$i]["idItem"],$alumno["idUsuario"],$alumno["datosPauta"]["idPautaItem"]);
				$totalItem[$i] = $totalItem[$i] + $respuesta["puntajeRespuestaItem"];
			}
		}
	}

	for($i=0;$i<count($items);$i++){
		$porcentaje = round(($totalItem[$i]/($totalAlumnosConPauta*$items[$i]["puntajeItem"]))*100); 
		$items[$i]["porcentajeLogro"] = $porcentaje;
	}

	$mostrarEscala = true;
	$datosColegio = getColegioByRBD($rbdColegio);
	if ($datosColegio["comuna"] == '5751') {
		$mostrarEscala = false;
	}
	?>
	<table class="tablesorter" id="tabla"> 
		   	<thead>  
	   		<tr>
			   <th colspan="5">Alumnos de: <?php echo $nombreNivel." ".$letraCursoColegio;?></th>
			</tr>
			<tr>
			    <th>Nº</th>
			    <th>Nombres</th>
			    <th>Puntaje</th>
			    <th>%Logro</th>
			    <?php if ( $mostrarEscala ) { ?>
			    <th>
			    	Nota al <?php echo $escala * 100 ?>%
	            </th>
			    <?php } ?>
			</tr>
			</thead>
			<tbody>
			<?php 
			if (count($alumnos) > 0){
				 $i = 1;
				foreach ($alumnos as $alumno){ 
					if ($alumno['asistio'] == 1) {
			  			?>
				        <tr>
							<td><?php echo $i;?></td>
							<td><?php echo $alumno["apellidoPaternoAlumno"]." ".$alumno["nombreAlumno"];?></td>
							<td><?php echo $alumno["datosPauta"]["resultadoListaPautaItem"] == NULL ? 0 : $alumno["datosPauta"]["resultadoListaPautaItem"];?></td>
				            <td><?php echo $alumno["datosPauta"]["porcentajeLogroPautaItem"]." %";?></td>
				            <?php if ( $mostrarEscala ) { ?>
				            <td><?php echo $alumno["nota"];?></td>
				            <?php } ?>
						</tr>
						<?php 	$i++;					
					} else {
						$noAsistieron[$alumno["idUsuario"]] = $alumno["apellidoPaternoAlumno"]." ".$alumno["nombreAlumno"];
					}
				}
	 }else{ 
		 echo "<tr><td colspan='12'>No existen Alumnos en este curso.</td></tr>"; 
	  }
	  ?>
		</tbody> 
	</table>
<br>
	<?php 
	if (count($noAsistieron) > 0) {	
	?>
		<table class="tablesorter" id="tabla"> 
		   	<thead>  
		   		<tr>
				   <th>En esta prueba usted tiene ausente los siguientes alumnos:</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($noAsistieron as $id => $nombre) {
				?>	
				<tr>
					<td>										
						<?php echo $nombre; ?>					
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	<?php 
	}
	?>
<br>

	<table>
			<thead>  
		   		<tr>
				   <th>Item</th>
				   <th>Tarea Matemática</th>
				   <th>Nivel de Complejidad</th>
				   <th>Habilidad</th>
				   <th>% Logro Curso</th>
				</tr>
			</thead>
			<?php 
			for($i=0;$i<count($items);$i++){ 
			?>
			<tr>
				<td style="text-align:center;"><?php echo $items[$i]["enunciadoItem"]; ?></td>
				<td style="text-align:left;"><?php echo getTareaMatematicaItem($items[$i]["idItem"]); ?></td>
				<td style="text-align:left;"><?php echo getNivelComplejidadItem($items[$i]["idItem"]); ?></td>
				<td style="text-align:left;"><?php echo getCompetenciaMatematicaItem($items[$i]["idItem"]); ?></td>
	            <td style="text-align:center;"><?php echo $items[$i]["porcentajeLogro"]." %"; ?></td>
			</tr>		
			<?php } ?> 
		</table>
<br>

		<table class="tablesorter">
			<tr>
            	<th  style="text-align:left;">Resultados por capitulos</th>
                <th style="text-align:center;">%logro Curso</th>
			</tr>
			<?php 

			foreach($seccionesLista as $seccion){ 
				$promedioSeccion = calculaPromedioSeccion($seccion["idSeccionBitacora"],$items);
				?>
				<tr>
					<td style="text-align:left;"><?php echo $seccion["nombreSeccionBitacora"]; ?></td>
	                <td style="text-align:center;"><?php echo $promedioSeccion." %"; ?></td>
				</tr>		
			<?php } ?> 
		</table>
<br>
		<table class="tablesorter">
			<tr>
            	<th style="text-align:left;">Resultados por habilidad matemática</th>
                <th style="text-align:center;">%logro Curso</th>
			</tr>
			<?php foreach($competencias as $competencia){ 
				$promedioCompetencia = calculaPromedioCompetenciaMatematica($competencia["idCompetencia"],$items); ?>
				<tr>
					<td style="text-align:left;"><strong><?php echo $competencia["nombreCompetencia"]; ?></strong></td>
	                <td style="text-align:center;"><?php echo $promedioCompetencia." %"; ?></td>
				</tr>	
			<?php } ?> 
		</table>
<br>
		<table class="tablesorter">
			<tr>
            	<th style="text-align:left;">Resultados por Nivel de Complejidad</th>
                <th style="text-align:center;">%logro Curso</th>
			</tr>
			<?php foreach($nivelesLista as $nivel){ 
					$promedioNivel = calculaPromedioNivelComplejidad($nivel["idNivelDeComplejidad"],$items); ?>
					<tr>
						<td style="text-align:left;"><strong><?php echo $nivel["nombreNivelDeComplejidad"]; ?></strong></td>
		                <td style="text-align:center;"><?php echo $promedioNivel." %"; ?></td>
					</tr>	
			<?php } ?> 
		</table>


		<br>

		<?php 
		$cursosMismoColegio = getCursosByColegio($rbdColegio, $anoCursoColegio, $idNivel);
		 ?>
		<table id="table1" class="tablesorter">
			<tr>
				<th style="text-align:left;" colspan="<?php echo count($cursosMismoColegio) ?>">Cursos <?php echo $datosColegio["nombreColegio"] ?></th>
				<th style="text-align:left;" rowspan="2">% Logro <?php echo $datosColegio["nombreColegio"] ?></th>
				<?php 
					if ($datosColegio['idCongregacion'] !== NULL) {
						?>
						<th style="text-align:left;" rowspan="2">% Logro Grupo <?php echo $datosColegio["nombreCongregacion"] ?></th>
						<?php
					}
				 ?>
			</tr>
			<tr>
				<th style="text-align:left;"><?php echo $idNivel."° ".$letraCursoColegio ?></th>
				<?php 
				$cursoSeleccionado = array();
				foreach ($cursosMismoColegio as $key => $curso) {
					if ($curso["letraCursoColegio"] !== $letraCursoColegio) {
						?>
						<th style="text-align:left;"><?php echo $curso["idNivel"]."° ".$curso["letraCursoColegio"] ?></th>
						<?php		
					} else {
						$cursoSeleccionado = $curso;
					}	
				} 
				?>
			</tr>
			<tr>
				<?php 
				$logroColegio = getLogroColegio($rbdColegio, $anoCursoColegio, $idLista, $idNivel);
				$logroCurso = getLogroByCursoAndIdLista($cursoSeleccionado, $idLista);
				?>
				<td style="text-align:left;"><?php echo $logroCurso; ?></td>
				<?php 				
				foreach ($cursosMismoColegio as $key => $curso) {
					if ($curso["letraCursoColegio"] !== $letraCursoColegio) {
						?>
						<td style="text-align:left;"><?php echo getLogroByCursoAndIdLista($curso, $idLista) ?></td>
						<?php		
					}	
				}
				?>
				<td style="text-align:left;"><?php echo $logroColegio; ?></td>
				<?php 
					if ($datosColegio['idCongregacion'] !== NULL) {
						?>
						<td style="text-align:left;"><?php echo getLogroCongregacion($datosColegio["idCongregacion"], $anoCursoColegio); ?></td>
						<?php
					}
				 ?>
			</tr>
		</table>
		<br>
		<table id="table2" class="tablesorter">
			<tr>
				<th style="text-align:left; width:40px;"><?php echo $idNivel."° ".$letraCursoColegio ?></th>				
				<th style="text-align:left;">% Logro <?php echo $datosColegio["nombreColegio"] ?></th>
				<?php 
				if ($datosColegio['idGrupoSocioEconomico'] !== NULL) {
				?>
					<th style="text-align:left;">% Logro grupo socio-económico <?php echo $datosColegio["nombreGrupoSocioEconomico"] ?></th>				
				<?php
				}
				?>
				<th style="text-align:left;">% Logro general <?php echo $cursoSeleccionado['nombreNivel'] ?></th>						
			</tr>
			<tr>
				<td style="text-align:left;"><?php echo $logroCurso; ?></td>
				<td style="text-align:left;"><?php echo $logroColegio; ?></td>
				<?php 
				if ($datosColegio['idGrupoSocioEconomico'] !== NULL) {
				?>
					<td style="text-align:left;"><?php echo getLogroGrupoSocioEconomico($datosColegio["idGrupoSocioEconomico"], $anoCursoColegio, $idLista, $idNivel); ?></td>
				<?php
				}
				?>
				<td style="text-align:left;"><?php echo getLogroGeneralByNivel($idNivel, $anoCursoColegio, $idLista); ?></td>
			</tr>
		</table>

<?php 
}

ob_end_flush();
?>