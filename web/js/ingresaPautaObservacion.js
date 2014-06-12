var Pauta = function (tipoUsuario, rut) {

  var congregaciones = $('#congregaciones').select2(),
  establecimientos = $('#establecimientos').select2(),
  profesores = $('#profesores').select2(),
  cursosNiveles = $('#cursosNiveles').select2(),
  libros = $('#libros').select2();
  capitulos = $('#capitulos').select2(),
  apartados = $('#apartados').select2(),
  paginasTexto = $('#paginasTexto'),
  indicadorGestion = $('#gestion-table tbody'),
  indicadorCondiciones = $('#condicion-table tbody'),
  modal = $('#href-modal'),
  modalBody = $('#modal-body');

  $('select.async').change(function(e, f) {
    var sel = $(this).attr('id');
    var id = $(this).find('option:selected').val() ||
      $(this).find('option:last').val();
    funciones[sel](id);
  });

  var funciones = {
    "congregaciones" : loadEstablecimientos,
    "establecimientos" : loadProfesores,
    "profesores" : loadCursosNiveles,
    "libros" : loadCapitulos,
    "capitulos" : loadApartados
  };

  function loadCongregaciones() {
    $.ajax({
      url: './api/PautaObservacion.php/congregaciones/',
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        congregaciones.append(
          $.map(data, function(v, i) {
          return $('<option>', { val: v.id, text: v.nombre });
        })
        );
      }
    });
  }

  function loadEstablecimientos(id) {
    $.ajax({
      url: './api/PautaObservacion.php/establecimientos/' + id,
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        establecimientos
        .empty()
        .append(
          $('<option>' ),
          $.map(data, function(v, i) {
            return $('<option>', {val: v.rbdColegio, text: v.nombreColegio});
          })
        ).change();
      }
    });
  }

  function loadProfesores(id) {
    $.ajax({
      url: './api/PautaObservacion.php/profesores/' + id,
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        profesores
        .empty()
        .append(
          $('<option>' ),
          $.map(data, function(v, i) {
            return $('<option>', {val: v.rutProfesor, text: v.nombre});
          })
        ).change();
      }
    });
  }

  function loadCursosNiveles(id) {
    $.ajax({
      url: './api/PautaObservacion.php/cursos/niveles/' + id,
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        cursosNiveles
        .empty()
        .append(
          $('<option>' ),
          $.map(data, function(v, i) {
            return $('<option>', {val: v.curso, text: v.curso + ' ' + v.nivel});
          })
        ).change();
      }
    });
  }

  function loadLibros() {
    $.ajax({
      url: "./api/PautaObservacion.php/libros",
      dataType: "json",
      success: function (data, textStatus, jqXHR) {
        libros.append(
          $.map(data, function(v, i) {
          return $('<option>', {val: v.parteLibro, text: v.parteLibro});
        })
        ).change();
      }
    });
  }

  function loadCapitulos(id) {
    $.ajax({
      url: './api/PautaObservacion.php/libros/' + id + '/capitulos',
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        capitulos
        .empty()
        .append(
          $('<option>' ),
          $.map(data, function(v, i) {
            return $('<option>', {val: v.id, text: v.nombre});
          })
        ).change();
      }
    });
  }

  function loadApartados(id) {
    $.ajax({
      url: './api/PautaObservacion.php/capitulos/' + id + '/apartados',
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        apartados
        .empty()
        .append(
          $('<option>'),
          $.map(data, function(v, i) {
            return $('<option>', {val: v.id, text: v.nombre});
          })
        ).change();
      }
    });
  }

  function loadIndicadorGestion() {
    $.ajax({
      url: "./api/PautaObservacion.php/indicadorGestion",
      dataType: "json",
      success: function (data, textStatus, jqXHR) {
        createOptionsIndGestion(data);
      }
    });
  }

  function loadIndicadorCondiciones() {
    $.ajax({
      url: "./api/PautaObservacion.php/indicadorCondiciones",
      dataType: "json",
      success: function (data, textStatus, jqXHR) {
        createOptionsIndCondiciones(data);
      }
    });
  }

  function createOptionsIndGestion(data) {
    indicadorGestion.append(
      $.map(data, function(v, i) {
        var html = [];
        html.push('<tr>');
        html.push('<td>' + (i + 1) + '</td>');
        html.push('<td><label class="radio">' + v.descripcion +  '</td>');
        html.push('<td><label class="radio"><input type="radio" name="g_' + v.id + '" value="NO"></label></td>');
        html.push('<td><label class="radio"><input type="radio" name="g_' + v.id + '" value="1"></label></td>');
        html.push('<td><label class="radio"><input type="radio" name="g_' + v.id + '" value="2"></label></td>');
        html.push('<td><label class="radio"><input type="radio" name="g_' + v.id + '" value="3"></label></td>');
        html.push('</tr>');
        return html.join('');       
      })
    );
  }

  function createOptionsIndCondiciones(data) {
    indicadorCondiciones.append(
      $.map(data, function(v, i) {
        var html = [];
        html.push('<tr>');
        html.push('<td>' + v.id + '</td>');
        html.push('<td><label class="radio">' + v.descripcion +  '</td>');
        html.push('<td><label class="radio"><input type="radio" name="c_' + v.id + '" value="NA"></label></td>');
        html.push('<td><label class="radio"><input type="radio" name="c_' + v.id + '" value="si"></label></td>');
        html.push('<td><label class="radio"><input type="radio" name="c_' + v.id + '" value="no"></label></td>');
        html.push('</tr>');
        return html.join('');       
      })
    );
  }

  $('#inputHoraInicio').timepicker({
     minuteStep: 1
  });
  //.on('changeTime.timepicker', function(e) {
    //console.log('The time is ' + e.time.value);
  //});

  $('#inputHoraTermino').timepicker({
     minuteStep: 1
  });
  //.on('changeTime.timepicker', function(e) {
    //console.log('The time is ' + e.time.value);
  //});

  calendar = $('#inputFecha').datepicker({
    dateFormat: "yy-mm-dd",
    showOn: "button",
    buttonImage: "./img/calendar.gif",
    buttonImageOnly: true,
    onSelect: function() {
    }
  });//.next().before('  ');


  $('#form-observacion').submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();

    if (! validarForm() ) {
      e.preventDefault();
    } else {
      $.ajax({
        url: "./api/PautaObservacion.php/save/" + data,
        data: $(this).serialize() + "&rut=" + encodeURIComponent(rut) +"&tipoUsuario=" + encodeURIComponent(tipoUsuario),
        type: "POST",
        complete: function(d) {
          console.log('complete', d);
        },
        success: function (data, textStatus, jqXHR) {
          var e;
          if (data.response == 'ok') {
            // modal OK
            e = $('<p>', {text: "Se ha ingresado correctamente la Pauta"});
            $("#btn-ok").on("click", function() { window.location.reload(); });
          } else {
            // modal error
            e = $('<p>', {text: "Se ha producido un error al momento de guardar la información."});
          }
          setBodyModal(e);
          showModal();
          return false;
        }
      });
    }

  });

  function validarForm() {

    var valid = true;
    var errors = [];

    if (! congregaciones.val() ) {
      errors.push('Seleccione Congregacion');
      valid = false;
    }

    if (! establecimientos.val() ) {
      errors.push('Seleccione Establecimiento');
      valid = false;
    }

    if (! profesores.val() ) {
      errors.push('Seleccione Profesor');
      valid = false;
    }

    if (! cursosNiveles.val() ) {
      errors.push('Seleccione Curso');
      valid = false;
    }

    if (! libros.val() ) {
      errors.push('Seleccione Libro');
      valid = false;
    }

    if (! capitulos.val() ) {
      errors.push('Seleccione Capitulo');
      valid = false;
    }

    if (! apartados.val() ) {
      errors.push('Seleccione Apartado');
      valid = false;
    }

    if (! paginasTexto.val() ) {
      errors.push('Seleccione Paginas Texto');
      valid = false;
    }

    if ( calendar.datepicker( "getDate" ) === null ) {
      errors.push('Seleccione Fecha');
      valid = false;
    }

    // Iterar sobre indicadores de gestion
    // Validar que exista algun elemento seleccionado
    var unChecked = [];

    $.each(indicadorGestion.find('tr'), function(i, labels) {
      if ( typeof( $('input:radio:checked', labels).val() ) === 'undefined' ) {
        unChecked.push( i + 1 );
      }
    });

    if (unChecked.length > 0) {
      errors.push('Por favor responda la preguntas de Gestion:' + unChecked.join(', '));
      valid = false;
    }

    // Opciones indicador Condiciones
    // OJO: Violacion DRY
    unChecked.length = 0;

    $.each(indicadorCondiciones.find('tr'), function(i, labels) {
      if ( typeof( $('input:radio:checked', labels).val() ) === 'undefined' ) {
        var letra = $(labels).find('td:first').text();
        unChecked.push(letra);
      }
    });

    if (unChecked.length > 0) {
      errors.push('Por favor responda las preguntas de Condiciones:' + unChecked.join(', '));
      valid = false;
    }

    if ( ! $('#gAbierta').val() ) {
      errors.push('Falta indicar observaciones generales de la clase');
      valid = false;
    }

    if ( ! $('#cAbierta').val() ) {
      errors.push('Falta indicar observaciones generales de la preparación de la clase');
      valid = false;
    }

    if (errors.length > 0) {
      var e = $.map(errors, function(v, i) { 
        return $('<p>', {text: v}); 
      });
      setBodyModal(e);
      showModal();
    }
    return valid;
  }

  function setBodyModal(elements) {
      modalBody.html(elements); 
  }

  function showModal() {
      modal.click();
  }

  function getEstablecimientoByUTPUser(id, callback) {
    $.ajax({
      url: './api/PautaObservacion.php/establecimientoByUTPUser/' + id,
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        var rbd = data[0].rbdColegio;
        loadProfesores(rbd);

        var nombreColegio = data[0].nombreColegio;
        callback(establecimientos, rbd, nombreColegio);

        var idCongregacion = data[0].idCongregacion;
        var nombreCongregacion = data[0].nombreCongregacion;
        callback(congregaciones, idCongregacion, nombreCongregacion);
      }
    });
  }

  function setOptionByEl(el, val, text) {
    el.append(
        $('<option>', { val: val, text: text })
    );
    el.select2('val', val);
    //establecimientos.prop('disabled', 'disabled');
  }

  if ( tipoUsuario == "UTP") {
    getEstablecimientoByUTPUser(rut, setOptionByEl);
  } else {
    loadCongregaciones();
  }
  loadLibros();
  loadIndicadorGestion();
  loadIndicadorCondiciones();

};
