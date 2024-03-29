<?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require("inc/incluidos.php");
        require ("hd.php");
        require("inc/_asistenciaSesion.php");
    }
?>
<style type="text/css">
textarea{
    padding:3px;
    min-height:50px;
    resize:none;
    width: 98%;
}
textarea:disabled{
    background-color: #eee;
}
.error{
    border: 2px solid #d9534f;
    -webkit-box-shadow: 0px 0px 11px 0px #d9534f;
    -moz-box-shadow:    0px 0px 11px 0px #d9534f;
    box-shadow:         0px 0px 11px 0px #d9534f;
}
.select-destacados, .select-debiles{
    width:225px;
    font-size:14px;
}
</style>
<meta charset="iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<form method="POST" action="guardarInformeSesion.php">
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
                        $aux = getDatosEmpleadoKlein($datos["idRelator"]);
                        echo $aux["nombreParaMostrar"];
                        echo "<input type='hidden' name='idRelator' value".$datos["idRelator"].">";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <br>
        <table id="capitulos-programados" style="font-size:14px;">
            <?php
                $caps = split("[,]",substr($detalle["capitulosProgramadosSesion"],1,strlen($detalle["capitulosProgramadosSesion"])-2));
                $cant_caps = 0;
                if($caps[0]!=""){
                    foreach ($caps as $value) {
                        echo "<tr class='cap' onchange='resetTalleres()' data-index='$cant_caps'><td>";
                        if($cant_caps==0){
                            echo "<h4>Cap&iacute;tulos Programados:</h4>";
                        }
                        echo "</td>
                            <td>
                                Cap&iacute;tulo ";
                        
                        $capitulos = getCapitulos(getNivelCurso($_SESSION["sesionIdCurso"]));
                        echo "<select onChange='resetTalleres();validaCapitulos();' class='select-capitulos' name='numeroCapitulo-$cant_caps' style='width:200px;'>";
                        foreach ($capitulos as $cap) {
                            if($value == $cap["id"]){
                                echo "<option selected value='".$cap["id"]."'>".$cap["nombre"]."</option>";
                            }else{
                                echo "<option value='".$cap["id"]."'>".$cap["nombre"]."</option>";
                            }
                        }
                        echo "</select>";
                        //echo "<input onChange='resetTalleres()' value='$value' style='width:32px;font-size:14px;' name='numeroCapitulo-$cant_caps' type='number' min=1>";
                        echo "</td><td>";
                        if($cant_caps!=0){
                            echo "<input type='button' class='menos' style='height:30px;' onClick='menosCapitulo($cant_caps)' value='-' />";
                        }
                        if($cant_caps == count($caps)-1){
                            echo "<input type='button' class='mas' style='height:30px;' onClick='masCapitulo()' value='+' />";
                        }else{
                            echo "<input type='button' class='mas' style='height:30px; display:none;' onClick='masCapitulo()' value='+' />";
                        }
                        echo "</td>
                        </tr>";
                        $cant_caps++;
                    }
                }else{ ?>
                        <?php
                        echo "<tr class='cap' onchange='resetTalleres()' data-index='$cant_caps'>
                              <td>
                              <h4>Cap&iacute;tulos Programados:</h4>
                              </td>
                              <td>
                              Cap&iacute;tulo ";
                        $capitulos = getCapitulos(getNivelCurso($_SESSION["sesionIdCurso"]));
                        echo "<select class='select-capitulos' onChange='resetTalleres();validaCapitulos();' name='numeroCapitulo-$cant_caps' style='width:200px;'>";
                        $cant_caps++;
                        foreach ($capitulos as $cap) {
                            if($value == $cap["id"]){
                                echo "<option selected value='".$cap["id"]."'>".$cap["nombre"]."</option>";
                            }else{
                                echo "<option value='".$cap["id"]."'>".$cap["nombre"]."</option>";
                            }
                        }
                        echo "</select>";
                        //echo "<input onChange='resetTalleres()' value='$value' style='width:32px;font-size:14px;' name='numeroCapitulo-$cant_caps' type='number' min=1>";
                        echo "</td>";
                        ?>
                        <td>
                            <input type="button" class="mas" style="height:30px;" onClick="masCapitulo()" value="+" />
                        </td>
                    </tr>
                <?php }
            ?>
        </table>
        <br>
        <br>

        <h3 style="font-size:14px;" >Trabajo Realizado:</h3>
        <?php
            $talleres = split("[,]",substr($detalle["trabajoRealizadoSesion"],1,strlen($detalle["trabajoRealizadoSesion"])-2));
            $cant_talleres =0;
        ?>
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
        <textarea name="justificaNoRealizado"><?php echo $detalle["justificacionNoRealizadoSesion"]; ?></textarea>
        <br>
        <br>
        <h3 style="font-size:14px;">Datos esenciales de la Relator&iacute;a</h3>
        <p style="font-size:12px; width:70%;float:left;margin-right:55px;">&iquest;Los docentes presentan dificultades respecto de temas matem&aacute;ticos y/o did&aacute;cticos en estudio?</p>
        <table>
            <tr>
                <td>Si <input onChange="difChange()" <?php if($detalle["dificultadesMatDidSesion"]){echo "checked";} ?> name="dificultades" value="1" type="radio"></td>
                <td style="width:10px;"> </td>
                <td>No <input onChange="difChange()" <?php if(array_key_exists("dificultadesMatDidSesion", $detalle) && !$detalle["dificultadesMatDidSesion"]){echo "checked";} ?> name="dificultades" value="0" type="radio"></td>
            </tr>
        </table>
        <br>
        <div id="dificultades-si" <?php if(!$detalle["dificultadesMatDidSesion"]){echo "style='display:none;'";} ?> >
            <h4>Matem&aacute;tico:</h4>
            <textarea name="difMatematicas"><?php echo $detalle["matematicoSesion"]; ?></textarea>
            <h4>Did&aacute;ctico:</h4>
            <textarea name="difDidactico"><?php echo $detalle["didacticoSesion"]; ?></textarea>
        </div>
        <br />
        <br />
        <?php
            $profesores = getAlumnosCurso($_SESSION["sesionIdCurso"]);
            ordenar($profesores,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
            $cant_destacados = 0;
            $cant_debiles = 0;
            $strProfesores = "";
            foreach ($profesores as $prof){
                $nombreP = getNombrePerfil($prof["idPerfil"]);
                if($nombreP == "UTP" || $nombreP=="Profesor"){
                    $strProfesores.="<option value='".$prof["idUsuario"]."'>".$prof["nombreCompleto"]."</option>";
                }
            }
            //print_r( substr($detalle["participacionDestacadaSesion"],1,strlen($detalle["participacionDestacadaSesion"])-2) );
             if($detalle["participacionDestacadaSesion"]){
                
                 $rutDestacados = split("[,]",substr($detalle["participacionDestacadaSesion"],1,strlen($detalle["participacionDestacadaSesion"])-2));
             }
            $rutDebiles = split("[,]",substr($detalle["participacionDebilSesion"],1,strlen($detalle["participacionDebilSesion"])-2));
        ?>
        <table id="docentesDestacados" style="font-size:14px;">
            <?php 
                if($rutDestacados[0]!=""){
                    foreach ($rutDestacados as $rut){
                        echo "<tr class='docente-destacado' data-index2='".$cant_destacados."'><td style='font-size:12px;width:215px;'>";
                        if($cant_destacados==0){
                            echo "Docentes con participaci&oacute;n destacada:";
                        }
                        echo "</td><td><select class='select-destacados' onchange='validaDestacados()' style='font-size:14px;' name='destacado-".$cant_destacados."'><option value=''>---</option>";
                        foreach ($profesores as $prof){
                            $nombreP = getNombrePerfil($prof["idPerfil"]);
                            if($nombreP == "UTP" || $nombreP=="Profesor"){
                                if($prof["idUsuario"]==$rut){
                                    echo "<option selected value='".$prof["idUsuario"]."'>".$prof["nombreCompleto"]."</option>";
                                }else{
                                    echo "<option value='".$prof["idUsuario"]."'>".$prof["nombreCompleto"]."</option>";
                                }
                            }
                        }
                        echo "</select></td><td>";
                        if($cant_destacados== count($rutDestacados)-1){
                            echo "<input type='button' class='masDestacado' style='height:30px;float:right;' onClick='masDestacado()' value='+' />";
                        }
                        echo "<input type='button' class='menosDestacado' style='height:30px;' onClick='menosDestacado(".$cant_destacados.")' value='-' />
                              </td></tr>";
                        $cant_destacados++;
                    }
                    $cant_destacados--;
                }else{
            ?>
            <tr class="docente-destacado" data-index2="<?php echo $cant_destacados; ?>">
                <td style="font-size:12px;width:215px;">Docentes con participaci&oacute;n destacada:</td>
                <td>
                    <select class="select-destacados" onchange='validaDestacados()' style="font-size:14px;" name="destacado-<?php echo $cant_destacados; ?>">
                        <option value="">---</option>
                        <?php 
                            echo $strProfesores;
                        ?>
                    </select>
                </td>
                <td>
                    <input type="button" class="masDestacado" style="height:30px;float:right;" onClick="masDestacado()" value="+" />
                    <input type="button" class="menosDestacado" style="height:30px;" onClick="menosDestacado(<?php echo $cant_destacados; ?>)" value="-" />
                </td>
            </tr>
            <?php } $cant_destacados++; ?>
        </table>
        <br />
        <table id="docentesDebiles" style="font-size:14px;">
            <?php 
                if($rutDebiles[0]!=""){
                    foreach ($rutDebiles as $rut){
                        echo "<tr class='docente-debil' data-index3='".$cant_debiles."'><td style='font-size:12px;width:215px;'>";
                        if($cant_debiles==0){
                            echo "Docentes que presentan debilidades:";
                        }
                        echo "</td><td><select onchange='validaDebiles()' class='select-debiles' style='font-size:14px;' name='debil-".$cant_debiles."'><option value=''>---</option>";
                        foreach ($profesores as $prof){
                            $nombreP = getNombrePerfil($prof["idPerfil"]);
                            if($nombreP == "UTP" || $nombreP=="Profesor"){
                                if($prof["idUsuario"]==$rut){
                                    echo "<option selected value='".$prof["idUsuario"]."'>".$prof["nombreCompleto"]."</option>";
                                }else{
                                    echo "<option value='".$prof["idUsuario"]."'>".$prof["nombreCompleto"]."</option>";
                                }
                            }
                        }
                        echo "</select></td><td>";
                        if($cant_debiles== count($rutDebiles)-1){
                            echo "<input type='button' class='masDebil' style='height:30px;float:right;' onClick='masDebil()' value='+' />";
                        }
                        echo "<input type='button' class='menosDebil' style='height:30px;' onClick='menosDebil(".$cant_debiles.")' value='-' /></td></tr>";
                        $cant_debiles++;
                    }
                    $cant_debiles--;
                }else{
            ?>
            <tr class="docente-debil" data-index3="<?php echo $cant_debiles; ?>">
                <td style="font-size:12px;width:215px">Docentes que presentan debilidades:</td>
                <td>
                    <select class="select-debiles" onchange="validaDebiles" style="font-size:14px;" name="debil-<?php echo $cant_debiles; ?>">
                        <option value="">---</option>
                        <?php echo $strProfesores; ?>
                    </select>
                </td>
                <td>
                    <input type="button" class="masDebil" style="height:30px;float:right;" onClick="masDebil()" value="+" />
                    <input type="button" class="menosDebil" style="height:30px;" onClick="menosDebil(<?php echo $cant_debiles; ?>)" value="-" />
                </td>
            </tr>
            <?php } $cant_debiles++; ?>
        </table>
        <br>
        <br>
        <h3 style="font-size:14px;">Implementaci&oacute;n del M&eacute;todo</h3>
        <br>
        <p style="font-size:12px; width:80%;float:left;">&iquest;Los docentes mencionan situaciones o problem&aacute;ticas en relaci&oacute;n a aspectos did&aacute;cticos o pedag&oacute;gicos surgidos durante la implementaci&oacute;n?</p>
        <table>
            <tr>
                <td>Si <input onChange="sitChange()" <?php if($detalle["situacionPedagogicaSesion"]){echo "checked";} ?> name="situaciones" value="1" type="radio"></td>
                <td style="width:10px;"> </td>
                <td>No <input onChange="sitChange()" <?php if(array_key_exists("situacionPedagogicaSesion", $detalle) && !$detalle["situacionPedagogicaSesion"]){echo "checked";} ?> name="situaciones" value="0" type="radio"></td>
            </tr>
        </table>
        <br>
        <br>
        <div id="situacion-si" <?php if(!$detalle["situacionPedagogicaSesion"]){ echo "style='display:none;'";} ?> >
            <textarea name="situacionPedagogica" placeholder="&iquest;Cu&aacute;les?"><?php echo $detalle["cualSituacionPedagogicaSesion"]; ?></textarea>
        </div>
        <br>
        <br>
        <p style="font-size:12px; width:80%;float:left;">&iquest;Los docentes mencionan situaciones o problem&aacute;ticas en relaci&oacute;n a aspectos institucionales que afectan la implementaci&oacute;n?</p>
        <table>
            <tr>
                <td>Si <input onChange="instChange()" <?php if($detalle["situacionInstitucionalSesion"]){echo "checked";} ?> name="institucionales" value="1" type="radio"></td>
                <td style="width:10px;"> </td>
                <td>No <input onChange="instChange()" <?php if(array_key_exists("situacionInstitucionalSesion", $detalle) && !$detalle["situacionInstitucionalSesion"]){echo "checked";} ?> name="institucionales" value="0" type="radio"></td>
            </tr>
        </table>
        <br>
        <br>
        <div id="institucionales-si" <?php if(!$detalle["situacionInstitucionalSesion"]){ echo "style='display:none;'";} ?> >
            <textarea name="situacionInstitucional" placeholder="&iquest;Cu&aacute;les?"><?php echo $detalle["cualSituacionInstitucionalSesion"]; ?></textarea>
        </div>
        <br>
        <br>
        
        <input type="submit" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="enviarInforme()" value="Enviar" />
        
		<br />
        <br />
        <br />
    </form>

	
    <script type="text/javascript">
        var indiceCapitulo = <?php echo $cant_caps-1; ?>;
        var indiceDestacado = <?php echo $cant_destacados-1; ?>;
        var indiceDebil = <?php echo $cant_debiles-1; ?>;
        var indiceTaller = <?php echo $cant_talleres; ?>;
        var flagCaps = false;

        $( document ).ready(function(){
            $(function() {
                $( "#datepicker" ).datepicker();
            });
        });
        function validaCapitulos(){
            var capsTomados = [];
            $(".select-capitulos").each(function(){
                if(capsTomados.indexOf( $(this).val() )>=0){
                    $(this).addClass("error");
                }else{
                    capsTomados.push($(this).val());
                    $(this).removeClass("error");
                }
            });
        }
        function validaDestacados(){
            var destacadosTomados = [];
            $(".select-destacados").each(function(){
                if(destacadosTomados.indexOf( $(this).val() )>=0){
                    $(this).addClass("error");
                }else{
                    destacadosTomados.push($(this).val());
                    $(this).removeClass("error");
                }
            });
        }
        function validaDebiles(){
            var debilesTomados = [];
            $(".select-debiles").each(function(){
                if(debilesTomados.indexOf( $(this).val() )>=0){
                    $(this).addClass("error");
                }else{
                    debilesTomados.push($(this).val());
                    $(this).removeClass("error");
                }
            });
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
        function validarRealizado(){
            if(indiceTaller==0){
                flagCaps=false;
                $("textarea[name=justificaNoRealizado]").prop("disabled",""); ;
            }else{
                $("textarea[name=justificaNoRealizado]").prop("disabled","disabled");
                flagCaps = true;
                $(".cap select option:selected").each(function(){
                    if( $("#espacio-talleres select option:selected[value="+$(this).val()+"]").length ==0 ){
                        flagCaps=false;
                        $("textarea[name=justificaNoRealizado]").prop("disabled",""); ;
                    }
                });
            }
        }

        function masTaller(){
            indiceTaller+=1;
            flag = true;
            strSelect = "<td><select onchange='validarRealizado()' name='taller-"+indiceTaller+"'>";
            $(".cap").each(function(){
                num = $(this).find("select").val();
                if( $("#espacio-talleres input[type=number]").last().val()!=undefined ){
                    val = parseInt($("#espacio-talleres input[type=number]").last().val())+1;
                }else{
                    val = indiceTaller;
                }
                if(num!=""){
                    strSelect += "<option value='"+num+"'>"+$("option[value="+num+"]:selected").html()+"</option>";
                }else{
                    flag=false;
                }
            });
            strSelect += "</select></td>";
            if(flag){
                $("#espacio-talleres").append("<tr><td>Taller <input type='number' name='tallerN-"+indiceTaller+"' min='1' max='12' value='"+val+"'></td>"+strSelect+"</tr>");
                validarRealizado();
            }else{
                alert("Todos los capítulos agregados deben ser llenados.");
            }
            //verificarJustificacion();
        }
        function addTaller(taller, cap){
            indiceTaller=taller;
            flag = true;
            strSelect = "<td><select name='taller-"+indiceTaller+"'>";
            $(".cap").each(function(){
                num = $(this).find("select").val();
                if(num!=""){
                    if(num == cap){
                        strSelect += "<option selected value='"+num+"'>"+$("option[value="+num+"]:selected").html()+"</option>";
                    }else{
                        strSelect += "<option value='"+num+"'>"+$("option[value="+num+"]:selected").html()+"</option>";
                    }
                }else{
                    flag=false;
                }
            });
            strSelect += "</select></td>";
            $("#espacio-talleres").append("<tr><td>Taller <input type='number' name='tallerN-"+indiceTaller+"' min='1' max='12' value='"+indiceTaller+"'></td>"+strSelect+"</tr>");
        }
        function masCapitulo(){
            <?php 
            $strCap1=  "<select onChange='resetTalleres()' class='select-capitulos' name='numeroCapitulo-";
            $strCap2= "' style='width:200px;'>";
                foreach ($capitulos as $cap) {
                    $strCap2.= "<option value='".$cap["id"]."'>".$cap["nombre"]."</option>";
                }
                $strCap2.= "</select>";
            ?>
            indiceCapitulo++;
            $('.mas').hide();
            $("#capitulos-programados").append("<tr class='cap' onChange='resetTalleres();validaCapitulos();' data-index='"+indiceCapitulo+"'><td></td><td>Cap&iacute;tulo <?php echo $strCap1 ?>"+indiceCapitulo+"<?php echo $strCap2; ?></td><td><input type='button' class='mas' style='float:right;height:30px;' onClick='masCapitulo()' value='+' /><input type='button' class='menos' style='height:30px;' onClick='menosCapitulo("+indiceCapitulo+")' value='-' /></td></tr>");
            resetTalleres();
            validaCapitulos();
        }
        function masDestacado(){
            indiceDestacado++;
            $('.masDestacado').hide();
            $("#docentesDestacados").append("<tr class='docente-destacado' data-index2='"+indiceDestacado+"'><td style='width:215px;'></td><td><select class='select-destacados' style='font-size:14px;' onChange='validaDestacados()' name='destacado-"+indiceDestacado+"'><option value=''>---</option><?php echo $strProfesores; ?></select></td><td><input type='button' class='masDestacado' style='height:30px;float:right;' onClick='masDestacado()' value='+' /><input type='button' class='menosDestacado' style='height:30px;' onClick='menosDestacado("+indiceDestacado+")' value='-' /></td></tr>");
            validaDestacados();
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
                    $("tr[data-index2=0] td").first().html("<span style='font-size:12px;'>Docentes con participaci&oacute;n destacada:</span>");
                }
            }else{
                $("tr[data-index2=0] option").first().prop("selected","selected");  
            }
            validaDestacados();
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
                    $("tr[data-index3=0] td").first().html("<span style='font-size:12px;'>Docentes que presentan debilidades:</span>");
                }
            }else{
                $("tr[data-index3=0] option").first().prop("selected","selected");
            }
            validaDebiles();
        }
        function masDebil(){
            indiceDebil++;
            $('.masDebil').hide();
            $("#docentesDebiles").append("<tr class='docente-debil' data-index3='"+indiceDebil+"'><td style='width:215px;'></td><td><select class='select-debiles' onChange='validaDebiles()' style='font-size:14px;' name='debil-"+indiceDebil+"'><option value=''>---</option><?php echo $strProfesores; ?></select></td><td><input type='button' class='masDebil' style='height:30px;float:right;' onClick='masDebil()' value='+' /><input type='button' class='menosDebil' style='height:30px;' onClick='menosDebil("+indiceDebil+")' value='-' /></td></tr>");
            validaDebiles();
        }

        function resetTalleres(){
            indiceTaller = 0;
            flagCaps=false;
            $("#espacio-talleres").html("");
            validarRealizado();
        }
        function menosCapitulo(num){
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
            resetTalleres();
            validaCapitulos();
        }
    
        $( document ).ready(function(){
            $("#cursoSelected").html( $("#cambiaCurso > option[value="+$("#cambiaCurso").val()+"]").html() );

            var talleres_previos = "<?php echo $detalle['trabajoRealizadoSesion']; ?>";
            talleres_previos = talleres_previos.substr(1,talleres_previos.length-2).split(",");

             for (var i = 0; i < talleres_previos.length; i++) {
                if(talleres_previos[i].split(":").length ==2){
                    addTaller(talleres_previos[i].split(":")[0],talleres_previos[i].split(":")[1]);
                }
             };
            
                //masTaller(talleres_previos[val].split(":")[0],talleres_previos[val].split(":")[1]);
            
        });
        $("#numeroSesion").change(function(){
            var sel = document.getElementById("columnaCentro");
            var a = "numero="+ $(this).val();
            AJAXPOST("recargarInformeSesion.php",a ,sel);
        });
        function enviarInforme(){
            if( $("#datepicker").val()!="" ){
                if( $("select[name=idRelator]").val()!="" ){
                    if(flagCaps || $("textarea[name=justificaNoRealizado]").val()!=""){
                        if($("input[name=dificultades]:checked").length==1){
                            if( $("input[name=dificultades]:checked").val()==1 -($("textarea[name=difMatematicas]").val()=="" && $("textarea[name=difDidactico]").val()=="") ){
                                if( $("input[name=situaciones]:checked").length==1 ){
                                    if($("input[name=situaciones]:checked").val()!=1 || $("textarea[name=situacionPedagogica]").val()!=""){
                                        if( $("input[name=institucionales]:checked").length==1 ){
                                            if($("input[name=institucionales]:checked").val()!=1 || $("textarea[name=situacionInstitucional]").val()!=""){
                                                if($(".error").length == 0){
                                                    if(confirm("Se enviar\u00E1 la asistencia. Desea continuar?")){return 1;}
                                                }else{
                                                    $(".error").first().focus();
                                                    alert("Este campo debe ser \u00FAnico.")
                                                }
                                            }else{
                                                $("textarea[name=situacionInstitucional]").focus();
                                                alert("Especifique situaciones detectadas.");
                                            }
                                        }else{
                                            $("input[name=institucionales]").focus();
                                            alert("Debe llenar todos los datos.")
                                        }
                                    }else{
                                        $("textarea[name=situacionPedagogica]").focus();
                                        alert("Especifique situaciones detectadas.");
                                    }
                                }else{
                                    $("input[name=situaciones]").focus();
                                    alert("Debe llenar todos los datos.")
                                }
                            }else{
                                $("textarea[name=difMatematicas]").focus();
                                alert("Debe especificar cuales dificultades se detectaron.");
                            }
                        }else{
                            $("input[name=dificultades]").focus();
                            alert("Debe seleccionar si docentes presentan dificultades.");
                        }
                    }else{
                        $("textarea[name=justificaNoRealizado]").focus();
                        alert("Debe justificar el trabajo no realizado.")
                    }
                }else{
                    $("select[name=idRelator]").focus();
                    alert("Debe seleccionar un relator.");
                }
            }else{
                $("#datepicker").focus();
                alert("Debe ingresar la fecha de la sesi\u00F3n.");
            }
            event.preventDefault();
        }
    </script>
