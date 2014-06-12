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
	$navegacion = "Home*mural.php?idCurso=$idCurso,Observación de Clases*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    

	<div id="columnaCentro">
		<p class="titulo_curso">Observación de Clases</p>
        <hr />
        <br />

        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Instrumentos para la Observación de Clases
                </p>
            </div>
            
            <div id="textoJornada">
			En esta sección usted encuentra disponible todos los documentos de apoyo para realizar la observación de clases y luego completar la pauta de observación a través de la plataforma virtual.
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
                Ingreso de Pautas de Observación de Clases  
                </p>
            </div>
            
            <div id="textoJornada">
            En esta sección usted encuentra disponible el formulario de la Pauta de Observación de Clases, el cual se debe completar para cada clase que haya sido observada de un docente que implemente en el aula el Método Singapur en el marco de la asesoría. 
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
                Informes de la Observación de Clases  
                </p>
            </div>
            
            <div id="textoJornada">
            En esta sección usted encontrará disponible los informes que se emitirán desde Centro Felix Klein respecto a la implementación en aula de Método Singapur, de acuerdo a la información recogida a través de las Pautas de Observación de Clases. 
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
