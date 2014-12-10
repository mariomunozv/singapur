<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require("inc/incluidos.php");
        require ("hd.php");
        require("inc/_asistenciaSesion.php");
    }
?>
<meta charset="iso-8859-1">
	<form method="POST" action="guardarinformesesion.php">
        <p class="titulo_curso">Ingresar informe de sesi&oacute;n</p>
        <hr />
        <br />
        <h3>Datos generales</h3>
        <table style="font-size:14px;" class="tablesorter">
            <tr>
                <th style="font-size:14px;">Curso:</th>
                <td id="cursoSelected"></td>
                <input type="hidden" value="<?php echo $_SESSION['sesionIdCurso']; ?>" name="idCurso">
            </tr>
            <tr>
                <th style="font-size:14px;">N&deg; Sesi&oacute;n:</th>
                <td>
                    <select name="numeroSesion" id="numeroSesion">
                        <?php 
                            $numSesiones = getNumerosSesionesCurso($_SESSION["sesionIdCurso"],$_SESSION["sesionIdUsuario"]);
                            $siguienteNumero = getSiguienteSesionesCurso($_SESSION["sesionIdCurso"]);
                            foreach ($numSesiones as $i) {
                                if($i==$_POST["numero"]){
                                    echo "<option selected value='".$i."'>".$i."</option>";
                                }else{
                                    echo "<option value='".$i."'>".$i."</option>";
                                }
                            }
                            if($siguienteNumero==$_POST["numero"] || $_SERVER['REQUEST_METHOD']=="GET"){
                               echo "<option selected value='".$siguienteNumero."'>".$siguienteNumero." (nuevo)</option>";
                            }else{
                               echo "<option value='".$siguienteNumero."'>".$siguienteNumero." (nuevo)</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <?php 
                $datos = getDatosSesion($_SESSION["sesionIdCurso"], $_POST["numero"]);
                $detalle = getDetalleSesion($datos["idInformeSesion"]); 
            ?>

            <tr>
                <th style="font-size:14px;">Fecha de Sesi&oacute;n:</th>
                <td><?php echo ($datos['fechaSesion']?$datos['fechaSesion']."<input type='hidden' value='".$datos['fechaSesion']."' name='fechaSesion'>":"<input name='fechaSesion' placeholder='dd/mm/aaaa' type='text' id='datepicker'>" ); ?></td>
            </tr>
            <tr>
                <th style="font-size:14px;width:120px;">Relator:</th>
                <td>
                    <?php 
                    if($_SERVER["REQUEST_METHOD"]=="GET" || $_POST["numero"]==$siguienteNumero){
                        if($_SESSION["sesionPerfilUsuario"]==5){
                             echo $_SESSION["sesionNombreUsuario"];
                             echo "<input name='idRelator' type='hidden' value='".$_SESSION["idUsuario"]."'>"; 
                        }else{
                            echo "<select name='idRelator'> <option value=''>---</option>";
                            $relatores= getRelatoresSesion();
                            foreach ($relatores as $rel) {
                                if($rel["idUsuario"]==$datos["idRelator"]){
                                    echo "<option selected value='".$rel["idUsuario"]."'>".$rel["nombreEmpleadoKlein"]." ".$rel["apellidoPaternoEmpleadoKlein"]." ".$rel["apellidoMaternoEmpleadoKlein"]."</option>";
                                }else{
                                    echo "<option value='".$rel["idUsuario"]."'>".$rel["nombreEmpleadoKlein"]." ".$rel["apellidoPaternoEmpleadoKlein"]." ".$rel["apellidoMaternoEmpleadoKlein"]."</option>";
                                }
                            }
                            echo "</select>";    
                        }
                    }else{
                        echo getDatosEmpleadoKlein($datos["idRelator"])["nombreParaMostrar"];
                    }
                    ?>
                </td>
            </tr>
        </table>
        <br>

        <table id="capitulos-programados" style="font-size:14px;">
            <tr class="cap" data-index="0">
                <td><h4>Cap&iacute;tulos Programados:</h4></td>
                <td>
                    Cap&iacute;tulo <input onChange='resetTalleres()' style="width:32px;font-size:14px;" name="numeroCapitulo-0" type="number" min=1>
                </td>
                <td>
                    <input type="button" class="mas" style="height:30px;" onClick="masCapitulo()" value="+" />
                    <!--<input type="button" class="menos" style="float:right;height:30px;" onClick="menosCapitulo()" value="-" />-->
                </td>
            </tr>
        </table>
        <br>
        <br>

        <h3 style="font-size:14px;" >Trabajo Realizado:</h3>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>Taller</th>
                    <th>Cap&iacute;tulo</th>
                </tr>
            </thead>
            <tbody id="espacio-talleres">

                <!--insercion de codigo-->
            </tbody>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="masTaller()" style="height:25px;" value="+" />
                </td>
            </tr>
        </table>

        <br>
        <br>
        <h3 style="font-size:14px;">Justificaci&oacute;n del trabajo no realizado:</h3>
        <textarea name="justificaNoRealizado" style="width:100%;height:50px;resize:none;"><?php echo $detalle["justificacionNoRealizadoSesion"]; ?></textarea>
        <br>
        <?php 
            print_r($detalle);
        ?> 
        <br>
        <h3 style="font-size:14px;">Datos esenciales de la Relator&iacute;a</h3>
        <p style="font-size:12px; width:60%;float:left;">&iquest;Los docentes presentan dificultades respecto de temas matem&aacute;ticos y/o did&aacute;cticos en estudio?</p>
        <table>
            <tr>
                <td>Si <input onChange="difChange()" <?php if($detalle["dificultadesMatDidSesion"]){echo "checked";} ?> name="dificultades" value="1" type="radio"></td>
                <td style="width:10px;"> </td>
                <td>No <input onChange="difChange()" <?php if(array_key_exists("dificultadesMatDidSesion", $detalle) && !$detalle["dificultadesMatDidSesion"]){echo "checked";} ?> name="dificultades" value="0" type="radio"></td>
            </tr>
        </table>
        <br>
        <div id="dificultades-si" style="display:none;">
            <h4>Matem&aacute;tico:</h4>
            <textarea name="difMatematicas" style="width:100%;height:50px;resize:none;"></textarea>
            <h4>Did&aacute;ctico:</h4>
            <textarea name="difDidactico" style="width:100%;height:50px;resize:none;"></textarea>
        </div>
        <br />
        <br />
        <table id="docentesDestacados" style="font-size:14px;">
            <tr class="docente-destacado" data-index2="0">
                <td style="font-size:12px;">Docentes con participaci&oacute;n destacada:</td>
                <td>
                    <select style="font-size:14px;" name="destacado-0">
                        <option value="">---</option>
                        <?php 
                            $profesores = getAlumnosCurso($_SESSION["sesionIdCurso"]);
                            $strProfesores = "";
                            foreach ($profesores as $prof){

                                $strProfesores.="<option value='".$prof["idUsuario"]."'>".$prof["nombreCompleto"]."</option>";
                            }
                            echo $strProfesores;

                        ?>
                        
                    </select>
                </td>
                <td>
                    <input type="button" class="masDestacado" style="height:30px;float:right;" onClick="masDestacado()" value="+" />
                    <input type="button" class="menosDestacado" style="height:30px;" onClick="menosDestacado(0)" value="-" />
                </td>
            </tr>
        </table>
        <br />
        <table id="docentesDebiles" style="font-size:14px;">
            <tr class="docente-debil" data-index3="0">
                <td style="font-size:12px;">Docentes que presentan debilidades:</td>
                <td>
                    <select style="font-size:14px;" name="debil-0">
                        <option value="">---</option>
                        <?php echo $strProfesores; ?>
                    </select>
                </td>
                <td>
                    <input type="button" class="masDebil" style="height:30px;float:right;" onClick="masDebil()" value="+" />
                    <input type="button" class="menosDebil" style="height:30px;" onClick="menosDebil(0)" value="-" />
                </td>
            </tr>
        </table>
        <br>
        <br>
        <h3 style="font-size:14px;">Implementaci&oacute;n del M&eacute;todo</h3>
        <br>
        <p style="font-size:12px; width:60%;float:left;">&iquest;Los docentes mencionan situaciones o problem&aacute;ticas en relaci&oacute;n a aspectos did&aacute;cticos o pedag&oacute;gicos surgidos durante la implementaci&oacute;n?</p>
        <table>
            <tr>
                <td>Si <input onChange="sitChange()" name="situaciones" value="1" type="radio"></td>
                <td style="width:10px;"> </td>
                <td>No <input onChange="sitChange()" name="situaciones" value="0" type="radio"></td>
            </tr>
        </table>
        <br>
        <br>
        <div id="situacion-si" style="display:none;">
            <textarea name="situacionPedagogica" placeholder="&iquest;Cu&aacute;les?" style="width:100%;height:50px;resize:none;"></textarea>
        </div>
        <br>
        <br>
        <p style="font-size:12px; width:60%;float:left;">&iquest;Los docentes mencionan situaciones o problem&aacute;ticas en relaci&oacute;n a aspectos institucionales que afectan la implementaci&oacute;n?</p>
        <table>
            <tr>
                <td>Si <input onChange="instChange()" name="institucionales" value="1" type="radio"></td>
                <td style="width:10px;"> </td>
                <td>No <input onChange="instChange()" name="institucionales" value="0" type="radio"></td>
            </tr>
        </table>
        <br>
        <br>
        <div id="institucionales-si" style="display:none;">
            <textarea name="situacionInstitucional" placeholder="&iquest;Cu&aacute;les?" style="width:100%;height:50px;resize:none;"></textarea>
        </div>
        <br>
        <br>
        
        <input type="submit" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="enviarInforme()" value="Enviar" />
        
		<br />
        <br />
        <br />
    </form>

	
    <script type="text/javascript">
        var indiceCapitulo = 0;
        var indiceDestacado = 0;
        var indiceDebil = 0;
        var indiceTaller = 0;

        $( document ).ready(function(){
            $(function() {
                $( "#datepicker" ).datepicker();
            });
        });

        function verificaJustificacion(){

        }
        function difChange(){
            if( $("input[name=dificultades]:checked").val()=="1" ){
                $("#dificultades-si").show();
            }else{
                $("#dificultades-si").hide();
            }
        }
        function sitChange(){
            if($("input[name=situaciones]:checked").val()=="1"){
                $("#situacion-si").show();
            }else{
                $("#situacion-si").hide();
            }
        }
        function instChange(){
            if($("input[name=institucionales]:checked").val()=="1"){
                $("#institucionales-si").show();
            }else{
                $("#institucionales-si").hide();
            }
        }

        function masTaller(){
            indiceTaller++;
            flag = true;
            strSelect = "<td><select name='taller-"+indiceTaller+"'>";
            $(".cap").each(function(){
                num = $(this).find("input[type=number]").val();
                if(num!=""){
                    strSelect += "<option value='"+num+"'>Cap&iacute;tulo "+num+"</option>";
                }else{
                    flag=false;
                }
            });
            strSelect += "</select></td>";
            if(flag){
                $("#espacio-talleres").append("<tr><td>Taller "+indiceTaller+"</td>"+strSelect+"</tr>");
            }else{
                alert("Todos los capítulos agregados deben ser llenados.");
            }
            verificarJustificacion();
        }
        function masCapitulo(){
            indiceCapitulo++;
            resetTalleres();
            $('.mas').hide();
            $("#capitulos-programados").append("<tr class='cap' onChange='resetTalleres()' data-index='"+indiceCapitulo+"'><td></td><td>Cap&iacute;tulo <input style='width:32px;font-size:14px;' class='numero-capitulo' name='numeroCapitulo-"+indiceCapitulo+"' type='number' min=1></td><td><input type='button' class='mas' style='float:right;height:30px;' onClick='masCapitulo()' value='+' /><input type='button' class='menos' style='height:30px;' onClick='menosCapitulo("+indiceCapitulo+")' value='-' /></td></tr>");
        }
        function masDestacado(){
            indiceDestacado++;
            $('.masDestacado').hide();
            $("#docentesDestacados").append("<tr class='docente-destacado' data-index2='"+indiceDestacado+"'><td></td><td><select style='font-size:14px;' name='destacado-"+indiceDestacado+"'><option value=''>---</option><?php echo $strProfesores; ?></select></td><td><input type='button' class='masDestacado' style='height:30px;float:right;' onClick='masDestacado()' value='+' /><input type='button' class='menosDestacado' style='height:30px;' onClick='menosDestacado("+indiceDestacado+")' value='-' /></td></tr>");
        }
        function menosDestacado(num){
            if( $("tr.docente-destacado").length > 1 ){


                $("tr[data-index2="+num+"]").remove();
                for (var i = num+1; i <= indiceDestacado; i++) {

                    $("tr[data-index2="+i+"] input.menosDestacado").attr("onClick","menosDestacado("+(i-1)+")");
                    $("tr[data-index2="+i+"] select").attr("name","destacado-"+(i-1));
                    $("tr[data-index2="+i+"]").attr("data-index2",(i-1));

                };
                indiceDestacado--;
                if(num == indiceDestacado+1){
                    $("tr[data-index2="+(num-1)+"] input.masDestacado").show();
                }
                if(num == 0){
                    $("tr[data-index2=0] td").first().html("<h4>Docentes con participaci&oacute;n destacada:</h4>");
                }
            }else{
                $("tr[data-index2=0] option").first().prop("selected","selected");  
            }
        }


        function masDebil(){
            indiceDebil++;
            $('.masDebil').hide();
            $("#docentesDebiles").append("<tr class='docente-debil' data-index3='"+indiceDebil+"'><td></td><td><select style='font-size:14px;' name='debil-"+indiceDebil+"'><option value=''>---</option><?php echo $strProfesores; ?></select></td><td><input type='button' class='masDebil' style='height:30px;float:right;' onClick='masDebil()' value='+' /><input type='button' class='menosDebil' style='height:30px;' onClick='menosDebil("+indiceDebil+")' value='-' /></td></tr>");
        }
        function menosDebil(num){
            if( $("tr.docente-debil").length > 1 ){


                $("tr[data-index3="+num+"]").remove();
                for (var i = num+1; i <= indiceDebil; i++) {

                    $("tr[data-index3="+i+"] input.menosDebil").attr("onClick","menosDebil("+(i-1)+")");
                    $("tr[data-index3="+i+"] select").attr("name","debil-"+(i-1));
                    $("tr[data-index3="+i+"]").attr("data-index3",(i-1));

                };
                indiceDebil--;
                if(num == indiceDebil+1){
                    $("tr[data-index3="+(num-1)+"] input.masDebil").show();
                }
                if(num == 0){
                    $("tr[data-index3=0] td").first().html("<h4>Docentes con participaci&oacute;n destacada:</h4>");
                }
            }else{
                $("tr[data-index3=0] option").first().prop("selected","selected");
            }
        }


        function resetTalleres(){
            indiceTaller = 0;
            $("#espacio-talleres").html("");
        }
        function menosCapitulo(num){
            resetTalleres();
            $("tr[data-index="+num+"]").remove();
            for (var i = num+1; i <= indiceCapitulo; i++) {

                $("tr[data-index="+i+"] input.menos").attr("onClick","menosCapitulo("+(i-1)+")");
                $("tr[data-index="+i+"] input.numero-capitulo").attr("name","numeroCapitulo-"+(i-1));
                $("tr[data-index="+i+"]").attr("data-index",(i-1));

            };
            indiceCapitulo--;
            if(num == indiceCapitulo+1){
                $("tr[data-index="+(num-1)+"] input.mas").show();
            }

        }
    
        $( document ).ready(function(){
            $("#cursoSelected").html( $("#cambiaCurso > option[value="+$("#cambiaCurso").val()+"]").html() );
        });
        $("#numeroSesion").change(function(){
            var sel = document.getElementById("columnaCentro");
            var a = "numero="+ $(this).val();
            AJAXPOST("recargarInformeSesion.php",a ,sel);
        });

        function enviarAsistencia(){
            var num = <?php echo count($profesores) ?>;
            if( $(".radio-asist:checked").length == num ){
                confirm("Se enviará la asistencia. Desea continuar?");
            }else{
                alert("Debe completar la asistencia de todos los profesores listados.");
            }
        }
    </script>
