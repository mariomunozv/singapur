<?php 
require("inc/incluidos.php");
require ("hd.php");
require("inc/_asistenciaSesion.php");
?>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="./css/seccion-cajas.css" />
<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Informes de Sesi&#243;n*informesSesion.php,Ingreso Informe*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
	<div id="columnaCentro">
     
		
        <p class="titulo_curso">Ingresar informe de sesi&oacute;n</p>
        <hr />
        <br />
        <h3>Datos generales</h3>
        <table style="font-size:14px;" class="tablesorter">
                <tr>
                    <th style="font-size:14px;">Curso:</th>
                    <td id="cursoSelected"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">N&deg; Sesi&oacute;n:</th>
                    <td id="numeroSesion"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;width:120px;">Relator:</th>
                    <td>
                        <select>
                            <?php 
                                $relatores= getRelatoresSesion();
                                foreach ($relatores as $rel) {
                                    echo "<option>".$rel["nombreEmpleadoKlein"]." ".$rel["apellidoPaternoEmpleadoKlein"]." ".$rel["apellidoMaternoEmpleadoKlein"]."</option>";
                                } 
                            ?>
                        </select>
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
        <textarea style="width:100%;height:50px;resize:none;"></textarea>
        <br>
        <br>
        <h3 style="font-size:14px;">Datos esenciales de la Relator&iacute;a</h3>
        <p style="font-size:12px; width:60%;float:left;">&iquest;Los docentes presentan dificultades respecto de temas matem&aacute;ticos y/o did&aacute;cticos en estudio?</p>
        <table>
            <tr>
                <td>Si <input onChange="difChange()" name="dificultades" value="1" type="radio"></td>
                <td style="width:10px;"> </td>
                <td>No <input onChange="difChange()" name="dificultades" value="0" type="radio"></td>
            </tr>
        </table>
        <br>
        <div id="dificultades-si" style="display:none;">
            <h4>Matem&aacute;tico:</h4>
            <textarea style="width:100%;height:50px;resize:none;"></textarea>
            <h4>Did&aacute;ctico:</h4>
            <textarea style="width:100%;height:50px;resize:none;"></textarea>
        </div>
        <div id="dificultades-no" style="display:none;">
        </div>
        <br>
        <br>
        
        <input type="button" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="enviarInforme()" value="Enviar" />
        
		<br />
        <br />
        <br />
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
    <script type="text/javascript">
        var indiceCapitulo = 0;
        var indiceTaller = 0;

        function verificaJustificacion(){

        }
        function difChange(){
            if( $("input[name=dificultades]:checked").val()=="1" ){
                $("#dificultades-si").show();
                $("#dificultades-no").hide();
            }else{
                $("#dificultades-si").hide();
                $("#dificultades-no").show();
            }
        }

        function masTaller(){
            indiceTaller++;
            flag = true;
            strSelect = "<td><select>";
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
            $("#numeroSesion").html("1");

        });

        function enviarAsistencia(){
            var num = <?php echo count($profesores) ?>;
            if( $(".radio-asist:checked").length == num ){
                confirm("Se enviará la asistencia. Desea continuar?")
            }else{
                alert("Debe completar la asistencia de todos los profesores listados.");
            }
        }
    </script>
</div><!--principal--> 
</body>
</html>