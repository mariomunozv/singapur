
<?php 
 ini_set('display_errors','On');
session_start();
include "inc/conectav10.php";
include "inc/funciones.php";
//@$idUsuario = $_SESSION["sesionIdUsuario"];
//@$nombre =  $_SESSION["sesionNombreUsuario"];

$idActividad = $_REQUEST["idActividad"];

Conectarse(); 

include "inc/_actividad.php";
include "inc/_pauta.php";
include "inc/_colegio.php";

function getTodosProfes(){
	$sql = "SELECT * FROM usuario a join profesor b on a.rutProfesor = b.rutProfesor";
	$sql.=" WHERE  visibleUsuario = 1 order by b.rbdColegio ";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$curso =  estaEn6to($row["idUsuario"]);
		$usuarios[$i] = array(
			"idUsuario"=> $row["idUsuario"],	
			"curso" => $curso,
			"nombreProfesor"=> $row["nombreProfesor"],
			"apellidoPaternoProfesor"=> $row["apellidoPaternoProfesor"],
			"rbdColegio"=> $row["rbdColegio"]		);
		$i++;
	}
	return($usuarios);
	}	



function getSeccionesFormulario($idFormulario){
		
	$sql = "SELECT * FROM seccionFormulario  WHERE idFormulario = '$idFormulario' ORDER BY idSeccionFormulario ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idSeccionFormulario"=> $row["idSeccionFormulario"],
			"tituloSeccionFormulario"=> $row["tituloSeccionFormulario"]
			);
		$i++;
	}
	return($arreglo);
}
 




function getItemsSeccion($idSeccion){
	$sql = "SELECT * FROM detalleSeccionEnunciado a join enunciado b  on a.idEnunciado = b.idEnunciado WHERE  a.idSeccionFormulario  = ".$idSeccion;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$items[$i] = array(
			"idEnunciado"=> $row["idEnunciado"],
			"textoEnunciado"=> $row["textoEnunciado"],
			"esAbiertaEnunciado"=> $row["esAbiertaEnunciado"]
			
		);
		$i++;
	}
	return($items);
	}
	
function getActividadesProfesor($idActividad){
	$sql = "SELECT * FROM actividad a join lista b  on a.idActividad = b.idActividad WHERE a.idActividad = ".$idActividad;
	
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$actividades[$i] = array(
			"idActividad"=> $row["idActividad"],
			"tituloActividad"=> $row["tituloActividad"],
			"limiteVecesActividad"=> $row["limiteVecesActividad"],
			"idLista"=> $row["idLista"],
			"porcentajeLogroLista"=> $row["porcentajeLogroLista"],
			"linkActividad"=> $row["linkActividad"]
			
		);
		$i++;
	}
	return($actividades);
	}	



function getUsuariosContestan($idFormulario){
	$sql = "SELECT DISTINCT (a.idUsuario), a.idPauta,a.idFormulario,c.nombreDirectivo,c.apellidoPaternoDirectivo,c.rbdColegio FROM pauta ";
	$sql.=" a join usuario b on a.idUsuario = b.idUsuario join directivo c on b.rutDirectivo = c.rutDirectivo ";
	
	$sql.=" WHERE a.idFormulario = 7 and b.visibleUsuario = 1 group by a.idUsuario order by c.rbdColegio ";
//	$sql = "SELECT * FROM detalleSeccionEnunciado a join enunciado b  on a.idEnunciado = b.idEnunciado WHERE  a.idSeccionFormulario  = ".$idSeccion;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$usuarios[$i] = array(
			"idUsuario"=> $row["idUsuario"],				  
			"nombreDirectivo"=> $row["nombreDirectivo"],
			"apellidoPaternoDirectivo"=> $row["apellidoPaternoDirectivo"],
			"rbdColegio"=> $row["rbdColegio"]
			
		);
		$i++;
	}
	return($usuarios);
	}


		
function getRespuestaUsuarioIdEnunciado($idEnunciado,$idUsuario){
	$sql = "SELECT * FROM respuesta WHERE idEnunciado = ".$idEnunciado." AND idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuesta = $row["valorSeleccionada"];
	return($respuesta);
	}


function estaEn6to($idUsuario){

	$sql = "SELECT idUsuario  FROM `inscripcionCursoCapacitacion` WHERE `idUsuario` = ".$idUsuario." AND `idCursoCapacitacion` = 23";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if ($row){
		return("6to");
		
		}else{
		$sql2 = "SELECT idUsuario  FROM `inscripcionCursoCapacitacion` WHERE `idUsuario` = ".$idUsuario." AND `idCursoCapacitacion` = 1";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($res2);
		if ($row2){
		return("5to");
		
		}else{
		echo "NINGUNFO";	
			}
	}
	
}

function getItemMalos($idPauta){
	$sql = "SELECT a.idItem, b.idItem ,b.idTareaMatematica, c.nombreTareaMatematica FROM `respuestaItem` a join item b on a.idItem = b.idItem join tareaMatematica c on b.idTareaMatematica = c.idTareaMatematica WHERE `idPautaItem` = ".$idPauta." and puntajeRespuestaItem < 1"; 
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$respuestasMalas[$i] = array(
				"idItem"=> $row["idItem"],
				"nombreTareaMatematica"=> $row["nombreTareaMatematica"]

				
			
			
			
		);
		$i++;
	}
	if ($i > 0){
		return($respuestasMalas);					
		}else{
		return(array());
		}
	
	
	}

function getCondicionesItem($idItem){

	$sql = "SELECT * FROM condicion a JOIN instanciaVariableDidactica b ON a.idInstanciaVariableDidactica = b.idInstanciaVariableDidactica" ;
	$sql.=" JOIN variableDidactica c ON c.idVariableDidactica = b.idVariableDidactica ";
	$sql.=" WHERE a.idItem =".$idItem;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$condiciones[$i] = array(
				"idItem"=> $row["idItem"],
				"nombreVariableDidactica"=> $row["nombreVariableDidactica"],
				"valorInstanciaVariableDidactica"=> $row["valorInstanciaVariableDidactica"]
		);
		$i++;
	}
	if ($i > 0){
		return($condiciones);					
		}else{
		return(array());
		}
	
	
	}

	
function getIntentos($idUsuario,$idLista){
	$sql = "SELECT * FROM pautaItem where idLista = ".$idLista." and idUsuario = ".$idUsuario." and porcentajeLogroPautaItem > 0 order by fechaRespuestaPautaItem ASC";
	$res = mysql_query($sql);
	$i =0;
	
	while ($row = mysql_fetch_array($res)) {
		$pautasUsuario[$i] = array(
			"idUsuario"=> $idUsuario,				  
			"porcentajeLogroPautaItem"=> $row["porcentajeLogroPautaItem"],
			"idPautaItem"=> $row["idPautaItem"],
			
			
		);
		$i++;
	}
	if ($i > 0){
		return($pautasUsuario);					
		}else{
		return(array());
		}
	

	
	}


$profes = getTodosProfes();
$actividades = getActividadesProfesor($idActividad);


/*$idUsuario = $_REQUEST["idUsuario"];


$usuarios = getUsuariosContestan($idFormulario);

$idActividad = $_REQUEST["idActividad"];
	
$idPauta = $_REQUEST["idPauta"];

$idFormulario = $_REQUEST["idFormulario"];

$usuarios = getUsuariosContestan($idFormulario);
	
$seccionFormulario = getSeccionesFormulario($idFormulario);
*/	
///////// SEGURIDAD ////////////////
// Menor que APE y idUsuario de GET es distinto a idUsuario de SESSION
if ($_SESSION["sesionPerfilUsuario"] < 5 && $_REQUEST["idUsuario"] != $_SESSION["sesionIdUsuario"]){ 
	
	alerta("No puedes acceder a esta página.");
	dirigirse_a("../home.php");
}


////// ACTUALIZACION NOTIFICACION
/* Se actualiza el estado de notificacion en caso de entrar a traves de las notificaciones */

	
	

//$datosActividad = getDatosActividad($_REQUEST["idActividad"]);	
	


require ("hd.php");?>

<body>


	
     
        <p class="titulo_curso">Informe de Actividades de Profesores
 </p>
      
<table class="tablesorter">

<tr>
	<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  
    <?php foreach ($actividades as $actividad){	?>

                <th><?php echo $actividad["tituloActividad"];?></th>
  
                <?php } ?>
</tr>




                
                <?php foreach ($profes as $profe){
					$datosColegio = getDatosColegio($profe["rbdColegio"]);
					
					?>
                <tr>
                
                <td><?php echo $datosColegio["nombreColegio"];?></td><td><?php echo $profe["curso"];?></td><td><?php echo $profe["nombreProfesor"]." ".$profe["apellidoPaternoProfesor"];?></td>
                
                 <?php foreach ($actividades as $actividad){
					 $pautasUsuario =  getIntentos($profe["idUsuario"],$actividad["idLista"])
					 ?>
               			<td>
                        <table class="tablesorter">
                        <tr><th>Intento</th><th>%</th><th>Item Malos</th></tr>
                        <?php $i = 1; 
							foreach ($pautasUsuario as $pauta){?>
							<tr>
                            <td><?php echo "Intento ".$i; $i++; ?></td><td><?php echo $pauta["porcentajeLogroPautaItem"]."%"; ?></td>
                            <td>&nbsp;<?php $itemMalos =	getItemMalos($pauta["idPautaItem"]); ?>
                            <table class="tablesorter">
                            <tr><td>ID</td><td>TAREA</td><td>Condiciones</td></tr>
								<?php foreach ($itemMalos as $item){
									$condiciones = getCondicionesItem($item["idItem"]);
									?>
                                 <tr>
                                <td><?php echo $item["idItem"]?></td><td><?php echo $item["nombreTareaMatematica"]?></td>
                                
                                		<td><?php foreach ($condiciones as $condicion){
												echo "<b>".$condicion["nombreVariableDidactica"]."</b>: ".$condicion["valorInstanciaVariableDidactica"]."<br>";
											
											
										}?></td>
                                
                                
                                
                            </tr>    
                                <?php }?>
                            
                            
                            </table>
                            
                            
                            </td>
                            
                            
                            
                            </tr>
							<?php }?>
                        </table>
                        
                        
                        </td>
                <?php } ?>
                
                </tr>  	
  <?php // echo getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario); ?></textarea>
                <?php } ?>


         
       <?php //  require("misCursos.php");?>
     
               
    
   
                



</body>
</html>
