<?php 
require("inc/incluidos.php");
require ("hd.php");
?>

<body>
<div id="principal">
<?php require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <?php 
		require("caja_misCursos.php");
        require("caja_glosarioPalabra.php");
        require("caja_participantes.php");
        require("caja_mensajes.php");
	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
		<?php 
        require("caja_bienvenida.php");
        require("caja_calendario.php");
        ?>
    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     
			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>
