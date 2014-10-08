<?php 
require("inc/incluidos.php");
require ("hd.php");
require("inc/_visitaEscuela.php");

?>
<meta charset="iso-8859-1">
<link rel="stylesheet" href="./css/seccion-cajas.css" />
<body>
<div id="principal">
<?php 
    require("topMenu.php"); 
    $navegacion = "Informes*informes.php,Visita Escuela*visitaEscuela.php,Descargar Visita Escuela*#";
    require("_navegacion.php");
    $informes = getInfoVisitaUsuario($_SESSION["sesionIdUsuario"]);
?>
    
    <div id="lateralIzq">
        <?php require("menuleft.php");  ?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
        <?php require("menuright.php"); ?>
    </div><!--lateralDer-->
    
    
    <div id="columnaCentro">
     
        
        <p class="titulo_curso">Informes de Visita a Escuela: </p>
        <hr />
        <br />
   
        <div id="cajaCentralFondo" >
        
            <div id="cajaCentralTop">
                <p class="titulo_jornada">
                Informes disponibles
                </p>
            </div>
            
            <div id="textoJornada">
                <table class="tablesorter" id="tabla">
              <thead> 
                      
              <tr>
                <th>Colegio</th>
                <th>N&uacute;mero visita</th>
                <th>A&ntilde;o</th>
                <th>Asesor</th>
                <th></th>
              </tr>
              </thead>
              <tbody id="filtrado"> 
                <?php foreach ($informes as $inf) { ?>
                    <tr>
                        <td><?php echo $inf["nombreColegioVisitaEscuela"] ?></td>
                        <td> Visita n&ordm;<?php echo $inf["numeroVisitaEscuela"] ?></td>
                        <td><?php echo $inf["anoVisitaEscuela"] ?></td>
                        <td><?php echo $inf["nombreAsesorVisitaEscuela"] ?></td>
                        <td width="72">
                            <a href="informes/informeVisitaEscuela.php?v=<?php echo $inf['idVisitaEscuela'] ?>&tipo=resumen" target="_blank">
                                <img border="0" src="img/pdf.gif" width="14" height="14" alt="Descargar PDF" title="Descargar PDF" /> Resumen</a>
                            <?php if ($_SESSION["sesionTipoUsuario"]=="Asesor" || $_SESSION["sesionTipoUsuario"]=="Relator/Tutor" || $_SESSION["sesionTipoUsuario"]=="Coordinador General" || $_SESSION["sesionTipoUsuario"]=="Empleado Klein"){ ?>
                            <br />
                            <a href="informes/informeVisitaEscuela.php?v=<?php echo $inf['idVisitaEscuela'] ?>&tipo=completo" target="_blank">
                                <img border="0" src="img/pdf.gif" width="14" height="14" alt="Descargar PDF" title="Descargar PDF" /> Completo
                            </a>
                            <?php } ?>
                          
                        </td>
                    </tr> 
                <?php } ?>
             </tbody> <tr>  <?php if($_SESSION["sesionTipoUsuario"]=="Coordinador General"){ ?>
                             
                                 <div class='block-btn'>
               											 <input type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" onClick="window.open('/informes/informeExcelVisitaEscuela.php','_self')" value="Descargar informe excel" />
             					 </div>
                         <!--       <form class="descarga-excel">
                                    <input type="hidden" name="idVisita" value="<?php echo $inf['idVisitaEscuela']; ?>">
                                    <a href="/informes/informeExcelVisitaEscuela.php" target="blank">
                                        <img border="0" src="img/excel.png" width="14" height="14" alt="  Excel" title="Descargar Excel" /> Excel
                                    </a>
                                </form>-->
                                
                            <?php } ?>
                            </tr>
            </table>
            <br><br>

            </div>
            
            <div id="cajaCentralDown">
            &nbsp; 
            </div>
            
        </div> <!--cajaCentralFondo-->
        <br>
        
    </div> <!--columnaCentro-->

    <?php 
        
        require("pie.php");
        
    ?> 
    <script type="text/javascript">
        $('.descarga-excel').submit(function(e){
            var form = $(this);
            form.prop( "action", "./informes/informeExcelVisitaEscuela.php" );
        });
    </script>
 
</div><!--principal--> 
</body>
</html>