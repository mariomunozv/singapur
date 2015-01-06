<?php
require("../admin/inc/config.php");
require("../inc/_asistenciaSesion.php");
require("../inc/_cursoCapacitacion.php");
require("../inc/_usuario.php");
require("../inc/_empleadoKlein.php");
require("../inc/_seccionBitacora.php");
require("../inc/_profesor.php");



?>
<style type="text/Css">


table.table ,.table  th,.table  td {
    border: 1px solid #333;
    border-spacing: 0px;
    border-collapse: collapse;
    font-size:14px;
}
.table td,.table th{
    padding: 4px;
}
li{
    font-size:14px;
    padding-left: 5px;
}



</style>
<page style="font-size: 12px"><!--Pagina 1-->
    <page_footer>
        <div style="width:100%;text-align:center;">Singapur <?php echo date("Y"); ?></div>
        <p style="text-align:right;margin-right:20px;">[[page_cu]]</p>
    </page_footer>
    <page_header>
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación, Experimentación y Transferencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>
    <br><br><br><br><br><br><br><br>
    <h3 style="text-align:center;">Bitácora Taller<br><br>Capacitación Método Singapur</h3>
    <h4>Datos Generales</h4>
    <?php
        $datos = getDatosSesionPorId($_GET["s"]);
        $detalle = getDetalleSesion($_GET["s"]);
        $capProgramados = split(",",substr($detalle["capitulosProgramadosSesion"],1,count($detalle["capitulosProgramadosSesion"])-2));
        //print_r($detalle);
    ?>
        
        <table style="width:100%;margin-left:40px;font-size:14px;" id="datos-generales">
            <tr>
                <td>Curso: <?php echo utf8_encode(getNombreCortoCurso($datos["idCursoCapacitacion"])); ?></td>
            </tr><tr><td></td></tr>
            <tr>
                <td>Sesión: <?php echo $datos["numeroSesion"]; ?></td>
            </tr><tr><td></td></tr>
            <tr>
                <td>Fecha: <?php echo $datos["fechaSesion"]; ?></td>
            </tr><tr><td></td></tr>
            <tr>
                <td>Relator: <?php echo utf8_encode(getNombreUsuario($datos["idRelator"])); ?></td>
            </tr><tr><td></td></tr>
        </table>
    <br />
    <h4>Capitulos programados:</h4>
    <div style="overflow:hidd_en;">
    </div>
        <?php foreach ($capProgramados as $cap) { ?>
        <div style="font-size:14px;">
            <img style='margin-left:20px;margin-right:10px;' src='res/img/off.png'><?php echo utf8_encode(getNombreCapitulo($cap)); ?><br><br>
        </div>
        <?php } ?>
    <br />
    <h4>Trabajo realizado:</h4>
    <table align="center" class="table">
        <thead style="text-align:center;">
            <tr>
                <th style="width:200px;">Talleres</th>
                <th style="width:200px;">Capítulos</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $talleres = split(",",substr($detalle["trabajoRealizadoSesion"],1,count($detalle["trabajoRealizadoSesion"])-2));
                foreach ($capProgramados as $dat) {
                    $strTaller = "";
                    foreach ($talleres as $tall) {
                        if($tall!=""){
                            $aux = split(":",$tall);
                            if($aux[1]==$dat){
                                $strTaller.="Taller ".$aux[0]."<br>";
                            }
                        }
                    }
            ?>
                <tr>
                    <td><?php echo utf8_encode($strTaller); ?></td>
                    <td><?php echo utf8_encode(getNombreCapitulo($dat)); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br><br>
    <table class="table" style="width:100%;">
        <tr>
            <th style="width:100%;">Justificación del trabajo no realizado:</th>
        </tr>
        <tr>
            <td style="width:620px;padding:10px;text-align:justify;"><?php echo utf8_encode($detalle["justificacionNoRealizadoSesion"]); ?></td>
        </tr>
    </table>
</page>
<page style="font-size: 12px"><!--pagina 2-->
    <page_footer>
        <div style="width:100%;text-align:center;">Singapur <?php echo date("Y"); ?></div>
        <p style="text-align:right;margin-right:20px;">[[page_cu]]</p>
    </page_footer>
    <page_header style="margin-top:-20px;">
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación, Experimentación y Transferencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>
    <h4 style="margin-top:80px;margin-bottom:-10;">Datos esenciales de la relatoría</h4>
    <p style="font-size:15px;">¿Los docentes presentan dificultades respecto de temas matemáticos y/o didácticos en estudio? (Describa a modo general y/o particular)</p>
    <table class="table" align="center">
        <tr>
            <td style="width:10px;text-align:center;"><?php echo ($detalle["dificultadesMatDidSesion"])? "X":"" ?></td>
            <td style="width:40px;">Si</td>
            <td style="border-top: 0px;border-bottom: 0px;"></td>
            <td style="width:10px;text-align:center;"><?php echo ($detalle["dificultadesMatDidSesion"])? "":"X" ?></td>
            <td style="width:40px;">No</td>
        </tr>
    </table>
    <br><br>
    <table align="center" style="border: 1px black solid; font-size:14px;padding:5px;">
        <tr>
            <th style="width:620px;">Matemático</th>
        </tr>
        <tr>
            <td style="width:620px;padding:10px;text-align:justify;"><?php echo utf8_encode($detalle["matematicoSesion"]); ?><br><br></td>
        </tr>
        <tr>
            <th>Didáctico</th>
        </tr>
        <tr>
            <td style="width:620px;padding:10px;text-align:justify;"><?php echo utf8_encode($detalle["didacticoSesion"]); ?><br><br></td>
        </tr>
    </table>
    <br><br>
    <h4>Docentes con participación destacada:</h4>
    <div style="font-size:14px;">
        <?php
            $destacada = split(",",substr($detalle["participacionDestacadaSesion"],1,count($detalle["participacionDestacadaSesion"])-2) );
            foreach ($destacada as $dest) {
                echo "<img style='margin-left:20px;margin-right:10px;' src='res/img/off.png'>".utf8_encode(getNombreUsuario($dest))."<br /><br />";
            } 
        ?>
    </div>
    <h4>Docentes que presentan debilidades:</h4>
    <div style="font-size:14px;">
        <?php
            $debil = split(",",substr($detalle["participacionDebilSesion"],1,count($detalle["participacionDebilSesion"])-2));
            foreach ($debil as $debi) {
                echo "<img style='margin-left:20px;margin-right:10px;' src='res/img/off.png'>".utf8_encode(getNombreUsuario($debi))."<br /><br />";
            } 
        ?>
    </div>
</page><!--pagina 2-->

<page style="font-size: 12px"><!--Pagina 3-->
    <page_footer>
        <div style="width:100%;text-align:center;">Singapur <?php echo date("Y"); ?></div>
        <p style="text-align:right;margin-right:20px;">[[page_cu]]</p>
    </page_footer>
    <page_header>
        <p style="text-align:center; font-size: 10pt;font-family: Times">CENTRO FELIX KLEIN</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">Investigación, Experimentación y Transferencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times">en Didáctica de la Matemática y la Ciencia</p>
        <p style="text-align:center; margin-top:-15px; font-size: 10pt;font-family: Times"><a href="http://www.centrofelixklein.cl">www.centrofelixklein.cl</a></p>
        <hr style="height: 1px; margin-top:-10px; background: #000; border: solid 1px #555">
    </page_header>

    <br /><br /><br /><br />
    <h4 style="margin-top:80px;margin-bottom:-10;">Implementación del Método</h4>
    <br>
    <p style="font-size:15px;">¿Los docentes mencionan situaciones o problemáticas en relación a aspectos didácticos o pedagógicos surgidos durante la implementación? </p>
    <table class="table" align="center">
        <tr>
            <td style="width:10px;text-align:center;"><?php echo ($detalle["situacionPedagogicaSesion"])? "X":"" ?></td>
            <td style="width:40px;">Si</td>
            <td style="border-top: 0px;border-bottom: 0px;"></td>
            <td style="width:10px;text-align:center;"><?php echo ($detalle["situacionPedagogicaSesion"])? "":"X" ?></td>
            <td style="width:40px;">No</td>
        </tr>
    </table>
    <br><br>
    <table align="center" style="border: 1px black solid; font-size:14px;padding:5px;">
        <tr>
            <th style="width:620px;">¿Cuáles?</th>
        </tr>
        <tr>
            <td style="width:620px;padding-left:10px;padding-right:10px;text-align:justify"><?php echo utf8_encode($detalle["cualSituacionPedagogicaSesion"]); ?><br><br></td>
        </tr>
    </table>
    <br><br>


    <p style="font-size:15px;">¿Los docentes mencionan situaciones o problemáticas en relación a aspectos institucionales que afectan la implementación? </p>
    <table class="table" align="center">
        <tr>
            <td style="width:10px;text-align:center;"><?php echo ($detalle["situacionInstitucionalSesion"])? "X":"" ?></td>
            <td style="width:40px;">Si</td>
            <td style="border-top: 0px;border-bottom: 0px;"></td>
            <td style="width:10px;text-align:center;"><?php echo ($detalle["situacionInstitucionalSesion"])? "":"X" ?></td>
            <td style="width:40px;">No</td>
        </tr>
    </table>
    <br><br>
    <table align="center" style="border: 1px black solid; font-size:14px;padding:5px;">
        <tr>
            <th style="width:620px;">¿Cuáles?</th>
        </tr>
        <tr>
            <td style="width:620px;padding-left:10px;padding-right:10px;text-align:justify"><?php echo utf8_encode($detalle["cualSituacionInstitucionalSesion"]); ?><br><br></td>
        </tr>
    </table>
    <br><br>

    
</page><!--pagina 3-->




