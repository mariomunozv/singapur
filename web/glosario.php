<?php 
require("inc/incluidos.php");
require ("hd.php");

?>

<script type="text/javascript">
$(function() {
	$("#tabs").tabs({
		ajaxOptions: {
			error: function(xhr, status, index, anchor) {
				$(anchor.hash).html("No existen datos.");
			}
		}
	});
});
</script>

<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Glosario*#";	
	require("_navegacion.php");
?>
	
    <div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    
    
	<div id="lateralDer">
	    <?php require("menuright.php");	?>
	</div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     
		<div id="tabs">
            <ul>
        
                <?php 
                
            
                    if (isset($_REQUEST["idPalabra"])){
                        $tipoGlosario = "glosarioPalabra.php?idPalabra=".$_REQUEST["idPalabra"];
                    }
                    else{
                        if (isset($_REQUEST["idCurso"])){
                            $tipoGlosario = "glosarioCurso.php?idCurso=".$_REQUEST["idCurso"];
                        }
                        else{
                            $tipoGlosario = "glosarioCurso.php";
                        }
                    }

                ?>    
            
                <li><a href="<?php echo $tipoGlosario; ?>">Glosario</a></li>
                <li><a href="glosarioLetra.php?letra=a">A</a></li>
                <li><a href="glosarioLetra.php?letra=b">B</a></li>
                <li><a href="glosarioLetra.php?letra=c">C</a></li>
                <li><a href="glosarioLetra.php?letra=d">D</a></li>
                <li><a href="glosarioLetra.php?letra=e">E</a></li>
                <li><a href="glosarioLetra.php?letra=f">F</a></li>
                <li><a href="glosarioLetra.php?letra=g">G</a></li>
                <li><a href="glosarioLetra.php?letra=h">H</a></li>
                <li><a href="glosarioLetra.php?letra=i">I</a></li>
                <li><a href="glosarioLetra.php?letra=j">J</a></li>
                <li><a href="glosarioLetra.php?letra=k">K</a></li>
                <li><a href="glosarioLetra.php?letra=l">L</a></li>
                <li><a href="glosarioLetra.php?letra=m">M</a></li>
                <li><a href="glosarioLetra.php?letra=n">N</a></li>
                <li><a href="glosarioLetra.php?letra=ñ">Ñ</a></li>
                <li><a href="glosarioLetra.php?letra=o">O</a></li>
                <li><a href="glosarioLetra.php?letra=p">P</a></li>
                <li><a href="glosarioLetra.php?letra=q">Q</a></li>
                <li><a href="glosarioLetra.php?letra=r">R</a></li>
                <li><a href="glosarioLetra.php?letra=s">S</a></li>
                <li><a href="glosarioLetra.php?letra=t">T</a></li>
                <li><a href="glosarioLetra.php?letra=u">U</a></li>
                <li><a href="glosarioLetra.php?letra=v">V</a></li>
                <li><a href="glosarioLetra.php?letra=w">W</a></li>
                <li><a href="glosarioLetra.php?letra=x">X</a></li>
                <li><a href="glosarioLetra.php?letra=y">Y</a></li>
                <li><a href="glosarioLetra.php?letra=z">Z</a></li>
            </ul>
        </div> <!--tabs-->

			
    </div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
   </div>
</body>
</html>
