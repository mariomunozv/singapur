<?php require("inc/config.php");
require_once("../inc/_colegio.php");
?> 
 <p> 
 <script language="javascript">
$(document).ready(function() 
    { 
    $("#tbl").tablesorter({ 
      sortList: [[2,1], [1,0]],
    })  
  }
  ); 
</script>
 
<table class="tablesorter" id="tbl">
   <thead>         
  <tr>
    <th>RBD</th>
    <th>Nombre </th>
    <th>Congregacion </th>
    <th>Comuna</th>
    <th>Email</th>
    <th>Estado</th>
	  <th>Opciones</th>
    
  </tr>
  </thead>
  <tbody>
  <?php 
 
    $colegios = getColegiosTodos();

  
  if (count($colegios) > 0){
		foreach ($colegios as $colegio){  
	  ?> 
              <tr>
                <td><?php echo $colegio["rbdColegio"];?></td>
                <td><?php echo $colegio["nombreColegio"];?></td>
                <td><?php echo $colegio["nombreCongregacion"];?></td>
                <td><?php echo $colegio["nombreComuna"];?></td>
                <td><?php echo $colegio["emailColegio"];?></td>
                <td><?php echo $colegio["estadoColegio"];?></td>
                <td><a href="escuelaDetalle.php?rbdColegio=<? echo $colegio["rbdColegio"];?>">Ver Ficha</a></td>
               
              </tr>
<?php 		}
 }else{ 
	 echo "<tr><td colspan='5'>No existen colegio registrados</td></tr>"; 
  
  }
  
  ?>
 </tbody> 
</table>