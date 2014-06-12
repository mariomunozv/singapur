<?php require("inc/config.php");

require("../inc/_colegio.php");

?>
<?php 
$rbdColegio = $_REQUEST["rbdColegio"];
$colegio = getDatosColegio($rbdColegio);?>
<p> <table class="tablesorter" >
   <thead>         
  <tr>
    <th>RBD</th>
    <th>Nombre </th>
    <th>Comuna</th>
    <th>Email</th>
    <th>Direccion</th>
    <th>Telefono</th>
    <th>Web</th> 
    <th>Logo</th>
	<th>Opciones</th> 
   
  </tr> 
  </thead>
  <tbody>
  <?php 
  

  
 
		
	  ?>
              <tr>
                <td><?php echo $colegio["rbdColegio"];?></td>
                <td><?php echo $colegio["nombreColegio"];?></td>
                <td><?php echo $colegio["nombreComuna"];?></td>
                <td><?php echo $colegio["emailColegio"];?></td>
                 <td><?php echo $colegio["direccionColegio"];?></td>
                  <td><?php echo $colegio["telefonoColegio"];?></td>
                   <td><?php echo $colegio["paginaWebColegio"];?></td>
                   <td><?php echo $colegio["logoColegio"];?></td>
                <td>Editar </td>
               
              </tr>
<?php 		
 
  
  ?>
 </tbody> 
</table>