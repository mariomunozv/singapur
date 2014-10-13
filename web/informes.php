<?php 
require("inc/incluidos.php");
require ("hd.php");
?>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="./css/seccion-cajas.css" />
<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Informes*#";
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
       	  <p class="textoBienvenida">
            Los informes de observación y de visita le permitirán tener un registro de las aproximaciones del asesor con su establecimiento encargado.            
          </p><br />
        </div><!--textoBienvenida-->
        

        
    	<?php
		$idPerfil = $_SESSION["sesionPerfilUsuario"];  

        if ($idPerfil==$coordinador_general || $idPerfil==$relator_tutor || $idPerfil==$asesor || $idPerfil==$directivo || $idPerfil==$utp){ ?>
        <div id="cajaCentralFondo" >
       
        <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Ver Visitas Escuela
                </p>
            </div>
            
              <div id="textoJornada">
               Lista de Visitas Ingresadas
              <br><br>
			 <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('visitaEscuela.php','_self')" value="Registro de visita a escuela" />
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
         <?php } ?>  
          
        </div> <!--cajaCentralFondo-->
        
		<br>
        <div id="cajaCentralFondo" >
      
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Pauta de Observaci&#243;n de Clases  
                </p>
            </div>
            
            <div id="textoJornada">
                Pauta de Observaci&#243;n de Clases 
              <br><br>

              <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('observacionClases.php','_self')" value="Ingresar/Ver Pautas" />
              </div>
              <br />

            </div>
            
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        <br />
    </div> <!--columnaCentro-->

	<?php 
    	

		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>