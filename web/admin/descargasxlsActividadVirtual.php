<?php
	ini_set('display_errors','1');
	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=Descarga.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	require("inc/config.php");

	$nivel = $_GET["nivel"];


	function getRespuestasItem($nivel){
		$sql = "SELECT u.rutProfesor, ri.idRespuestaItem, ri.valorSeleccionadaItem, ri.idPautaItem, ri.idItem, ri.idUsuario, ri.idLista, i.tema, ri.puntajeRespuestaItem, i.puntajeItem, sbP.nombreSeccionBitacora as capitulo, sbP.idNivelCursoSeccionBitacora, sb.nombreSeccionBitacora as apartado
		FROM respuestaItem AS ri
		JOIN usuario AS u ON u.idUsuario = ri.idUsuario
		JOIN item AS i ON i.idItem = ri.idItem
		JOIN seccionBitacora as sb on i.idSeccionBitacora = sb.idSeccionBitacora
		JOIN seccionBitacora as sbP on sb.idPadreSeccionBitacora = sbP.idSeccionBitacora
		where
			u.rutProfesor != ''
			and sbP.idNivelCursoSeccionBitacora = $nivel
			and u.rutProfesor != 333
			order by u.rutProfesor, ri.idPautaItem";

		$res = mysql_query($sql);

		$resultado = array();
		$intentos = array();
		$cursoUsuario = array();

		while($row = mysql_fetch_array($res))
		{

			if (isset($intentos[$row["idPautaItem"]])) {
				$numeroIntento = $intentos[$row["idPautaItem"]];
			} else {
				$inten = getIntentos($row["idLista"], $row["idUsuario"]);

				foreach ($inten as $key => $intento) {
					$intentos[$intento["idPautaItem"]] = $key + 1;
				}
				$numeroIntento = $intentos[$row["idPautaItem"]];
			}

			if (isset($cursoUsuario[$row["idUsuario"]])) {
				$curso = $cursoUsuario[$row["idUsuario"]];
			} else {
				$curso = getCursoUs($row["idUsuario"]);
				$cursoUsuario[$row["idUsuario"]] = $curso;
			}


			if ($row["idRespuestaItem"] < 705155) {
				$row["valorSeleccionadaItem"] = utf8_decode($row["valorSeleccionadaItem"]);
			}

			$resultado[] = array("rutProfesor" => $row["rutProfesor"],
								"idItem" => $row["idItem"],
								"tema" => $row["tema"],
								"puntajeItem" => $row["puntajeItem"],
								"nivel" => $row["idNivelCursoSeccionBitacora"],
								"capitulo" => $row["capitulo"],
								"apartado" => $row["apartado"],
								"idPautaItem" => $row["idPautaItem"],
								"idUsuario" => $row["idUsuario"],
								"idLista" => $row["idLista"],
								"valorSeleccionadaItem" => $row["valorSeleccionadaItem"],
								"curso" => $curso,
								"intento" => $numeroIntento,
								"puntajeRespuestaItem" => $row["puntajeRespuestaItem"]
							);
		}
		return $resultado;
	}

	function getIntentos($idLista,$idUsuario){
	    $sql ="SELECT * FROM pautaItem as PI inner join lista as L on PI.idLista = L.idLista WHERE PI.idLista = ".$idLista." and idUsuario = ".$idUsuario." ORDER BY fechaRespuestaPautaItem ASC";

	    $res = mysql_query($sql);
	    $i=0;
	    $intentos = array();
	    while($row = mysql_fetch_array($res)){
	            $intentos[] = array(
	            "idPautaItem"=> $row["idPautaItem"],
	            "porcentajeLogroPautaItem" => $row["porcentajeLogroPautaItem"],
	            "tiempoPautaItem" => $row["tiempoPautaItem"]);
	    }

	    return $intentos;
	}


	function getCursoUs($idUsuario){
		$sql ="SELECT * FROM `inscripcionCursoCapacitacion` a left join cursoCapacitacion b on a.idCursoCapacitacion = b.idCursoCapacitacion where b.estadoCursoCapacitacion > 0 AND idUsuario = ".$idUsuario;
		//echo $sql;
		$res = mysql_query($sql);
		$row = mysql_fetch_array($res);
		$cursoUsuario = $row["nombreCortoCursoCapacitacion"];
		return($cursoUsuario);
	}
?>

<p>

<table class="tablesorter" id="tabla">
   <thead>
	<tr>
		<th>rutProfesor</th>
		<th>ID</th>
		<th>Nivel</th>
		<th>Curso</th>
		<th>Tema</th>
		<th>Capitulo</th>
		<th>Apartado</th>
		<th>Numero de Intento</th>
		<th>Puntaje Obtenido</th>
		<th>Puntaje maximo</th>
		<th>Valor seleccionado</th>
  	</tr>
  </thead>
  <tbody>


  <?php

  		$respuestas = getRespuestasItem($nivel);

		$i=1;

		if(count($respuestas)>0){


			foreach($respuestas as $respuesta)
			{
				?>
				<tr>
					<td><?php echo $respuesta["rutProfesor"]; ?></td>
					<td><?php echo $respuesta["idItem"]; ?></td>
					<td><?php echo $respuesta["nivel"]; ?></td>
					<td><?php echo $respuesta["curso"]; ?></td>
					<td><?php echo $respuesta["tema"]; ?></td>
					<td><?php echo $respuesta["capitulo"]; ?></td>
					<td><?php echo $respuesta["apartado"]; ?></td>
					<td><?php echo $respuesta["intento"]; ?></td>
					<td><?php echo $respuesta["puntajeRespuestaItem"]; ?></td>
					<td><?php echo $respuesta["puntajeItem"]; ?></td>
					<td> <?php echo $respuesta["valorSeleccionadaItem"]; ?></td>
				</tr>
				<?php
			}
		}

	?>


 </tbody>
</table>