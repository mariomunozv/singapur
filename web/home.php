<?php 
require("inc/incluidos.php");
require ("hd.php");
include("inc/analyticstracking.php");

?>



<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">
<?php
$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"];
require("_navegacion.php");
 require("topMenu.php"); ?>
    <div id="lateralIzq">
    	<?php require("menuleft.php");?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
	    <?php require("menuright.php");?>
    </div><!--lateralDer-->
    
    
    
    
    
	<div id="columnaCentro">
    
    	<div id="notificaciones" align="center">
		<?php 
            require("notificaciones.php");
        
        ?>	
        </div>
			
    </div> <!--columnaCentro-->


	<?php 
    	
		require("pie.php");
		
    ?> 
</div> 
</body>
</html>
