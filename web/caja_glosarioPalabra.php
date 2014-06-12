<?php $datosPalabra = getPalabraRandom();?>
<br />
<div class="titulo_div">Glosario</div>

<div class="info_div">
    <a href="glosario.php?idPalabra=<?php echo $datosPalabra["idPalabra"];?>">
    	<strong><?php echo $datosPalabra["nombrePalabra"];?>:</strong><br />
	</a>
		<?php echo $datosPalabra["definicionPalabra"];?>
	
</div>    

