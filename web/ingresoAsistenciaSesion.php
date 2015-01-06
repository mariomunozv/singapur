<?php 
require("inc/incluidos.php");
require ("hd.php");
require("inc/_asistenciaSesion.php");
?>
<meta charset="iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    
    <form method="POST" action="guardarAsistenciaSesion.php" onSubmit="return enviarAsistencia()">
	<div id="columnaCentro">
        
		
        <p class="titulo_curso">Ingresar asistencia de sesi&oacute;n</p>
        <hr />
        <br />
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
                                $numSesiones = getNumerosSesionesCurso($_SESSION["sesionIdCurso"], $_SESSION["sesionIdUsuario"]);
                                $siguienteNumero = getSiguienteSesionesCurso($_SESSION["sesionIdCurso"]);
                                foreach ($numSesiones as $i) {
                                    echo "<option value='".$i."'>".$i."</option>";
                                }
                                echo "<option selected value='".$siguienteNumero."'>".$siguienteNumero." (nuevo)</option>";
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th style="font-size:14px;">Fecha de Sesi&oacute;n:</th>
                    <td><input placeholder="dd/mm/aaaa" name="fechaSesion" type="text" id="datepicker"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;width:120px;">Relator:</th>
                    <td>
                        <?php 

                        if($_SESSION["sesionPerfilUsuario"]==5){
                             echo $_SESSION["sesionNombreUsuario"];
                             echo "<input name='idRelator' type='hidden' value='".$_SESSION["sesionIdUsuario"]."'>"; 
                        }else{
                            echo "<select name='idRelator'>";
                            $relatores= getRelatoresSesion();
                            foreach ($relatores as $rel) {
                                echo "<option value='".$rel["idUsuario"]."'>".$rel["nombreEmpleadoKlein"]." ".$rel["apellidoPaternoEmpleadoKlein"]." ".$rel["apellidoMaternoEmpleadoKlein"]."</option>";
                            }
                            echo "</select>";    
                        }
                        ?>
                    </td>
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
                    //$profesores = getProfesoresAsistencia($idCurso);
                    $profesores = getAlumnosCurso($_SESSION["sesionIdCurso"]);
                    ordenar($profesores,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
                    $key = 0;
                    foreach ($profesores as $prof) {
                        if(empty($profesores[0])){
                            echo '<td colspan="6">No hay participantes en el curso.</td>';
                        }else{
                            $nombreP = getNombrePerfil($prof["idPerfil"]);
                            if($nombreP == "UTP" || $nombreP=="Profesor"){
                ?>
                <tr>
                    <td><?php echo $key+1;$key++; ?></td>
                    <td><?php echo $prof["nombreCompleto"]; ?></td>
                    <td><?php echo $nombreP; ?></td>
                    <td><?php echo getDatosColegio($prof["rbdColegio"])["nombreColegio"]; ?></td>
                    <td><input type="radio" class="radio-asist" value="1" name="asistencia-<?php echo $prof["idUsuario"] ?>"></td>
                    <td><input type="radio" class="radio-asist" value="0" name="asistencia-<?php echo $prof["idUsuario"] ?>"></td>
                </tr>
                <?php }}} ?>
            </tbody>
        </table>
        
        <input type="submit" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="Enviar Asistencia" />
        
		<br />
        <br />
        <br />
    </div> <!--columnaCentro-->
    </form>
	<?php 
    	
		require("pie.php");
		
    ?> 
    <script type="text/javascript">
        $( document ).ready(function(){
            $(function() {
                $( "#datepicker" ).datepicker();
            });
            $("#cursoSelected").html( $("#cambiaCurso > option[value="+$("#cambiaCurso").val()+"]").html() );
        });

        $("#numeroSesion").change(function(){
            var sel = document.getElementById("columnaCentro");
            var a = "numero="+ $(this).val();
            //alert(a);
            AJAXPOST("recargarAsistenciaSesion.php",a ,sel);
        });

        
        function enviarAsistencia(){
            var num = <?php echo count($profesores) ?>;
            if( $("#datepicker").val()!="" ){
                if( $(".radio-asist:checked").length == num ){
                    if(!confirm("Se enviar"+String.fromCharCode(225)+" la asistencia. Desea continuar?")){
                        return false;
                    }
                }else{
                    alert("Debe completar la asistencia de todos los profesores listados.");
                    return false;
                }
            }else{
                alert("Debe ingresar la fecha de la sesi"+String.fromCharCode(243)+"n.");
                $("#datepicker").focus();
                return false;
            }
        }
    </script>
</div><!--principal--> 
</body>
</html>