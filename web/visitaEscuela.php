<?php 
require("inc/incluidos.php");
require ("hd.php");
?>

<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Informes*informes.php,Visita Escuela*#";
	require("_navegacion.php");
$idPerfil = $_SESSION["sesionPerfilUsuario"];  

?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
	<div id="columnaCentro">
        <p class="titulo_curso">Informes de Actividades: </p>
        <hr />
        <br />
  	 	<div id="textoBienvenida">
       	  <p class="textoBienvenida"></p>
        </div><!--textoBienvenida-->
        
        <?php 
    	
		$idPerfil = $_SESSION["sesionPerfilUsuario"];  

		if ($idPerfil == $coordinador_general || $idPerfil == $relator_tutor ||$idPerfil == $asesor ){   ?>
        <div id="cajaCentralFondo" >
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Llenar Visitas Escuela
                </p>
            </div>
            
              <div id="textoJornada">
               En la siguiente opción podrá ingresar un registro de visita del establecimiento del cual asesora, posteriormente podrá ver los registros ingresados en la opción ver visita escuela.
              <br><br>
			         <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('llenarVisitaEscuela.php','_self')" value="Ingresar visita escuela" />
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
		<br>
        <div id="cajaCentralFondo" >
		<?php } 
        if ($idPerfil==$coordinador_general ||$idPerfil==$relator_tutor || $idPerfil==$asesor ||$idPerfil==$directivo || $idPerfil==$utp){ ?>
        <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Ver Visitas Escuela
                </p>
            </div>
            
              <div id="textoJornada">
               En esta opción podrá ver o descargar los registros ingresados previamente por los asesores de los establecimiento.
              <br><br>
			 <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('informes/informeVisitaEscuela.php','_self')" value="Ver visita escuela" />
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
         <?php } ?>   
        </div> <!--cajaCentralFondo-->
        
		<br>
        
        <br />
    </div> <!--columnaCentro-->

	<?php 
    	

		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>