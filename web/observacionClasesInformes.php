<?php
require("inc/incluidos.php");
require ("hd.php");
require_once 'models/PautaObservacion/PautaObservacion.php';
?>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="./css/select2.css"/>
<link rel="stylesheet" href="./css/bootstrap.min.css"/>
<body>
<div id="principal">

<?php require("topMenu.php");
$navegacion = "Home*mural.php?idCurso=$idCurso,Informes*#";
require("_navegacion.php");

$perfil = $_SESSION['sesionPerfilUsuario'];

if ($perfil == 3 || $perfil == 4) {
  $tipoUsuario = 'UTP';
} else {
  $tipoUsuario = 'Klein';
}
?>

  <div id="lateralIzq">
      <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->

    <div id="lateralDer">
    <?php require("menuright.php"); ?>
    </div><!--lateralDer-->

  <div id="columnaCentro">

        <p class="titulo_curso">Informes de Actividades: </p>
        <hr />
        <br />

        <div id="cajaCentralFondo" >

            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                  Informe de Evaluaciones
                </p>
            </div>

            <div class="container" >
<?php

$rut = null;
if ($tipoUsuario == 'UTP') {
  $rut = $_SESSION['sesionRutUsuario'];
}
$p = new PautaObservacion();
$rutProfesores = $p->getProfesores($rut);

if ( empty($rutProfesores) ) {
  echo "<i>Aun no hay informes disponibles</i>";
} else {
?>
                <form id='form' action="#"  class="form-horizontal">
                  <div class="control-group" style="padding-top:35px">
                    <label class="control-label" for="inputProfesor">Profesor</label>
                    <div class="controls">
                      <select class="input-xlarge async" name="profesores" id="profesores" data-placeholder="Seleccione Rut">
                        <?php foreach ($rutProfesores as $key => $data) {?>
                          <option value="<?php echo $data["rutProfesor"]?>" ><?php echo utf8_decode( $data["nombreProfesor"]) ?></option>
                        <?php}?>
                      </select>
                    </div>
                  </div>

                  <div class="control-group">
                    <div class="controls">
                     <?php if ($tipoUsuario != 'UTP') { ?>
                      <a href="#" id='cambiaVisibilidad' class="btn btn-info" style="color:white">Cambiar Visibilidad</a>
                     <?php } ?>

                      <button type="submit" class="btn btn btn-success">Descargar Informe</button>
                    </div>
                  </div>

                </form>

                <div class='row'>
                <form id='formVisibilidad' action="./api/PautaObservacion.php/visibilidad/" method="post">
                  <div class='offset1 span6'>
                    <table class="table table-bordered" id="detallePauta" style="display:none">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Fecha Ingreso</th>
                          <th>Rut Responsable</th>
                          <th>Nombre Responsable</th>
                          <th>Visibilidad UTP</th>
                        </tr>
                       </thead>
                       <tbody></tbody>
                        <tfoot>
                          <tr>
                            <td colspan='5'>
                              <button type="submit" class="btn btn-success">Actualizar</button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    </form>
                  </div>
<?php
}
?>
            <br><br>
            </div>

            <div id='response alert'>

            </div>

            <div id="cajaCentralDown">
            &nbsp;
            </div>

        </div> <!--cajaCentralFondo-->
    <br>

    </div> <!--columnaCentro-->

<?php

require("pie.php");

?>

</div><!--principal-->

<script src="./js/select2.min.js"></script>
<script src="./js/select2_locale_es.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  var profesores = $("#profesores").select2();
  var table = $("#detallePauta");
  var tipoUsuario = '<?php echo $tipoUsuario ?>';

  $("#cambiaVisibilidad").click(function() {
    $.ajax({
      url: './api/PautaObservacion.php/detallePauta/' + profesores.val(),
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
          table.find('tbody').html(
            $.map(data, function(v, i) {
              var html = [];
              html.push('<tr>');
              html.push('<td>' + v['id'] + '</td>');
              html.push('<td>' + v['fechaIngreso'] + '</td>');
              html.push('<td>' + v['rutResponsable'] + '</td>');
              html.push('<td>' + v['nombreResponsable'] + '</td>');
              var visible = v['visibilidadUTP'] == 1 ? 'checked' : 'unchecked';
              html.push('<td><input type="checkbox" value="" ' + visible + '></td>');
              html.push('</tr>');
              return html.join('');
            })
           );
        }
      });

      table.fadeOut();
      table.fadeIn(400);
    });

    $("#formVisibilidad").submit(function(e) {
      var form = $(this);
      e.preventDefault();
      var info = {};

      var tr =  table.find('tbody > tr');
      tr.each(function(i, tr) {
        var tr = $(tr);
        var id =  tr.find('td:first').text();
        var check = tr.find('input[type="checkbox"]').is(':checked');
        info[id] = check == true ? 1 : 0;
      });

      // Enviar data al action del form
      $.ajax({
        url: './api/PautaObservacion.php/visibilidad/',
          data : {'info': info},
          dataType: 'json',
          type: 'post',
          success: function (data, textStatus, jqXHR) {
            alert('Se ha actualizado la visibilidad para el profesor');
          }
      });
    });

    $("#form").submit(function(e) {
      var form = $(this);
      form.prop( "action", "./api/PautaObservacion.php/informe/" + profesores.val() + "/" + tipoUsuario );
     });

  });
</script>
</body>
</html>
