<?php 
require("inc/incluidos.php");
?>

<?php require ("hd.php");?>

<script language="javascript">
$(function() {
	<?php /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		headers: {  
			5: { sorter: false },
			6: { sorter: false }  // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({
			container: $("#pager"),
			positionFixed: false,
			size:1 //Numero de registros tb
			});  
}); 
</script>

<body>
<div id="principal" style="font-size: 12px;">
<?php require("topMenu.php"); ?>
	
    <div id="lateralIzq" style="width: 180px;">
        <p class="titulo_div" style="width: 180px;">Noticias</p>
        <p class="info_div" style="width: 180px;" align="justify">
        	
            <a href="http://asiapacifico.bcn.cl/noticias/cultura-y-sociedad/dinko-mitrovich-centro-klein-balance-metodo-singapur-en-chile" target="_blank">Asesoría Singapur en la Prensa:  "El método Singapur se está haciendo muy popular en Chile"</a>
            <br /><br />
            Desde el año 2009 el Centro Félix Klein de la Universidad de Santiago de Chile adapta los textos escolares 
            "Pensar sin Límites: Matemática Método de Singapur" de la editorial Marshall Cavendish para Chile y Latinoamérica, 
            y actualmente se encuentran realizando el sexto libro, que completa la serie y que saldrá al sistema educacional 
            chileno el 2014
        </p>
    
    <br />
                  
        <p class="titulo_div" style="width: 180px;">Twitter</p>
        <p class="info_div" style="width: 180px;">
        	<a class="twitter-timeline" width="180" href="https://twitter.com/centrofklein" data-chrome="transparent"  data-widget-id="365477932493307906"lang="ES"data-tweet-limit="1">Tweets por @centrofklein</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

        </p>
    
    </div>
    
    
    
     <div id="lateralDer">
     <?php 
	 	require("ingreso.php");
		require("caja_colegiosParticipantes.php");
	 
	 ?>
       <br />
    
                      
   		
         
  </div>
    
     <div id="columnaCentro" style="padding: 14px; width: 540px;"><p align="justify">     
       <p align="justify">       
       <p align="justify"><br />
		Bienvenidas y bienvenidos a la Plataforma Virtual de los cursos de capacitación y asesoría en la propuesta didáctica para la  Enseñanza de las Matemáticas de Singapur. <br />
        <br />
        El Centro Felix Klein, de Investigación, Experimentación y transferencia en Didáctica de las Matemáticas y las Ciencias perteneciente a la Facultad de Ciencia de la Universidad de Santiago de Chile, ha sido el encargado de adaptar los textos “My Pals Are Here” de Singapur al sistema educativo nacional, con lo que hemos podido concretar la versión en español titulada "Pensar sin Límites: Matemática Método Singapur". <br />
        <br />
        Este año 2014 se llevarán a cabo cursos de formación docente para los niveles de 1º a 5º básico y para los directivos técnicos de los establecimientos educacionales que han optado por este programa. Estos cursos contemplan una actualización de conocimientos matemáticos y didácticos coherentes con la propuesta plasmada en los textos de la serie “Pensar sin Límites”, centrándose en la gestión de aula, a través de la preparación, análisis y reflexión de procesos de enseñanza aprendizaje matemáticos. 
               
     	
     
  </div> 
  
     
       <?php //  require("misCursos.php");?>
               

                
                
		</td>
       
      <?php //require("ingreso.php");?>
     
       
      </tr>
        <?php require("pie.php");?>

</div>
</body>
</html>
