
<?php 
require("inc/incluidos.php");
include "inc/_actividad.php";

	
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
			FROM pauta
			WHERE idLista = $idLista
			AND idUsuario = $idUsuario";
			//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}

function getActividadesCurso($idCursoCapacitacion){
	$sql= "SELECT *	FROM detalleActividadCursoCapacitacion a join actividad	b on a.idActividad = b.idActividad WHERE a.idCursoCapacitacion = $idCursoCapacitacion";
	//echo $sql;
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
		$actividadesCurso[$i] = array(
			"idCursoCapacitacion"=> $row["idCursoCapacitacion"],
			"idActividad" => $row["idActividad"],
			"tituloActividad" => $row["tituloActividad"],
			"estadoActividad" => $row["estadoActividad"],
			"linkActividad" => $row["linkActividad"],
			"limiteVecesActividad" => $row["limiteVecesActividad"]
			);
		$i++;
	}
	if ($i == 0){
		$actividadesCurso = array();	
	} 
	return($actividadesCurso);
	
	
	}
	

//$idCurso = $_SESSION["sesionIdCurso"];
$idCurso = $_REQUEST['idCurso'];
$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil =  $_SESSION["sesionPerfilUsuario"];


//$datosActividad = getDatosActividad($idActividad);

$actividades = getActividadesCurso($idCurso);

require ("hd.php");?>

<body>
<div id="principal">
<?php 
require("topMenu.php"); 
$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
//$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"].",Actividades*informeActividad.php";
//require("_navegacion.php");

?>


    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
		
		require("caja_participantes.php");
		 
		require("caja_mensajes.php");
		
		if ($idPerfil == 5){
			require("caja_respuestas.php");
			}
		
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
     
        <p class="titulo_curso">Informe de Actividades</p>
        <hr />
        <br />
         <?php if($actividades){?>
        <p align="justify">Seleccione la actividad que desea consultar.</p>
       <br>
<br>

        <ul>
    	<?php foreach ($actividades as $actividad){
			
				if ($_SESSION["sesionPerfilUsuario"] < 5){ // Tutor
					$link = "informeActividadDetalle.php?idUsuario=".$idUsuario."&idActividad=".$actividad["idActividad"];
				}else{
					$link = "informeActividadCurso.php?idActividad=".$actividad["idActividad"];	
				}
				
				
			
			?>
        	<li><a href="<?php echo $link; ?>"><?php echo $actividad["tituloActividad"];?></a></li>
            <li>&nbsp;</li>
        	
        <?php }?>
        </ul>
       <?php }else{?>
       <p class="titulo_curso">No hay actividades en este curso</p>
       <br>

       <?php }
	   
	   boton("Volver","history.back();");
	   ?>
        
        
       </p>
    
   
    
       
        
      </div><!--columnaCentro-->
         
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
