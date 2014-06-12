<?php 
require("inc/incluidos.php");
include "inc/_actividad.php";
include "inc/_pauta.php";
include "inc/_bitacora.php";
require ("hd.php");
if (@$_REQUEST["idCurso"]){
	$idCurso = $_REQUEST["idCurso"];
}else{
	$idCurso = $_SESSION["sesionIdCurso"];
}

$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$idActividad = $_REQUEST["idActividad"];
$datosActividad = getDatosActividad($idActividad);
$_SESSION["sesionIdActividad"] = $idActividad;


// Menor que APE y idUsuario de GET es distinto a idUsuario de SESSION
if ($_SESSION["sesionPerfilUsuario"] < 5 ){ 
	
	alerta("No puedes acceder a esta página.");
	dirigirse_a("../home.php");
}
?>
<script type="text/javascript">

function muestraBitacorasProfe(idUsuario){  
	window.location.href="bitacoraReporteProfe.php?idUsuario="+idUsuario;
}
</script>
<body>
<div id="principal">
<?php 
require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($idCurso);
$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$idCurso.",Informe Bitacoras*#";
require("_navegacion.php");
?>
	
<div id="lateralIzq">
	<?php require("menuleft.php"); ?>
</div>
    
<div id="lateralDer">
	<?php require("menuright.php"); ?>
<br />
</div>
    
<div id="columnaCentro">
	<p class="titulo_curso"><?php echo "Informe Bitácoras Curso ".$nombreCurso; ?></p>
    <hr /> <br />
	<table border="0" align="center" width="100%" class="tablesorter">
	    <tr  align="center">
            <th width="90">N&deg;</th>
            <th width="470">Participante</th>
            <th width="287">Rol </th>
            <th width="255">Respuestas</th>
        </tr>
	<?php 
	//print_r($_SESSION);
	$alumnosCurso = getAlumnosCursoParaBitacora($idCurso);
//	print_r($alumnosCurso);
    ordenar($alumnosCurso,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
    

                
    //print_r($alumnosCurso);
    $color = ' bgcolor ="#FFFFFF"';
    $flag = 0;
    $num = 0;
    
    
	foreach ($alumnosCurso as $i => $value) { 
		$num = $num+1;
		if ($flag == 0){
			$flag = 1;
			$color = "";
		}else{
			$flag = 0;
			$color = ' bgcolor ="#FFFFFF"';
		}
		?>
		<tr <?php echo $color;?>>
			<td valign="center"><?php echo $num;?></td>
		<?php
		// Si no existen alumnos
		if(empty($alumnosCurso[0])){
			echo '<td colspan="6">No hay alumnos inscritos em el curso</td>';
		}else{
			?>
			<td valign="center">
				<div align="left">
					<strong><?php echo $value["nombreCompleto"]; ?></strong>
				</div>
			</td>
			
			<td valign="center">
				<div align="center">
					<?php
					echo getNombrePerfil($value["idPerfil"]); 
					?>
				</div>
			</td>
			
			<td>
				<div align="center">
             	<?php
					$numBitacoras = cuentaBitacoras($value["idUsuario"]);
					if ($numBitacoras > 0){
				?>
						<a href="javascript:muestraBitacorasProfe(<?php  echo $value["idUsuario"]; ?>)" >
                        	Ver Bitacoras (<?php echo $numBitacoras;?>)
						</a>
                <?php }	?>
				</div>
			</td>
		</tr>
	<?php 	
		} // else (existen alumnos)
		
	} //foreach
	?>
       
	</table>
	<?php boton("Volver","history.back();");?>
	<div id="bitacorasProfe"></div>
</div><!--columnaCentro-->
<?php 
	require("pie.php");
?>      
</div><!--principal-->
</body>
</html>
