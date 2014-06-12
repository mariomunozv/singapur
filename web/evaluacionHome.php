<?php
ini_set("display_errors", "on");
require "inc/incluidos.php";
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
</style>
<body>
<div id="principal">
<?php
require "topMenu.php";
$navegacion = "Home*mural.php?idCurso=$idCurso,Evaluacion*#";
require "_navegacion.php";
?>

  <div id="lateralIzq">
    <?php require "menuleft.php"; ?>
  </div> <!--lateralIzq-->

  <div id="lateralDer"> <?php require "menuright.php"; ?>
  </div><!--lateralDer-->

  <div id="columnaCentro">
  <p class="titulo_curso">Instrumentos evaluativos de Proceso:</p>
    <hr /><br />
    <p>
      La Evaluaci&oacute;n permitir&aacute; tener un registro del desempeño de los estudiantes en las evaluaciones que proporcionar&aacute; el centro Felix Klein para ser aplicadas en cada curso de los estudiantes participantes. Con la herramienta Evaluaci&oacute;n los docentes podr&aacute;n hacer un registro de los resultados de los estudiantes en las evaluaciones aplicadas y el sistema autom&aacute;ticamente entregar&aacute; un informe con un an&aacute;lisis de los resultados de aprendizajes obtenidos por los estudiantes
    </p>

      <div>
        <div class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Instrumentos de Evaluaci&oacute;n</p>
          </div>

          <div id="textoJornada">
            <p>
              En esta secci&oacute;n usted encuentra disponible todos los instrumentos necesarios para aplicar las
              evaluaciones de proceso a los estudiantes de cada nivel y luego cargar los resultados a la plataforma.
            </p>

            <div class='block-btn'>
              <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('descargaInstrumentos.php','_self')" value="Descargar Instrumentos" />
            </div>
         </div>
         <div id="cajaCentralDown">
           &nbsp;
        </div>

       </div>

       <div class='cajaCentralFondo'>
        <div id="cajaCentralTop">
          <p class="titulo_jornada">Ingreso Registros de Evaluaci&oacute;n</p>
        </div>

        <div id="textoJornada">
          <p>
            En esta secci&oacute;n usted encuentra disponible las planillas que debe completar cons los resultados
            evaluaciones de proceso obtenidos en cada uno de los cursos que tiene a cargo.
          </p>

          <div class='block-btn'>
            <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('evaluacionProfesor.php','_self')" value="Ingresar Registro de Evaluaci&oacute;n" />
          </div>

       </div>

       <div id="cajaCentralDown">
         &nbsp;
       </div>

      </div>

      <div class='cajaCentralFondo'>
        <div id="cajaCentralTop">
          <p class="titulo_jornada">Resultados Evaluaciones de Proceso</p>
        </div>

        <div id="textoJornada">
          <p>
            En esta secci&oacute;n usted encontrar&aacute; disponible informes que se generan de manera
            autom&aacute;tica, una vez completados los registros de evaluaci&oacute;n  de cada curso.
          </p>

          <div class='block-btn'>
            <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('informeEvaluacion.php','_self')" value="Ver Informes" />
          </div>

        </div>

        <div id="cajaCentralDown">
           &nbsp;
        </div>

      </div>

    </div>
    <br>
  </div>

<?php require "pie.php";?>

</div>
</body>
</html>
