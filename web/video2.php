<?php 
require("inc/incluidos.php");
require ("hd.php");
?>

<body>


<div id="principal">
<?php require("topMenu.php"); ?>
	
    <div id="lateralIzq">
    <?php 
		require("menuleft.php");
	?>
    </div> <!--lateralIzq-->
    
    
    
    <div id="lateralDer">
		<?php 		
		require("menuright.php");
	?>
    
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
    	<p class="titulo_curso">Video - </p>
        <hr /><br>

        
       <!-- <video width="320" height="240" controls>
          <source src="videos/Actividad_Virtual_1ro.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>-->
		<div id='my-video'></div>
		<script type='text/javascript'>
            jwplayer('my-video').setup({
                file: 'http://158.170.66.18/~desarrollo/singapur/videos/Actividad_Virtual_1ro_Basico.flv',
                width: '320',
                height: '240'
            });
        </script>
        
			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
 
</div><!--principal--> 
</body>
</html>
