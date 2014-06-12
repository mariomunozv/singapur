<?php

require("inc/config.php");

include "../inc/_tareaMatematica.php";

?> 

<script language="javascript">

$(function() {
	<?php /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		sortList: [[1,0]] 
	});  
}); 
</script>

<br />

<table class="tablesorter" id="tabla">
    <thead>         
        <tr>
            <th>ID</th>
            <th width="400">Nombre</th>
            <th>Campo</th>
            <th>Opciones</th>
        </tr>
    </thead>
    
    <tbody>
        

		<?php
    
    $arreglo = getTareasMatematicas();
    foreach($arreglo as $elemento){
        
    	?>
        <tr onmouseover="this.className='normalActive'" onmouseout="this.className='normal'" class="normal">
            <td><?php echo $elemento["idTareaMatematica"]; ?> </td>
            <td><?php echo $elemento["nombreTareaMatematica"]; ?> </td>
			<?php
            //$nombreCampo = getNombreAtributoDeTabla($elemento["idCampo"],"Campo")
            ?>
            <td><?php echo $elemento["idCampo"]; ?> </td>
            
            <td><a href="#" onclick="javascript:edit_(<?php echo $elemento["idTareaMatematica"]; ?>)">Editar</a></td>
        </tr>

		<?php		
	}
		
   
        
    ?>  
    </tbody> 
</table>

            