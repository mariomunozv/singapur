
<?php 
require("inc/incluidos.php");
include "inc/_actividad.php";
include "inc/_pauta.php";
include_once "inc/_accesoRecurso.php";

function getAcceso($idUsuario, $idTipoRecursoObservado, $idLinkAccesoRecurso){

	$sql = "SELECT *
			FROM `accesoRecurso`
			WHERE `idUsuario` = $idUsuario
			AND `idTipoRecursoObservado` = $idTipoRecursoObservado
			AND `idLinkAccesoRecurso` = $idLinkAccesoRecurso";
	
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$datosAcceso = array();
	
	$datosAcceso = array( "idAccesoRecurso" => $row["idAccesoRecurso"],
					  "idTipoRecursoObservado" => $row["idTipoRecursoObservado"],
					  "fechaAccesoRecurso" => $row["fechaAccesoRecurso"],
					  "idLinkAccesoRecurso" => $row["idLinkAccesoRecurso"]
					  );
	return($datosAcceso);
	

}

	
function cuentaPautasFormulario($idFormulario, $idUsuario){
	$sql= "SELECT COUNT(*) AS cont
			FROM pauta
			WHERE idFormulario = $idFormulario
			AND idUsuario = $idUsuario";
	//echo $sql;		
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
} 

function cuentaPautasItem($idLista, $idUsuario){
	$sql= "SELECT COUNT(*) AS cont
			FROM pautaItem
			WHERE idLista = $idLista
			AND idUsuario = $idUsuario";
			//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}

function getActividadesCurso ($idCurso){
	$sql= "SELECT *	FROM detalleActividadCursoCapacitacion a join actividad	b on a.idActividad = b.idActividad WHERE a.idCurso = $idCursoCapacitacion";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
	
	
	}

function getIdListaActividad($idActividad){
	$sql= "SELECT *	FROM lista WHERE idActividad = $idActividad";
	
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["idLista"];
	
	}
function getIdFormularioActividad($idActividad){
	
	$sql= "SELECT *	FROM formulario a join actividadPagina b on a.idActividadPagina = b.idActividadPagina join actividad c on c.idActividad = b.idActividad WHERE c.idActividad = $idActividad";
	
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["idFormulario"];
	
	}

$idCurso = $_SESSION["sesionIdCurso"];
$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$idActividad = $_REQUEST["idActividad"];

$datosActividad = getDatosActividad($idActividad);


$alumnos = getAlumnosCurso($idCurso);



$_SESSION["sesionIdActividad"] = $idActividad;


// Menor que APE y idUsuario de GET es distinto a idUsuario de SESSION
if ($_SESSION["sesionPerfilUsuario"] < 5 ){ 
	
	alerta("No puedes acceder a esta página.");
	dirigirse_a("../home.php");
}


require ("hd.php");

if($datosActividad["linkActividad"] == "actividadesPagina.php"  ){
	$idFormulario = getIdFormularioActividad($datosActividad["idActividad"]);
	//echo ($idFormulario);
	$tipo = "F";
	
}else{
	
	$idLista = getIdListaActividad($datosActividad["idActividad"]);
	
	$tipo = "L";
	
}
if($datosActividad["linkActividad"] == "actividadesPaginaSeccion.php"){
	$idFormulario = 7;	
	$tipo = "F";
	}






?>
<link rel="stylesheet" type="text/css" href="series/shadowbox/shadowbox.css">
<script type="text/javascript" src="series/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
<body>
<div id="principal">
<?php 
require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
//$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"].",Actividades*informeActividad.php,Informe Curso*informeActividadCurso.php?idActividad=".$idActividad;
//require("_navegacion.php");

?>
	
    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
		
		require("caja_participantes.php");
		 
		require("caja_mensajes.php");
		
		?>
    

    </div>
    
    
    
     <div id="lateralDer">
      <?php 
	  require("caja_bienvenida.php");
		require("caja_calendario.php");
	  ?>
         <br />
    
                      
   		
          
  </div>
    
	<div id="columnaCentro">
     
        <p class="titulo_curso"><?php echo $datosActividad["tituloActividad"]; ?></p>
        <hr />
        <br />
    
       <table border="0" align="center" width="100%" class="tablesorter">

    <tr  align="center">
        <th width="90">N&deg;</th>
        <th width="470">Participante</th>
        <th width="287">Rol </th>
        <th width="255">Respuestas</th>
    </tr>
  

	<?php 
	//print_r($_SESSION);

    $alumnosCurso = getAlumnosCurso($idCurso);
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
		}
		else{
			$flag = 0;
			$color = ' bgcolor ="#FFFFFF"';
		}

		?>
		<tr <?php echo $color;?>>
			<td valign="center">
				<?php echo $num;?>
			</td>
		<?php
		// Si no existen alumnos
		if(empty($alumnosCurso[0])){
			echo '<td colspan="6">No hay alumnos inscritos em el curso</td>';
		}
		else{
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
				// FORMULARIOS
				if($datosActividad["linkActividad"] == "actividadesPagina.php" ||  $datosActividad["linkActividad"] == "actividadesPaginaSeccion.php" ){ 
					switch ($idActividad){
						/*id actividades*/
						case 1:
						case 2:
						case 3:
						case 4:
						case 5:
						case 6:
						case 7:
						case 8:
						case 9:
							if (buscaAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]) == true ){
								
								$datosAcceso = getAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]);
								//print_r($datosAcceso);
							?>
								<a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">Revisar</a>
							</div>
                            <?php
									
							}
						break;
						
						
					case 10:
						
							if (buscaAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]) == true ){
								
								$datosAcceso = getAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]);
								//print_r($datosAcceso);
								
								if ($datosAcceso["fechaAccesoRecurso"] < "2012-05-08 13:00:00"){ // la hora del servidor está 1 hora adelantada
									
								
							
							?>
                            
									<a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">
										Revisar
									</a>
							<?php
								}
								else{
									?>
                                    <div style="color:#F00">
                                    <a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">
										Revisar
		
                                        
									</a><br>(ATRASADO:<br>
									<?php 
									
								
									echo $datosAcceso["fechaAccesoRecurso"] ; 
									
									?>)
                                    </div>
                                    <?php
									
								}
							}
							
						break;
						
						
						
						case 12:
						case 13:
							
							if (buscaAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]) == true ){
								
								$datosAcceso = getAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]);
								//print_r($datosAcceso);
								
								if ($datosAcceso["fechaAccesoRecurso"] < "2012-05-22 13:00:00"){ // la hora del servidor está 1 hora adelantada
									
								
							
							?>
                            
									<a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">
										Revisar
									</a>
							<?php
								}
								else{
									?>
                                    <div style="color:#F00">
                                    <a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">
										Revisar
									</a><br>(ATRASADO)
                                    </div>
                                    <?php
									
								}
							}
							
							
						
						break;
						
						
						case 14:
						case 15:
							
							if (buscaAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]) == true ){
								
								$datosAcceso = getAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]);
								//print_r($datosAcceso);
								
								if ($datosAcceso["fechaAccesoRecurso"] < "2012-06-05 13:00:00"){ // la hora del servidor está 1 hora adelantada
									
								
							
							?>
                            
									<a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">
										Revisar
									</a>
							<?php
								}
								else{
									?>
                                    <div style="color:#F00">
                                    <a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">
										Revisar
									</a><br>(ATRASADO)
                                    </div>
                                    <?php
									
								}
							}
							
							
						
						break;
						
						
						
						
						default:
							if (buscaAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]) == true ){
								$datosAcceso = getAcceso( $value["idUsuario"], 14, $datosActividad["idActividad"]);
							?>
								<a href="actividades.php?idUsuarioRevisado=<?php echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" target="_blank">Revisar</a>
							<?php
							}
						break;
						
						
						} //switch
				
						
						
	
				
				?>
                

                <?php }
					// ITEMS
					else{
					
						$numPautasItem = cuentaPautasItem($idLista,$value["idUsuario"]);
						if ($numPautasItem > 0){
				?>
                             <a href="informeActividadDetalle.php?idUsuario=<?php  echo $value["idUsuario"]; ?>&idActividad=<?php echo $datosActividad["idActividad"];?>" >
                            
                                Ver Respuestas (<?php echo $numPautasItem;?>)
                            </a>
                <?php
						}else{?>
							 Ver Respuestas (<?php echo $numPautasItem;?>)
							<?php
                            }
				
					}
				?>
				</div>
			</td>
			
			
		</tr>
		
	<?php 	
		
	
		} // else (existen alumnos)
		
	} //foreach


	?>
       
</table>
     
        <?php boton("Volver","history.back();");?>

   
    
       
        
      </div><!--columnaCentro-->
         
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
