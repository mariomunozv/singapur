<?php 
ini_set("display_errors","on");
require("inc/incluidos.php");
require("hd.php");
require("inc/_evaluacion.php");
$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil = $_SESSION["sesionPerfilUsuario"];
$rbdColegio = getRbdUsuario($idUsuario);
?>
<meta charset="iso-8859-1">
<body>
<div id="principal">
<?php 
    require("topMenu.php"); 
    $navegacion = "Home*curso.php?idCurso=$idCurso,Evaluacion*evaluacionHome.php,Descarga de Instrumentos*#";
    require("_navegacion.php");


?>
    
    <div id="lateralIzq">
        <?php require("menuleft.php");  ?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
        <?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    <div id="columnaCentro">
    <p class="titulo_curso">Evaluaciones de proceso</p>
    <hr /><br />
    <p class="textoBienvenida">  Atención: error en Ìtem 20 de la prueba de 3º básico, por favor revisar más detalles en Home.</p>
    <?php $grupos = getGruposEvaluaciones(); ?>
    <?php foreach ($grupos as $grupo) { ?>
    <?php $recursos = getEvaluacionGrupo($grupo["idGrupoEvaluacion"], $idUsuario); ?>
    <?php if(count($recursos[0]) >0 || count($recursos[1]) >0 || count($recursos[2]) >0){ ?>
        <div id="cajaCentralFondo" >
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                    <?php echo $grupo["nombreGrupoEvaluacion"]; ?>
                </p>
            </div>
            <ul>
                <li>
                    <ul >
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Prueba  </td>
                            <?php foreach($recursos[0] as $recurso){ ?>
                                <td width="50"><a href="<?php echo $recurso['urlEvaluacion']; ?>"><?php echo $recurso['nombreEvaluacion']; ?></a> - </td>
                            <?php } ?>
                          </tr>
                        </table>
                        </li>
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Pauta correcci&oacute;n</td>
                            <?php foreach($recursos[1] as $recurso){ ?>
                                <td width="50"><a href="<?php echo $recurso['urlEvaluacion']; ?>"><?php echo $recurso['nombreEvaluacion']; ?></a> - </td>
                            <?php } ?>
                          </tr>
                        </table> 
                        </li>
                        
                        <li>
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="150">Protocolo aplicaci&oacute;n</td>
                            <?php foreach($recursos[2] as $recurso){ ?>
                                <td width="50"><a href="<?php echo $recurso['urlEvaluacion']; ?>"><?php echo $recurso['nombreEvaluacion']; ?></a> - </td>
                            <?php } ?>
                          </tr>
                        </table> 
                        </li>
                    </ul>
                </li>
            </ul>
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
        </div>
        <br>
    <?php }} ?>
        
        <br>
        <center>
            <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('evaluacionHome.php','_self')">
                <span class="ui-button-text">Volver</span>
            </button>
        </center>
    </div> <!--columnaCentro-->

    <?php 
        
        require("pie.php");
    ?> 
 
</div><!--principal--> 
</body>
</html>