<?php 
	
?>


<?php
$tipoCurso = getTipoCurso($_SESSION['sesionIdCurso']);
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


$homeCurso = array($coordinador_general,$profesor,$utp,$relator_tutor,$empleado_klein,$coordinador_general, $asesor);
$homeMural = array();
$curso = array();//array($coordinador_general, $asesor);
$mural = array($asesor, $profesor,$utp,$relator_tutor,$empleado_klein,$empleado_klein,$coordinador_general);
$recursos = array($asesor, $coordinador_general,$profesor,$utp,$relator_tutor,$empleado_klein);
$foros = array($asesor, $coordinador_general,$profesor,$utp,$relator_tutor);
$evaluacion = array($asesor, $coordinador_general,$profesor,$utp,$relator_tutor,$directivo);
$bitacora = array($asesor, $coordinador_general,$profesor,$utp,$directivo,$relator_tutor);
$resultados = array($asesor, $coordinador_general,$relator_tutor);
//$observacion =array($coordinador_general,$utp);
$informes = array($coordinador_general,$utp,$directivo,$asesor,$empleado_klein);
$informesUTP = array($asesor, $relator_tutor);
$informesSesion = array($relator_tutor, $asesor);
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
                <li><a href="informeBitacorasCurso.php<?php if ($_SESSION['sesionIdCurso']!="") echo  "?idCurso=".@$_SESSION["sesionIdCurso"]; ?>">Bitácora</a></li>

                <?php } if (in_array($idPerfil, $evaluacion) && $tipoCurso!="curso" && $tipoCurso != "") { ?>
                <li><a href="evaluacionHome.php">Evaluación</a></li>

				<?php } if (in_array($idPerfil, $resultados) && $tipoCurso == "curso") { ?>
                <li><a href="actividadescoordinacion.php">Resultados Actividades</a></li>

                <?php } if (in_array($idPerfil, $observacion)) { ?>
                <!--<li><a href="observacionClases.php">Observación de clases</a></li>-->

                <?php } if (in_array($idPerfil, $informesSesion) && $tipoCurso == "curso") { ?>
                <li><a href="#">Informe de Sesi&#243;n</a></li>

                <?php } if (in_array($idPerfil, $informesUTP) && $tipoCurso == "directivos") { ?>
                <li><a href="informes.php">Informes</a></li>

                <?php } if (in_array($idPerfil, $informes)) { ?>
                <li><a href="informes.php">Informes</a></li>
				<?php } ?>

            </ul>
        </div>
    </div>