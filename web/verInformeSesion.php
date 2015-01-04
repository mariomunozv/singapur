<?php
ini_set("display_errors", "on");
require "inc/incluidos.php";
require("inc/_asistenciaSesion.php");
require "hd.php";

$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil = $_SESSION["sesionPerfilUsuario"];
$rbdColegio = getRbdUsuario($idUsuario);

?>
<meta charset="iso-8859-1">
<style type="text/css" media="all">
  .block-btn {
    text-align: center;
    padding-bottom:15px;
    padding-top:10px;
  }
  .cajaCentralFondo {
    margin-top:15px;
    width: 570px;
    background-image: url("../img/cajaCentralFondo2.png");
    background-repeat: repeat-y;
  }
  input[disabled],textarea[disabled] {
    background-color: #eee;
  }
</style>

<body>
<div id="principal">
<?php
require "topMenu.php";
$navegacion = "Informes*informes.php,Visita Escuela*visitaEscuela.php,Ver informes de sesión*#";
require "_navegacion.php";
?>

  <div id="lateralIzq">
    <?php require "menuleft.php"; ?>
  </div> <!--lateralIzq-->

  <div id="lateralDer"> <?php require "menuright.php"; ?>
  </div><!--lateralDer-->

  <div id="columnaCentro">
    <hr /><br />
    <div id="cajaCentralFondo">
      <div id="datos-generales">
        <div id="cajaCentralTop">
          <p class="titulo_jornada">Informes por sesión</p>
        </div>
        <div id="textoJornada">
          <table class="tablesorter" style="font-size:14px;">
            <tr>
              <th style="font-size:14px; text-align:center" colspan="3">Informe de sesión</th>
            </tr>
            <tr>
              <td style="width:10%;">Nº Sesión</td>
              <td style="width:5%;">
                <select id="select-numero-sesion">
                  <option>---</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </td>
              <td style="width:30%;">
                Informe Asistencia <img src="img/excel.png"><span></span><br>
                Informe de Sesión <img src="img/pdf.gif">
              </td>
            </tr>
          </table>
          <br />
          <div id="informes-ge_nerales" style="display:non_e;">
            <table class="tablesorter" style="font-size:14px;">
              <tr>
                <th style="font-size:14px; text-align:center" colspan="3">Informes generales del curso <span id="llenar-curso"></span></th>
              </tr>
              <tr>
                <td colspan=3 style="width:30%;">
                  Informe Asistencia <a href="#" id="mostrar-asistencia"><img src="img/ver.gif"></a><br>
                  Informe de Sesión <a href="#" id="mostrar-sesion"><img src="img/ver.gif"></a>
                </td>
              </tr>
            </table>
          </div>
          <?php
            $asistenciaGral = 0;
            $profesores = getAlumnosCurso($_SESSION["sesionIdCurso"]);
            ordenar($profesores,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
            $key = 0;
            $cantidadSesiones = cantidadSesionesCurso($_SESSION["sesionIdCurso"]);
            $contProf = 0;
            foreach ($profesores as $i => $prof) {
              if($profesores[$i]["nombrePerfil"] == "Profesor" || $profesores[$i]["nombrePerfil"]=="UTP"){
                $contProf++;
                $profesores[$i]["nombrePerfil"] = getNombrePerfil($prof["idPerfil"]);
                $profesores[$i]["porcentajeAsistencia"]=asistenciaProfesor($prof["idUsuario"],$_SESSION["sesionIdCurso"],$cantidadSesiones);
                $asistenciaGral += $profesores[$i]["porcentajeAsistencia"];
              }
            }
            $asistenciaGral /= $contProf;
            $asistenciaGral = round($asistenciaGral);
          ?>
          <div id="informe-asistencia" style="display:n_one;">
            <table class="tablesorter">
              <tr>
                <th colspan=4>Porcentaje de asistencia general:</th>
                <th><?php echo $asistenciaGral; ?>%</th>
              </tr>
              <tr>
                <th>Nº</th>
                <th>Nombre</th>
                <th>Perfil</th>
                <th>Establecimiento</th>
                <th>Porcentaje<br>general del<br>participante:</th>
              </tr>
              <tbody>
                <?php
              
                  foreach ($profesores as $prof) {
                    if(empty($profesores[0])){
                        echo '<td colspan="6">No hay participantes en el curso.</td>';
                    }else{
                        $nombreP = $prof["nombrePerfil"];
                        if($nombreP == "Profesor" || $nombreP=="UTP"){
                  ?>
                  <tr>
                      <td><?php $key++;echo $key; ?></td>
                      <td><?php echo $prof["nombreCompleto"]; ?></td>
                      <td><?php echo $nombreP; ?></td>
                      <td><?php echo ($prof["rbdColegio"]? getDatosColegio($prof["rbdColegio"])["nombreColegio"] :''); ?></td>
                      <td><?php echo round($prof["porcentajeAsistencia"]); ?>%</td>
                  </tr>
                <?php }}} ?>
              </tbody>
            </table>
            <div class='block-btn'>
              <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('#','_self')" value="Descargar" />
            </div>
          </div>
          <div id="informe-sesion" style="display:none;">
            <table style="text-align:left" class="tablesorter">
              <tr>
                <th colspan=3>Curso de capacitación</th>
                <th colspan=3><span id="llenar-curso-capacitacion"></span></th>
              </tr>
              <tr>
                <th>Nº sesión</th>
                <th>Fecha sesión</th>
                <th>Nº taller</th>
                <th>Capítulo</th>
                <th>Estado</th>
                <th>Relator</th>
              </tr>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>25/04/2014</td>
                  <td>Taller 1</td>
                  <td>Capítulo 1: Tiempo</td>
                  <td>Implementado</td>
                  <td>Amaya Hidalgo </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>26/05/2014</td>
                  <td>Taller 2<br>Taller 3</td>
                  <td>Capítulo 1: Tiempo<br>Capítulo 2: Longitud</td>
                  <td>Implementado</td>
                  <td>Amaya Hidalgo </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>26/05/2014</td>
                  <td>---</td>
                  <td>Capítulo 2: Longitud</td>
                  <td>Omitido</td>
                  <td>Antonio Cofré</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>21/07/2014</td>
                  <td>Taller 3</td>
                  <td>Capítulo 3: Calculo mental</td>
                  <td>Implementado</td>
                  <td>Amaya Hidalgo </td>
                </tr>
              </tbody>
            </table>
            <div class='block-btn'>
              <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('#','_self')" value="Descargar" />
            </div>
          </div>
        </div>
        <div id="cajaCentralDown">
          &nbsp; 
        </div>
      </div>
    </div>
  </div>


<?php require "pie.php";?>

</div>

<script language="javascript">
$("#llenar-curso").html( $("#cambiaCurso option:selected").html() );
  $("#select-numero-sesion").change(function(){
    $("span#elegir-numero").html( $(this).val() );
    $("#informe-asistencia").hide();
    $("#informe-sesion").hide();
    if( $(this).val()!="---" ){
      $("#informes-generales").show();
    }else{
      $("#informes-generales").hide();
    }
  });
  $("#mostrar-asistencia").click(function(){
    event.preventDefault();
    $("#informe-asistencia").show();
    $("#informe-sesion").hide();
  });
  $("#mostrar-sesion").click(function(){
    event.preventDefault();
    $("#llenar-curso-capacitacion").html( $("#cambiaCurso option:selected").html() );
    $("#informe-sesion").show();
    $("#informe-asistencia").hide();
  });
</script>

</body>
</html>
