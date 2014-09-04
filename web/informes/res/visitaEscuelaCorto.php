<?php
require("../admin/inc/config.php");
require("../inc/_visitaEscuela.php");

if(validarVisitaEscuela($_GET["v"],$_SESSION["sesionIdUsuario"]) ){
?>
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
<page style="font-size: 14px">
    <page_footer>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
        <p style="margin-top:-5px;">Asesoría Metodo Singapur</p>
    </page_footer>
    <page_header>
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación y Experimentación en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Facultad de Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Universidad de Santiago de Chile</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>
    <br><br><br><br><br><br>
    <h3 style="text-align:center;">Acciones realizadas durante la<br>Visita a Escuela</h3>
    <br>
    <h4>Datos Generales</h4>
    <?php
        $datos = getInfoVisita($_GET["v"]);
        $docentes = getDocentesVisita($_GET["v"]);
    ?>
        
        <table cellspacing="0" style="width:100%;" id="datos-generales" class="table">
            <tr>
                <td style="width: 33%">RBD Establecimiento: <?php echo $datos["rbdColegio"]; ?></td>
                <td style="width: 33%">Asesor: <?php echo $datos["nombreAsesorVisitaEscuela"]; ?></td>
                <td style="width: 33%">Nº Visita: <?php echo $datos["numeroVisitaEscuela"]; ?></td>
            </tr>
            <tr>
                <td>Fecha: <?php echo substr($datos["fechaVisitaEscuela"],8)."/".substr($datos["fechaVisitaEscuela"],5,2)."/".substr($datos["fechaVisitaEscuela"],0,4); ?></td>
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
    <h4>Acciones Realizadas</h4>
    <table><tr><td style="width: 5%;text-align:center"><?php if(sizeof($docentes) > 0){echo "X";} ?></td><th style="width: 95%">Trabajó con docentes (individual)</th></tr></table>
    <table style="margin-top:5px;">
        <tr><th style="width: 100%">Profesores:</th></tr>
        <?php foreach ($docentes as $doc) {
            echo "<tr><td>".$doc["nombreDocenteObservacion"]."</td></tr>";
        }
        ?>
    </table>
    <br />
    <table>
        <tr>
            <td style="width: 5%;text-align:center;">
                <?php if($datos["nombreDocenteColectivo1"]!="" || $datos["nombreDocenteColectivo2"]!="" || $datos["nombreDocenteColectivo3"]!="" || $datos["nombreDocenteColectivo4"]!="" || $datos["nombreDocenteColectivo5"]!=""){echo "X";} ?>
            </td>
            <th style="width: 95%">Reunión con Profesores (colectivo)</th>
        </tr>
    </table>
    <table style="margin-top:5px;">
        <tr><th style="width: 100%">Profesores:</th></tr>
        <?php if($datos["nombreDocenteColectivo1"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo1"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo2"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo2"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo3"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo3"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo4"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo4"]."</td></tr>";}?>
        <?php if($datos["nombreDocenteColectivo5"]!=""){echo "<tr><td>".$datos["nombreDocenteColectivo5"]."</td></tr>";}?>
    </table>
    <br>
    <table>
        <tr><th style="width: 100%">Acuerdos o Compromisos</th></tr>
        <tr><td><?php echo $datos["acuerdosDocentesVisitaEscuela"] ?></td></tr>
    </table>
</page>
<page style="font-size: 14px">
    <page_footer>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
        <p style="margin-top:-5px;">Asesoría Metodo Singapur</p>
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

    <table>
        <tr>
            <td style="width: 5%;text-align:center">
                <?php if($datos["nombreDirectivo1VisitaEscuela"]!="" || $datos["nombreDirectivo2VisitaEscuela"]!="" || $datos["nombreDirectivo3VisitaEscuela"]!="" || $datos["nombreDirectivo4VisitaEscuela"]!="" || $datos["nombreDirectivo5VisitaEscuela"]!=""){echo "X";} ?>
            </td>
            <th style="width: 95%">Reunión con Directivos</th>
        </tr>
    </table>
    <table style="margin-top:5px;">
        <tr><th style="width: 70%">Nombre</th><th style="width: 30%">Cargo</th></tr>
        <?php if($datos["nombreDirectivo1VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo1VisitaEscuela"]."</td><td>".$datos["cargoDirectivo1VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo2VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo2VisitaEscuela"]."</td><td>".$datos["cargoDirectivo2VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo3VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo3VisitaEscuela"]."</td><td>".$datos["cargoDirectivo3VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo4VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo4VisitaEscuela"]."</td><td>".$datos["cargoDirectivo4VisitaEscuela"]."</td></tr>";}?>
        <?php if($datos["nombreDirectivo5VisitaEscuela"]!=""){echo "<tr><td>".$datos["nombreDirectivo5VisitaEscuela"]."</td><td>".$datos["cargoDirectivo5VisitaEscuela"]."</td></tr>";}?>
    </table>
    <br>
    <table>
        <tr><th style="width: 100%">Acuerdos o Compromisos</th></tr>
        <tr><td><?php echo $datos["acuerdosDirectivoVisitaEscuela"] ?></td></tr>
    </table>
    <br>
    <table>
        <tr><th style="width: 100%">Comentarios generales de la visita</th></tr>
        <tr><td>¿que atributo es este?</td></tr>
    </table>
    <br><br><br><br><br><br><br><br>
    <table style="border:0px">
        <tr>
            <td style="border:0px;text-align:center;width:50%;">___________________________</td>
            <td style="border:0px;text-align:center;width:50%;">___________________________</td>
        </tr>
        <tr>
            <td style="border:0px;text-align:center;width:50%;">Firma Asesor</td>
            <td style="border:0px;text-align:center;width:50%;">Firma Jefe de UTP</td>
        </tr>
        <tr>
            <td style="border:0px;width:50%;">Nomnbre Asesor:</td>
            <td style="border:0px;width:50%;">Nombre Jefe de UTP:</td>
        </tr>
    </table>

</page>

<?php   }else{
            header('Location: ../descargaVisitaEscuela.php');
        }

 ?>



