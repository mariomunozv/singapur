
<?php require("inc/config.php"); 
require("inc/funcionesAdmin.php");
ini_set('display_errors','On');

$rbdColegio = $_REQUEST["rbdColegio"];

function cuentaAlumnosCurso($letraCursoColegio,$anoCursoColegio,$rbdColegio,$idNivel){
	$sql = "SELECT Count(rutAlumno) AS resultado FROM matricula where rbdColegio = '$rbdColegio' and idNivel = $idNivel and anoCursoColegio = $anoCursoColegio and letraCursoColegio = '$letraCursoColegio'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	echo $row["resultado"];
	
	}

?>
<table class="tablesorter" id="tabla">
   <thead>         
  <tr>
    <th>Curso</th>
    <th>Año</th>
    <th>Profesor Jefe </th>
    
	<th>N alumnos</th>
    <th>Opciones</th>
  </tr>
  </thead>
  <tbody> 
  <?php 
  
  $cursos = getCursosColegio($rbdColegio);
 

  if (count($cursos) > 0){
		foreach ($cursos as $curso){  
		
	  ?>
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='normal'" class="normal">
                <td><?php echo $curso["nombreNivel"]." ".$curso["letraCursoColegio"];?></td>
                <td><?php echo $curso["anoCursoColegio"];?></td>
                <td><?php echo $curso["nombreProfesor"];?> <?php echo $curso["apellidoPaternoProfesor"];?></td>
                  <td><?php cuentaAlumnosCurso($curso["letraCursoColegio"],$curso["anoCursoColegio"],$rbdColegio,$curso["idNivel"]);?> </td>
                
                <td>Editar - Activar - <a href="cursoDetalle.php?rbdColegio=<?php echo $rbdColegio;?>&idNivel=<?php echo $curso["idNivel"];?>&anoCursoColegio=<?php echo $curso["anoCursoColegio"];?>&letraCursoColegio=<?php echo $curso["letraCursoColegio"];?>">Ver Ficha</a></td>
               
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='5'>No existen Cursos en este colegio</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>