
            <div class="titulo_div">Bienvenido!</div>
            <div class="info_div"><a href="miPerfil.php"><?php echo $nombre; ?></a></div>   
            <div class="info_div"><img src="img/mail.png" width="16" height="16" /><a href="bandeja.php"> <?php echo getMensajesSinLeerUsuario($idUsuario);?> Mensajes </a></div> 
            <div class="info_div"><a href="sesion/cierraSesion.php">Cerrar Sesión</a></div>      
    
        
        