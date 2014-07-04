<?php 
  ini_set('display_errors','On');
require("inc/incluidos.php"); 
$rbdColegio = $_REQUEST["rbdColegio"];
$idNivel = $_REQUEST["idNivel"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];

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


$items[0] = array("idItem" => 2,"idTarea" => 2);
$items[1] = array("idItem" => 3,"idTarea" => 1);
$items[2] = array("idItem" => 4,"idTarea" => 4);

?>

<script>
function activaDesactiva(rutAlumno,modo){
	var division = document.getElementById("activa");
	AJAXPOST("alumnoGuarda.php","modo="+modo+"&rut="+rutAlumno,division);
	
} 
</script>
<h3>Alumnos</h3>
 
<p>
En esta pantalla debe revisar cada uno de los datos de sus alumnos y confirmarlos en el caso de que sean correctos (por defecto los alumnos, se encuentran ya confirmados). 
<br /><br />
En el caso de que estos datos presenten algún error, deberá <strong>deshabilitarlos</strong> o <strong>editarlos</strong> entrando a la opción <strong>"Editar"</strong>. Después de editarlos correctamente debe presionar el botón <strong>"Guardar"</strong>.
<br /><br />
Para agregar un nuevo alumno al listado debe presionar el botón <strong>"Nuevo Alumno"</strong> </p>
<a class="button" href="javascript:newAlumno();"><span><div class="crear"><?php echo " Nuevo Alumno"; ?></div></span></a>
<br />
<br />


<table class="tablesorter" id="tabla"> 
   <thead>  
   <tr>
   <td></td><td></td><td></td><td></td>
   <?php    foreach($items as $item){ ?>   
	   
       <td><?php echo $item["idItem"];?></td>
       <?php }  ?>
   <td>%</td>
   </tr>
         
  <tr>
    <th>Nº</th>
    
    <th>Nombres</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
   
   
  </tr>
  </thead>
  <tbody>

	
  <?php 
  
$alumnos = getAlumnosCurso2($rbdColegio,$idNivel,$anoCursoColegio,$letraCursoColegio);


  if (count($alumnos) > 0){
	  $i = 1;
		foreach ($alumnos as $alumno){ 
		
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
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='<?php echo $claseTR; ?>'" class="<?php echo $claseTR; ?>">
              <td><?php echo $i;?></td>
                
                <td><?php echo $alumno["nombreAlumno"];?></td>
                <td><?php echo $alumno["apellidoPaternoAlumno"];?></td>
                <td><?php echo $alumno["apellidoMaternoAlumno"];?></td>
             
                <?php    foreach($items as $item){ ?>   
	   
       <td><?php echo $item["idItem"];?></td>
       <?php }  ?>
       <td>%</td>
       
              </tr>
<?php 	$i++;	}
 }else{ 
	 echo "<tr><td colspan='12'>No existen Alumnos en este curso.</td></tr>"; 
  
  }
  
  ?>
   <div id="activa"></div>
 </tbody> 
</table>