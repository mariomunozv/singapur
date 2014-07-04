<?php
$idCursoCap = $_SESSION["sesionIdCurso"];
$nombreCurso = getNombreCortoCurso($idCursoCap);


?>
            <div class="titulo_div">Información de Sesión</div>
            <div class="info_div">
            <p align="center">Usted está navegando en: </p>
            <p align="center"><b><?php echo $nombreCurso; ?></b></p>
			<p align="center">
            <?php if(!esClProfesor($idUsuario)){ ?>
                <a href="fichaDocente.php">
                	<img  border="0" src="<?php echo "subir/fotos_perfil/th_".$_SESSION["sesionImagenUsuario"];?>" onerror="this.src='img/nophotoMini.jpg'"/>
                    
               		<br />
					<?php echo $_SESSION["sesionNombreUsuario"]; ?>
				</a>
                <?php } else {?>
                <a href="fichaDocenteCl.php">
                	<img  border="0" src="<?php echo "subir/fotos_perfil/th_".$_SESSION["sesionImagenUsuario"];?>" onerror="this.src='img/nophotoMini.jpg'" />
                    
               		<br />
					<?php echo $_SESSION["sesionNombreUsuario"]; ?>
				</a>
                <?php } ?>
              </p>  
            </div>   
            <div class="info_div"><p align="center">
            	<img src="img/mail.png" width="16" height="16" /><a href="bandeja.php?mostrar=recibidos"> <?php echo getMensajesSinLeerUsuario($_SESSION["sesionIdUsuario"]);?> Mensajes </a><br/>
				<img src="img/postit.jpg" width="16" height="16" /><a href="notificacionResumen.php"> <?php echo getNotificacionesSinLeer($_SESSION["sesionIdUsuario"]);?> Notificaciones </a>
            </div> 
            <div class="info_div"></div> 
            <div class="info_div"><p align="center"><a href="sesion/cierraSesion.php">Cerrar Sesión</a></p></div>      
    
        
        