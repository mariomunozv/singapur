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
 <?php /*?>      <p align="justify"><br />
		Bienvenidas y bienvenidos a la
         Plataforma Virtual de los cursos de capacitaci&oacute;n y asesor&iacute;a
         en la propuesta did&aacute;ctica para la&nbsp; ense&ntilde;anza de las
         matem&aacute;ticas de Singapur. <br />
         <br />
         El Centro Felix Klein, de Investigaci&oacute;n, Experimentaci&oacute;n
         y transferencia en Did&aacute;ctica de las Matem&aacute;ticas y las
         Ciencias perteneciente a la Facultad de Ciencia de la Universidad de
         Santiago de Chile, ha sido el encargado de adaptar los textos &ldquo;My
         Pals Are Here&rdquo;de Singapur al sistema educativo nacional, con lo
         que hemos podido concretar la versi&oacute;n en espa&ntilde;ol titulada &quot;<strong>Pensar
         sin L&iacute;mites: Matem&aacute;tica M&eacute;todo Singapur</strong>&quot;.<br />
         <br />
         Este a&ntilde;o 2013 se llevar&aacute;n a cabo cursos de formaci&oacute;n
         docente para los niveles de 1&ordm; a 5&ordm; b&aacute;sico y para los
         directivos t&eacute;cnicos de los establecimientos educacionales que
         han optado por este programa. Estos cursos contemplan una actualizaci&oacute;n
         de conocimientos matem&aacute;ticos y did&aacute;cticos coherentes con
         la propuesta plasmada en los textos de la serie &ldquo;Pensar sin L&iacute;mites&rdquo;,
         centr&aacute;ndose en la gesti&oacute;n de aula, a trav&eacute;s de
         la preparaci&oacute;n, an&aacute;lisis y reflexi&oacute;n de procesos
         de ense&ntilde;anza aprendizaje matem&aacute;ticos.
         <?php */?>
        
     	<img src="img/avisoReceso.jpg" width="555">
     
  </div> 
  
     
       <?php //  require("misCursos.php");?>
     
               <!-- <hr />
                
             
                <a class="button" href="#"><span><div class="guardar">boton</div></span></a><br /><br />
                <a class="button" href="#"><span><div class="listar">boton</div></span></a><br /><br />
                <a class="button" href="#"><span><div class="preguntar">boton</div></span></a><br /><br />
                <a class="button" href="#"><span><div class="precio">boton</div></span></a><br /><br />
                <a class="button" href="#"><span><div class="pagos">boton</div></span></a><br /><br />
                <a class="button" href="#"><span><div class="refrescar">boton</div></span></a><br /><br /> 

                <hr />
                
    
                <table id="tabla" class="tablesorter"> 
                <thead> 
                    <tr> 
                    <th>RUT</th> 
                    <th>Razon Social</th>  
                    <th>Dirección</th> 
                    <th>Región</th>
        
                    <th>Comuna</th>
                    <th>Correo</th>  
                    <th colspan="2">Opciones</th> 
                    </tr> 
                </thead> 
                <tbody> 
                	<tr valign="top"> 
                    <td >2-7</td> 
                    <td >ESPINACA CREATIVO</td>  
                    <td >WKWMWKLKLW</td> 
                    <td >Región Metropolitana</td> 
                    <td >MARIA PINTO</td> 
                    <td >ESPINACA@ESPINACA.CL</td>  		
                    <td width="50"><a href="prv_editar.php?id=4"><img src="css/btn/editar.gif" border="0"></a></td>
        
                    <td width="70"><a href="javascript:eliminar(4);"><img src="css/btn/cancelar.gif" border="0"></a></td> 
                    </tr>
                                <tr valign="top"> 
                    <td >12345676</td> 
                    <td >dimacofi</td>  
                    <td >agustinas 786</td> 
                    <td >Región Metropolitana</td> 
                    <td >SANTIAGO CENTRO</td> 
                    <td >dimacofi@yahoo.com</td>  		
                    <td width="50"><a href="prv_editar.php?id=3"><img src="css/btn/editar.gif" border="0"></a></td>
        
                    <td width="70"><a href="javascript:eliminar(3);"><img src="css/btn/cancelar.gif" border="0"></a></td> 
                    </tr>
                                <tr valign="top"> 
                    <td >12345678</td> 
                    <td >todopoleras</td>  
                    <td >lakjdsbheug87</td> 
                    <td >Región Metropolitana</td> 
                    <td >PROVIDENCIA</td> 
                    <td >info@todopoleras.cl</td>  		
                    <td width="50"><a href="prv_editar.php?id=2"><img src="css/btn/editar.gif" border="0"></a></td>
        
                    <td width="70"><a href="javascript:eliminar(2);"><img src="css/btn/cancelar.gif" border="0"></a></td> 
                    </tr>
                    </tbody> 
                </table> 
                <div id="pager" class="pager">
                    <form>
                        <img src="css/tabla/first.png" class="first"/>
                        <img src="css/tabla/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="css/tabla/next.png" class="next"/>
            
                        <img src="css/tabla/last.png" class="last"/>
                        <input type="hidden" class="pagesize" value="1"><?php  //Registros por paginas  ?> 
                    </form>
                </div>-->

                
                
		</td>
       
      <?php //require("ingreso.php");?>
     
       
      </tr>
        <?php require("pie.php");?>

</div>
</body>
</html>
