<?php 
//ini_set('display_errors','On');
require("inc/incluidos.php");
require("inc/pruebasPorCurso.php");
require ("hd.php");

function DatosUsuario($idUsuario){
	$sql = "SELECT * from usuario WHERE idUsuario = ".$idUsuario;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosUsuario = array("rutAlumno" => $row["rutAlumno"],"rutProfesor" => $row["rutProfesor"],"tipoUsuario" => $row["tipoUsuario"]);
	return($datosUsuario);
	
	}

function cuentaAlumnosCurso($letraCursoColegio,$anoCursoColegio,$rbdColegio,$idNivel){
	$sql = "SELECT Count(rutAlumno) AS resultado FROM matricula where rbdColegio = '$rbdColegio' and idNivel = $idNivel and anoCursoColegio = $anoCursoColegio and letraCursoColegio = '$letraCursoColegio'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	echo $row["resultado"];
	
}

function getCursosProfesor($rutProfesor, $anoCursoColegio, $tipoUsuario){
	$sql = "";
	if ($tipoUsuario == 4 || $tipoUsuario == 3) {
		$datosProfesor = getDatosProfesorByRut($rutProfesor);

		$profesores = getProfesoresColegio($datosProfesor["rbdColegio"]);
		$conditionProfesor = "(cu.rutProfesor = '$rutProfesor'";
		foreach ($profesores as $key => $data) {
			$conditionProfesor .= "or cu.rutProfesor = '".$data['rutProfesor']."'";
		}
		$conditionProfesor .= ")";
		$sql = "SELECT * 
				FROM cursoColegio cu join nivel ni 
				on cu.idNivel = ni.idNivel 
				WHERE $conditionProfesor 
				AND cu.anoCursoColegio = $anoCursoColegio";
		
	} else {
		$sql = "SELECT * 
				FROM cursoColegio cu join nivel ni 
				on cu.idNivel = ni.idNivel 
				WHERE cu.rutProfesor = '$rutProfesor' 
				AND cu.anoCursoColegio = $anoCursoColegio";
	}

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


function getDatosProfesorByRut($rutProfesor){
	$sql = "SELECT rbdColegio 
			FROM  profesor 
			WHERE  rutProfesor =  '$rutProfesor'";
	// echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosProfesor = array("rbdColegio" => $row["rbdColegio"]);
	return $datosProfesor;
}


if(@$_REQUEST["escala"] != ""){
	$escala = $_REQUEST["escala"];
}else{
	$escala = 0.5;
	}
	
registraAcceso($_SESSION["sesionIdUsuario"], 17, 'NULL'); 
$datosUsuario = DatosUsuario($_SESSION["sesionIdUsuario"]);

?>
<script>

var volver = function () {
	$('#lugarCarga').hide();
	$('#seleccionCurso').show();
};

var muestraCurso = function (rbdColegio,idNivel,anoCursoColegio,letraCursoColegio,escala,nombreNivel,idLista) {
	a = "rbdColegio="+rbdColegio+"&idNivel="+idNivel+"&anoCursoColegio="+anoCursoColegio+"&letraCursoColegio="+letraCursoColegio+"&escala="+escala+"&nombreNivel="+nombreNivel+"&idLista="+idLista;
	var division = document.getElementById("lugarCarga");
	AJAXPOST("evaluacionResumen.php",a,division);
	$('#seleccionCurso').hide();
} 
</script>


<body> 
 

<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Evaluación*#";
	require("_navegacion.php");

?>
	
    <div id="lateralIzq">
    <?php 
		require("menuleft.php")	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
  	<?php 
		require("menuright.php")
    ?>
    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
    	<p class="titulo_curso">Evaluaciones de proceso</p>
		<hr />
		<br />
        
		<div id="seleccionCurso">
			<p>
			En el siguiente listado usted encontrará los cursos que tiene asignados en el
			Sistema. Para ingresar al listado de los alumnos y modificar los puntajes seleccione una de las <img src="img/ver.gif" width="14" height="14" alt="Ver más" title="Ver más" /> <strong>Pruebas</strong>.
			</p>

			<table class="tablesorter" id="tabla">
			  <thead> 
			          
			  <tr>
			    <th>Curso</th>
			    <th>Año</th>
			    <th>Profesor Jefe </th>
			    
				<th>N° Alumnos Matricula</th>
			    <th>Informe de Evaluación</th>
			  </tr>
			  </thead>
			  <tbody> 
			  <?php 
			  $perfilUsuario = $_SESSION['sesionPerfilUsuario'];
			  $cursos = getCursosProfesor($datosUsuario["rutProfesor"],$anoActual, $perfilUsuario);
			 

			  if (count($cursos) > 0){
					foreach ($cursos as $curso){
						$nombre = getNombreProfesor($curso["rutProfesor"]);


				  ?>
			              <tr onMouseOver="this.className='normalActive'" onMouseOut="this.className='normal'" class="normal">
			                <td><?php echo $curso["nombreNivel"]." ".$curso["letraCursoColegio"];?></td>
			                <td><?php echo $curso["anoCursoColegio"];?></td>
			                <td><?php echo $nombre;?> </td>
			                  <td><?php cuentaAlumnosCurso($curso["letraCursoColegio"],$curso["anoCursoColegio"],$curso["rbdColegio"],$curso["idNivel"]);?> </td>
			                
			  <td>
			  <?php 
				$i=0;
				if (isset($pruebasPorCurso[$curso["idNivel"]])) {
					$pruebas = $pruebasPorCurso[$curso["idNivel"]];
				}
			  
			  
			  
			  foreach ($pruebas as $idLista){
				  $i++;
				 // para separar P1,P2 de P3,P4
					if ($i == 3)
				 	{
						echo "<br>"; 
					}
				  ?>
			  <a href="javascript:muestraCurso(<?php echo $curso["rbdColegio"];?>,<?php echo $curso["idNivel"];?>,<?php echo $curso["anoCursoColegio"];?>,'<?php echo $curso["letraCursoColegio"];?>',<?php echo $escala.",'".$curso["nombreNivel"]."',".$idLista; ?>)"><img border="0" src="img/ver.gif" width="14" height="14" alt="Ver más" title="Ver más" /> Prueba <?php echo $i;?></a>
			  <?php } ?>
			  
			  </td>
			             </a>
			               
			              </tr>
			<?php 		}
			 }else{ 
				 echo "<tr><td colspan='5'>No existen Cursos asociados a este profesor</td></tr>"; 
			  
			  }
			  
			  ?>
			 </tbody> 
			</table>

			<center>
	            <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('evaluacionHome.php','_self')">
	                <span class="ui-button-text">Volver</span>
	            </button>
	        </center>

		</div>
            
           
  	<div id="lugarCarga"></div>          
      
  <?php
if(@$_SESSION["sesionRbdColegio"] != ""){?>
	<!--<script>
	muestraCurso(<?php echo $_SESSION["sesionRbdColegio"];?>,<?php echo $_SESSION["sesionIdNivel"];?>,<?php echo $_SESSION["sesionAnoCursoColegio"];?>,'<?php echo $_SESSION["sesionLetraCursoColegio"];?>',<?php echo $escala.","."'".$_SESSION["sesionNombreNivel"]."'"; ?>);
	</script>-->
	<?php
	}
?>      
			
        
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 

<script src="./js/highcharts.js"></script>
<script src="./js/exporting.js"></script>
</body>
</html>
