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
	$navegacion = "Home*mural.php?idCurso=$idCurso,Observaci�n de Clases*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    

	<div id="columnaCentro">
		<p class="titulo_curso">Observaci�n de Clases</p>
        <hr />
        <br />

        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Instrumentos para la Observaci�n de Clases
                </p>
            </div>
            
            <div id="textoJornada">
			En esta secci�n usted encuentra disponible todos los documentos de apoyo para realizar la observaci�n de clases y luego completar la pauta de observaci�n a trav�s de la plataforma virtual.
            <br><br>

            <div class='block-btn'>
              <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('observacionClasesDescargaInstrumentos.php','_self')" value="Descargar Instrumentos" />
            </div>

            </div>
			
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        
        
        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Ingreso de Pautas de Observaci�n de Clases  
                </p>
            </div>
            
            <div id="textoJornada">
            En esta secci�n usted encuentra disponible el formulario de la Pauta de Observaci�n de Clases, el cual se debe completar para cada clase que haya sido observada de un docente que implemente en el aula el M�todo Singapur en el marco de la asesor�a. 
              <br><br>

              <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('observacionClasesIngresarPauta.php','_self')" value="Ingresar Pauta" />
              </div>

            </div>
			
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        
        
        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Informes de la Observaci�n de Clases  
                </p>
            </div>
            
            <div id="textoJornada">
            En esta secci�n usted encontrar� disponible los informes que se emitir�n desde Centro Felix Klein respecto a la implementaci�n en aula de M�todo Singapur, de acuerdo a la informaci�n recogida a trav�s de las Pautas de Observaci�n de Clases. 
              <br><br>

              <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('observacionClasesInformes.php','_self')" value="Informe Evaluaci&oacute;n" />
              </div>

            </div>
			
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
       

		<br>
			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>
