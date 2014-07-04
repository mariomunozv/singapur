<?php
  require "inc/incluidos.php";
  require "hd.php";
?>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="./css/bootstrap.min.css"/>
<link rel="stylesheet" href="./css/select2.css"/>
<link type="text/css" href="css/bootstrap-timepicker.min.css" />
<body>
<div id="principal">
  <?php
  require "topMenu.php";
  $navegacion = "Home*mural.php?idCurso=$idCurso,Informes*#";
  require "_navegacion.php";

  //$_SESSION['sesionIdUsuario'];
  //$tipoUsuario = $_SESSION['sesionTipoUsuario'];
  //echo "Perfil: $perfil , tipo usuario: $tipoUsuario";
  //var_dump($_SESSION);

  $perfil = $_SESSION['sesionPerfilUsuario'];
  if ($perfil == 3 || $perfil == 4) {
      $tipoUsuario = 'UTP';
  } else {
      $tipoUsuario = 'Klein';
  }
  $rut = $_SESSION['sesionRutUsuario'];

  ?>
	<div id="lateralIzq">
	    <?php require "menuleft.php";	?>
    </div>

    <div id="lateralDer">
      <?php require"menuright.php"; ?>
    </div>

    <div id="columnaCentro">

      <p class="titulo_curso">Ingreso de Pautas de Observaci&oacute;n</p>
      <hr />

      <div id="cajaCentralFondo" >
        <div id="cajaCentralTop">
          <p class="titulo_jornada">
            Pauta General de Observación  de clases - Método Singapur
          </p>
        </div>
          <form id='form-observacion' action="#" method="post" class="form-horizontal">
            <div class="well">
              <div class="control-group">
                <label class="control-label" for="inputInstitucion">Institución</label>
                <div class="controls">
                  <select class="input-xlarge async" name="congregaciones" id="congregaciones" data-placeholder=" ">
                    <option></option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputEstablecimiento">Establecimiento</label>
                <div class="controls">
                  <select class="input-xlarge async" name="establecimientos" id="establecimientos" data-placeholder=" ">
                    <option></option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputProfesor">Profesor</label>
                <div class="controls">
                  <select class="input-xlarge async" name="profesores" id="profesores" data-placeholder=" ">
                    <option></option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputCurso">Curso - Niveles</label>
                <div class="controls">
                  <select class="input-xlarge" name="cursosNiveles" id="cursosNiveles" data-placeholder=" ">
                    <option></option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputLibro">Texto</label>
                <div class="controls">
                  <select name="libros" class="input-medium async" id="libros" data-placeholder=" ">
                    <option></option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputCapitulo">Capitulo</label>
                <div class="controls">
                  <select class="async" name="capitulos" id="capitulos" data-placeholder=" ">
                    <option></option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputApartado">Apartado</label>
                <div class="controls">
                  <select name="apartados" id="apartados" data-placeholder=" ">
                    <option></option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputPaginasTexto">Páginas Texto</label>
                <div class="controls">
                  <input type="text" name="paginasTexto" id="paginasTexto" data-placeholder=" ">
                  </input>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputPaginasTextoEjercitacion">Páginas Texto Ejercitaci&oacute;n <br><strong>(sólo si fue utilizado)</strong></label>
                <div class="controls">
                  <input type="text" name="paginasTextoEjercitacion" id="paginasTextoEjercitacion" data-placeholder=" ">
                  </input>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputFecha">Fecha</label>
                <div class="controls">
                  <input class="input-medium" name="fecha" type="text" id="inputFecha" placeholder="clickear calendario" >
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputHoraInicio">Hora Inicio</label>
                <div class="controls">
                  <div class="input-append bootstrap-timepicker">
                    <input id="inputHoraInicio" name="inputHoraInicio" type="text" class="input-small">
                    <span class="add-on"><i class="icon-time"></i></span>
                  </div>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label" for="inputHoraTermino">Hora Término</label>
                <div class="controls">
                  <div class="input-append bootstrap-timepicker">
                    <input id="inputHoraTermino" name="inputHoraTermino" type="text" class="input-small">
                    <span class="add-on"><i class="icon-time"></i></span>
                  </div>
                </div>
              </div>

            </div>


            <h4 class="text-center"> Indicadores sobre las condiciones de realización de la clase</h4>
            <table id='condicion-table' class='table table-borderer table-hover '>
              <thead>
                <tr>
                 <th></th>
                 <th>Indicadores</th>
                 <th>N/A</th>
                 <th>Si</th>
                 <th>No</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan='5'>
                    <strong>Observaciones generales de la preparación de la clase (aspectos que dificultaron y/o favorecieron en el desarrollo de la clase), en especial de aquellos indicadores en que su respuesta es NO.</strong>
                    <textarea id="cAbierta" name="cAbierta" rows=5 style="width: 98%;"></textarea>
                  </td>
                </tr>
              </tfoot>
            </table>

            <h4 class="text-center"> Indicadores sobre la gestión de clase</h4>
            <table id='gestion-table' class='table table-borderer' border="0">
              <thead>
                <tr>
                 <th>Nº</th>
                 <th>Indicadores</th>
                 <th>N/A</th>
                 <th>1</th>
                 <th>2</th>
                 <th>3</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan='5'>
                    <strong>Observaciones generales de la clase</strong>
                    <textarea id="gAbierta" name="gAbierta" rows=5 style="width: 98%;"></textarea>
                  </td>
                </tr>
              </tfoot>
            </table>

            <!-- Send -->
            <div class="control-group">
              <div class="controls">
                <a href="#modal" data-toggle="modal" class="hide" id='href-modal'></a>
                <button type="submit" class="btn btn btn-success">Ingresar</button>
              </div>
            </div>
          </form>

          <div id='response alert'>
          </div>

          <div id="modal" class="modal hide fade">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>Ingreso de Pauta Información</h3>
            </div>
            <div id="modal-body" class="modal-body">
            </div>
            <div class="modal-footer">
                <button id="btn-ok" type="button" data-dismiss="modal" class="btn btn btn-success">Cerrar</button>
            </div>
          </div>

        <div id="cajaCentralDown">
          &nbsp;
        </div>
      </div> <!--cajaCentralFondo-->

      <br>

    </div> <!--columnaCentro-->

    <?php
      require "pie.php";
    ?>
</div><!--principal-->
<script src="./js/select2.min.js"></script>
<script src="./js/select2_locale_es.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/bootstrap-timepicker.min.js"></script>
<script src="./js/ingresaPautaObservacion.js"></script>
<script type="text/javascript">
  //$.ready(function() {
  new Pauta('<?php echo $tipoUsuario ?>', '<?php echo $rut ?>');
  //});

</script>
</body>
</html>
