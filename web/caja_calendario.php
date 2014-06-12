<div class="titulo_div">Eventos próximos</div>
<div class="info_div">
<?php 
require("cal/calendario2.php");
$idCurso = $_SESSION["sesionIdCurso"];
?>
 
<?php
//$datosEventos = getEventosProximosCurso(1);
$datosEventos = getTodosEventosProximos();
?>

<ul>
	<?php 
		foreach ($datosEventos as $i => $value) { 
			if ($value["nombreEvento"] == "No existen Eventos Proximos."){ ?>
    			<li><?php 	echo $value["nombreEvento"];?></li>
    <?php		}else{
    
    ?>
    			<li>
                <p align="left">
                <strong>
                <?php echo cambiaf_a_normal($value["fechaEvento"]);?>: </strong><?php echo $value["nombreEvento"];?>
				</p>
                </li>
    <?php 
			} 
		}
	?>
    </ul>
</div>      
