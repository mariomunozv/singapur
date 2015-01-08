<?php 
require("inc/incluidos.php");
require ("hd.php");
require("inc/_asistenciaSesion.php");
?>
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
                        $numSesiones = getNumerosSesionesCurso($_SESSION["sesionIdCurso"],$_SESSION["sesionIdUsuario"]);
                        $siguienteNumero = getSiguienteSesionesCurso($_SESSION["sesionIdCurso"]);
                        foreach ($numSesiones as $i) {
                            if($i==$_POST["numero"]){
                                echo "<option selected value='".$i."'>".$i."</option>";
                            }else{
                                echo "<option value='".$i."'>".$i."</option>";
                            }
                        }
                        if($siguienteNumero==$_POST["numero"]){
                            echo "<option selected value='".$siguienteNumero."'>".$siguienteNumero." (nuevo)</option>";
                        }else{
                            echo "<option value='".$siguienteNumero."'>".$siguienteNumero." (nuevo)</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <?php $datos = getDatosSesion($_SESSION["sesionIdCurso"], $_POST["numero"]); ?>
        <?php $asistencia = getAsistenciaSesion($_SESSION["sesionIdCurso"], $_POST["numero"]); ?>
        <?php $detalle = getDetalleSesion(); ?>
        <tr>
            <th style="font-size:14px;">Fecha de Sesi&oacute;n:</th>
            <td><input name="fechaSesion" value="<?php echo $datos['fechaSesion'] ?>" type="text" id="datepicker"></td>
        </tr>
        <tr>
            <th style="font-size:14px;width:120px;">Relator:</th>
            <td>
                <?php 

                if($_SESSION["sesionPerfilUsuario"]==5){
                     echo $_SESSION["sesionNombreUsuario"];
                     echo "<input name='idRelator' type='hidden' value='".$_SESSION["sesionIdUsuario"]."'>"; 
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
            <td><?php $key++;echo $key; ?></td>
            <td><?php echo $prof["nombreCompleto"]; ?></td>
            <td><?php echo getNombrePerfil($prof["idPerfil"]); ?></td>
            <td><?php 
            $datosColegio = getDatosColegio($prof["rbdColegio"]);
            echo ($prof["rbdColegio"]?  $datosColegio["nombreColegio"] :''); ?></td>
            <td><input <?php echo ($asistencia[$prof["idUsuario"]]? "checked":""); ?> type="radio" class="radio-asist" value="1" name="asistencia-<?php echo $prof["idUsuario"]; ?>"></td>
            <td><input <?php echo (!$asistencia[$prof["idUsuario"]]? "checked":""); ?> type="radio" class="radio-asist" value="0" name="asistencia-<?php echo $prof["idUsuario"] ?>"></td>
        </tr>
        <?php }}} ?>
    </tbody>
</table>

<input type="submit" style="float:right;" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="Enviar Asistencia" />

<br />
<br />
<br />
<script type="text/javascript">
$( document ).ready(function(){
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    $("#cursoSelected").html( $("#cambiaCurso > option[value="+$("#cambiaCurso").val()+"]").html() );
});
$("#numeroSesion").change(function(){
    var sel = document.getElementById("columnaCentro");
    var a = "numero="+ $(this).val()+"&curso=<?php echo $_SESSION['sesionIdCurso']; ?>&perfil=<?php echo $_SESSION['sesionPerfilUsuario']; ?>&nombre=<?php echo $_SESSION['sesionNombreUsuario']; ?>&usuario=<?php echo $_SESSION['sesionIdUsuario']; ?>";
    AJAXPOST("recargarAsistenciaSesion.php",a ,sel);
});

</script>
