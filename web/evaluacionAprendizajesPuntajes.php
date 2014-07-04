
<script>
	jQuery(function($){
	
		// decimal values
		
		<?php 
		for ($i=1;$i<5;$i++){
			echo "$('#ptje".$i."').stepper({step:0.5, decimals:1, min:0, max:1});	";
		}
		
		?>


	});		
</script>



<table id="tabla" class="tablesorter"> 
    <thead> 
        <tr> 
            <th>#</th> 
            <th>Alumno</th>
            <?php
			
			for ($i=1;$i<5;$i++){
				echo '
			<th>P'.$i.'</th>
			
			';
			}
			
			
			?>
            
            <th>Puntaje total</th>
            <th>% Logro</th>  
        </tr> 
    </thead> 
    <tbody>
    	<tr>
        	<td>1</td> 
            <td>Alumno 1</td>
           	
            <?php 
			for ($i=1;$i<5;$i++){
				echo '
			<td>
            <span id="ptje'.$i.'" class="ui-stepper">
            <input id="txtPtje1" type="text" name="textbox_ptje1" size="2" autocomplete="off" class="ui-stepper-textbox" />
            <button type="submit" name="botMasPtje1" value="1" class="ui-stepper-plus">+</button>
            <button type="submit" name="botMenosPtje1" value="-1" class="ui-stepper-minus">-</button>
            </span>	
            </td>
			';
			}
			?>
           
            
			<td>4</td> 
            <td>60 %</td> 
        </tr>    
    </tbody> 
</table>






