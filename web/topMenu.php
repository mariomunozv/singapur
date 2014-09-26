

<?php
$tipoCurso = getTipoCurso($_SESSION['sesionIdCurso']);
//echo "tipo:".$tipoCurso;
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
//echo $idPerfil;
//Asignacion de permisos para limitacion del menu
//perfiles disponibles en la tabla Perfiles de la bd.
$profesor = 1;
$utp =3;
$profesor_utp=4;
$relator_tutor=5;
//$coordinador_nivel=7;
$coordinador_general=9;
$empleado_klein=20;
$directivo=21;
$alumno=22;
$asesor=23;
$visitante=24;


$homeCurso = array($coordinador_general,$profesor,$utp,$relator_tutor,$empleado_klein, $asesor,$visitante);
$homeMural = array();
$curso = array();//array($coordinador_general, $asesor);
$mural = array($asesor, $profesor,$utp,$relator_tutor,$empleado_klein,$empleado_klein,$coordinador_general,$visitante);
$recursos = array($asesor, $coordinador_general,$profesor,$utp,$relator_tutor,$empleado_klein,$visitante);
$foros = array($asesor, $coordinador_general,$profesor,$utp,$relator_tutor,$visitante);
$evaluacion = array($coordinador_general,$profesor,$utp,$directivo,$visitante);
$evaluacion_sin_directivos = array($asesor,$relator_tutor);
$resultados_evaluaciones = array($asesor, $relator_tutor);
$bitacora = array($profesor,$utp,$visitante,$directivo);
$resultados_bitacora = array($coordinador_general, $asesor,$relator_tutor);
$resultados = array($asesor, $coordinador_general,$relator_tutor);
//$observacion =array($coordinador_general,$utp);
$informes = array($coordinador_general,$directivo,$empleado_klein);
$informesUTP = array($asesor, $relator_tutor,$utp,$visitante);
$informesSesion = array($relator_tutor, $asesor, $empleado_klein, $coordinador_general);
$idCurso = $_SESSION["sesionIdCurso"];
?>
	<div id="cabecera">
    	<img src="img/header.jpg" width="950" height="170"> 
     	<div id="styletwo">
            <ul>
            	<?php if (in_array($idPerfil, $homeMural)) { ?>
			    <li><a href="mural.php?idCurso=<?php echo @$_SESSION["sesionIdCurso"]; ?>">Home</a></li>

			    <?php } if (in_array($idPerfil, $homeCurso)) { ?>
                <li><a href="curso.php?idCurso=<?php echo @$_SESSION["sesionIdCurso"]; ?>">Home</a></li>

                <?php } if (in_array($idPerfil, $curso)) { ?>
				<li><a href="curso.php?idCurso=<?php echo @$_SESSION["sesionIdCurso"]; ?>">Curso</a></li>

				<?php } if (in_array($idPerfil, $mural) && $tipoCurso != "nivel" && $tipoCurso != "" ) { ?>
	            <li><a href="mural.php?idCurso=<?php echo @$_SESSION["sesionIdCurso"]; ?>">Mural</a></li>

                <?php } if (in_array($idPerfil, $recursos)) { ?>
                <li><a href="recursos.php?idCurso=<?php echo @$_SESSION["sesionIdCurso"]; ?>">Recursos</a></li>

                <?php } if (in_array($idPerfil, $foros)) { ?>
                <li><a href="foro.php?idCurso=<?php echo @$_SESSION["sesionIdCurso"]; ?>">Foros</a></li>

		        <?php } if (in_array($idPerfil, $bitacora) && $tipoCurso!= "curso" && $tipoCurso !="") { ?>
                <li><a href="bitacora.php<?php if ($_SESSION['sesionIdCurso']!="") echo  "?idCurso=".@$_SESSION["sesionIdCurso"]; ?>">Bitácora</a></li>

                <?php } if (in_array($idPerfil, $resultados_bitacora) && $tipoCurso!= "directivos") { ?>
                <li><a href="resultadosBitacora.php<?php if ($_SESSION['sesionIdCurso']!="") echo  "?idCurso=".@$_SESSION["sesionIdCurso"]; ?>">Resultados Bitácora</a></li>

                <?php } if (in_array($idPerfil, $evaluacion) && $tipoCurso!="curso" && $tipoCurso != "") { ?>
                <li><a href="evaluacionHome.php">Evaluación</a></li>

                <?php } if (in_array($idPerfil, $evaluacion_sin_directivos) && $tipoCurso=="nivel" && $tipoCurso != "") { ?>
                <li><a href="evaluacionHome.php">Evaluación</a></li>

                <?php } if (in_array($idPerfil, $resultados_evaluaciones) && $tipoCurso=="curso" && $tipoCurso != "") { ?>
                <li><a href="resultadosEvaluaciones.php">Resultados Evaluaciones</a></li>

				<?php } if (in_array($idPerfil, $resultados) && $tipoCurso == "curso") { ?>
                <li><a href="actividadescoordinacion.php">Resultados Actividades</a></li>

                <?php } if (in_array($idPerfil, $observacion)) { ?>
                <!--<li><a href="observacionClases.php">Observación de clases</a></li>-->

                <?php } if (in_array($idPerfil, $informesSesion) && $tipoCurso == "curso") { ?>
                <li><a href="informesSesion.php">Informe de Sesi&#243;n</a></li>

                <?php } if (in_array($idPerfil, $informesUTP) && $tipoCurso == "directivos") { ?>
                <li><a href="informes.php">Informes</a></li>

                <?php } if (in_array($idPerfil, $informes)) { ?>
                <li><a href="informes.php">Informes</a></li>
				<?php } ?>

            </ul>
        </div>
    </div>