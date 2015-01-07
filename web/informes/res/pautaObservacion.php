<?php

function utf8_($contenido){
    $str = (string)$contenido;
    $aux = "";
    $contador = 0;
    while($contador < strlen($contenido)){
        switch (ord($str[$contador])) {
            case 241:
                $aux = $aux."&#241;";
                break;
            case 209:
                $aux = $aux."&#209;";
                break;
            case 170:
                $aux = $aux."&#170;";
                break;
            case 176:
                $aux = $aux."&#176;";
                break;
            case 186:
                $aux = $aux."&#186;";
                break;
            case 176:
                $aux = $aux."&#176;";
                break;
            case 192:
                $aux = $aux."&#192;";
                break;
            case 193:
                $aux = $aux."&#193;";
                break;
            case 196:
                $aux = $aux."&#196;";
                break;
            case 200:
                $aux = $aux."&#200;";
                break;
            case 201:
                $aux = $aux."&#201;";
                break;
            case 203:
                $aux = $aux."&#203;";
                break;
            case 204:
                $aux = $aux."&#204;";
                break;
            case 205:
                $aux = $aux."&#205;";
                break;
            case 207:
                $aux = $aux."&#207;";
                break;
            case 210:
                $aux = $aux."&#210;";
                break;
            case 211:
                $aux = $aux."&#211;";
                break;
            case 213:
                $aux = $aux."&#213;";
                break;
            case 217:
                $aux = $aux."&#217;";
                break;
            case 218:
                $aux = $aux."&#218;";
                break;
            case 220:
                $aux = $aux."&#220;";
                break;
            case 224:
                $aux = $aux."&#224;";
                break;
            case 225:
                $aux = $aux."&#225;";
                break;
            case 228:
                $aux = $aux."&#228;";
                break;
            case 232:
                $aux = $aux."&#232;";
                break;
            case 233:
                $aux = $aux."&#233;";
                break;
            case 235:
                $aux = $aux."&#235;";
                break;
            case 236:
                $aux = $aux."&#236;";
                break;
            case 237:
                $aux = $aux."&#237;";
                break;
            case 239:
                $aux = $aux."&#239;";
                break;
            case 242:
                $aux = $aux."&#242;";
                break;
            case 243:
                $aux = $aux."&#243;";
                break;
            case 246:
                $aux = $aux."&#246;";
                break;
            case 249:
                $aux = $aux."&#249;";
                break;
            case 250:
                $aux = $aux."&#250;";
                break;
            case 252:
                $aux = $aux."&#252;";
                break;
            default:
                $aux = $aux.chr(ord($str[$contador]));
                break;
        }
        $contador++;
    }
    return $aux;
}

function getPautas($idPauta){
    $sql = "SELECT * FROM pautaObservacion
            WHERE id = $idPauta";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return $row;

}

if (($_SESSION["sesionTipoUsuario"]=="Asesor"||$_SESSION["sesionTipoUsuario"]=="Relator/Tutor"||$_SESSION["sesionTipoUsuario"]=="Coordinador General"||$_SESSION["sesionTipoUsuario"]=="Empleado Klein") ){ ?>


<style type="text/Css">


table, th, td {
    border: 1px solid #333;
    border-spacing: 0px;
    border-collapse: collapse;
    font-size: 14px;
}
td,th{
    padding: 5px;
}
td.name{
    width: 23%;
    border:0px;
    border-right: 1px;
}
td.cont{
    width: 72%;
}
td.blank{
    height: 30px;
    border-left: 0px;
    border-right: 0px;
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
    <h3 style="text-align:center;">PAUTA DE OBSERVACIÓN GENERAL PARA CLASES DE MATEMÁTICAS</h3>
    <h3 style="margin-top:-10px;text-align:center;">SINGAPUR <?php date("Y"); ?></h3>
    <br><br>
    <?php
        $id =  params('id');

        $p = new PautaObservacion();
        
        //$pauta = $p->getInforme2($id)[0];
        $arr_pauta = $p->getInforme2($id);
        $pauta = $arr_pauta[0];
        //var_dump($pauta);

        $indCondicion = json_decode1($pauta->indicadoresCondiciones);
        $objectIndGestion = json_decode1($pauta->indicadoresGestion);
        $indGestion = get_object_vars($objectIndGestion);
        // foreach ($pautas as $pauta) {
        //     echo $pauta->rbdColegio."\n";
        // }
        //$datos = getPautas($rut);

        

    ?>
        <?php $establecimiento = new Establecimiento(); 
        

        

        ?>
        <table cellspacing="0" style="width:100%;" id="datos-generales" class="table">
            <tr>
                <td class="name">Establecimiento:</td>
                <td class="cont"><?php echo $pauta->rbdColegio; ?></td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td class="name">Institución:</td>
                <td class="cont"><?php 
                $arr_establecimiento = $establecimiento->getByRbdColegio($pauta->rbdColegio);
                echo $arr_establecimiento[0]["nombreColegio"]; ?></td>
            </tr>
        </table><br><br>
        <table>
            <tr>
                <td class="name">Profesor:</td>
                <td class="cont"><?php echo ($pauta->nombreProfesor); ?></td>
            </tr>
        </table><br><br>
        <table>
            <tr>
                <td class="name">Curso - Niveles:</td>
                <td class="cont"><?php echo ($pauta->nombreNivel); ?></td>
            </tr>
        </table><br><br>
        <table>
            <tr>
                <td class="name">Texto:</td>
                <td class="cont"><?php echo utf8_decode($pauta->idLibro); ?></td>
            </tr>
        </table><br><br>
        <table>
            <tr>
                <td class="name">Capítulo:</td>
                <td class="cont"><?php echo ($pauta->capitulo); ?></td>
            </tr>
        </table><br><br>
        <table>
            <tr>
                <td class="name">Apartado:</td>
                <td class="cont"><?php echo ($pauta->apartado); ?></td>
            </tr>
        </table><br><br>
        <table>
            <tr>
                <td class="name">Páginas Texto:</td>
                <td class="cont"><?php echo $pauta->paginasTexto; ?></td>
            </tr>
        </table><br><br>
        <table>
            <tr>
                <td class="name">Pág. Texto ejercitación:</td>
                <td class="cont"><?php echo $pauta->paginasTextoEjercitacion; ?></td>
            </tr>
        </table>
        <br /><br>
        <table>
            <tr>
                <td class="name">Grabación de clases:</td>
                <td class="cont"><?php echo ($pauta->grabaClase ? "Si" : "No"); ?></td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td class="name">Fecha:</td>
                <td class="cont"><?php echo substr($pauta->fecha,-2,2)."/".substr($pauta->fecha,-5,2)."/".substr($pauta->fecha,0,4); ?></td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td class="name">Hora Inicio:</td>
                <td class="cont"><?php echo $pauta->horaInicio; ?></td>
            </tr>
        </table>
        <br><br>
        <table>
            <tr>
                <td class="name">Hora Término:</td>
                <td class="cont"><?php echo $pauta->horaTermino; ?></td>
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
    <br>
    <h4 style="margin-top:80px;margin-bottom:-10;">Indicadores sobre las condiciones de realización de la clase: </h4>
    <br>
    <table>
        <tr>
            <th style="text-align:center;width:82%;" colspan="2">INDICADORES</th>
            <td style="width:5%;text-align:center;">N/O</td>
            <td style="width:5%;text-align:center;">Si</td>
            <td style="width:5%;text-align:center;">No</td>
        </tr>
        <tr>
            <td style="width:4%;">a)</td>
            <td style="width:78%;">Todos los estudiantes cuentan con los textos necesarios para realizar las actividades de la clase.</td>
            <td style="text-align:center;"><?php echo $indCondicion->a=="NA"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->a=="si"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->a=="no"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;">b)</td>
            <td style="width:78%;">El docente tiene el material didáctico dispuesto para ser utilizados en el momento que se necesiten durante el desarrollo de la clase.</td>
            <td style="text-align:center;"><?php echo $indCondicion->b=="NA"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->b=="si"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->b=="no"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;">c)</td>
            <td style="width:78%;">El docente demuestra que tiene preparada la clase (sigue un orden para presentar las actividades, dispone ordenadamente los materiales didácticos a utilizar, tiene claridad de si las actividades son individuales, y/o grupales, y/o colectivas, etc.).</td>
            <td style="text-align:center;"><?php echo $indCondicion->c=="NA"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->c=="si"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->c=="no"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;">d)</td>
            <td style="width:78%;">La actitud de los estudiantes frente a las actividades propuestas favoreció al desarrollo de la clase.</td>
            <td style="text-align:center;"><?php echo $indCondicion->d=="NA"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->d=="si"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->d=="no"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;">e)</td>
            <td style="width:78%;">La clase se realizó sin interrupciones externas (entrega de información, consultas al profesor(a), etc.).</td>
            <td style="text-align:center;"><?php echo $indCondicion->e=="NA"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->e=="si"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->e=="no"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;">f)</td>
            <td style="width:78%;">La infraestructura de la sala de clases es adecuada para un buen desarrollo de la misma (aislada de ruidos externos, bancos y sillas adecuadas, etc.).</td>
            <td style="text-align:center;"><?php echo $indCondicion->f=="NA"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->f=="si"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indCondicion->f=="no"? "X":""; ?></td>
        </tr>
        <tr>
            <th colspan="5" style="border-bottom:0px;width:1%">Observaciones generales de la preparación de la clase (aspectos que dificultaron y/o favorecieron en el desarrollo de la clase), en especial de aquellos indicadores en que su respuesta es NO:</th>
        </tr>
        <tr>
            <td colspan="5" style="border-top:0px;width:1%"><?php echo $pauta->preguntaCondiciones; ?></td>
        </tr>
    </table>
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

    <h4 style="margin-top:100px;margin-bottom:-10;">Indicadores sobre la gestión de la clase:</h4>
    <br>
    <table>
        <tr style="text-align:center;">
            <th rowspan=2 style="width:4%;">Nº</th>
            <th rowspan=2 style="width:70%;">INDICADORES</th>
            <th colspan="4" style="width:24%;">ESCALA</th>
        </tr>
        <tr style="text-align:center;">
            <th style="border-left:0px;">N/O</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">1</td>
            <td style="width:70%;">El profesor(a) muestra <b>dominio del tema matemático</b> en estudio durante la clase.</td>
            <td style="text-align:center;"><?php echo $indGestion[1]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[1]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[1]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[1]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">2</td>
            <td style="width:70%;">El profesor(a) gestiona la actividad propuesta generando las condiciones para que <b>los alumnos exploren sobre un nuevo conocimiento matemático</b> en estudio.</td>
            <td style="text-align:center;"><?php echo $indGestion[2]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[2]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[2]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[2]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">3</td>
            <td style="width:70%;">El profesor(a) <b>articula los conocimientos matemáticos</b> estudiados durante la clase o en clases anteriores.</td>
            <td style="text-align:center;"><?php echo $indGestion[3]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[3]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[3]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[3]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">4</td>
            <td style="width:70%;">El profesor(a) logra <b>relacionar los contenidos matemáticos en estudio con el  material didáctico.</b></td>
            <td style="text-align:center;"><?php echo $indGestion[4]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[4]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[4]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[4]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">5</td>
            <td style="width:70%;">El profesor utiliza  <b>distintos tipos de representación</b> (concreto - pictórico -  simbólico) de la noción matemática en estudio.</td>
            <td style="text-align:center;"><?php echo $indGestion[5]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[5]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[5]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[5]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">6</td>
            <td style="width:70%;">El profesor promueve que los estudiantes <b>argumenten sus respuestas y procedimientos.</b></td>
            <td style="text-align:center;"><?php echo $indGestion[6]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[6]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[6]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[6]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">7</td>
            <td style="width:70%;">La gestión que realiza el profesor(a), promueve que los alumnos <b>ejerciten o naturalicen el o los procedimientos.</b></td>
            <td style="text-align:center;"><?php echo $indGestion[7]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[7]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[7]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[7]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">8</td>
            <td style="width:70%;">El profesor(a) <b>realiza una gestión frente a los errores</b> que posibilita a los estudiantes reconocer por qué se han equivocado.</td>
            <td style="text-align:center;"><?php echo $indGestion[8]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[8]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[8]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[8]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">9</td>
            <td style="width:70%;">El profesor(a) <b>otorga el tiempo necesario</b> para que los estudiantes logren realizar cada una de las actividades planteadas en la clase.</td>
            <td style="text-align:center;"><?php echo $indGestion[9]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[9]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[9]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[9]=="3"? "X":""; ?></td>
        </tr>
        <tr>
            <td style="width:4%;text-align:center;">10</td>
            <td style="width:70%;">El profesor(a) <b>realiza un cierre en que sistematiza</b> los conocimientos matemáticos surgidos o trabajados en la(s) clase(s).</td>
            <td style="text-align:center;"><?php echo $indGestion[10]=="NO"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[10]=="1"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[10]=="2"? "X":""; ?></td>
            <td style="text-align:center;"><?php echo $indGestion[10]=="3"? "X":""; ?></td>
        </tr>
    </table>
</page><!--pagina 3-->


<page style="font-size: 12px"><!--Pagina 4-->
    <page_footer>
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
    <br /><br /><br /><br /><br /><br /><br /><br />

    <h4 >Observaciones  generales de la clase:</h4>
    <br>
    <table>
        <tr>
            <td style="width:100%;"><?php echo ($pauta->preguntaGestion); ?></td>
        </tr>
    </table>
    

</page><!--pagina 4-->

<?php   }else{
            header('Location: .././');
        }

 ?>



