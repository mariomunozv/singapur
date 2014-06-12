<?php 
//ini_set('display_errors','On');
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
		echo "hay sesion";
				$escala = $_REQUEST["escala"];
				$rbdColegio = $_SESSION["sesionRbdColegio"];
				$idNivel = $_SESSION["sesionIdNivel"];
				$letraCursoColegio = $_SESSION["sesionLetraCursoColegio"];
				$anoCursoColegio = $_SESSION["sesionAnoCursoColegio"];
				$idLista= $_SESSION["sesionIdLista"];
				echo $idLista;
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
$totalAlumnosConPauta = getAlumnosConPauta($al, $idLista);
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
	<div id="tabs">
		<ul>
	    	<li><a href="#tabsResultadosIndividuales" style="font-size:10px">Resultados Individuales</a></li>
	    	<li><a href="#tabsResultadoTareaMatematicas" style="font-size:10px">Resultados Tarea Matemática</a></li>
	    	<li><a href="#tabsResultadoGeneral" style="font-size:10px">Resultado General</a></li>
	    	<li><a href="#tabsComparacion" style="font-size:10px">Comparación</a></li>
		</ul>
		<div id="tabsResultadosIndividuales">
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
			    	Nota al 
	             	<select id="escala" onchange="acutalizaNotas();">
					    <option value="0.5" <?php if ($escala == 0.5){ echo 'selected="selected"';}?>>50%</option>
					    <option value="0.6" <?php if ($escala == 0.6){ echo 'selected="selected"';}?>>60%</option>
					    <option value="0.7" <?php if ($escala == 0.7){ echo 'selected="selected"';}?>>70%</option>
					</select>
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
						// $datosPauta = buscaPauta($alumno["idUsuario"],$idLista);
						// $nota = calculaNotaPorEscala($escala, $datosLista["puntajeTotalLista"], $datosPauta["resultadoListaPautaItem"]);
			  			?>
				        <tr onmouseover="this.className='normalActive'" onmouseout="this.className='<?php echo $claseTR; ?>'" class="<?php echo $claseTR; ?>">
							<td><?php echo $i;?></td>
							<td  style="text-align:left;"><?php echo $alumno["apellidoPaternoAlumno"]." ".$alumno["nombreAlumno"];?></td>
							<td style="text-align:center;"><?php echo $alumno["datosPauta"]["resultadoListaPautaItem"] == NULL ? 0 : $alumno["datosPauta"]["resultadoListaPautaItem"];?></td>
				            <td style="text-align:center;"><?php echo $alumno["datosPauta"]["porcentajeLogroPautaItem"]." %";?></td>
				            <?php if ( $mostrarEscala ) { ?>
				            <td style="text-align:center;"><?php echo $alumno["nota"];?></td>
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
	   <div id="activa"></div>
		</tbody> 
	</table>

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
	</div>

	<div id="tabsResultadoTareaMatematicas">
		<table class="tablesorter">
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
	</div>


	<div id="tabsResultadoGeneral">
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
	</div>

	<div id="tabsComparacion">

		<?php 
		$cursosMismoColegio = getCursosByColegio($rbdColegio, $anoCursoColegio, $idNivel);
		 ?>
		<table id="table1" class="tablesorter">
			<tr>
				<th style="text-align:left;" colspan="<?php echo count($cursosMismoColegio) ?>">Cursos <?php echo $datosColegio["nombreColegio"] ?></th>
				<th style="text-align:left;" rowspan="2">% Logro <?php echo $datosColegio["nombreColegio"] ?></th>
				<?php 
					if ($datosColegio['idCongregacion'] != NULL and $datosColegio['idCongregacion'] != 5) {
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
					if ($curso["letraCursoColegio"] != $letraCursoColegio) {
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
					if ($datosColegio['idCongregacion'] != NULL and $datosColegio['idCongregacion'] != 5) {
						?>
						<td style="text-align:left;"><?php echo getLogroCongregacion($datosColegio["idCongregacion"], $anoCursoColegio); ?></td>
						<?php
					}
				 ?>
			</tr>
		</table>

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


		<div id="chartTable1" style="min-width: 550px; height: 400px; margin: 0 auto"></div>
		<div id="chartTable2" style="min-width: 550px; height: 400px; margin: 0 auto"></div>
	</div>


<script type="text/javascript">
	function xls(){	
		escala = document.getElementById("escala").value;
		location.href="evaluacionAlumnoResumenXLSNew.php?escala="+escala;
	}

	var acutalizaNotas = function () {
		escala = document.getElementById("escala").value;
		muestraCurso(<?php echo $rbdColegio.','.$idNivel.','.$anoCursoColegio.', "'.$letraCursoColegio.'",escala,"'.$nombreNivel.'",'.$idLista; ?>);
	};

	$(function() {
		$( "#tabs" ).tabs();
	});


    var graficar = function(idDiv, categories, data, title) {
    	$('#'+idDiv).highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: title
	        },
	        subtitle: {
	            text: ''
	        },
	        xAxis: {
	            categories: categories
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: '% de Logro'
	            }
	        },
	        tooltip: {
	            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	            pointFormat: '<tr><td style="color:{series.color};padding:0">Logro:  </td>' +
	                '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
	            footerFormat: '</table>',
	            shared: true,
	            useHTML: true
	        },
	        plotOptions: {
	            column: {
	                pointPadding: 0.2,
	                borderWidth: 0
	            }
	        },
	        series: [{
	            name: '% de logro',
	            data: data

	        }]
	    });
    }

	$(function () {
		var table = $('#table1'), table2 = $('#table2');
		var categories = [], categories2 = [];
		var data = [], data2 = [];

		$(table.find('tr')[1]).find("th").each( function(i, v) {
             categories.push(v.innerHTML);
        });

        $(table.find('tr')[0]).find("th").each( function(i, v) {
        	if (i > 0) {
        		var enc = v.innerHTML.replace("% Logro ","");
	            categories.push(enc);	
        	}
        });

        $(table.find('tr')[2]).find("td").each( function(i, v) {
        	var numero = v.innerHTML;
        	numero = parseFloat(numero);
        	if (isNaN(numero)) {
        		numero = 0;
        	}
	        data.push(numero);
        });

        graficar('chartTable1', categories, data, '% de Logro por Nivel');

        $(table2.find('tr')[0]).find("th").each( function(i, v) {
    		var enc = v.innerHTML.replace("% Logro ","");
            categories2.push(enc);
        });

        $(table2.find('tr')[1]).find("td").each( function(i, v) {
        	var numero = v.innerHTML;
        	numero = parseFloat(numero);
        	if (isNaN(numero)) {
        		numero = 0;
        	}
	        data2.push(numero);
        });

        graficar('chartTable2', categories2, data2, '% de Logro por Estratos');
    });


</script>

</div>


<?php 
} else {
?>
	<div>
		No se han ingresado completamente las notas de esta prueba.
	</div>

<?php
}
?>
<br>
<center>
<?php
boton("Exportar a XLS","xls();");
boton("Volver","volver();");	
 ?>
 </center>
 <br>