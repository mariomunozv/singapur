<?php $cursosUsuario = getCursosUsuario($_SESSION["sesionIdUsuario"]);?>
<div class="titulo_div">Mis Cursos:</div>

<div class="info_div">
    <ul>
		<?php 
        foreach ($cursosUsuario as $datosCurso){ 
        ?>
            <li>
            <a href="curso.php?idCurso=<?php echo $datosCurso["idCursoCapacitacion"];?>"><?php echo $datosCurso["nombreCortoCursoCapacitacion"];?></a>
            </li>
        <?php 
        }
        ?>
    </ul>
</div>        
      

