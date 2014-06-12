<?php
session_start();

require '../models/Curso.php';
require '../models/AsistenciaAlumno.php';

$curso = new Curso();
$_SESSION["sesionRbdColegio"] = $_REQUEST["rbdColegio"];
$_SESSION["sesionIdNivel"] = $_REQUEST["idNivel"];
$_SESSION["sesionAnoCursoColegio"]  = $_REQUEST["anoCursoColegio"];
$_SESSION["sesionLetraCursoColegio"]= $_REQUEST["letraCursoColegio"];
$_SESSION["sesionIdLista"]= $_REQUEST["idLista"];
$_SESSION["idPrueba"]= $_REQUEST["idPrueba"];

$curso->rbd=  $_REQUEST["rbdColegio"];
$curso->idNivel =  $_REQUEST["idNivel"];
$curso->ano= $_REQUEST["anoCursoColegio"];
$curso->letra= $_REQUEST["letraCursoColegio"];
$idLista = $_REQUEST["idLista"];

$modelAsistencia = new AsistenciaAlumno();
$asistenciaAlumno = $modelAsistencia->getAlumnos($curso, $idLista);
$operacionDb = 'update';
if ( empty($asistenciaAlumno) ) {
    $asistenciaAlumno = $modelAsistencia->getAlumnosSinPauta($curso, $idLista);
    $operacionDb = 'insert';
}

?>


  <table class='tablesorter' id='<?php echo $idLista ?>'>
  <thead>
    <tr>
      <th>Nº</th>
      <th>Nombres</th>
      <th>Presente</th>
      <th>Ausente</th>
    </tr>
  </thead>
  <tbody>
      <?php
          $i = 1;
          foreach ($asistenciaAlumno as $asistencia)
          {
            $asistencia->makeHtml($i);
            $i++;
          }
      ?>
  </tbody>
</table>

  <div style="padding-bottom:40px">
    <input type="button" id='btn-asistencia' class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="CONFIRMAR E INGRESAR PUNTAJES" style="float:left"/>
    <div style="float:right">
      <strong>Fecha de la prueba:</strong>
      <input type="text" id="fecha-asistencia" disabled/>
    </div>
  </div>

 <script type="text/javascript">
    (function () {
      var operacionDb = '<?php echo $operacionDb ?>';

      var confirmaFecha = <?php echo $asistenciaAlumno[0]->fechaConfirmada ? 'true' : 'false'; ?>;

      var tablaId = '<?php echo $idLista ?>';

      var send = false;

      var calendar = $('#fecha-asistencia').datepicker({
        dateFormat: "yy-mm-dd",
        showOn: "button",
        buttonImage: "./img/calendar.gif",
        buttonImageOnly: true,
        onSelect: function() {
          confirmaFecha = true
          if (operacionDb === 'update')
            alert('Usted cambió la fecha de aplicación de la prueba');
        }
      });

      if (confirmaFecha) {
        calendar.datepicker("setDate", "<?php echo $asistenciaAlumno[0]->fechaRespuestaPautaItem?>");
      }

      var getAlumnosPresentes = function() {
        var alumnos = [];
        var table = $('#' + tablaId).find('input[type=radio]:checked');
        $.each(table, function(i, j) {
          var row = $(j);
          var idAlumno = row.attr("name");
          var asistio = row.attr("class") == "presente" ? 1 : 0;
          alumnos.push({'id': idAlumno, 'asistio': asistio});
        });
        return alumnos;
      };

      var formatDate = function (date1) {
        return date1.getFullYear() + '-' +
          (date1.getMonth() < 9 ? '0' : '') + (date1.getMonth()+1) + '-' +
          (date1.getDate() < 10 ? '0' : '') + date1.getDate();
      };

      var confirmarAsistencia = function() {
        if (! send) {
          send = true;
          var idLista = tablaId;
          var fecha = calendar.datepicker("getDate");
          fecha = formatDate(new Date(fecha));
          var alumnos = getAlumnosPresentes();
          var info = {'idLista': idLista,
                      'fecha': fecha,
                      'alumnos': JSON.stringify(alumnos),
                      'operacion': operacionDb
                     };

          if (confirmaFecha) {
            $.ajax({
              url: './partials/ConfirmaAsistencia.php',
              type: 'POST',
              data: info,
              complete: function(xhr, textStatus) {
              },
              success: function(data, textStatus, xhr) {
                location.href = './evaluacionAlumnoListado.php';
              },
              error: function(xhr, textStatus, errorThrown) {
              send = false;
              }
            });
          } else {
            alert('No ha confirmado asistencia');
            send = false;
          }
        }

      };


      $('input:radio').change(
          function() {
            var type = $(this).val();
            if (type === 'presente') {
              alert('Usted cambió a un alumno a ausente a presente');
            } else {
              alert('Usted cambió a un alumno a presente a ausente');
            }
          }
      );

      $('#btn-asistencia').click(function() {
        confirmarAsistencia();
      });

    })();
 </script>
