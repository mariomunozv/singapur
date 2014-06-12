<?php 
ini_set("display_errors","On");
require("inc/incluidos.php");
require ("hd.php");

?>

<body>
<div id="principal">
<?php require("topMenu.php"); ?>
    <div id="lateralIzq">
    <?php 
		//require("menuleft.php");
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
 
    
    <?php 
		require("menuright.php");
	?>

    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
    
    	<p class="titulo_curso"><?php //echo getNombreCurso($idCurso); ?></p>
  	    <?php require("cal/calendarioDetalle.php");?>
        

		<?php $datosEventos = getEventosProximosCurso(1); ?>
        <table class="tablesorter">
        <tr><th colspan="3">Eventos próximos</th></tr>
        <tr><th>Fecha</th><th>Titulo</th><th>Descripcion</th></tr>
            <?php 	foreach ($datosEventos as $i => $value) { ?>
                <tr>
                    <?php if ($value["nombreEvento"] == "No existen Eventos Proximos."){ ?>
                            <td colspan="3"><?php 	echo $value["nombreEvento"];?></td>
                    <?php }else{ ?>
                            <td><?php echo cambiaf_a_normal($value["fechaEvento"]);?></td><td><?php echo $value["nombreEvento"];?></td><td><?php echo $value["descripcionEvento"];?></td>
                    <?php 	} ?>
                </tr>	
            <?php	}?>
        </table>
        
	</div>
    
	<?php 
    	require("pie.php");    ?> 
   </div>     
</body>
</html>