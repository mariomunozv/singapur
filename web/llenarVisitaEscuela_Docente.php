<?php
require("admin/inc/config.php");
require("inc/_funciones.php");
//Funciones
function getDocentes($rbdColegio){
  $sql = "SELECT * FROM profesor WHERE rbdColegio = ".$rbdColegio." AND estadoProfesor = 1 ORDER BY apellidoPaternoProfesor";
  $res = mysql_query($sql);
  $i = 0;
  while ($row = mysql_fetch_array($res)){
  $profesores[$i] = array("rutProfesor"=> $row["rutProfesor"],"nombreProfesor"=>$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"]." ".$row["nombreProfesor"] );  
  $i++;
  }
  if ($i==0){
    return(NULL);
  }
  return($profesores);
}

?>
<?php if($_POST["rbd"]!=""){ ?>
<div id="campo-llenado-docente-<?php echo $_POST['index'] ?>">
  <br />
  <h5>Docente nº<?php echo $_POST['index']+1 ?></h5>
  <table>
    <tr>
      <td>Docente: </td>
      <td>
        <select class="select-docente-observado" name="select-docente-observado-<?php echo $_POST['index'] ?>">
          <option value="">----</option>
            <?php 
                $docentes = getDocentes($_POST["rbd"]);
                if (count($docentes) > 0){
                  foreach ($docentes as $docente){
                    echo "<option value='".$docente['rutProfesor']."'>".$docente["nombreProfesor"]."</option>";
                  }
                }
            ?>
            <option value="">Otro</option>
        </select>
      </td>
      <td style="min-width:10px;"></td>
      <td>Curso: </td>
      <td id="lugar-cargado-cursos-observado-<?php echo $_POST['index'] ?>">
        <select></select>
      </td>
    </tr>
  </table>
  <div style="width:320px;">
    <table class="tablesorter">
      <tbody>
        <tr>
          <th>Acciones realizadas</th>
          <th></th>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <td>Observacion de clases</td>
          <td><input type="checkbox" name="doc1-<?php echo $_POST['index'] ?>"></td>
        </tr>
        <tr>
          <td>Observación de clases con apoyo</td>
          <td><input type="checkbox" name="doc2-<?php echo $_POST['index'] ?>"></td>
        </tr>
        <tr>
          <td>Preparación y/o estudio de una clase a implementar</td>
          <td><input type="checkbox" name="doc3-<?php echo $_POST['index'] ?>"></td>
        </tr>
        <tr>
          <td>Retroalimentación de la clase observada.</td>
          <td><input type="checkbox" name="doc4-<?php echo $_POST['index'] ?>"></td>
        </tr>
        <tr>
          <td>Análisis de resultados</td>
          <td><input type="checkbox" name="doc5-<?php echo $_POST['index'] ?>"></td>
        </tr>
        <tr>
          <td>Dificultades surgidas durante la implementación y logros</td>
          <td><input type="checkbox" name="doc6-<?php echo $_POST['index'] ?>"></td>
        </tr>
        <tr>
          <td>Otros <input disabled id="input-otro-<?php echo $_POST['index'] ?>"></td>
          <td><input class="check-otros-individual" type="checkbox" name="doc7-<?php echo $_POST['index'] ?>"></td>
        </tr>
      </tbody>
    </table>
    Observaciones:<br />
    <textarea style="resize:none;width:100%;height:40px;"></textarea>
  </div>  
  
  <br />
  <hr>
</div>
<script type="text/javascript">
    $(".check-otros-individual").change(function(){
      if($(this).prop("checked")){
        $(this).parent().prev().find("input").prop("disabled",false);
      }else{
        $(this).parent().prev().find("input").val("").prop("disabled",true);
      }
    });

    $(".select-docente-observado").change(function(){
      var index = $(this).attr("name").substring(25);
      a = "tag=observado-"+index+"&pide=cursos&rbd=<?php echo $_POST['rbd']; ?>&rutProfesor="+$(this).val();
      var sel = document.getElementById("lugar-cargado-cursos-observado-"+index);
      AJAXPOST("llenarVisitaEscuela_cursos.php",a,sel);
    });
</script>


<?php } ?>



