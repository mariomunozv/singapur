<?php 
  require("inc/incluidos.php");
  require ("hdOld.php");
  $idCurso = $_SESSION["sesionIdCurso"];
  $_SESSION["sesionIdCurso"] = $idCurso; 

?>

<script language="javascript">
$(function() {
  $( "#datepicker" ).datepicker();
  $( "#datepicker2" ).datepicker();
});
  
function iniciar(){
  $(function() {
    
  $('#datepicker').datepicker({dateFormat: "yy-mm-dd"});
  $("#datepicker").datepicker($.datepicker.regional['es']);
  $("#datepicker").datepicker({ minDate: new Date(2013, 1 - 1, 1)});
  
  $('#datepicker2').datepicker({dateFormat: "yy-mm-dd"});
  $("#datepicker2").datepicker($.datepicker.regional['es']);
  $("#datepicker2").datepicker({ minDate: new Date(2013, 1 - 1, 1) });
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

function nuevoBitacoraProfe(idPeril){  
    var division = document.getElementById("nuevaBitacora");
    var a = "perfil="+idPeril; 
    AJAXPOST("nuevaBitacoraProfe.php",a,division,false, iniciar);  
}

function listaBitacoraProfe(idPeril){  
    var division = document.getElementById("nuevaBitacora");
    var a = "perfil="+idPeril; 
    AJAXPOST("bitacoraUsuarioListado.php",a,division,false, iniciar);  
}

function muestraBitacoras(){  
    var division = document.getElementById("listadoBitacoras");
    AJAXPOST("bitacorasUtpListado.php","",division);  
}
  
function revisaBitacoras(){  
  window.location.href = "informeBitacorasCurso.php?idCurso="+<?php echo $idCurso?>;
}
  

</script>


 
<body>

<div id="principal">
<?php 
require("topMenu.php"); 
$navegacion = "Home*curso.php?idCurso=$idCurso,Resultados Bit&#225;cora*#";
require("_navegacion.php");
?>
  
  <div id="lateralIzq">
      <?php require("menuleft.php");?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
      <?php require("menuright.php");?>
    </div><!--lateralDer-->
 
    
  <div id="columnaCentro">
    <p class="titulo_curso">Bit&#225;cora del Docente</p>
      <hr />
      <br />
  
    <div id="textoBienvenida">
          <p class="textoBienvenida">
            La Bit&#225;cora permitir&#225; tener un registro respecto a la cobertura curricular de la 
            implementación en aula del Método Singapur, de acuerdo a los capítulos y apartados 
            del texto Pensar Sin Límites. En la Bit&#225;cora podr&#225; registrar periódicamente las 
            actividades realizadas en cada clase con los cursos que atiende en su establecimiento. 
            Esta información permitir&#225; medir oportunamente el ritmo de trabajo alcanzado por sus 
            estudiantes y detectar qué acciones de apoyo ser&#225;n necesarias realizar.
      </p><br />
        </div><!--textoBienvenida-->
  
<?php 
$idPerfil = $_SESSION["sesionPerfilUsuario"];  


switch($idPerfil){
  case 1:
  case 3:
  case 4:
  case 7:
  case 5:
    boton("Bit&#225;cora Profesores","revisaBitacoras()");
    break;
  case 9:
    boton("Bit&#225;cora Profesores","revisaBitacoras()");
    break;
  case 23:
    boton("Bit&#225;cora Profesores","revisaBitacoras()");
    break;
}
?>

  <div id="nuevaBitacora"></div>
</div>     




  
<?php
// Llegó desde el curso profes
if (isset ($_REQUEST["idSeccionBitacora"])){
?>
  <input name="idSeccionBitacora" id="idSeccionBitacora" class="campos" type="hidden" value="<?php echo @$_REQUEST["idSeccionBitacora"]; ?>" />
    <script>
    nuevoBitacoraProfe(<?php echo $idPerfil?>);
  </script>
<?php }

?>

   
<?php 
  require("pie.php");
?> 
</div>
</body>
</html>
