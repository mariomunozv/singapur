<?php require("inc/incluidos.php"); ?>
<?php require ("hd.php");

$idCurso = $_SESSION["sesionIdCurso"];
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
	
function mostrarProfes(idCurso){  
		var division = document.getElementById("listado");
		var a = $(".campos").fieldSerialize(); 
		AJAXPOST("bitacoraReportePorProfe.php",a,division,false, iniciar);  
	}
function mostrarCapitulos(idCurso){  
		var division = document.getElementById("listado");
		AJAXPOST("bitacoraReportePorSeccion.php","",division,false, iniciar);  
	}	

function muestraBitacorasUtp(){  
		var division = document.getElementById("listadoBitacoras");
		var a = $(".campos").fieldSerialize(); 
		AJAXPOST("bitacoraReporteUTP.php",a,division);  
	}
</script>


 
<body>

<div id="principal">
<?php require("topMenu.php"); ?>
	
    <div id="lateralIzq">
   
   
	<?php 
		require("caja_misCursos.php");
		require("caja_glosarioPalabra.php");
		require("caja_mensajes.php");
	?>
    
    </div>
  
   <div id="lateralDer">
    <?php 		require("caja_bienvenida.php"); ?>
	<br>


	<?php	require("caja_calendario.php");
	
	?>
    
    
    </div><!--lateralDer-->
 
    
     <div id="columnaCentro">
     
<p class="titulo_curso">Reporte de Bitácoras de Profesores</p>
    <hr />
    <br />

 <p>Seleccione el tipo de informe que desea presionando los botones que aparecen a continuación</p>
<?php $idPerfil = $_SESSION["sesionPerfilUsuario"];  ?>
<?php 

echo "<br><br>";
if($idPerfil >= 5){
	boton("Reporte Bitacoras Por Profesor","mostrarProfes(".$idCurso.")");
	boton("Reporte Bitacoras Por Capítulo","mostrarCapitulos(".$idCurso.")");
	}
	echo "<br>";

$alumnosCurso = getAlumnosCurso($idCurso);

 ordenar($alumnosCurso,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
?>

<table class="tablesorter">
<tr><th>Nombre Utp</th><th>Instancia</th><th>Ver</th></tr>
<tr>
	<td><select name="idUsuario" id="idUsuario" class="campos">
    <?php foreach ($alumnosCurso as $alumno){?>
    <option value="<?php echo $alumno["idUsuario"];?>"><?php echo $alumno["nombreCompleto"];?></option>
    <?php }?>
    </select></td>
    <td><select name="instancia" id="instancia" class="campos"><option value="utp1">Reuniones</option><option value="utp2">Acompañamiento</option></select></td>
    <td><a href="javascript:muestraBitacorasUtp()">Ver</a></td>
</tr>
</table>

 <div id="listado"></div>              
                   
  <div id="listadoBitacoras"></div>                   

				    <div class="demo"><br />
<br />

      </div> 
    
     
  </div>     <?php //  require("misCursos.php");?>
     
          
      
   
<?php 
    	
		require("pie.php");
		
    ?> 
</div> </body>
</html>
