<?php

require '../lib/limonade.php';
require '../admin/inc/jsonwrapper_inner.php';
require '../models/PautaObservacion/congregacion.php';
require '../models/PautaObservacion/Establecimiento.php';
require '../models/PautaObservacion/Profesor.php';
require '../models/PautaObservacion/CursoPautaObservacion.php';
require '../models/PautaObservacion/libro.php';
require '../models/PautaObservacion/capitulo.php';
require '../models/PautaObservacion/apartado.php';
require '../models/PautaObservacion/indicadorGestion.php';
require '../models/PautaObservacion/indicadorCondiciones.php';
require '../models/PautaObservacion/PautaObservacion.php';

function filter($array, $delimiter) {
  $filterElements = array();
  foreach ($_POST as $key => $value) {
    if (substr($key, 0, 2) == $delimiter) {
      $id = substr($key, 2, strlen($key));
      $filterElements[$id] = $value;
    }
  }
  return $filterElements;
}

dispatch('/congregaciones', 'congregaciones');
dispatch('/establecimientos/:id', 'establecimientos');
dispatch('/profesores/:id', 'profesores');
dispatch('/cursos/niveles/:id', 'cursosAndNiveles');
dispatch('/libros', 'libros');
dispatch('/libros/:libro/capitulos', 'capitulos');
dispatch('/capitulos/:capituloId/apartados', 'apartados');
dispatch('/indicadorGestion', 'indicadorGestion');
dispatch('/indicadorCondiciones', 'indicadorCondiciones');
dispatch('/establecimientoByUTPUser/:rut', 'establecimientoByUTPUser');
dispatch_post('/save/*', 'save');
dispatch('/informe/:rut/:tipoUsuario', 'informe');
dispatch('/detallePauta/:rut', 'detallePauta');
dispatch_post('/visibilidad/*', 'updateVisibilidad');

function congregaciones()
{
  $c = new Congregacion();
  return json_encode1($c->get());
}

function establecimientos($id = null)
{
  $id =  params('id');
  $e = new Establecimiento();
  return json_encode1($e->getByIdCongregacion($id));
}

function profesores($id = null)
{
  $id =  params('id');
  $p = new Profesor();
  return json_encode1($p->getByEstablecimientoId($id));
}

function cursosAndNiveles($id = null)
{
  $id =  params('id');
  $c = new CursoPautaObservacion();
  return json_encode1($c->getByRutProfesor($id));
}

function libros()
{
  $l = new Libro();
  return json_encode1( $l->getLibros() );
}

function capitulos($libro = null)
{
  $libro =  params('libro');
  $c = new Capitulo();
  return json_encode1( $c->getByLibro($libro) );
}

function apartados($capituloId = null)
{
  $capituloId =  params('capituloId');
  $a = new Apartado();
  return json_encode1( $a->getByCapituloId($capituloId) );
}

function indicadorGestion()
{
  $a = new IndicadorGestion();
  return json_encode1( $a->all() );
}

function indicadorCondiciones()
{
  $a = new IndicadorCondicion();
  return json_encode1( $a->all() );
}

function establecimientoByUTPUser($rut = null)
{
  $rut =  params('rut');
  $p = new Profesor();
  return json_encode1( $p->getEstablecimientoByRut($rut) );
}


function save($args)
{
  $pauta = new PautaObservacion();
  $pauta->idCongregacion = $_POST['congregaciones'];
  $pauta->rbdColegio = $_POST['establecimientos'];
  $pauta->rutProfesor = $_POST['profesores'];
  $pauta->rutResponsable = $_POST['rut'];
  $pauta->idLibro = $_POST['libros'];
  $pauta->idCapitulo = $_POST['capitulos'];
  $pauta->idApartado = $_POST['apartados'];
  $pauta->paginasTexto = $_POST['paginasTexto'];
  $pauta->paginasTextoEjercitacion = $_POST['paginasTextoEjercitacion'];
  $pauta->fecha = $_POST['fecha'];
  $pauta->horaInicio = $_POST['inputHoraInicio'];
  $pauta->horaTermino = $_POST['inputHoraTermino'];
  $pauta->preguntaGestion = $_POST['gAbierta'];
  $pauta->preguntaCondiciones = $_POST['cAbierta'];
  $pauta->indicadoresGestion = json_encode1( filter($_POST, 'g_') );
  $pauta->indicadoresCondiciones = json_encode1( filter($_POST, 'c_') );
  $curso = explode('-', $_POST['cursosNiveles']);
  $pauta->letraCurso = $curso[0];
  $pauta->anoCurso = $curso[1];
  $pauta->visibilidadUTP = $_POST['tipoUsuario'] == 'UTP' ? 1 : 0;
  $result = $pauta->save();

  $response = array();
  if ($result) {
    $response['response'] = 'ok';
  } else {
    $response['response'] = 'error';
  }
  header('Content-Type: application/json');
  return json_encode1($response);
}

function informe($rut = null, $tipoUsuario = null)
{
  $tabla =<<<HTML
<table>
  <th>RBDEscuela</th>
  <th>Rut Responsable</th>
  <th>Rut Observado</th>
  <th>Nivel</th>
  <th>Curso</th>
  <th>Fecha</th>
  <th>Fecha Ingreso</th>
  <th>Hora Inicio</th>
  <th>Hora Termino</th>
  <th>Libro</th>
  <th>Capitulo</th>
  <th>Apartado</th>
  <th>Paginas Texto</th>
  <th>Paginas Texto Ejercitacion</th>
  <th>a</th>
  <th>b</th>
  <th>c</th>
  <th>d</th>
  <th>e</th>
  <th>f</th>
  <th>Observaciones</th>
  <th>1</th>
  <th>2</th>
  <th>3</th>
  <th>4</th>
  <th>5</th>
  <th>6</th>
  <th>7</th>
  <th>8</th>
  <th>9</th>
  <th>10</th>
  <th>Observaciones Generales</th>
  <tbody>
HTML;

  $rut =  params('rut');
  $p = new PautaObservacion();
  $pautas = $p->getInforme($rut, $tipoUsuario);
  foreach ($pautas as $pauta) {

    $indCondicion = json_decode1($pauta->indicadoresCondiciones);
    $objectIndGestion = json_decode1($pauta->indicadoresGestion);
    $indGestion = get_object_vars($objectIndGestion);

    $capitulo = utf8_decode($pauta->capitulo);
    $apartado = utf8_decode($pauta->apartado);
    $preguntaGestion = utf8_decode($pauta->preguntaGestion);
    $preguntaCondicion = utf8_decode($pauta->preguntaCondiciones);

    $tabla .=<<<HTML
    <tr>
      <td>$pauta->rbdColegio</td>
      <td>$pauta->rutResponsable</td>
      <td>$pauta->rutProfesor</td>
      <td>$pauta->anoCurso</td>
      <td>$pauta->letraCurso</td>
      <td>$pauta->fecha</td>
      <td>$pauta->fechaIngreso</td>
      <td>$pauta->horaInicio</td>
      <td>$pauta->horaTermino</td>
      <td>$pauta->idLibro</td>
      <td>$capitulo</td>
      <td>$apartado</td>
      <td>$pauta->paginasTexto</td>
      <td>$pauta->paginasTextoEjercitacion</td>
      <td>$indCondicion->a</td>
      <td>$indCondicion->b</td>
      <td>$indCondicion->c</td>
      <td>$indCondicion->d</td>
      <td>$indCondicion->e</td>
      <td>$indCondicion->f</td>
      <td>$preguntaCondicion</td>
      <td>$indGestion[1]</td>
      <td>$indGestion[2]</td>
      <td>$indGestion[3]</td>
      <td>$indGestion[4]</td>
      <td>$indGestion[5]</td>
      <td>$indGestion[6]</td>
      <td>$indGestion[7]</td>
      <td>$indGestion[8]</td>
      <td>$indGestion[9]</td>
      <td>$indGestion[10]</td>
      <td>$preguntaGestion</td>
    </tr>
HTML;
  }

  $tabla .=<<<HTML
</tbody>
</table>
HTML;

  $titulos =<<<HTML
<table>
   <th colspan='13'>Informacion Observacion</th>
   <th colspan='7'>Indicadores sobre las condiciones de realizacion</th>
   <th colspan='11'>Indicadores sobre la gestion de la clase</th>
</table>
HTML;

  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=Descarga.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $titulos;
  echo $tabla;
}

function detallePauta($rut = null)
{
  $rut =  params('rut');
  $p = new PautaObservacion();
  $pautas = $p->getInforme($rut);
  return json_encode1($pautas);
}

function updateVisibilidad($args = null)
{
  $p = new PautaObservacion();
  $values = $_POST['info'];
  foreach ($values as $id => $visibility)
  {
    $p->updateVisibilidad($id, $visibility);
  }
  return true;
}

run();
