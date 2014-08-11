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
echo $idUsuario;
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

      <div>
        <div class='cajaCentralFondo'>
          <div id="cajaCentralTop">
            <p class="titulo_jornada">Datos Generales</p>
          </div>

          <div id="textoJornada">
            <table>
              <tr>
                <td>RBD Establecimiento: </td>
                <td>
                  <?php getColegiosNuevo($idUsuario); ?>
                  <select name="rbdColegio" class="campos" id="select-RBD" style="max-width:40%;">
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
              </tr>
              <tr>
                <td>Asesor: </td>
                <td id="campo_asesor">?</td>
              </tr>
              <tr>
                <td>Visita Nº:</td>
                <td><input type=number min=1></td>
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
          <p class="titulo_jornada">Observacón de Clases</p>
        </div>
        <div id="textoJornada">
          ¿Cuantos docentes observó? <input id="cant-docentes" type=number min=0 onchange="get_docentes();">
          <div id="lugar_de_carga"></div>
       </div>

       <div id="cajaCentralDown">
         &nbsp;
       </div>

      </div>

      <div class='cajaCentralFondo'>
        <div id="cajaCentralTop">
          <p class="titulo_jornada">Factores que afectan la Implementación</p>
        </div>

        <div id="textoJornada">
          <table border="1">
            <tr>
            <th>Indicador</th>
            <th>Sí</th>
            <th>No</th>
            <th>N/O</th>
            </tr>
            <tr>
              <td>1. El establecimiento cuenta con los materiales didácticos necesario para desarrollar las actividades.</td>
              <td><input type="radio" name="1"></td>
              <td><input type="radio" name="1"></td>
              <td><input type="radio" name="1"></td>
            </tr>
            <tr>
              <td>2. En el colegio se les  facilita a los profesores el acceso a los materiales didácticos.</td>
              <td><input type="radio" name="2"></td>
              <td><input type="radio" name="2"></td>
              <td><input type="radio" name="2"></td>
            </tr>
            <tr>
              <td>3. Las horas de clases semanales son suficientes para implementar el MS.</td>
              <td><input type="radio" name="3"></td>
              <td><input type="radio" name="3"></td>
              <td><input type="radio" name="3"></td>
            </tr>
            <tr>
              <td>4. Los docentes están implementando los capítulos en los tiempos programados.</td>
              <td><input type="radio" name="4"></td>
              <td><input type="radio" name="4"></td>
              <td><input type="radio" name="4"></td>
            </tr>
            <tr>
              <td>5. Los docentes están trabajando con los textos PSL, no con otros recursos o recursos extras.</td>
              <td><input type="radio" name="5"></td>
              <td><input type="radio" name="5"></td>
              <td><input type="radio" name="5"></td>
            </tr>
            <tr>
              <td>6. Los docentes de un mismo nivel se reúnen para preparar las clases, analizar los resultados en las evaluaciones y/o analizar lo ocurrido en las clases.</td>
              <td><input type="radio" name="6"></td>
              <td><input type="radio" name="6"></td>
              <td><input type="radio" name="6"></td>
            </tr>
            <tr>
              <td>7. Las clases se desarrollan sin interrupciones externas (entrega de información, consultas al profesor(a), etc.) que afectan el proceso de enseñanza/ aprendizaje.</td>
              <td><input type="radio" name="7"></td>
              <td><input type="radio" name="7"></td>
              <td><input type="radio" name="7"></td>
            </tr>
            <tr>
              <td>8. Las características de la sala son las adecuadas para un buen desarrollo de la clase (sin ruidos externos, bancos y sillas adecuadas, buena iluminación, entre otras).</td>
              <td><input type="radio" name="8"></td>
              <td><input type="radio" name="8"></td>
              <td><input type="radio" name="8"></td>
            </tr>
            <tr>
              <td>9. El ambiente que hay en el colegio mientras se desarrollan las clases facilita el aprendizaje.</td>
              <td><input type="radio" name="9"></td>
              <td><input type="radio" name="9"></td>
              <td><input type="radio" name="9"></td>
            </tr>
            <tr>
              <td>10. Los recursos que hay en la clase facilita el proceso de enseñanza/ aprendizaje.</td>
              <td><input type="radio" name="10"></td>
              <td><input type="radio" name="10"></td>
              <td><input type="radio" name="10"></td>
            </tr>
            <tr>
              <td>11. Los docentes se sienten apoyados por el equipo directivo.</td>
              <td><input type="radio" name="11"></td>
              <td><input type="radio" name="11"></td>
              <td><input type="radio" name="11"></td>
            </tr>
            <tr>
              <td>12. El/los docente(s) participa(n) del curso virtual (descargando material, desarrollando las actividades virtuales, participando en foros, etc.).</td>
              <td><input type="radio" name="12"></td>
              <td><input type="radio" name="12"></td>
              <td><input type="radio" name="12"></td>
            </tr>
            <tr>
              <td>13. El/los docente(s) completa(n) el instrumento de seguimiento (Bitácora).</td>
              <td><input type="radio" name="13"></td>
              <td><input type="radio" name="13"></td>
              <td><input type="radio" name="13"></td>
            </tr>
            <tr>
              <td>Otro: <input></td>
              <td><input type="radio" name="14"></td>
              <td><input type="radio" name="14"></td>
              <td><input type="radio" name="14"></td>
            </tr>
          </table>
        </div>

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
              <td><input type="radio" name="tipo-trabajo"</td><td>En forma individual</td>
            </tr>
            <tr>
              <td><input type="radio" name="tipo-trabajo"</td><td>En forma grupal</td>
            </tr>
          </table>
          <div id="lugar_de_carga_trabajo_docentes"></div>

          <!--<div class='block-btn'>
            <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('informeEvaluacion.php','_self')" value="Ver Informes" />
          </div>-->

        </div>

        <div id="cajaCentralDown">
           &nbsp;
        </div>

      </div>

      <div class='cajaCentralFondo'>
        <div id="cajaCentralTop">
          <p class="titulo_jornada">Reunión con Directivos</p>
        </div>

        <div id="textoJornada">
          <p>
          </p>
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

<script language="javascript">
      
    $("input[name=tipo-trabajo]").on('change',function(){
      var div2 = document.getElementById("lugar_de_carga_trabajo_docentes");
      //
    });


    function get_docentes(){
      var division = document.getElementById("lugar_de_carga");
      var cantidad_docentes = $('#cant-docentes').val();
      var RBD = $('#select-RBD').val();
      a="rbd="+RBD+"&cantidad="+cantidad_docentes;
      AJAXPOST("llenarVisitaEscuela_Docente.php",a,division);
    } 
</script>

</body>
</html>
