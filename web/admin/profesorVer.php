<?php require("inc/config.php");
require("_head.php");
$menu = "ini";
require("_menu.php"); 

$navegacion = "Inicio*inicio.php,Escuela: ".@$colegio["nombreColegio"]."*#";
require("_navegacion.php");

$rutProfesor = $_REQUEST["rutProfesor"];


?>
<table class="tablesorter" id="tabla">

   <tbody>
  <?php 
  
  $profesor = getDatosProfesor($rutProfesor);
  
  if (count($profesor) > 0){
		
	  ?>
              
                 <tr><th>Rut</th> <td><?php echo $profesor["rutProfesor"];?></td></tr>
                  <tr><th>Nombre </th> <td><?php echo $profesor["nombreProfesor"];?></td></tr>
                <tr> <th>Apellido Paterno</th> <td><?php echo $profesor["apellidoPaternoProfesor"];?></td></tr>
                 <tr><th>Apellido Materno </th> <td><?php echo $profesor["apellidoMaternoProfesor"];?></td></tr>
                  <tr><th>Sexo</th> <td><?php echo $profesor["sexoProfesor"];?></td></tr>
                <tr><th>Fecha Nacimiento </th> <td><?php echo $profesor["fechaNacimientoProfesor"];?></td></tr>
                <tr> <th>Telefono</th>   <td><?php echo $profesor["telefonoProfesor"];?></td></tr>
                 <tr> <th>email </th><td><?php echo $profesor["emailProfesor"];?></td></tr>
                <tr> <th>Experiencia </th><td><?php echo $profesor["anosExperienciaProfesor"];?></td></tr>
               <tr> <th>Asignatura a Cargo </th>  <td><?php echo $profesor["asignaturaACargoProfesor"];?></td></tr>
                <tr> <th>CE </th><td><?php echo $profesor["coordinadorEnlaceProfesor"];?></td></tr>
               
               
              
<?php 		
 }else{ 
	 echo "<tr><td colspan='12'>No existen datos de este profesor</td></tr>"; 
  
  }
  
  ?>
</tbody>
</table>