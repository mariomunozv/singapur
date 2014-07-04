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
	$navegacion = "Home*mural.php?idCurso=$idCurso,Observaci�n de Clases*observacionClases.php,Instrumentos para la Observaci�n de Clases*#";
	require("_navegacion.php");
?>
	
   <div id="lateralIzq">
    <?php 
      require("menuleft.php");
	  ?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php 
      require("menuright.php");
    ?>
    </div><!--lateralDer-->
    
	  <div id="columnaCentro">
        <p class="titulo_curso">Observaci�n de Clases</p>
        <hr />
        <br />

        <div id="cajaCentralFondo" >
            <div id="cajaCentralTop">
              <p class="titulo_jornada">
				Instrumento de Registro de la Clase de Matem�ticas
	            </p>
            </div>
            <div id="textoJornada">
              Este es un instrumento de apoyo que permite realizar registros de aspectos relevantes de una clase de matem�ticas, basado en evidencias  o hechos puntuales que se hayan suscitado en la clase observada.   
              <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('subir/docs/registro_clase_matematica_2013.pdf','_self')" value="Ver" />
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('subir/docs/registro_clase_matematica_2013.pdf','_blank')" value="Descargar" />
                <!-- <object width="100%" height="200" type="application/pdf" data="subir/docs/registro_clase_matematica.pdf" id="pdf1_content"> <p>Error al cargar el PDF.</p>
                 </object>-->
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
        </div> <!--cajaCentralFondo-->
        
        <div id="cajaCentralFondo" >
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
				Pauta de Observaci�n de Clases
                </p>
            </div>
            
            <div id="textoJornada">
				Instrumento con el conjunto de indicadores que deber� evaluar, en base a la evidencia, una vez que haya observado una clase. Adem�s posteriormente completar en la opci�n "Ingresar Pauta"
              <div class='block-btn'>
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('subir/docs/Pauta_de_Observacion_General_Singapur_22_04_2013_VF.pdf','_self')" value="Ver" />
                <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('subir/docs/Pauta_de_Observacion_General_Singapur_22_04_2013_VF.pdf','_blank')" value="Descargar" />
              </div>
            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
        </div> <!--cajaCentralFondo-->

        <div id="cajaCentralFondo" >
          <div id="cajaCentralTop">
            <p class="titulo_jornada">
      R�brica de la Pauta de Observaci�n de Clases
            </p>
          </div>
          <div id="textoJornada">
      En este documento se encuentran los descriptores para cada uno de los 
             indicadores de la Pauta de Observaci�n de Clases, lo que permitir� asignar con 
             mayor claridad el valor a cada indicador, seg�n lo que haya observado en la 
             clase.�
             <div class='block-btn'>
               <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('subir/docs/Rubrica_de_Pauta_de_Observacion_Singapur_22-04-2013-VF.pdf','_self')" value="Ver"/>
               <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onclick="window.open('subir/docs/Rubrica_de_Pauta_de_Observacion_Singapur_22-04-2013-VF.pdf','_blank')" value="Descargar"/>
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
