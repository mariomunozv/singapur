<?php 
require("inc/incluidos.php");
require ("hd.php");

?>



<body onLoad="toggleDisplay(document.getElementById('theTable'));">	
<div id="principal">
<?php require("topMenu.php"); ?>
    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
		require("caja_glosarioPalabra.php");
		require("caja_mensajes.php");
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
    <?php 		require("caja_bienvenida.php"); ?>
	<br>


	<?php	require("caja_calendario.php");
	
	?>
    
    
    </div><!--lateralDer-->
    
    
    
    
    
	<div id="columnaCentro">
    
    	<div id="notificaciones" align="center">
		<?php 
            require("evaluacionAprendizajesPuntajes.php");
        
        ?>	
        </div>
			
    </div> <!--columnaCentro-->


	<?php 
    	
		require("pie.php");
		
    ?> 
</div> 
</body>
</html>
