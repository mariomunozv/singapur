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
        	
            <a href="http://asiapacifico.bcn.cl/noticias/cultura-y-sociedad/dinko-mitrovich-centro-klein-balance-metodo-singapur-en-chile" target="_blank">Asesor�a Singapur en la Prensa:  "El m�todo Singapur se est� haciendo muy popular en Chile"</a>
            <br /><br />
            Desde el a�o 2009 el Centro F�lix Klein de la Universidad de Santiago de Chile adapta los textos escolares 
            "Pensar sin L�mites: Matem�tica M�todo de Singapur" de la editorial Marshall Cavendish para Chile y Latinoam�rica, 
            y actualmente se encuentran realizando el sexto libro, que completa la serie y que saldr� al sistema educacional 
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
		Bienvenidas y bienvenidos a la Plataforma Virtual de los cursos de capacitaci�n y asesor�a en la propuesta did�ctica para la� Ense�anza de las Matem�ticas de Singapur. <br />
        <br />
        El Centro Felix Klein, de Investigaci�n, Experimentaci�n y transferencia en Did�ctica de las Matem�ticas y las Ciencias perteneciente a la Facultad de Ciencia de la Universidad de Santiago de Chile, ha sido el encargado de adaptar los textos �My Pals Are Here� de Singapur al sistema educativo nacional, con lo que hemos podido concretar la versi�n en espa�ol titulada "Pensar sin L�mites: Matem�tica M�todo Singapur". <br />
        <br />
        Este a�o 2014 se llevar�n a cabo cursos de formaci�n docente para los niveles de 1� a 5� b�sico y para los directivos t�cnicos de los establecimientos educacionales que han optado por este programa. Estos cursos contemplan una actualizaci�n de conocimientos matem�ticos y did�cticos coherentes con la propuesta plasmada en los textos de la serie �Pensar sin L�mites�, centr�ndose en la gesti�n de aula, a trav�s de la preparaci�n, an�lisis y reflexi�n de procesos de ense�anza aprendizaje matem�ticos. 
               
     	
     
  </div> 
  
     
       <?php //  require("misCursos.php");?>
               

                
                
		</td>
       
      <?php //require("ingreso.php");?>
     
       
      </tr>
        <?php require("pie.php");?>

</div>
</body>
</html>
