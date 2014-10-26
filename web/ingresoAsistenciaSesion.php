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
	$navegacion = "Home*curso.php?idCurso=$idCurso,Informes de Sesi&#243;n*informesSesion.php,Ingreso Asistencia*#";
	require("_navegacion.php");


?>
	
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
	<div id="columnaCentro">
     
		
        <p class="titulo_curso">Ingresar asistencia de sesi&oacute;n</p>
        <hr />
        <br />
        <table style="font-size:14px;" class="tablesorter">
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
                <tr>
                    <th style="font-size:14px;">Curso:</th>
                    <td id="cursoSelected"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">N&deg; Sesi&oacute;n:</th>
                    <td id="numeroSesion"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">Fecha de Sesi&oacute;n:</th>
                    <td><input name="fechaVisita" type="text" id="datepicker"></td>
                </tr>
        </table>
        <br>
        <table class="tablesorter">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>NOMBRE</th>
                    <th>PERFIL</th>
                    <th>ESTABLECIMIENTO</th>
                    <th>PRESENTE</th>
                    <th>AUSENTE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $profesores = getProfesoresAsistencia($idCurso);
                    foreach ($profesores as $key => $prof) {
                ?>
                <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $prof["apellidoPaternoProfesor"]." ".$prod["apellidomaternoProfesor"]." ".$prof['nombreProfesor']; ?></td>
                    <td><?php echo $prof["tipoUsuario"]; ?></td>
                    <td><?php echo $prof["nombreColegio"]; ?></td>
                    <td><input type="radio" class="radio-asist" value="1" name="asistencia-<?php echo $prof["rutProfesor"] ?>"></td>
                    <td><input type="radio" class="radio-asist" value="0" name="asistencia-<?php echo $prof["rutProfesor"] ?>"></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <input type="button" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="enviarAsistencia()" value="Enviar Asistencia" />
        
		<br />
        <br />
        <br />
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
    <script type="text/javascript">
        $( document ).ready(function(){
            $(function() {
                $( "#datepicker" ).datepicker();
            });
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