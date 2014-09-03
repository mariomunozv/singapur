<?php
?>


<?php
ini_set("display_errors", "on");
require "inc/incluidos.php";
require "hd.php";
//require "inc/_colegio.php";



function getColegiosNuevo($idUsuario){
  $sql = "SELECT * FROM colegio a join usuariocolegio b WHERE estadoColegio = 1 AND a.rbdColegio = b.rbdColegio AND b.idUsuario = ".$idUsuario." ORDER BY nombreColegio";
  $res = mysql_query($sql);
  $i = 0;
  while ($row = mysql_fetch_array($res)){
  $colegios[$i] = array("idColegio"=> $row["rbdColegio"],"nombreColegio"=>$row["nombreColegio"] );  
  $i++;
  }
  if ($i==0){
    return(NULL);
  }
  return($colegios);
}


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
$navegacion = "Home*curso.php?idCurso=$idCurso,Informes*#,Llenar Visita Escuela*#";
require "_navegacion.php";
?>

  <div id="lateralIzq">
    <?php require "menuleft.php"; ?>
  </div> <!--lateralIzq-->

  <div id="lateralDer"> <?php require "menuright.php"; ?>
  </div><!--lateralDer-->

  <div id="columnaCentro">
  <p class="titulo_curso">Visita Escuela</p>
    <hr /><br />
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec interdum risus, ut aliquet nunc. Sed vitae ullamcorper nisi. Nulla tincidunt, libero sit amet consequat gravida, tortor quam viverra lorem, eu cursus dolor lectus vel libero. Pellentesque ac consequat enim, ac laoreet enim.
    </p>
      <form id="form-visita-escuela" action="pruebas.php" method="POST">
        <div>
          <div id="datos-generales" class='cajaCentralFondo'>
            <div id="cajaCentralTop">
              <p class="titulo_jornada">Datos Generales</p>
            </div>

            <div id="textoJornada">
              <table>
                <tr>
                  <td>Establecimiento: </td>
                  <td>
                    <?php getColegiosNuevo($idUsuario); ?>
                    <select style="width:90%;" onchange="reset_docentes();resetReunionDirectivos();resetDocentesColectivo();" name="rbdColegio" class="campos" id="select-RBD">
                      <option value="">----</option>
                      <?php 
                          $colegios = getColegiosNuevo($idUsuario);
                          if (count($colegios) > 0){
                            foreach ($colegios as $colegio){
                              echo "<option value='".$colegio['idColegio']."'>".$colegio["nombreColegio"]."</option>";
                            }
                          }
                      ?>
                    </select>
                  </td>
                  <td> RBD: </td>
                  <td id="espacio-rbd"></td>
                </tr>
                <tr>
                  <td>Asesor: </td>
                  <td id="campo_asesor">
                    <?php if($_SESSION["sesionPerfilUsuario"]==23 || $_SESSION["sesionPerfilUsuario"]==5 ){
                      echo $_SESSION["sesionNombreUsuario"];} 
                      echo "<input type='hidden' name='idAsesor' value='".$_SESSION["sesionIdUsuario"]."'>";
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Visita Nº:</td>
                  <td>
                    <select name="numeroVisita" id="select-cantidad-visitas">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="">Otro</option>
                    </select>
                    &nbsp;&nbsp;
                    <input style="display:none;width:56px;" name="numeroVisitaOtro" value="13" type="number" id="input-cantidad-visitas" min=13></td>
                </tr>
                <tr>
                  <td>Fecha:</td>
                  <td><input name="fechaVisita" type="text" id="datepicker"></td>
                </tr>
                <tr>
                  <td>Hora llegada:</td>
                  <td><input type="time" name="horaLlegada"></td>
                </tr>
                <tr>
                  <td>Hora salida:</td>
                  <td><input type="time" name="horaSalida"></td>
                </tr>
              </table>
           </div>
           <div id="cajaCentralDown">
             &nbsp;
          </div>
         </div>

         <div class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Acciones Realizadas</p>
          </div>
          <div id="textoJornada">
            <h4>Apoyo a docentes en forma individual</h4>
            ¿Observó docentes? 
            <select id="observo-docentes" name="select-observo-docentes">
              <option value="si">Si</option>
              <option value="no">No</option>
            </select>
            <div id="lugar_de_carga"></div>
            <br />
            <button style="display:none;" id="boton-agregar-docente" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                <span class="ui-button-text">Agregar docente observado</span>
            </button>
         </div>
         <br />
         <div id="cajaCentralDown">
           &nbsp;
         </div>

        </div>

        <div class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Trabajo realizado con Docentes</p>
          </div>

          <div id="textoJornada">
            <h4>
             Tipo de trabajo realizado:
            </h4>
            <table>
              <tr>
                <td><input onchange="resetDocentesColectivo();" type="checkbox" name="apoyo-docentes"></td><td>Apoyo a docentes en forma  colectiva</td>
              </tr>
              <tr>
                <td><input onchange="resetReunionDirectivos();" type="checkbox" name="reunion-directivos"></td><td>Reunión con Directivos</td>
              </tr>
            </table>
            <div id="lugar_de_carga_trabajo_docentes"></div>
          </div>

          <div id="cajaCentralDown">
             &nbsp;
          </div>

        </div>
        
        <div id="registro-docentes" style="display:none;" class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Apoyo a docentes en forma  colectiva</p>
          </div>

          <div id="textoJornada">
            <h4>Docentes participantes</h4>
            <table class="tablesorter" id="carga-participantes-docentes-colectivo">
              <!--lugar de carga -->
            </table>
            <br />
            <button id="agregar-docente-colectivo" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                <span class="ui-button-text">Agregar docente</span>
            </button>
            <br /><br />
            </div>

            <h4>Temas abordados en la reunión</h4>
            <table class="tablesorter">
              <thead>
                <tr>
                  <th>Temas</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Preparación y/o estudio de una clase a implementar</td>
                  <td><input type="checkbox" name="docentes-colectivo-1"></td>
                </tr>
                <tr>
                  <td>Retroalimentación de la clase observada</td>
                  <td><input type="checkbox" name="docentes-colectivo-2"></td>
                </tr>
                <tr>
                  <td>Análisis de resultados</td>
                  <td><input type="checkbox" name="docentes-colectivo-3"></td>
                </tr>
                <tr>
                  <td>Dificultades surgidas durante la implementación y logros obtenidos</td>
                  <td><input type="checkbox" name="docentes-colectivo-4"></td>
                </tr>
                <tr>
                  <td>Otros: <input class="validar-disabled" style="width:98%;" disabled name="apoyo-docentes-otro" id="apoyo-docentes-otro"></td>
                  <td><input id="check-apoyo-docentes-otro" type="checkbox" name="docentes-colectivo-5"></td>
                </tr>
              </tbody>
            </table>
            <h4>Acuerdos o compromisos</h4>
            <textarea name="acuerdos-docentes-colectivo" style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br />
            <div id="cajaCentralDown">
             &nbsp;
          </div>
          </div>
        </div>

        <div id="registro-directivos" style="display:none;" class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Reunión con Directivos</p>
          </div>

          <div id="textoJornada">
            <h4>Participantes</h4>
            <table class="tablesorter">
              <thead>
                <tr>
                  <th></th>
                  <th>Cargo</th>
                  <th>Nombre</th>
                </tr>
              </thead>
              <tbody id="tabla-contenedor-participante-reunion">
                
              </tbody>
            </table>
            <button style="float:right;" id="boton-agregar-participante" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                <span class="ui-button-text">Agregar participante</span>
            </button>
            <br /><br />
            <h4>Temas abordados:</h4>
            <table class="tablesorter">
              <thead>
                <tr>
                  <th>Factores que interfieren en la enseñanza y aprendizaje de las matemáticas</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Factores Institucionales<br> <input class="validar-display" id="indicar-factores-institucionales" name="indicar-factores-institucionales" placeholder="¿Indicar cuáles?" style="width:98%;display:none;"></td>
                  <td><input id="check-factores-institucionales" name="check-factores-institucionales" type="checkbox"></td>
                </tr>
                <tr>
                  <td>Factores Pedagógicos<br> <input class="validar-display" id="indicar-factores-pedagogicos" name="indicar-factores-pedagogicos" placeholder="¿Indicar cuáles?" style="width:98%;display:none;"></td>
                  <td><input id="check-factores-pedagogicos" name="check-factores-pedagogicos" type="checkbox"></td>
                </tr>
              </tbody>
            </table>
            <br/>
            <h4>Retroalimentación:</h4>
            <table class="tablesorter">
              <thead>
                <tr>
                  <th>Retroalimentación</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    1. Avances y logros que aprecian como consecuencia de la implementación del Método Singapur (Estudiante/Docente).
                    <br> 
                    <input class="validar-display" id="indicar-retroalimentacion-1" name="indicar-retroalimentacion-1" placeholder="¿Indicar cuáles?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-1" name="check-retroalimentacion-1" type="checkbox"></td>
                </tr>
                <tr>
                  <td>
                    2. Análisis de resultados de los aprendizajes de los estudiantes.
                    <br> 
                    <input class="validar-display" id="indicar-retroalimentacion-2" name="indicar-retroalimentacion-2" placeholder="¿Indicar cuáles?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-2" name="check-retroalimentacion-2" type="checkbox"></td>
                </tr>
                <tr>
                  <td>
                    3. Reporte del monitoreo realizado por el CFK
                    <br> 
                    <input class="validar-display" id="indicar-retroalimentacion-3" name="indicar-retroalimentacion-3" placeholder="¿Indicar cuáles?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-3" name="check-retroalimentacion-3" type="checkbox"></td>
                </tr>
                <tr>
                  <td>
                    4. Otro (especifique)
                    <br> 
                    <input class="validar-display" id="indicar-retroalimentacion-4" name="indicar-retroalimentacion-4" placeholder="¿Indicar cuáles?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-4" name="check-retroalimentacion-4" type="checkbox"></td>
                </tr>
              </tbody>
            </table>
            <br />
            <h4>Acuerdos o compromisos</h4>
            <textarea id="area-retroalimentacion" name="acuerdos-directivo-visita" style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br />
          </div>

          <div id="cajaCentralDown">
             &nbsp;
          </div>

        </div>


        <div class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p id="monitoreo-del-colegio" class="titulo_jornada">Monitoreo del Colegio</p>
          </div>
          <br>
          <div id="textoJornada">
            <h4>Factores que afectan la Implementación</h4>
            <table id="tabla-monitoreo" class="tablesorter">
              <tr>
              <th>Indicador</th>
              <th>Sí</th>
              <th>No</th>
              <th>N/O</th>
              </tr>
              <tr>
                <td>1. El establecimiento cuenta con los materiales didácticos necesario para desarrollar las actividades.</td>
                <td><input class="factor" type="radio" value="si" name="fac-1"></td>
                <td><input class="factor" type="radio" value="no" name="fac-1"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-1"></td>
              </tr>
              <tr>
                <td>2. En el colegio se les  facilita a los profesores el acceso a los materiales didácticos.</td>
                <td><input class="factor" type="radio" value="si" name="fac-2"></td>
                <td><input class="factor" type="radio" value="no" name="fac-2"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-2"></td>
              </tr>
              <tr>
                <td>3. Las horas de clases semanales son suficientes para implementar el MS.</td>
                <td><input class="factor" type="radio" value="si" name="fac-3"></td>
                <td><input class="factor" type="radio" value="no" name="fac-3"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-3"></td>
              </tr>
              <tr>
                <td>4. Los docentes están implementando los capítulos en los tiempos programados.</td>
                <td><input class="factor" type="radio" value="si" name="fac-4"></td>
                <td><input class="factor" type="radio" value="no" name="fac-4"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-4"></td>
              </tr>
              <tr>
                <td>5. Los docentes están trabajando con los textos PSL, no con otros recursos o recursos extras.</td>
                <td><input class="factor" type="radio" value="si" name="fac-5"></td>
                <td><input class="factor" type="radio" value="no" name="fac-5"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-5"></td>
              </tr>
              <tr>
                <td>6. Los docentes de un mismo nivel se reúnen para preparar las clases, analizar los resultados en las evaluaciones y/o analizar lo ocurrido en las clases.</td>
                <td><input class="factor" type="radio" value="si" name="fac-6"></td>
                <td><input class="factor" type="radio" value="no" name="fac-6"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-6"></td>
              </tr>
              <tr>
                <td>7. Las clases se desarrollan sin interrupciones externas (entrega de información, consultas al profesor(a), etc.) que afectan el proceso de enseñanza/ aprendizaje.</td>
                <td><input class="factor" type="radio" value="si" name="fac-7"></td>
                <td><input class="factor" type="radio" value="no" name="fac-7"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-7"></td>
              </tr>
              <tr>
                <td>8. Las características de la sala son las adecuadas para un buen desarrollo de la clase (sin ruidos externos, bancos y sillas adecuadas, buena iluminación, entre otras).</td>
                <td><input class="factor" type="radio" value="si" name="fac-8"></td>
                <td><input class="factor" type="radio" value="no" name="fac-8"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-8"></td>
              </tr>
              <tr>
                <td>9. El ambiente que hay en el colegio mientras se desarrollan las clases facilita el aprendizaje.</td>
                <td><input class="factor" type="radio" value="si" name="fac-9"></td>
                <td><input class="factor" type="radio" value="no" name="fac-9"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-9"></td>
              </tr>
              <tr>
                <td>10. Los recursos que hay en la clase facilita el proceso de enseñanza/ aprendizaje.</td>
                <td><input class="factor" type="radio" value="si" name="fac-10"></td>
                <td><input class="factor" type="radio" value="no" name="fac-10"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-10"></td>
              </tr>
              <tr>
                <td>11. Los docentes se sienten apoyados por el equipo directivo.</td>
                <td><input class="factor" type="radio" value="si" name="fac-11"></td>
                <td><input class="factor" type="radio" value="no" name="fac-11"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-11"></td>
              </tr>
              <tr>
                <td>12. El/los docente(s) participa(n) del curso virtual (descargando material, desarrollando las actividades virtuales, participando en foros, etc.).</td>
                <td><input class="factor" type="radio" value="si" name="fac-12"></td>
                <td><input class="factor" type="radio" value="no" name="fac-12"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-12"></td>
              </tr>
              <tr>
                <td>13. El/los docente(s) completa(n) el instrumento de seguimiento (Bitácora).</td>
                <td><input class="factor" type="radio" value="si" name="fac-13"></td>
                <td><input class="factor" type="radio" value="no" name="fac-13"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-13"></td>
              </tr>
              <tr>
                <td>Otro: <input class="validar-disabled" name="fac-otro" style="width:88%;" disabled></td>
                <td><input class="factor" type="radio" value="si" name="fac-14"></td>
                <td><input class="factor" type="radio" value="no" name="fac-14"></td>
                <td><input class="factor" type="radio" value="n/o" name="fac-14"></td>
              </tr>
            </table>
            <p>Refiérase a cómo los indicadores  marcados con NO, están afectando la implementación y/o cómo obtuvo la información:</p>
            <textarea class="validar-disabled" name="refieraseMarcadosNo" disabled id="area-observacion-monitoreo" style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br /><br />
            <span id="comp-span"></span>
            <h4>Los docentes cumplen los compromisos adquiridos</h4>
            <table>
              <tr>
                <td>
                  Si <input class="radio-compromisos" type="radio" name="cumplen-compromisos-docentes" value="si">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No <input class="radio-compromisos" type="radio" name="cumplen-compromisos-docentes" value="no">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No hay compromisos <input class="radio-compromisos" type="radio" name="cumplen-compromisos-docentes" value="n/a">
                </td>
              </tr>
            </table>
            <textarea class="validar-disabled" name="detalle-cumplen-docentes" disabled id="compromisos-docentes" placeholder="¿Cuáles?" style="resize:none; width:100%;height:40px;"></textarea>
            <br><br>
            <h4>Los directivos cumplen los compromisos adquiridos</h4>
            <table>
              <tr>
                <td>
                  Si <input class="radio-compromisos" type="radio" name="cumplen-compromisos-directivos" value="si">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No <input class="radio-compromisos" type="radio" name="cumplen-compromisos-directivos" value="no">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No hay compromisos <input class="radio-compromisos" type="radio" name="cumplen-compromisos-directivos" value="n/a">
                </td>
              </tr>
            </table>
            <textarea name="detalle-cumplen-directivos" class="validar-disabled" id="compromisos-directivos" disabled placeholder="¿Cuáles?" style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br />
          </div>

          <div id="cajaCentralDown">
             &nbsp;
          </div>
        </div>
        <br />
        <button id="boton-submit" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
            <span class="ui-button-text">Guardar</span>
        </button>
        <br />
      </div>
    </form>
    <br>
  </div>

<?php require "pie.php";?>

</div>


<script>
$(function() {
    $( "#datepicker" ).datepicker();
});
</script>

<script language="javascript">
    
    var indice_llenado = 0;
    var participantes_reunion_directivos = 0;
    var docentes_colectivo = 0;

    $('#agregar-docente-colectivo').click(function(e){
      e.preventDefault();

      if($("#select-RBD").val()!=""){      
        a = "pide=docentes&rbd="+$("#select-RBD").val()+"&tag=colectivo-"+docentes_colectivo+"&prefix=colectivo";
        $("#carga-participantes-docentes-colectivo").append("<tr><td id='td-colectivo-"+docentes_colectivo+"'></td><td></td></tr>")
        var sel = document.getElementById("td-colectivo-"+docentes_colectivo);
        docentes_colectivo++;
        if(docentes_colectivo==5){
          $("#agregar-docente-colectivo").hide();
        }
        AJAXPOST("llenarVisitaEscuela_cursos.php",a,sel);
      }else{
        alert("Seleccione un Establecimiento");
      }
    });
    $("#select-RBD").change(function(){
      if($(this).val()!=""){
        $(".select-participante-reunion-cargo").prop("disabled","");
      }else{
        $(".select-participante-reunion-cargo").prop("disabled","disabled");
      }
    });
    $("#check-retroalimentacion-1").change(function(){
      if($("#check-retroalimentacion-1").prop("checked")){
        $("#indicar-retroalimentacion-1").show();
      }else{
        $("#indicar-retroalimentacion-1").val("").hide();
      }
    });
    $("#check-retroalimentacion-2").change(function(){
      if($("#check-retroalimentacion-2").prop("checked")){
        $("#indicar-retroalimentacion-2").show();
      }else{
        $("#indicar-retroalimentacion-2").val("").hide();
      }
    });
    $("#check-retroalimentacion-3").change(function(){
      if($("#check-retroalimentacion-3").prop("checked")){
        $("#indicar-retroalimentacion-3").show();
      }else{
        $("#indicar-retroalimentacion-3").val("").hide();
      }
    });
    $("#check-retroalimentacion-4").change(function(){
      if($("#check-retroalimentacion-4").prop("checked")){
        $("#indicar-retroalimentacion-4").show();
      }else{
        $("#indicar-retroalimentacion-4").val("").hide();
      }
    });


    $("#check-factores-institucionales").change(function(){
      if($("#check-factores-institucionales").prop("checked")){
        $("#indicar-factores-institucionales").show();
      }else{
        $("#indicar-factores-institucionales").val("").hide();
      }
    });

    $("#check-factores-pedagogicos").change(function(){
      if($("#check-factores-pedagogicos").prop("checked")){
        $("#indicar-factores-pedagogicos").show();
      }else{
        $("#indicar-factores-pedagogicos").val("").hide();
      }
    });

    $("#tabla-monitoreo input[type=radio]").change(function(){
      if( $("#tabla-monitoreo input[value=no]:checked").size()>0 ){
        $("#area-observacion-monitoreo").prop("disabled", false);
      }else{
        $("#area-observacion-monitoreo").val("").prop("disabled", true);
      }
    });

    $("input[name=cumplen-compromisos-docentes]").change(function(){
      if( $("input[name=cumplen-compromisos-docentes]:checked").val()== "n/a" ){
        $("#compromisos-docentes").val("").prop("disabled",true);
      }else{
        $("#compromisos-docentes").prop("disabled",false);
      }
    });
    $("input[name=cumplen-compromisos-directivos]").change(function(){
      if( $("input[name=cumplen-compromisos-directivos]:checked").val()== "n/a" ){
        $("#compromisos-directivos").val("").prop("disabled",true);
      }else{
        $("#compromisos-directivos").prop("disabled",false);
      }
    });

    $("input[name=fac-14]").change(function(){
      if($("input[name=fac-14]:checked").val()!="n/o" ){
        $("input[name=fac-otro]").prop("disabled", false);
      }else{
        $("input[name=fac-otro]").val("").prop("disabled", true);
      }
    });

    $("#select-cantidad-visitas").change(function(){
      if($(this).val()==""){
        $("#input-cantidad-visitas").show();
      }else{
        $("#input-cantidad-visitas").hide();
      }
    });

    $("input[name=tipo-trabajo]").on('change',function(){
      var div2 = document.getElementById("lugar_de_carga_trabajo_docentes");
      //
    });
    $("#select-RBD").change(function(){
      $("#espacio-rbd").html($(this).val());
    });

    function reset_docentes(){
      $("#lugar_de_carga").html("");
      indice_llenado=0;
      if($("#select-RBD").val()!="" && $("#observo-docentes").val()=="si" ){
        $("#boton-agregar-docente").show();
      }else{
        $("#boton-agregar-docente").hide();
      }

      $("#carga-participantes-docentes-colectivo").html("");
      docentes_colectivo = 0;
      $("#agregar-docente-colectivo").show();
    }
    
    $("input[name=apoyo-docentes]").change(function(){
      if( $(this).is(":checked")){
        $("#registro-docentes").show();
      }else{
        $("#registro-docentes").hide();
      }
    });
    $("input[name=reunion-directivos]").change(function(){
      if( $(this).is(":checked")){
        $("#registro-directivos").show();
      }else{
        $("#registro-directivos").hide();
      }
    });

    $("#observo-docentes").change(function(){
      if($(this).val() == "si"){
        if($("#select-RBD").val()!=""){
          $("#boton-agregar-docente").show();
        }
        $("#lugar_de_carga").html("");
        indice_llenado=0;
        $("#boton-agregar-docente").css("display","display");
      }
      if($(this).val() == "no"){
        $("#boton-agregar-docente").hide();
        $("#lugar_de_carga").html("");
        indice_llenado=0;
      }
    });

    $('#boton-agregar-participante').click(function(e){
      e.preventDefault();
      if(participantes_reunion_directivos<5){
        participantes_reunion_directivos++;
        var str = "<tr><td></td><td><select disabled class='select-participante-reunion-cargo' style='width:98%;' name='participante-reunion-cargo-"+participantes_reunion_directivos+"'><option value=''>---</option><option value='Director'>Director</option><option value='Coordinador'>Coordinador</option><option value='UTP'>UTP</option><option value='Otro'>Otro</option></select><br><input class='otro-participante-reunion-cargo' style='width:95%;margin-top:5px;display:none;' placeholder='¿cual?' name='otro-participante-reunion-cargo-"+participantes_reunion_directivos+"'></td><td id='td-directivos-"+participantes_reunion_directivos+"'></td></tr>";
        $("#tabla-contenedor-participante-reunion").append(str);
        if(participantes_reunion_directivos == 5){
          $("#boton-agregar-participante").hide();
        }
        if($("#select-RBD").val()!=""){
          $(".select-participante-reunion-cargo[name=participante-reunion-cargo-"+participantes_reunion_directivos+"]").prop("disabled","");
        }

        $(".select-participante-reunion-cargo[name=participante-reunion-cargo-"+participantes_reunion_directivos+"]").change(function(){
          if($(this).val()!=""){
            var indice = $(this).prop("name").substr(27);
            var display="&display1=none&display2=";
            if($(this).val()=="Otro"){
              $("[name=otro-participante-reunion-cargo-"+indice+"]").show();
              display="&display2=none&display1=";
            }else{
              $("[name=otro-participante-reunion-cargo-"+indice+"]").hide();
            }
            a = "pide=docentes&rbd="+$("#select-RBD").val()+"&tag=directivos-"+indice+"&prefix=directivos"+display;
            var sel = document.getElementById("td-directivos-"+indice);
            AJAXPOST("llenarVisitaEscuela_cursos.php",a,sel);
          }else{
            var indice = $(this).prop("name").substr(27);
            $("#td-directivos-"+indice).html("");
          }
        });

      }else{
        alert("El maximo de directivos registrados es de 5.");
      }

    });
    $('#boton-agregar-docente').click(function(e){
      e.preventDefault();
      var RBD = $('#select-RBD').val();
      if (RBD =="") {
        alert("Seleccione un Establecimiento");
      }else{
        var parametros = {
                "rbd" : RBD,
                "index": indice_llenado
        };
        $.ajax({
          data:  parametros,
          url:   'llenarVisitaEscuela_Docente.php',
          type:  'POST',
          success:  function (response) {
            indice_llenado++;
            if(indice_llenado==5){
              $("#boton-agregar-docente").css("display","none");
            }
            $("#lugar_de_carga").append(response);
          }
        });
      }
    });

    $("#check-apoyo-docentes-otro").change(function(){
      if($("#check-apoyo-docentes-otro").prop("checked")){
        $("#apoyo-docentes-otro").prop("disabled",false);
      }else{
        $("#apoyo-docentes-otro").val("").prop("disabled",true);

      }
    });
    $(".select-participante-reunion-cargo").change(function(){
      if($(this).val()!=""){
        var indice = "1";
        var display="&display1=none&display2=";
        if($(this).val()=="Otro"){
          $("[name=otro-participante-reunion-cargo-"+indice+"]").show();
          display="&display2=none&display1=";
        }else{
          $("[name=otro-participante-reunion-cargo-"+indice+"]").hide();
        }
        a = "pide=docentes&rbd="+$("#select-RBD").val()+"&tag=directivos-"+indice+"&prefix=directivos"+display;
        var sel = document.getElementById("td-directivos-"+indice);
        AJAXPOST("llenarVisitaEscuela_cursos.php",a,sel);
      }
    });
    function resetReunionDirectivos(){
      if($('#select-RBD').val()!="" && $("input[name=reunion-directivos]").prop("checked")){
        $("#boton-agregar-participante").show();
        $("#tabla-contenedor-participante-reunion").html("");
      }else{
        $("#tabla-contenedor-participante-reunion").html("<p>Para agregar participantes seleccione un establecimiento</p>");
        $("#boton-agregar-participante").hide();
        participantes_reunion_directivos=0;
      }
    }
    function resetDocentesColectivo(){
      docentes_colectivo=0;
      $("#carga-participantes-docentes-colectivo").html("");
      $("#agregar-docente-colectivo").show();
    }

    $("#boton-submit").click(function(e){
      e.preventDefault();
      seguir=true;
      $(".validar-display").each(function(){
        if(seguir){
          if($(this).css("display")!="none" && $(this).val()==""){
            seguir = false;
            $(this).focus();
            error="Este campo es obligatorio";
          }
        }
      });
      $(".validar-disabled").each(function(){
        if(seguir){
          if($(this).prop("disabled")==false && $(this).val()==""){
            seguir = false;
            $(this).focus();
            error="Este campo es obligatorio";
          }
        }
      });
      if(seguir){
        if( $(".factor:checked").length <14  ){
          seguir = false;
          $('html,body').animate({
              scrollTop: $("#monitoreo-del-colegio").offset().top
          }, 500);
          error="Todos los indicadores deben ser contestados.";
        }
      }
      if(seguir){
        if( $(".radio-compromisos:checked").length < 2 ){
          seguir = false;
          $('html,body').animate({
              scrollTop: $("#comp-span").offset().top
          }, 500);
          error="Conteste acerca de los compromisos anteriores para cada reunión.";
        }
      }
      if(seguir){
        $.ajax({
          data:  $("#form-visita-escuela").serialize(),
          url:   'guardarVisitaEscuela.php',
          type:  'POST',
          success:  function (resp) {
            switch (parseInt(resp)){
              case 1:
                alert("Debe ser asesor.");
                break;
              case 2:
                alert("Debe escoger un establecimiento.");
                $('html,body').animate({ scrollTop: $("#datos-generales").offset().top }, 500);
                break;
              case 3:
                alert("Debe seleccionar una fecha.");
                $('html,body').animate({ scrollTop: $("#datos-generales").offset().top }, 500);
                break;
              case 4:
                alert("Debe seleccionar el numero de visita."); 
                $('html,body').animate({ scrollTop: $("#datos-generales").offset().top }, 500);
                break;
              case 5:
                alert("Las horas de llegada y salida son obligatorias.");
                $('html,body').animate({ scrollTop: $("#datos-generales").offset().top }, 500);
                break;
              case 6:
                alert("Ya se registró ese numero de visita para este establecimiento.");
                $('html,body').animate({ scrollTop: $("#datos-generales").offset().top }, 500);
                $("#select-cantidad-visitas").focus();
                break;
              case 7:
                alert("Ocurrió un error inesperado al guardar su información.");
                break;
              case 8:
                alert("Registro de vidita a escuela registrado correctamente.");
                break;
              case 9:
                alert("Se registro la vidita pero ocurrió un error al registrar la observación a docentes.");
                break;
              //default:
              //  $("body").append(resp);
              //  break;
            }
          },
          error: function(resp){
            alert("Error: "+resp);
          }
        });
      }else{ 
        alert(error) 
      }
    });

</script>

</body>
</html>
