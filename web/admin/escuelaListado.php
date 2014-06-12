<?php require("inc/config.php");
require("../inc/_detalleColegioProyecto.php");
?> 
 <p> <table class="tablesorter" id="tabla">
   <thead>         
  <tr>
    <th>RBD</th>
    <th>Nombre </th>
    <th>Comuna</th>
    <th>Email</th>
	<th>Opciones</th>
    
  </tr>
  </thead>
  <tbody>
  <?php 
 
    $colegios = getColegios(1);

  
  if (count($colegios) > 0){
		foreach ($colegios as $colegio){  
	  ?> 
              <tr>
                <td><?php echo $colegio["rbdColegio"];?></td>
                <td><?php echo $colegio["nombreColegio"];?></td>
                <td><?php echo $colegio["nombreComuna"];?></td>
                <td><?php echo $colegio["emailColegio"];?></td>
                <td>Editar - Activar - <a href="escuelaDetalle.php?rbdColegio=<?php echo $colegio["rbdColegio"];?>">Ver Ficha</a></td>
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='5'>No existen colegio registrados</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>