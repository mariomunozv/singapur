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
            <tr data-index="0">
                <td><h4>Cap&iacute;tulos Programados:</h4></td>
            
            
                <td>
                    Cap&iacute;tulo <input style="width:32px;font-size:14px;" name="numeroCapitulo-0" type="number" min=1>
                </td>
            
                <td>
                    <input type="button" class="mas" style="height:30px;" onClick="masCapitulo()" value="+" />
                    <!--<input type="button" class="menos" style="float:right;height:30px;" onClick="menosCapitulo()" value="-" />-->
                </td>
            </tr>
        </table>
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
        function masCapitulo(){
            indiceCapitulo++;
            $('.mas').hide();
            $("#capitulos-programados").append("<tr data-index='"+indiceCapitulo+"'><td></td><td>Cap&iacute;tulo <input style='width:32px;font-size:14px;' class='numero-capitulo' name='numeroCapitulo-"+indiceCapitulo+"' type='number' min=1></td><td><input type='button' class='mas' style='float:right;height:30px;' onClick='masCapitulo()' value='+' /><input type='button' class='menos' style='height:30px;' onClick='menosCapitulo("+indiceCapitulo+")' value='-' /></td></tr>");
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