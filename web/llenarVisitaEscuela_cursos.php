<?php
require("admin/inc/config.php");
require("inc/_funciones.php");
//Funciones
function getDocentes($rbdColegio){
  $sql = "SELECT * FROM profesor WHERE rbdColegio = ".$rbdColegio." AND estadoProfesor = 1 ORDER BY apellidoPaternoProfesor";
  $res = mysql_query($sql);
  $i = 0;
  while ($row = mysql_fetch_array($res)){
  $profesores[$i] = array("idProfesor"=> $row["rutProfesor"],"nombreProfesor"=>$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"]." ".$row["nombreProfesor"] );  
  $i++;
  }
  if ($i==0){
    return(NULL);
  }
  return($profesores);
}
function getCursos($rutProfesor,$rbdColegio){
  $sql = "SELECT * 
      FROM cursoColegio cu join nivel ni on cu.idNivel = ni.idNivel 
      WHERE cu.rutProfesor='$rutProfesor'
      AND cu.anoCursoColegio = ".date('Y')."
      AND cu.rbdColegio = $rbdColegio";
  $res = mysql_query($sql);
  $i = 0;
  while ($row = mysql_fetch_array($res)){
    $cursos[$i] = array("nombreCurso"=>$row["nombreNivel"]." ".$row["letraCursoColegio"]);  
    $i++;
  }
  if ($i==0){
    return(NULL);
  }
  return($cursos);
}


?>
<?php if($_POST["pide"]=="docentes"){ ?>

        <select class="select-docente-<?php echo $_POST['prefix']?>" name="select-docente-<?php echo $_POST['tag'] ?>">
          <option value="">----</option>
            <?php 
                $docentes = getDocentes($_POST["rbd"]);
                if (count($docentes) > 0){
                  foreach ($docentes as $docente){
                    echo "<option value='".$docente['idProfesor']."'>".$docente["nombreProfesor"]."</option>";
                  }
                }
            ?>
            <option value="">Otro</option>
        </select>
<?php if($_POST["prefix"]=="colectivo"){ ?>
<script type="text/javascript">
  $(".select-docente-colectivo").change(function(){
      var index = $(this).attr("name").substring(25);
      a = "tag=colectivo-"+index+"&pide=cursos&rbd="+$("#select-RBD").val()+"&rutProfesor="+$(this).val();
      var sel = $(this).parent().next(); //document.getElementById("lugar-cargado-cursos-observado-"+index);
      AJAXPOST("llenarVisitaEscuela_cursos.php",a,sel);
    });
</script>
<?php } ?>

<?php }elseif ($_POST["pide"]=="cursos"){ ?>

        <select class="select-cursos" name="select-cursos-<?php echo $_POST['tag'] ?>">
          <option value="">----</option>
            <?php 
                $cursos = getCursos($_POST["rutProfesor"],$_POST["rbd"]);
                if (count($cursos) > 0){
                  foreach ($cursos as $curso){
                    echo "<option value='".$curso['nombreCurso']."'>".$curso["nombreCurso"]."</option>";
                  }
                }
            ?>
        </select>

<?php } ?>



