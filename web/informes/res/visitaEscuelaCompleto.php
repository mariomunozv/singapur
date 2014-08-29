<?php
require("../admin/inc/config.php");
require("../inc/_visitaEscuela.php");
if ($_SESSION["sesionTipoUsuario"]=="Asesor"||$_SESSION["sesionTipoUsuario"]=="Relator/Tutor"||$_SESSION["sesionTipoUsuario"]=="Coordinador General"||$_SESSION["sesionTipoUsuario"]=="Empleado Klein"){ ?>


<style type="text/Css">


table, th, td {
    border: 1px solid #333;
    border-spacing: 0px;
    border-collapse: collapse;
}
td,th{
    padding: 4px;
}


</style>
<page style="font-size: 12px"><!--Pagina 1-->
    <page_footer>
        <!--<hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">-->
        <p style="text-align:right;margin-right:20px;">[[page_cu]]</p>
    </page_footer>
    <page_header>
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación y Experimentación en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Facultad de Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Universidad de Santiago de Chile</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>
    <br><br><br><br><br><br><br><br>
    <h3 style="text-align:center;">Registro de Visita a Escuela</h3>
    <h4>Datos Generales</h4>
    <?php
        $datos = getInfoVisita($_GET["idVisita"]);
        $docentes = getDocentesVisita($_GET["idVisita"]);
    ?>
        
        <table cellspacing="0" style="width:100%;" id="datos-generales" class="table">
            <tr>
                <td style="width: 33%">RBD Establecimiento: <?php echo $datos["rbdColegio"]; ?></td>
                <td style="width: 33%">Asesor:<?php echo $datos["nombreAsesorVisitaEscuela"]; ?></td>
                <td style="width: 33%">Nº Visita:<?php echo $datos["numeroVisitaEscuela"]; ?></td>
            </tr>
            <tr>
                <td>Fecha: <?php echo $datos["fechaVisitaEscuela"]; ?></td>
                <td>Hora de llegada: <?php echo substr($datos["horaLlegadaVisitaEscuela"],0,5); ?></td>
                <td>Hora de salida: <?php echo substr($datos["horaSalidaVisitaEscuela"],0,5); ?></td>
            </tr>

        </table>
    <br />
    <h4>Observación de Clases</h4>
    <table style="width:100%;">
        <thead>
            <tr>
                <th style="width: 65%">Profesor</th>
                <th style="width: 35%">Curso</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($docentes as $val) { ?>
            <tr>
                <td><?php echo $val["nombreDocenteObservacion"]; ?></td>
                <td><?php echo $val["cursoDocenteObservacion"]; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br />

    <h4>Factores que afectan la implementación</h4>
    <table id="tabla-monitoreo">
      <tr>
          <th style="width:88%;">Indicador</th>
          <th style="width:4%;">Sí</th>
          <th style="width:4%;">No</th>
          <th style="width:4%;">N/O</th>
      </tr>
      <tr>
        <td style="width:88%;">1. El establecimiento cuenta con los materiales didácticos necesario para desarrollar las actividades.</td>
        <td style="text-align:center;"><?php if($datos["indicador1VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador1VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador1VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:88%;">2. En el colegio se les  facilita a los profesores el acceso a los materiales didácticos.</td>
        <td style="text-align:center;"><?php if($datos["indicador2VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador2VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador2VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">3. Las horas de clases semanales son suficientes para implementar el MS.</td>
        <td style="text-align:center;"><?php if($datos["indicador3VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador3VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador3VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">4. Los docentes están implementando los capítulos en los tiempos programados.</td>
        <td style="text-align:center;"><?php if($datos["indicador4VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador4VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador4VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">5. Los docentes están trabajando con los textos PSL, no con otros recursos o recursos extras.</td>
        <td style="text-align:center;"><?php if($datos["indicador5VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador5VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador5VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">6. Los docentes de un mismo nivel se reúnen para preparar las clases, analizar los resultados en las evaluaciones y/o analizar lo ocurrido en las clases.</td>
        <td style="text-align:center;"><?php if($datos["indicador6VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador6VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador6VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">7. Las clases se desarrollan sin interrupciones externas (entrega de información, consultas al profesor(a), etc.) que afectan el proceso de enseñanza/ aprendizaje.</td>
        <td style="text-align:center;"><?php if($datos["indicador7VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador7VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador7VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">8. Las características de la sala son las adecuadas para un buen desarrollo de la clase (sin ruidos externos, bancos y sillas adecuadas, buena iluminación, entre otras).</td>
        <td style="text-align:center;"><?php if($datos["indicador8VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador8VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador8VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">9. El ambiente que hay en el colegio mientras se desarrollan las clases facilita el aprendizaje.</td>
        <td style="text-align:center;"><?php if($datos["indicador9VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador9VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador9VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">10. Los recursos que hay en la clase facilita el proceso de enseñanza/ aprendizaje.</td>
        <td style="text-align:center;"><?php if($datos["indicador10VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador10VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador10VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">11. Los docentes se sienten apoyados por el equipo directivo.</td>
        <td style="text-align:center;"><?php if($datos["indicador11VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador11VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador11VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">12. El/los docente(s) participa(n) del curso virtual (descargando material, desarrollando las actividades virtuales, participando en foros, etc.).</td>
        <td style="text-align:center;"><?php if($datos["indicador12VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador12VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador12VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">13. El/los docente(s) completa(n) el instrumento de seguimiento (Bitácora).</td>
        <td style="text-align:center;"><?php if($datos["indicador13VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador13VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador13VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
      <tr>
        <td style="width:85%;">Otro: <?php echo $datos["DetalleIndicador14VisitaEscuela"]; ?></td>
        <td style="text-align:center;"><?php if($datos["indicador14VisitaEscuela"]=="si"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador14VisitaEscuela"]=="no"){echo "X";} ?></td>
        <td style="text-align:center;"><?php if($datos["indicador14VisitaEscuela"]=="n/o"){echo "X";} ?></td>
      </tr>
    </table>
    <br>
    <table style="width:100%;">
        <tr>
            <th style="width:100%;">Refiérase a cómo los indicadores marcados con NO, están afectando la implementación y/o cómo obtuvo la información:</th>
        </tr>
        <tr>
            <td><?php echo $datos["refieraseAIndicadoresVisitaEscuela"]; ?></td>
        </tr>
    </table>
</page>
<page style="font-size: 12px"><!--pagina 2-->
    <page_footer>
        <!--<hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">-->
        <p style="text-align:right;margin-right:20px;">[[page_cu]]</p>
    </page_footer>
    <page_header style="margin-top:-20px;">
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación y Experimentación en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Facultad de Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Universidad de Santiago de Chile</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>
    <h4 style="margin-top:80px;margin-bottom:-10;">Trabajo con docentes</h4>
    <?php foreach ($docentes as $key => $doc) { ?>
    <?php if($key == 4){  ?>
        <br><br><br><br><br><br><br><br>
    <?php } ?>
    <table style="margin-top:10px;">
        <!--<tr><td ></td><td style="width:25%;"></td><td style=""></td></tr>-->
        <tr>
            <td style="width:70%"><b>Nombre Profesor:</b> <?php echo $doc["nombreDocenteObservacion"]; ?></td>
            <td style="width:30%;"><b>Curso:</b> <?php echo $doc["cursoDocenteObservacion"]; ?></td>
        </tr>
        <tr><th colspan=2>Tipo de trabajo realizado</th></tr>
    </table>
    <table style="margin-top:-1px;">
        <tr>
            <td style="width:95%">1. Observación de clases</td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion1Observacion"]){echo "X";} ?></td>
        </tr>
    
        <tr>
            <td style="width:95%">2. Observacion de clases con apoyo</td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion2Observacion"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%">3. Modelación de clase</td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion3Observacion"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%">4. Preparacion y/o estudio de una clase a implementar</td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion4Observacion"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%">5. Retroalimentación de clase observada</td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion5Observacion"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%">6. Análisis de resultados de los aprendizajes de los estudiantes</td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion6Observacion"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%">7. Dificultades surgidas durante la implementación y logros</td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion7Observacion"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%">8. Otro: <?php echo $doc["detalleOpcion8Observacion"]; ?></td>
            <td style="width:5%;text-align:center"><?php if($doc["opcion8Observacion"]){echo "X";} ?></td>
        </tr>
    </table>
    <?php } ?>
</page><!--pagina 2-->

<page style="font-size: 12px"><!--Pagina 3-->
    <page_footer>
        <!--<hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">-->
        <p style="text-align:right;margin-right:20px;">[[page_cu]]</p>
    </page_footer>
    <page_header>
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación y Experimentación en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Facultad de Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Universidad de Santiago de Chile</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>

    <br /><br /><br /><br /><br /><br /><br />

    <h4>Reunión con Profesores (colectivo)</h4>
    <table style="margin-top:5px;">
        <tr><th style="width: 100%">Profesores:</th></tr>
        <?php if($datos["nombreDocenteColectivo1"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo1"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo2"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo2"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo3"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo3"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo4"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo4"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo5"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo5"]."</td></tr>";}?>
    </table>
    <br />
    <table>
        <tr>
            <th style="width:100%;">¿Se cumplieron los compromisos y acuerdos tomados en la visita anterior?</th>
        </tr>
        <tr>
            <td><?php echo $datos["cumplenDocentesVisitaEscuela"]; ?></td>
        </tr>
        <?php if ($datos["cumplenDocentesVisitaEscuela"]!="n/a"){ ?>
        <tr><th>¿Cuáles?</th></tr>
        <tr><td style="width:100%;"><?php echo $datos["detalleCumpleDocenteVisitaEscuela"]; ?></td></tr>
        <?php } ?>
    </table>
    <br />
    <table>
        <tr>
            <th colspan=2 style="width:100%;">Seleccione los temas que abordó en la reunión</th>
        </tr>
        <tr>
            <td style="width:95%;">1. Preparación y/o estudio de una clase a implementar</td>
            <td style="width:5%;text-align:center;"><?php if($datos["tema1VisitaEscuela"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%;">2. Retroalimentación de clase observada</td>
            <td style="width:5%;text-align:center;"><?php if($datos["tema2VisitaEscuela"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%;">3. Análisis de resultados de los aprendizajes de los estudiantes</td>
            <td style="width:5%;text-align:center;"><?php if($datos["tema3VisitaEscuela"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%;">4. Dificultades surgidas durante la implementación y logros</td>
            <td style="width:5%;text-align:center;"><?php if($datos["tema4VisitaEscuela"]){echo "X";} ?></td>
        </tr>
        <tr>
            <td style="width:95%;">5. Otro: <?php echo $datos["detalleTema5VisitaEscuela"]; ?></td>
            <td style="width:5%;text-align:center;"><?php if($datos["tema5VisitaEscuela"]){echo "X";} ?></td>
        </tr>
    </table>
    <br />
    <table>
        <tr><th style="width: 100%">Registre los acuerdos o compromisos que se efectuaron con los docentes</th></tr>
        <tr><td><?php echo $datos["acuerdosDocentesVisitaEscuela"] ?></td></tr>
    </table>
</page><!--pagina 3-->


<page style="font-size: 12px"><!--Pagina 4-->
    <page_footer>
        <!--<hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">-->
        <p style="text-align:right;margin-right:20px;">[[page_cu]]</p>
    </page_footer>
    <page_header>
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación y Experimentación en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Facultad de Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Universidad de Santiago de Chile</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>
    <br /><br /><br /><br /><br /><br /><br />

    <h4>Reunión con directivos</h4>
    <label>Indique el nombre de las personas que participaron en la reunión y el cargo/rol dentro del establecimiento.</label>
    <table style="margin-top:5px;">
        <tr><th style="width: 70%">Nombre</th><th style="width:30%;">Cargo/Rol</th></tr>
        <?php if($datos["nombreDirectivo1VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo1VisitaEscuela"]."</td><td>".$datos["cargoDirectivo1VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo2VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo2VisitaEscuela"]."</td><td>".$datos["cargoDirectivo2VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo3VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo3VisitaEscuela"]."</td><td>".$datos["cargoDirectivo3VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo4VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo4VisitaEscuela"]."</td><td>".$datos["cargoDirectivo4VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo5VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo5VisitaEscuela"]."</td><td>".$datos["cargoDirectivo5VisitaEscuela"]."</td></tr>";}?>
    </table>
    <br />
    <table>
        <tr>
            <th style="width:100%;">¿Se cumplieron los compromisos y acuerdos tomados en la visita anterior?</th>
        </tr>
        <tr>
            <td><?php echo $datos["cumplenDirectivosVisitaEscuela"]; ?></td>
        </tr>
        <?php if ($datos["cumplenDirectivosVisitaEscuela"]!="n/a"){ ?>
        <tr><th>¿Cuáles?</th></tr>
        <tr><td style="width:100%;"><?php echo $datos["detalleCumpleDirectivoVisitaEscuela"]; ?></td></tr>
        <?php } ?>
    </table>
    <br />
    <h5>Temas abordados</h5>
    <table>
        <tr>
            <th style="width:95%;">1. Factores institucionales que están interfiriendo en la implementacion del Método Singapur</th>
            <td style="width:5%;text-align:center;"><?php if($datos["temaDirectivo1VisitaEscuela"]){echo "X"; } ?></td>
        </tr>
        <?php if($datos["temaDirectivo1VisitaEscuela"]){ ?>
        <tr>
            <td colspan=2>¿Cuáles?<br /><?php echo $datos["detalleTemaDirectivo1VisitaEscuela"] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th style="width:95%;">2. Factores pedagógicos o didácticos que están interfiriendo en la implementación del Método Singapur</th>
            <td style="width:5%;text-align:center;"><?php if($datos["temaDirectivo2VisitaEscuela"]){echo "X"; } ?></td>
        </tr>
        <?php if($datos["temaDirectivo2VisitaEscuela"]){ ?>
        <tr>
            <td colspan=2>¿Cuáles?<br /><?php echo $datos["detalleTemaDirectivo2VisitaEscuela"] ?></td>
        </tr>
        <?php } ?>
    </table>
    <br />
    <h5>Retroalimentación al establecimiento</h5>
    <table>
        <tr>
            <th style="width:95%;">1. Avances y logros que aprecian como consecuencia de la implementación del Método Singapur(Estudiante/Docente)</th>
            <td style="width:5%;text-align:center;"><?php if($datos["retroalimentacion1VisitaEscuela"]){echo "X"; } ?></td>
        </tr>
        <?php if($datos["retroalimentacion1VisitaEscuela"]){ ?>
        <tr>
            <td colspan=2>Especifique: <br /><?php echo $datos["detalleRetroalimentacion1VisitaEscuela"] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th style="width:95%;">2. Análisis de resultados de los aprendizajes de los estudiantes</th>
            <td style="width:5%;text-align:center;"><?php if($datos["retroalimentacion2VisitaEscuela"]){echo "X"; } ?></td>
        </tr>
        <?php if($datos["retroalimentacion2VisitaEscuela"]){ ?>
        <tr>
            <td colspan=2>Especifique: <br /><?php echo $datos["detalleRetroalimentacion2VisitaEscuela"] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th style="width:95%;">3. Reporte del monitoreo realizado por el CFK</th>
            <td style="width:5%;text-align:center;"><?php if($datos["retroalimentacion3VisitaEscuela"]){echo "X"; } ?></td>
        </tr>
        <?php if($datos["retroalimentacion3VisitaEscuela"]){ ?>
        <tr>
            <td colspan=2>Especifique: <br /><?php echo $datos["detalleRetroalimentacion3VisitaEscuela"] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <th style="width:95%;">4. Otro</th>
            <td style="width:5%;text-align:center;"><?php if($datos["retroalimentacion4VisitaEscuela"]){echo "X"; } ?></td>
        </tr>
        <?php if($datos["retroalimentacion4VisitaEscuela"]){ ?>
        <tr>
            <td colspan=2>Especifique: <br /><?php echo $datos["detalleRetroalimentacion4VisitaEscuela"] ?></td>
        </tr>
        <?php } ?>
        
    </table>

    <br />
    <table>
        <tr><th style="width: 100%">Acuerdos o compromisos que se efectuaron con los directivos</th></tr>
        <tr><td><?php echo $datos["acuerdosDirectivoVisitaEscuela"] ?></td></tr>
    </table>

</page><!--pagina 4-->

<?php   }else{
            header('Location: ../descargaVisitaEscuela.php');
        }

 ?>



