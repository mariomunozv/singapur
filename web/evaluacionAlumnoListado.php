<?php 
    require("inc/incluidos.php");
    require("inc/_respuestaItem.php");
    require("inc/_item.php");
    require("inc/_pautaItem.php"); 
    require ("hd.php");

    function getNombreNivel($idNivel){
        $sql = "SELECT * FROM nivel WHERE idNivel = $idNivel";
        $res = mysql_query($sql);
        $row = mysql_fetch_array($res);
        return($row["nombreNivel"]);
    }

    function getAlumnosCurso2($rbd, $idNivel, $anoCursoColegio, $letraCursoColegio, $idLista){
            
        $sql = "SELECT u.loginUsuario,u.rutAlumno,a.nombreAlumno,a.apellidoPaternoAlumno,a.apellidoMaternoAlumno,u.idUsuario,a.estadoAlumno
                FROM `matricula` as m
                left join usuario as u on m.rutAlumno = u.rutAlumno
                left join alumno as a on m.rutAlumno = a.rutAlumno
                left join pautaItem as pi on pi.idUsuario = u.idUsuario
                WHERE m.rbdColegio = '". $rbd."'
                AND m.idNivel = ".$idNivel."
                AND m.anoCursoColegio = ".$anoCursoColegio."
                AND m.letraCursoColegio = "."'$letraCursoColegio'"."
                AND pi.idLista = ". $idLista ."
                AND pi.asistio = 1
                ORDER BY a.apellidoPaternoAlumno ASC";
        // echo $sql;
        $res = mysql_query($sql);
        $i = 0;
        while ($row = mysql_fetch_array($res)){
            $alumnosCurso[$i]= array( "idUsuario" =>$row["idUsuario"],
                              "usuario" => $row["loginUsuario"],
                              "nombreAlumno" => $row["nombreAlumno"],
                              "apellidoPaternoAlumno" => $row["apellidoPaternoAlumno"],
                               "estadoAlumno" => $row["estadoAlumno"],
                               "rutAlumno" => $row["rutAlumno"],
                              "apellidoMaternoAlumno" => $row["apellidoMaternoAlumno"]
                              );    
            //echo $i." <- <br>";$i++;
            $i++;
        }
        if ($i==0){
            return(NULL);
        }
        
        
        return($alumnosCurso);
        
    }

    $idNivel = $_SESSION["sesionIdNivel"];
    $rbdColegio= $_SESSION["sesionRbdColegio"];
    $anoCursoColegio = $_SESSION["sesionAnoCursoColegio"];
    $letraCursoColegio= $_SESSION["sesionLetraCursoColegio"];
    $idLista = $_SESSION["sesionIdLista"];
    $idPrueba = '';
    $prueba = "";
    if (isset($_SESSION["idPrueba"])) {
        $idPrueba = $_SESSION["idPrueba"];
        $prueba = "Prueba ".$_SESSION["idPrueba"];
    }

    $items = getItemsLista($idLista);
    // print_r($items);
    $alumnos = getAlumnosCurso2($rbdColegio,$idNivel,$anoCursoColegio,$letraCursoColegio, $idLista);
?>


    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.numeric.js"></script>

<body>
    <button class="btn btn-large btn-primary" onclick="window.location.href = './evaluacionProfesor.php?rbdColegio=<?php echo $rbdColegio; ?>&idNivel=<?php echo $idNivel; ?>&anoCursoColegio=<?php echo $anoCursoColegio; ?>&letraCursoColegio=<?php echo $letraCursoColegio; ?>&escala=5&nombreNivel=null&idLista=<?php echo $idLista; ?>&idPrueba=<?php echo $idPrueba; ?>';">Modificar registro de asistencia  </button>
    <button class="btn btn-large btn-primary" onclick="xls();">Exportar a XLS</button>
    <button class="btn btn-large btn-primary" onclick="window.location.href = './evaluacionProfesor.php';">Volver a selección de los cursos</button>
    
    <div id="actualiza"></div>
        <p>
            Ingresa los puntajes de cada alumno y presiona Actualizar


    <table class="tablesorter" id="tabla"> 
        <thead>  
            <tr>
                <th colspan="2">Listado de Alumnos</th>
                <th colspan="<?php echo count($items);?>">Puntajes <?php echo getNombreNivel($idNivel)." ".$letraCursoColegio ?><br> <?php echo $prueba; ?> </th>
            </tr>
             
            <tr>
                <th>Nº</th>
                <th>Nombres</th>
        
                <?php foreach($items as $item){ ?>           
                    <th><?php echo $item["enunciadoItem"];?></th>
                <?php }  ?>           
       
            </tr>
        </thead>
        
        <tbody>        
            <?php 
            $countInput = 0;
            if (count($alumnos) > 0){
                $countAlumno = 1;
                foreach ($alumnos as $alumno){ 
                    $datosPauta = buscaPauta($alumno["idUsuario"],$idLista);
                    if($alumno["estadoAlumno"] == 1){
                        $claseTR = "normal";
                        $modo = "Deshabilitar";
                        $imgCambioEstado = "desactivado.gif";
                    }else{
                        $modo = "Confirmar";
                        $claseTR = "deshabilitado";
                        $imgCambioEstado = "activado.gif";
                    }
                    $respuestaUsuario = getRespuestaUsuarioByPauta($alumno["idUsuario"],$datosPauta["idPautaItem"]);
                    ?>
                    <input type="hidden" name="pauta[]" value="<?php echo $datosPauta["idPautaItem"];?>"  class="campos" />
                        <tr onMouseOver="this.className='normalActive'" onMouseOut="this.className='<?php echo $claseTR; ?>'" class="<?php echo $claseTR; ?>">
                            <td><?php echo $countAlumno;?></td>
                            <td><?php echo $alumno["apellidoPaternoAlumno"]." ".$alumno["nombreAlumno"];?></td>
                            <input type="hidden" name="usuarios[]" class="campos" value="<?php echo $alumno['idUsuario'];?>" /> 
                            <?php 
                            foreach($items as $item){ 
                                // $respuesta = getRespuestaUsuarioItem($item["idItem"],$alumno["idUsuario"],$datosPauta["idPautaItem"]);
                                $respuesta = '';
                                if (isset($respuestaUsuario[$item["idItem"]])) {
                                    $respuesta = $respuestaUsuario[$item["idItem"]];
                                }
                            ?>   
                                <td>
                                    <div id="divInput<?php echo $countInput;?>">
                                        <span id="item<?php echo $alumno["usuario"]."-".$item["idItem"]; ?>" class="ui-stepper">
                                            <input id="sel<?php echo $item['idItem'].$alumno['idUsuario']; ?>" data="<?php echo $item['puntajeItem'] ?>" type="text" 
                                                name="sel<?php echo $alumno['idUsuario']?>[]" size="2" autocomplete="off" class="ui-stepper-textbox campos field positive-integer"
                                                value="<?php echo $respuesta["puntajeRespuestaItem"];?>"
                                            />
                                        </span>
                                    </div>
                                </td>
                            <?php 
                                $countInput++;
                            } 
                            ?>                  
                        </tr>
                    <?php 
                    $countAlumno++;   
                }
            }else{ 
                echo "<tr><td colspan='12'>No existen Alumnos en este curso.</td></tr>"; 
            } ?>
                
            <div id="activa"></div>
        </tbody> 
    </table>

    <div class = "alert alert-info">
        <button type="button" class="close" data-dismiss="alert"><strong>x</strong></button> `
        <h5>
            <ul>
                <li>
                    Para guardar y seguir modificando su registro haga click en actualizar puntajes. <br>
                </li>
                <li>
                    Para finalizar  el registro y enviar puntajes haga click en  finalizar registro puntajes.
                </li>
            </ul>
        </h5>
    </div>

    <div  align="right">
        <button class="btn btn-large btn-primary" onclick="guarda();">Actualizar Puntaje</button>
        <button class="btn btn-large btn-primary" onclick="finalizarRegistro();">Finalizar registro de puntaje</button>
    </div>

    <script>
        function activaDesactiva(rutAlumno,modo){
            var division = document.getElementById("activa");
            AJAXPOST("alumnoGuarda.php","modo="+modo+"&rut="+rutAlumno,division);            
        } 

        var nItems = <?php echo count($items) ?>;

        var inputEmpty = function() {
            var inputEmpty = $('input:text').filter(function() { return $(this).val() == ""; });
            if (inputEmpty.length > 0) {
                return 1;
            }
            return 0;
        }

        var guarda = function (){
            var division = document.getElementById("actualiza");
            //a = "arreglo="+document.getElementsByName("sel"+jornada);
            var a = '';
            a = $(".campos").fieldSerialize();
            <?php 
            $valores = "";
            foreach ($items as $item){
                $valores .= "&itemes[]=".$item["idItem"];
            } 
            ?>
            a = a+"<?php echo $valores;?>"+"&inputEmpty="+inputEmpty()+"&idLista=<?php echo $idLista; ?>&idNivel=<?php echo $idNivel; ?>&rbdColegio=<?php echo $rbdColegio; ?>&anoCursoColegio=<?php echo $anoCursoColegio; ?>&letraCursoColegio=<?php echo $letraCursoColegio; ?>";
            AJAXPOST("evaluacionAlumnoGuarda.php",a,division);
        }

        var desactivaInput = function () {
            $("input").attr('disabled','disabled');
            $(".ui-stepper").css("background-color","#BDBDBD");
        };

        var finalizarRegistro = function () {
            var division = document.getElementById("actualiza");
            //a = "arreglo="+document.getElementsByName("sel"+jornada);
            var a = '';
            a = $(".campos").fieldSerialize();
            <?php 
            $valores = "";
            foreach ($items as $item){
                $valores .= "&itemes[]=".$item["idItem"];
            } 
            ?>
            a = a+"<?php echo $valores;?>"+"&inputEmpty="+inputEmpty()+"&idLista=<?php echo $idLista; ?>&idNivel=<?php echo $idNivel; ?>&rbdColegio=<?php echo $rbdColegio; ?>&anoCursoColegio=<?php echo $anoCursoColegio; ?>&letraCursoColegio=<?php echo $letraCursoColegio; ?>&finaliza=1";
            AJAXPOST("evaluacionAlumnoGuarda.php",a,division);
            if (!inputEmpty()) {
                desactivaInput();
            }
        };

        function xls(){
            location.href="evaluacionAlumnoListadoXLS.php";
        }  

        $(document).ready(function(){
            $(".field").change(function(){
                $(this).css("background-color","#D6D6FF");
            });
        });


        $(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });


        $('input').keyup(function(e) {
            var id, split, nextID, maxValue;

            if (e.keyCode == 13 || e.keyCode == 39) {
                id = $(this).closest("div").attr("id");
                split = id.split("divInput");
                nextID = parseInt(split[1]) + 1;
                $($("#divInput"+nextID).find("input")[0]).focus();                
            }

            if (e.keyCode == 37) {
                id = $(this).closest("div").attr("id");
                split = id.split("divInput");
                nextID = parseInt(split[1]) - 1;
                $($("#divInput"+nextID).find("input")[0]).focus();                
            }

            if (e.keyCode == 38) {
                id = $(this).closest("div").attr("id");
                split = id.split("divInput");
                nextID = parseInt(split[1]) - nItems;
                $($("#divInput"+nextID).find("input")[0]).focus();                
            }

            if (e.keyCode == 40) {
                id = $(this).closest("div").attr("id");
                split = id.split("divInput");
                nextID = parseInt(split[1]) + nItems;
                $($("#divInput"+nextID).find("input")[0]).focus();                
            }

            maxValue = parseInt($(this).attr("data"));
            if (maxValue < parseInt($(this).val())) {
                $(this).val(""+maxValue);
                $(this).css("background-color","#D6D6FF");
            }
        });

        $('input').keydown(function(e) {
            var maxValue;
            maxValue = parseInt($(this).attr("data"));
            if (maxValue < parseInt($(this).val())) {
                $(this).val(""+maxValue);
                $(this).css("background-color","#D6D6FF");
            }
        });

    </script>

</body>