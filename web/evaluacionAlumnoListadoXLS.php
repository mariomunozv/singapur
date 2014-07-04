<?php 
 ini_set('display_errors','On');
 header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=ResumenCursoMetodoSingapur.xls");
header("Pragma: no-cache");
header("Expires: 0");

require("inc/incluidos.php");
require("inc/_respuestaItem.php");
require("inc/_item.php");
require("inc/_pautaItem.php"); 
function getNombreNivel($idNivel){
	$sql = "SELECT * FROM nivel WHERE idNivel = $idNivel";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreNivel"]);
	}



function getAlumnosCurso2($rbd,$idNivel,$anoCursoColegio,$letraCursoColegio){
	$sql = "SELECT b.loginUsuario,b.rutAlumno,c.nombreAlumno,c.apellidoPaternoAlumno,c.apellidoMaternoAlumno,b.idUsuario,c.estadoAlumno FROM `matricula` a left join usuario b on a.rutAlumno = b.rutAlumno left join alumno c on a.rutAlumno = c.rutAlumno ";
	$sql.= " WHERE a.rbdColegio = '".$rbd."' AND a.idNivel = ".$idNivel." AND a.anoCursoColegio = ".$anoCursoColegio." AND a.letraCursoColegio = "."'$letraCursoColegio'"." ORDER BY c.apellidoPaternoAlumno ASC";
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


$idNivel = $_SESSION["sesionIdNivel"];
$rbdColegio= $_SESSION["sesionRbdColegio"];
$anoCursoColegio = $_SESSION["sesionAnoCursoColegio"];
$letraCursoColegio= $_SESSION["sesionLetraCursoColegio"];



$idLista = $_SESSION["sesionIdLista"];
$items = getItemsLista($idLista);


$alumnos = getAlumnosCurso2($rbdColegio,$idNivel,$anoCursoColegio,$letraCursoColegio);

?>

<script>
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


	jQuery(function($){
	
		// decimal values
		
		<?php 
		 if (count($alumnos) > 0){
		  $i = 1;
		foreach ($alumnos as $alumno){ 
		
			foreach($items as $item){
					echo "$('#item".$alumno['usuario']."-".$item['idItem']."').stepper({step:0.5, decimals:1, min:0, max:1});	";
				}
		
		}
		 }
		
		?>


	});		


</script>

 
 
<p>
Resumen del Curso: <?php echo getNombreNivel($idNivel)." ".$letraCursoColegio;?>





<table class="tablesorter" id="tabla"> 
   <thead>  
   <tr>
   <th colspan="2">Listado de Alumnos</th>
   		<th colspan="<?php echo count($items);?>">Preguntas</th>
   </tr>
         
  <tr>
    <th>Nº</th>
    
    <th>Nombres</th>
    
    <?php    foreach($items as $item){ ?>   
	   
       		<th><?php echo $item["enunciadoItem"];?></th>
       <?php }  ?>
       
   
  </tr>
  </thead>
  <tbody>

	
  <?php 
  



  if (count($alumnos) > 0){
	  $i = 1;
		foreach ($alumnos as $alumno){ 
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

	
	  ?>
      <input type="hidden" name="pauta[]" value="<?php echo $datosPauta["idPautaItem"];?>"  class="campos" />
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='<?php echo $claseTR; ?>'" class="<?php echo $claseTR; ?>">
              <td><?php echo $i;?></td>
                
                <td><?php echo $alumno["apellidoPaternoAlumno"]." ".$alumno["nombreAlumno"];?></td>
              
               
               <input type="hidden" name="usuarios[]" class="campos" value="<?php echo $alumno['idUsuario'];?>" /> 
           <?php  foreach($items as $item){ 
		   			
		   			$respuesta = getRespuestaUsuarioItem($item["idItem"],$alumno["idUsuario"],$datosPauta["idPautaItem"]);
					//print_r($respuesta);
					
					
		   ?>   
           
                         <td>
                     
                  			
                          <?php echo $respuesta["puntajeRespuestaItem"];?></td>
       <?php }  ?>
      
              </tr>
<?php 	$i++;	}
 }else{ 
	 echo "<tr><td colspan='12'>No existen Alumnos en este curso.</td></tr>"; 
  
  }
  
  ?>
   <div id="activa"></div>
 </tbody> 
</table>