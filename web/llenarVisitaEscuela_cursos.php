<?php
require("admin/inc/config.php");
require("inc/_funciones.php");
require("inc/_visitaEscuela.php");
//Funciones
function getDocentes($rbdColegio){
  $sql = "SELECT DISTINCT pr.rutProfesor, pr.apellidoPaternoProfesor, pr.apellidoMaternoProfesor, pr.nombreProfesor
          FROM profesor pr join cursoColegio cu on cu.rutProfesor=pr.rutProfesor
          WHERE cu.rbdColegio = ".$rbdColegio."
          AND pr.estadoProfesor = 1 
          AND cu.anoCursoColegio = ".date("Y")."
          ORDER BY pr.apellidoPaternoProfesor";
  if(substr($_POST['tag'],0,9)=="directivo"){
    $sql = "SELECT DISTINCT pr.rutProfesor, pr.apellidoPaternoProfesor, pr.apellidoMaternoProfesor, pr.nombreProfesor
            FROM profesor pr join usuario us on pr.rutProfesor=us.rutProfesor
                 join usuarioColegio uscol on us.idUsuario = uscol.idUsuario
            WHERE (pr.rbdColegio = $rbdColegio
                    AND us.tipoUsuario ='UTP'
                    ) 
               OR (uscol.rbdColegio=$rbdColegio
                   AND pr.estadoProfesor = 1
                   AND us.tipoUsuario='Directivo' )
            ORDER BY pr.apellidoPaternoProfesor";
  }
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
        <?php 
          if($_POST["prefix"]== "colectivo"){ 
            echo "<span>Docente: </span>"; 
          } 
        ?>
        <select style="width:200px;display:<?php echo $_POST['display2']; ?>;" class="select-docente-<?php echo $_POST['prefix']?>" name="select-docente-<?php echo $_POST['tag'] ?>">
          <option value="">----</option>
            <?php 
                $docentes = getDocentes($_POST["rbd"]);
                if (count($docentes) > 0){
                  foreach ($docentes as $docente){
                    echo "<option value='".$docente['idProfesor']."'>".utf8_encode($docente["nombreProfesor"])."</option>";
                  }
                }
            ?>
            <option value="otr">Otro</option>
        </select>
        <?php
          if(substr($_POST["tag"],0,9)== "directivo"){ 
            echo "<br /><input style='width:65%;margin-top:0px;display:".$_POST["display1"].";' placeholder='¿cual?' name='otro-participante-reunion-".$_POST["tag"]."'>";
          }
        ?>


<?php if($_POST["prefix"]=="colectivo"){ ?>
<script type="text/javascript">
  $(".select-docente-colectivo[name=select-docente-<?php echo $_POST['tag'] ?>]").change(function(){
      var index = $(this).attr("name").substring(25);
      a = "tag=colectivo-"+index+"&pide=cursos&rbd="+$("#select-RBD").val()+"&rutProfesor="+$(this).val();
      var sel = $(this).parent().next();
      AJAXPOST("llenarVisitaEscuela_cursos.php",a,sel);
    });
</script>
<?php }elseif(substr($_POST["tag"],0,9)=="directivo"){ ?>
<script type="text/javascript">
  $("[name=select-docente-<?php echo $_POST['tag'] ?>]").change(function(){
    if($(this).val()=="otr"){
      $("[name=otro-participante-reunion-<?php echo $_POST['tag'] ?>]").show();
    }else{
      $("[name=otro-participante-reunion-<?php echo $_POST['tag'] ?>]").hide();
    }
  });
</script>
<?php } ?>


<?php }elseif ($_POST["pide"]=="cursos"){ ?>
  
  <?php if($_POST["rutProfesor"]=="otr"){ ?>
        <span style='margin-left:25px;'>Docente: </span>
        <input style="width:185px;" type="text" placeholder="Nombre Docente" name="input-otro-docente-<?php echo $_POST['tag'] ?>">
        <br />
        <span style='margin-left:25px;'>Curso: </span>
        <input style="width:200px;" type="text" placeholder="Nombre curso" name="input-otro-cursos-<?php echo $_POST['tag'] ?>">
  <?php }else{ ?>
        <span style='margin-left:25px;'>Curso: </span>
        <select style="width:200px;" class="select-cursos" name="select-cursos-<?php echo $_POST['tag'] ?>">
          <option value="">----</option>
            <?php 
                $cursos = getCursos($_POST["rutProfesor"],$_POST["rbd"]);
                if (count($cursos) > 0){
                  foreach ($cursos as $curso){
					 // var_dump($cursos);
                    echo "<option value='".utf8_encode($curso['nombreCurso'])."'>".utf8_encode($curso["nombreCurso"])."</option>";
                  }
                }
            ?>
        </select>
  <?php } ?>
<?php } ?>



