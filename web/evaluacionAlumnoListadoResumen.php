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
		echo "hay sesioN";
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


function inicializarPautaAlumno($idUsuario,$idLista){
	$sql ="INSERT INTO `pautaItem` (	";
	$sql.="`idLista` ,`idUsuario` ,`idPautaItem` ,`fechaRespuestaPautaItem` ,`tiempoPautaItem` ,";
	$sql.=" `resultadoListaPautaItem` , `porcentajeLogroPautaItem`";
	$sql.=" ) VALUES ( ";
	$sql.=" ".$idLista.", ".$idUsuario.", NULL , NOW( ) , NULL , NULL, NULL );";
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
		$sql2.=" VALUES ( '".$item['idItem']."', $idLista, $idUsuario, $idPauta, NULL , NULL , NULL , NULL , NULL , NULL ); ";
		$res2 = mysql_query($sql2);
		if (!$res2) {
    		die('Error en la consulta SQL: <br><b>'.$sql2.'</b><br>'. mysql_error());
		}
	}
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


function calculaPromedioCompetenciaMatematica($idCompetencia,$items){
	$n= 0;
	$suma=0;
	foreach($items as $item){
		if($item["idCompetencia"] == $idCompetencia ){
			$n++;
			$suma = $suma+$item["porcentajeLogro"];
		}
	}
	//echo "SUMA: ".$suma."<br>";
	//echo "N: ".$n."<br>";
	$porcentaje = round(($suma/$n));
	//echo "PORCENTAJE: ".$porcentaje."<br>";
	return ($porcentaje);
}

function getAlumnosConPauta($alumnos,$idLista){
	$alumnosConPauta = 0;
	foreach($alumnos as $alumno)
	{
		$alumnosConPauta = $alumnosConPauta +count(getPautaAlumno($alumno["idUsuario"],$idLista));
	}
	return($alumnosConPauta);
}



?>

<script>

function xls(){
	
	escala = document.getElementById("escala").value;
	location.href="evaluacionAlumnoResumenXLS.php?escala="+escala;
}

function activaDesactiva(rutAlumno,modo){
	var division = document.getElementById("activa");
	AJAXPOST("alumnoGuarda.php","modo="+modo+"&rut="+rutAlumno,division);
	
} 

function guarda(){

	var division = document.getElementById("actualiza");
	//a = "arreglo="+document.getElementsByName("sel"+jornada);
	var a = $(".campos").fieldSerialize();
	<?php 
	$valores = "";
	foreach ($items as $item){
		$valores = $valores.$item["idItem"].";";
	} ?>
	a = a+"itemes=<?php echo $valores;?>";

	AJAXPOST("evaluacionAlumnoGuarda.php",a,division);
}

function modificar(rutAlumno,modo){
	location.href="evaluacionAlumnoListado.php";

	
} 
function acutalizaNotas(){
	escala = document.getElementById("escala").value;
	location.href="evaluacionProfesor.php?escala="+escala;
} 

$(function() {
		$( "#tabs" ).tabs();
	});
</script>

 <div id="actualiza"></div>
<p>

<?php 
if ($idLista>0){
	
switch($idLista){
	case 1:
	$titulo = "Prueba I Primero Básico";
	break;
	case 2:
	$titulo = "Prueba I Segundo Básico";
	break;
	case 3:
	$titulo = "Prueba I Tercero Básico";
	break;
	case 4:
	$titulo = "Prueba II Primero Básico";
	break;
	case 5:
	$titulo = "Prueba II Segundo Básico";
	break;
	case 6:
	$titulo = "Prueba II Tercero Básico";
	break;
	}	

$items = getItemsLista($idLista);
$alumnos = getAlumnosCurso2($rbdColegio,$idNivel,$anoCursoColegio,$letraCursoColegio);
$seccionesLista = getSeccionesLista($idLista);
$nivelesLista = getNivelComplejidadLista($idLista);  
$competencias = getCompetenciaMatematicaLista($idLista);
$tareasMatematicas = getTareasLista($idLista);
$datosLista = getDatosLista($idLista);
$totalPuntaje = $datosLista["puntajeTotalLista"];
$totalAlumnos = count($alumnos);
$totalAlumnosConPauta = getAlumnosConPauta($alumnos,$idLista);
boton("Modificar Puntajes","modificar();");
boton("Exportar a XLS","xls();");

for($i=0;$i<count($items);$i++){
    $totalItem[$i] = 0;
	foreach ($alumnos as $alumno){
		$datosPauta = buscaPauta($alumno["idUsuario"],$idLista);
		$respuesta = getRespuestaUsuarioItem($items[$i]["idItem"],$alumno["idUsuario"],$datosPauta["idPautaItem"]);
		$totalItem[$i] = $totalItem[$i] + $respuesta["puntajeRespuestaItem"];
		}
	}

for($i=0;$i<count($items);$i++){
	$porcentaje = round(($totalItem[$i]/($totalAlumnosConPauta*$items[$i]["puntajeItem"]))*100); 
	$items[$i]["porcentajeLogro"] = $porcentaje;
}


echo "<br><br><h2>".$titulo."</h2>";
}else{
echo "Seleccione una prueba";
}
?>
<div id="tabs">
	<ul>
    	<li><a href="#tabs-3" style="font-size:10px">Resultados Individuales</a></li>
    	<li><a href="#tabs-2" style="font-size:10px">Resultados Por Curso</a></li>
    	<li><a href="#tabs-1" style="font-size:10px">Resultados Generales</a></li>
    	<li><a href="#tabs-4" style="font-size:10px">Comparación</a></li>
	</ul>
    
    <div id="tabs-1">
		<table class="tablesorter">
			<tr>
            	<th  style="text-align:left;">Secciones</th>
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
            	<th style="text-align:left;">Competencia matemática</th>
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
            	<th style="text-align:left;">Niveles de Complejidad</th>
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
    
	<div id="tabs-2">
    	<table class="tablesorter">
			<tr>
            	<th style="text-align:center;">Item</th>
            	<th style="text-align:center;">Tarea Matemática</th>
            	<th style="text-align:center;">Nivel de Complejidad</th>
            	<th style="text-align:center;">Competencia Matemática</th>
                <th style="text-align:center;">%logro Curso</th>
			</tr>
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

	<div id="tabs-3">
	    <table class="tablesorter" id="tabla"> 
	   	<thead>  
   		<tr>
		   <th colspan="5">Alumnos de: <?php echo getNombreNivel($idNivel)." ".$letraCursoColegio;?></th>
		</tr>
		<tr>
		    <th>Nº</th>
		    <th>Nombres</th>
		    <th>Puntaje</th>
		    <th>%Logro</th>
		    <th>
            	<select id="escala" onchange="acutalizaNotas();">
			    <option value="0.5" <?php if ($escala == 0.5){ echo 'selected="selected"';}?>>50%</option>
			    <option value="0.6" <?php if ($escala == 0.6){ echo 'selected="selected"';}?>>60%</option>
			    <option value="0.7" <?php if ($escala == 0.7){ echo 'selected="selected"';}?>>70%</option></select>
            </th>
		</tr>
		</thead>
		<tbody>
		<?php if (count($alumnos) > 0){
			  $i = 1;
			 // echo $idLista;
				foreach ($alumnos as $alumno){ 
				//echo $alumno["idUsuario"]."<br>";
					if(!buscaPauta($alumno["idUsuario"],$idLista)){
						// crear pauta por alumno y respuestas en 0
						inicializarPautaAlumno($alumno["idUsuario"],$idLista);
						//echo "crea pauta<br>";
					}
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
			<td style="text-align:center;"><?php echo $datosPauta["resultadoListaPautaItem"];?></td>
            <td style="text-align:center;"><?php echo $datosPauta["porcentajeLogroPautaItem"]." %";?></td>
            <td style="text-align:center;"><?php echo $nota;?></td>
		</tr>
<?php 	$i++;	}
 }else{ 
	 echo "<tr><td colspan='12'>No existen Alumnos en este curso.</td></tr>"; 
  }
  ?>
   <div id="activa"></div>
	</tbody> 
</table>
</div>

<div id="tabs-4">
</div>

</div>