<?php
require("admin/inc/config.php");
require("inc/_funciones.php");
//Funciones
function getDocentes($rbdColegio){
  $sql = "SELECT * FROM profesor WHERE rbdColegio = ".$rbdColegio." AND estadoProfesor = 1 ORDER BY apellidoPaternoProfesor";
  $res = mysql_query($sql);
  $i = 0;
  while ($row = mysql_fetch_array($res)){
  $profesores[$i] = array("idProfesor"=> $row["idProfesor"],"nombreProfesor"=>$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"]." ".$row["nombreProfesor"] );  
  $i++;
  }
  if ($i==0){
    return(NULL);
  }
  return($profesores);
}
function getCursos(){
  $sql = "SELECT * FROM cursocapacitacion WHERE estadoCursoCapacitacion = 1 AND tipoCursoCapacitacion = 'curso' ORDER BY nombreCortoCursoCapacitacion";
  $res = mysql_query($sql);
  $i = 0;
  while ($row = mysql_fetch_array($res)){
  $cursos[$i] = array("idCurso"=> $row["idCursoCapacitacion"],"nombreCurso"=>$row["nombreCortoCursoCapacitacion"] );  
  $i++;
  }
  if ($i==0){
    return(NULL);
  }
  return($cursos);
}


?>
<?php if($_POST["rbd"]!="" AND $_POST["cantidad"]!=""){ ?>
<h4>Docentes a quienes observ&#243;:</h4>
<table>
  <?php for($i = 0; $i < $_POST["cantidad"]; $i++){ ?>
  <tr>
    <td>Docente: </td>
    <td>
      <select>
        <option value="">----</option>
          <?php 
              $docentes = getDocentes($_POST["rbd"]);
              if (count($docentes) > 0){
                foreach ($docentes as $docente){
                  echo "<option value='".$docente['idProfesor']."'>".$docente["nombreProfesor"]."</option>";
                }
              }
          ?>
      </select>
    </td>
    <td style="min-width:10px;"></td>
    <td>Curso: </td>
    <td>
      <?php $cursos = getCursos(); ?>
      <select>
        <option value="">----</option>
          <?php 
              
              if (count($cursos) > 0){
                foreach ($cursos as $curso){
                  echo "<option value='".$curso['idCurso']."'>".$curso["nombreCurso"]."</option>";
                }
              }
          ?>
      </select>
    </td>
  </tr>
  <?php } ?>

</table>

<?php } ?>