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
//echo $idUsuario;
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
      <form action="pruebas.php" method="POST">
        <div>
          <div class='cajaCentralFondo'>
            <div id="cajaCentralTop">
              <p class="titulo_jornada">Datos Generales</p>
            </div>

            <div id="textoJornada">
              <table>
                <tr>
                  <td>Establecimiento: </td>
                  <td>
                    <?php getColegiosNuevo($idUsuario); ?>
                    <select onchange="reset_docentes();" name="rbdColegio" class="campos" id="select-RBD" style="max-width:40%;">
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
                    <?php if($_SESSION["sesionPerfilUsuario"]==23 || $_SESSION["sesionPerfilUsuario"]==5 ){echo $_SESSION["sesionNombreUsuario"];} ?>
                  </td>
                </tr>
                <tr>
                  <td>Visita N�:</td>
                  <td>
                    <select id="select-cantidad-visitas">
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
                    <input style="display:none;width:56px;" type="number" id="input-cantidad-visitas" min=12></td>
                </tr>
                <tr>
                  <td>Fecha:</td>
                  <td><input type=date></td>
                </tr>
                <tr>
                  <td>Hora llegada:</td>
                  <td><input type=time></td>
                </tr>
                <tr>
                  <td>Hora salida:</td>
                  <td><input type=time></td>
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
            �Observ� docentes? 
            <select id="observo-docentes">
              <option value="si">Si</option>
              <option value="no">No</option>
            </select>
            <div id="lugar_de_carga"></div>
            <br />
            <button id="boton-agregar-docente" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
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
                <td><input type="checkbox" name="apoyo-docentes"></td><td>Apoyo a docentes en forma  colectiva</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="reunion-directivos"></td><td>Reuni�n con Directivos</td>
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
            <select><option>---</option></select>

            <h4>Temas abordados en la reuni�n</h4>
            <table class="tablesorter">
              <thead>
                <tr>
                  <th>Temas</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Preparaci�n y/o estudio de una clase a implementar</td>
                  <td><input type="checkbox" name="docentes-colectivo-1"></td>
                </tr>
                <tr>
                  <td>Retroalimentaci�n de la clase observada</td>
                  <td><input type="checkbox" name="docentes-colectivo-2"></td>
                </tr>
                <tr>
                  <td>An�lisis de resultados</td>
                  <td><input type="checkbox" name="docentes-colectivo-3"></td>
                </tr>
                <tr>
                  <td>Dificultades surgidas durante la implementaci�n y logros obtenidos</td>
                  <td><input type="checkbox" name="docentes-colectivo-4"></td>
                </tr>
                <tr>
                  <td>Otros: <input disabled name="apoyo-docentes-otro" id="apoyo-docentes-otro"></td>
                  <td><input id="check-apoyo-docentes-otro" type="checkbox" name="docentes-colectivo-5"></td>
                </tr>
              </tbody>
            </table>
            <h4>Acuerdos o compromisos</h4>
            <textarea style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br />
          </div>

          <div id="cajaCentralDown">
             &nbsp;
          </div>

        </div>

        <div id="registro-directivos" style="display:_none;" class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Reuni�n con Directivos</p>
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
                <tr>
                  <td></td>
                  <td>
                    <select style='width:98%;' name="participante-reunion-cargo-1">
                      <option>Director</option>
                      <option>Coordinador</option>
                      <option>UTP</option>
                      <option>Otro</option>
                    </select>
                  </td>
                  <td><input style='width:98%;' name="participante-reunion-nombre-1"></td>
                </tr>
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
                  <th>Factores que interfieren en la ense�anza y aprendizaje de las matem�ticas</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Factores Institucionales<br> <input id="indicar-factores-institucionales" name="indicar-factores-institucionales" placeholder="�Indicar cu�les?" style="width:98%;display:none;"></td>
                  <td><input id="check-factores-institucionales" name="check-factores-institucionales" type="checkbox"></td>
                </tr>
                <tr>
                  <td>Factores Pedag�gicos<br> <input id="indicar-factores-pedagogicos" name="indicar-factores-pedagogicos" placeholder="�Indicar cu�les?" style="width:98%;display:none;"></td>
                  <td><input id="check-factores-pedagogicos" name="check-factores-pedagogicos" type="checkbox"></td>
                </tr>
              </tbody>
            </table>
            <br/>
            <h4>Retroalimentaci�n:</h4>
            <table class="tablesorter">
              <thead>
                <tr>
                  <th>Retroalimentaci�n</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    1. Avances y logros que aprecian como consecuencia de la implementaci�n del M�todo Singapur (Estudiante/Docente).
                    <br> 
                    <input id="indicar-retroalimentacion-1" name="indicar-retroalimentacion-1" placeholder="�Indicar cu�les?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-1" name="check-retroalimentacion-1" type="checkbox"></td>
                </tr>
                <tr>
                  <td>
                    2. An�lisis de resultados de los aprendizajes de los estudiantes.
                    <br> 
                    <input id="indicar-retroalimentacion-2" name="indicar-retroalimentacion-2" placeholder="�Indicar cu�les?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-2" name="check-retroalimentacion-2" type="checkbox"></td>
                </tr>
                <tr>
                  <td>
                    3. Reporte del monitoreo realizado por el CFK
                    <br> 
                    <input id="indicar-retroalimentacion-3" name="indicar-retroalimentacion-3" placeholder="�Indicar cu�les?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-3" name="check-retroalimentacion-3" type="checkbox"></td>
                </tr>
                <tr>
                  <td>
                    4. Otro (especifique)
                    <br> 
                    <input id="indicar-retroalimentacion-4" name="indicar-retroalimentacion-4" placeholder="�Indicar cu�les?" style="width:98%;display:none;">
                  </td>
                  <td><input id="check-retroalimentacion-4" name="check-retroalimentacion-4" type="checkbox"></td>
                </tr>
              </tbody>
            </table>
            <br />
            <h4>Acuerdos o compromisos</h4>
            <textarea id="area-retroalimentacion" style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br />
          </div>

          <div id="cajaCentralDown">
             &nbsp;
          </div>

        </div>


        <div class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Monitoreo del Colegio</p>
          </div>
          <br>
          <div id="textoJornada">
            <h4>Factores que afectan la Implementaci�n</h4>
            <table id="tabla-monitoreo" class="tablesorter">
              <tr>
              <th>Indicador</th>
              <th>S�</th>
              <th>No</th>
              <th>N/O</th>
              </tr>
              <tr>
                <td>1. El establecimiento cuenta con los materiales did�cticos necesario para desarrollar las actividades.</td>
                <td><input type="radio" value="si" name="fac-1"></td>
                <td><input type="radio" value="no" name="fac-1"></td>
                <td><input type="radio" value="n/o" name="fac-1"></td>
              </tr>
              <tr>
                <td>2. En el colegio se les  facilita a los profesores el acceso a los materiales did�cticos.</td>
                <td><input type="radio" value="si" name="fac-2"></td>
                <td><input type="radio" value="no" name="fac-2"></td>
                <td><input type="radio" value="n/o" name="fac-2"></td>
              </tr>
              <tr>
                <td>3. Las horas de clases semanales son suficientes para implementar el MS.</td>
                <td><input type="radio" value="si" name="fac-3"></td>
                <td><input type="radio" value="no" name="fac-3"></td>
                <td><input type="radio" value="n/o" name="fac-3"></td>
              </tr>
              <tr>
                <td>4. Los docentes est�n implementando los cap�tulos en los tiempos programados.</td>
                <td><input type="radio" value="si" name="fac-4"></td>
                <td><input type="radio" value="no" name="fac-4"></td>
                <td><input type="radio" value="n/o" name="fac-4"></td>
              </tr>
              <tr>
                <td>5. Los docentes est�n trabajando con los textos PSL, no con otros recursos o recursos extras.</td>
                <td><input type="radio" value="si" name="fac-5"></td>
                <td><input type="radio" value="no" name="fac-5"></td>
                <td><input type="radio" value="n/o" name="fac-5"></td>
              </tr>
              <tr>
                <td>6. Los docentes de un mismo nivel se re�nen para preparar las clases, analizar los resultados en las evaluaciones y/o analizar lo ocurrido en las clases.</td>
                <td><input type="radio" value="si" name="fac-6"></td>
                <td><input type="radio" value="no" name="fac-6"></td>
                <td><input type="radio" value="n/o" name="fac-6"></td>
              </tr>
              <tr>
                <td>7. Las clases se desarrollan sin interrupciones externas (entrega de informaci�n, consultas al profesor(a), etc.) que afectan el proceso de ense�anza/ aprendizaje.</td>
                <td><input type="radio" value="si" name="fac-7"></td>
                <td><input type="radio" value="no" name="fac-7"></td>
                <td><input type="radio" value="n/o" name="fac-7"></td>
              </tr>
              <tr>
                <td>8. Las caracter�sticas de la sala son las adecuadas para un buen desarrollo de la clase (sin ruidos externos, bancos y sillas adecuadas, buena iluminaci�n, entre otras).</td>
                <td><input type="radio" value="si" name="fac-8"></td>
                <td><input type="radio" value="no" name="fac-8"></td>
                <td><input type="radio" value="n/o" name="fac-8"></td>
              </tr>
              <tr>
                <td>9. El ambiente que hay en el colegio mientras se desarrollan las clases facilita el aprendizaje.</td>
                <td><input type="radio" value="si" name="fac-9"></td>
                <td><input type="radio" value="no" name="fac-9"></td>
                <td><input type="radio" value="n/o" name="fac-9"></td>
              </tr>
              <tr>
                <td>10. Los recursos que hay en la clase facilita el proceso de ense�anza/ aprendizaje.</td>
                <td><input type="radio" value="si" name="fac-10"></td>
                <td><input type="radio" value="no" name="fac-10"></td>
                <td><input type="radio" value="n/o" name="fac-10"></td>
              </tr>
              <tr>
                <td>11. Los docentes se sienten apoyados por el equipo directivo.</td>
                <td><input type="radio" value="si" name="fac-11"></td>
                <td><input type="radio" value="no" name="fac-11"></td>
                <td><input type="radio" value="n/o" name="fac-11"></td>
              </tr>
              <tr>
                <td>12. El/los docente(s) participa(n) del curso virtual (descargando material, desarrollando las actividades virtuales, participando en foros, etc.).</td>
                <td><input type="radio" value="si" name="fac-12"></td>
                <td><input type="radio" value="no" name="fac-12"></td>
                <td><input type="radio" value="n/o" name="fac-12"></td>
              </tr>
              <tr>
                <td>13. El/los docente(s) completa(n) el instrumento de seguimiento (Bit�cora).</td>
                <td><input type="radio" value="si" name="fac-13"></td>
                <td><input type="radio" value="no" name="fac-13"></td>
                <td><input type="radio" value="n/o" name="fac-13"></td>
              </tr>
              <tr>
                <td>Otro: <input name="fac-otro" style="width:88%;" disabled></td>
                <td><input type="radio" value="si" name="fac-14"></td>
                <td><input type="radio" value="no" name="fac-14"></td>
                <td><input type="radio" value="n/o" name="fac-14"></td>
              </tr>
            </table>
            <p>Refi�rase a c�mo los indicadores  marcados con NO, est�n afectando la implementaci�n y/o c�mo obtuvo la informaci�n:</p>
            <textarea disabled id="area-observacion-monitoreo" style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br /><br />

            <h4>Los docentes cumplen los compromisos adquiridos</h4>
            <table>
              <tr>
                <td>
                  Si <input type="radio" name="cumplen-compromisos-docentes" value="si">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No <input type="radio" name="cumplen-compromisos-docentes" value="no">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No hay compromisos <input type="radio" name="cumplen-compromisos-docentes" value="n/a">
                </td>
              </tr>
            </table>
            <textarea disabled id="compromisos-docentes" placeholder="�Cu�les?" style="resize:none; width:100%;height:40px;"></textarea>
            <br><br>
            <h4>Los directivos cumplen los compromisos adquiridos</h4>
            <table>
              <tr>
                <td>
                  Si <input type="radio" name="cumplen-compromisos-directivos" value="si">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No <input type="radio" name="cumplen-compromisos-directivos" value="no">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>  
                  No hay compromisos <input type="radio" name="cumplen-compromisos-directivos" value="n/a">
                </td>
              </tr>
            </table>
            <textarea id="compromisos-directivos" disabled placeholder="�Cu�les?" style="resize:none; width:100%;height:40px;"></textarea>
            <br /><br />
          </div>

          <div id="cajaCentralDown">
             &nbsp;
          </div>
        </div>
      </div>
      <br />
      <button id="" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
          <span class="ui-button-text">Guardar</span>
      </button>
      <br />

    </form>
    <br>
  </div>

<?php require "pie.php";?>

</div>

<script language="javascript">
    
    var indice_llenado = 0;
    var participantes_reunion_directivos = 1; 


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
        $("#boton-agregar-docente").show();
        $("#lugar_de_carga").html("");
        indice_llenado=0;
      }
      if($(this).val() == "no"){
        $("#boton-agregar-docente").hide();
        $("#lugar_de_carga").html("");
        indice_llenado=0;
      }
    });

    $('#boton-agregar-participante').click(function(e){
      e.preventDefault();
      participantes_reunion_directivos++;
      var str = "<tr><td></td><td><select style='width:98%;' name='participante-reunion-cargo-"+participantes_reunion_directivos+"'><option>Director</option><option>Coordinador</option><option>UTP</option><option>Otro</option></select></td><td><input style='width:98%;' name='participante-reunion-nombre-"+participantes_reunion_directivos+"'></td></tr>";
      $("#tabla-contenedor-participante-reunion").append(str);
      

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

</script>

</body>
</html>
