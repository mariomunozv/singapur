<?php 
	require("inc/incluidos.php");
	require ("hd.php");
	$idCurso = $_SESSION["sesionIdCurso"];
	$_SESSION["sesionIdCurso"] = $idCurso; 

?>

<script language="javascript">

	$(function() {
		$( "#datepicker" ).datepicker();
	});
	

	function iniciar(){
		$(function() {
		$('#datepicker').datepicker({
			changeMonth: true,
			changeYear: true
		});
		
		$('#datepicker').datepicker('option', {dateFormat: "yy-mm-dd"});
		$("#datepicker").datepicker($.datepicker.regional['es']);
		$("#datepicker").datepicker({ minDate: new Date(2010, 1 - 1, 1) });


	});
		}
	
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


function nuevoBitacoraReunion($idJornada){  
		var division = document.getElementById("nuevaBitacora");
		AJAXPOST("nuevaBitacoraUtp1.php","",division,false, iniciar);  
	}
function nuevoBitacoraAula($idJornada){  
		var division = document.getElementById("nuevaBitacora");
		AJAXPOST("nuevaBitacoraUtp2.php","",division,false, iniciar);  
	}
	
function nuevoBitacoraProfe($idJornada){  
		var division = document.getElementById("nuevaBitacora");
		var a = $(".campos").fieldSerialize(); 
		AJAXPOST("nuevaBitacoraProfe.php",a,division,false, iniciar);  
	}

function muestraBitacoras(){  
		var division = document.getElementById("listadoBitacoras");
		AJAXPOST("bitacorasUtpListado.php","",division);  
	}
</script>


 
<body>

<div id="principal">
<?php 
require("topMenu.php"); 
$navegacion = "Home*curso.php?idCurso=$idCurso,Bitacora*#";
require("_navegacion.php");
?>
	
     <div id="lateralIzq">
    	<?php require("menuleft.php");?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
	    <?php require("menuright.php");?>
    </div><!--lateralDer-->
 
    
     <div id="columnaCentro">
     
	<p class="titulo_curso">Bit�cora del Docente</p>
    <hr />
    <br />
	
        <div id="textoBienvenida">
            <p class="textoBienvenida">La Bit�cora permitir� tener un registro respecto a la cobertura curricular de la implementaci�n en aula de  la M�todo Singapur, de acuerdo a los Cap�tulos y Secciones del Texto Pensar Sin L�mites.
En la Bit�cora podr� registrar peri�dicamente las actividades realizadas en cada clase con los cursos que atiende en su establecimiento. Esta informaci�n permitir� medir oportunamente el ritmo de trabajo alcanzado por sus estudiantes y detectar qu� acciones de apoyo ser�n necesarias realizar.
</p>
            <br />
        </div>    
  
<!--    <h3>En Construcci�n</h3>
    <img src="img/constructor.jpg"/> -->

<?php $idPerfil = $_SESSION["sesionPerfilUsuario"];  ?>
<?php 

if($idPerfil == 1){
	boton("Ingresar Bit�cora","#");
	//boton("Ingresar Bit�cora","nuevoBitacoraProfe()");
	}
	
if($idPerfil == 3){ /*
		echo '<p align="justify">
	   		En esta secci�n se presentan dos tipos de bit�coras, donde podr� reportar aspectos relativos a su trabajo como directivo t�cnico.<br /><br />
		</p>
			';
		boton("Reuniones con profesores","nuevoBitacoraReunion()");
		boton("Acompa�amiento en aula","nuevoBitacoraAula()");
		
		*/}	
if ($idPerfil >=3){
	boton("Ingresar Bitacora Profesor","nuevoBitacoraProfe()");
	
	echo '<br><br><p align="justify">
	   		En esta secci�n se presentan dos tipos de bit�coras, donde podr� reportar aspectos relativos a su trabajo como directivo t�cnico.<br /><br />
		</p>
			';
		boton("Reuniones con profesores (UTP)","nuevoBitacoraReunion()");
		boton("Acompa�amiento en aula (UTP2)","nuevoBitacoraAula()");
	}



?>


                   
                   
                     
                 
<div id="nuevaBitacora"></div>
<div id="listadoBitacoras"></div>
				    <div class="demo"><br />
<br />

      </div> 
     
  </div>     
     <?php //  require("misCursos.php");?>
     
  
<?php

// Lleg� desde el curso profes
if (isset ($_REQUEST["idSeccionBitacora"])){
	?>
    <input name="idSeccionBitacora" id="idSeccionBitacora" class="campos" type="hidden" value="<?php echo @$_REQUEST["idSeccionBitacora"]; ?>" />
    
    <script>
		nuevoBitacoraProfe();
	</script>
    
    <?php
}

// Lleg� desde el curso profes
if (isset ($_REQUEST["tipoBitacora"])){
	
	if ($_REQUEST["tipoBitacora"] == "reunion"){
		?>
		<script>
			nuevoBitacoraReunion();
		</script>    
		<?php
	}
	else{
		?>
        <script>
            nuevoBitacoraAula();
        </script>
        
        <?php	
	}
}
?>

   
<?php 
		require("pie.php");
?> 
</div> </body>
</html>
