<?php //session_start();
require("inc/config.php");
require("_head.php");
$menu = "ini";
require("_menu.php"); 

$navegacion = "Inicio*inicio.php,Escuela: "."*#";
require("_navegacion.php");
$usuario = $_REQUEST["usuario"];

$datosUsuario = getDatosUsuario($usuario);


?>
<table class="tablesorter" id="tabla">

   <tbody>
  <?php 
  
  $alumno = getDatosAlumno($datosUsuario["rut"]);
  
  if (count($alumno) > 0){
		
	  ?>
              
                 <tr><th>Rut</th> <td><?php echo $alumno["rutAlumno"];?></td></tr>
                  <tr><th>Nombre </th> <td><?php echo $alumno["nombreAlumno"];?></td></tr>
                <tr> <th>Apellido Paterno</th> <td><?php echo $alumno["apellidoPaternoAlumno"];?></td></tr>
                 <tr><th>Apellido Materno </th> <td><?php echo $alumno["apellidoMaternoAlumno"];?></td></tr>
                  <tr><th>Sexo</th> <td><?php echo $alumno["sexoAlumno"];?></td></tr>
                <tr><th>Fecha Nacimiento </th> <td><?php echo $alumno["fechaNacimientoAlumno"];?></td></tr>
             <tr><th>Tipo Usuario </th> <td><?php echo $datosUsuario["tipoUsuario"];?></td></tr>
              <tr><th>Email </th> <td><?php echo $datosUsuario["emailUsuario"];?></td></tr>
               <tr><th>Usuario </th> <td><?php echo $datosUsuario["loginUsuario"];?></td></tr>
                <tr><th>Ultimo Acceso </th> <td><?php echo $datosUsuario["ultimoAccesoUsuario"];?></td></tr>
       
               
               
              
<?php 		
 }else{ 
	 echo "<tr><td colspan='12'>No existen datos de este Alumno</td></tr>"; 
  
  }
  
  ?>
</tbody>
</table>