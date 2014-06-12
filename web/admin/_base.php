

<?php 

$path = $_SERVER['DOCUMENT_ROOT']."/sitio/";

//$path .= "/lib/funciones_clases/funciones_usuario.php";
//include_once($path);


//include "incluidos.php";
include ($path."hd.php");
?>

<body>
<?php // require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <?php 
		//require("caja_misCursos.php");
		//require("caja_glosarioPalabra.php");
		//require("caja_mensajes.php");
	
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
    <?php 
		//require("caja_bienvenida.php");
		//require("caja_eventosProximos.php");
		
	?>

    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     
			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("../pie.php");
		
    ?> 
   
</body>
</html>
