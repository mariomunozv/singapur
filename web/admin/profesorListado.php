<?php require("inc/config.php");
require("../inc/_profesor.php");
$rbdColegio = $_REQUEST["rbdColegio"];
?>
<table class="tablesorter" id="tabla">

   <thead>         
  <tr>
    <th>Rut</th>
    <th>Nombre </th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno </th>
    <th>Sexo</th>
    <th>Fecha Nacimiento </th>
    <th>Telefono</th>  
    <th>email </th>
    <th>Experiencia </th>
    <th>Asignatura a Cargo </th> 
    <th>CE </th>
    
	<th>Opciones</th>
   
  </tr>
  </thead>
  <tbody>
  <?php 
   
  $profesores = getProfesoresColegio($rbdColegio);
 
  
  if (count($profesores) > 0){
		foreach ($profesores as $profesor){  
	  ?>
              <tr onmouseover="this.className='normalActive'" onmouseout="this.className='normal'" class="normal">
                <td><?php echo $profesor["rutProfesor"];?></td>
                <td><?php echo $profesor["nombreProfesor"];?></td>
                <td><?php echo $profesor["apellidoPaternoProfesor"];?></td>
                <td><?php echo $profesor["apellidoMaternoProfesor"];?></td>
                <td><?php echo $profesor["sexoProfesor"];?></td>
                <td><?php echo $profesor["fechaNacimientoProfesor"];?></td>
                <td><?php echo $profesor["telefonoProfesor"];?></td>
                <td><?php echo $profesor["emailProfesor"];?></td>
                <td><?php echo $profesor["anosExperienciaProfesor"];?></td>
                <td><?php echo $profesor["asignaturaACargoProfesor"];?></td>
                <td><?php echo $profesor["coordinadorEnlaceProfesor"];?></td>
                <td>Editar - Activar - <a href="profesorVer.php?rutProfesor=<?php echo $profesor["rutProfesor"];?>">Ver +</a></td>
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='12'>No existen profesores</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>