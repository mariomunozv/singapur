<?php 

 ini_set('display_errors','On');

//session_start();
require("inc/config.php");
require("../inc/_evaluacion.php");
require("../inc/_nivel.php");



require("_head.php"); 
$menu = "ini"; 
require("_menu.php");  
$navegacion = "Usuarios*#";
require("_navegacion.php");
 

?>


<script language="javascript">

function new_evaluacion(){//nuevo_usuario
	var division = document.getElementById("evaluacion_nueva");
	AJAXPOST("evaluacionNueva.php","",division);
} 

class_activo('boton_evaluaciones','activo');

</script>

<p>
<span class="titulo_form">Adminitracion Sistema</span>



<form name="form" action="" method="POST" enctype="multipart/form-data">
	<div id="lugar_de_carga"></div>  
	</form>
    <a class="button" href="javascript:new_evaluacion();">
        <span>
            <div class="add">
            	<?php echo "Nueva Evaluacion"; ?>
            </div>
        </span>
    </a>
            
<br />
<br />
  <div id="guarda"></div>
<div id="evaluacion_nueva"></div>


<div class="caja" style="width:80%;">
  <h3>Listado de Evaluaciones</h3>
  <table class="tablesorter" id="tabla">

   <thead>         
  <tr>
    <th>Seleccionar </th>
    <th>ID</th>
    <th>Grupo</th>
    <th>Nombre</th>
    <th>Tipo</th>
    <th>Nivel</th>
    <th>A&ntilde;o</th>
    <th>Estado</th>
    <th>URL</th>

   
  </tr>
  </thead>
  <tbody>
  
  <?php 
  
    $evaluaciones = getEvaluaciones();
    
    
  
    
  if (count($evaluaciones) > 0){
    foreach ($evaluaciones as $eval){  ?>
      <tr>
        <td>
          <input type="checkbox" name="sel[]" id="sel<?php echo $eval['idEvaluacion'];?>"  class="campos" value="<?php echo $idUsuario['idUsuario'];?>">
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php echo $eval['idEvaluacion'];?>
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php echo getNombreGrupo($eval['idGrupoEvaluacion']);?>
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php echo $eval['nombreEvaluacion'];?>
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php echo $eval['tipoEvaluacion'];?>
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php echo getNombreNivel($eval['idNivel']);?>
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php echo $eval['anoEvaluacion'];?>
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php if ($eval["estadoEvaluacion"]==1) { echo "Activo";}else{ echo "Inactivo";} ?>
        </td>
        <td onclick="check=document.getElementById('sel<?php echo $eval['idEvaluacion'];?>');check.checked=(check.checked==false)?true:false;">
          <?php echo $eval['urlEvaluacion'] ; ?>
        </td>
      </tr>
              
<?php }
 }else{ 
   echo "<tr><td colspan='12'>No existen evaluaciones registradas</td></tr>"; 
  
  }
  
  ?>
  <div id="listaCurso"></div>
</div>

<?php require("_pie.php"); ?>
