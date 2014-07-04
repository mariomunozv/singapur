<br />
<div class="titulo_div">Categorias de Foro</div>

<div class="info_div">
	<ul>
	<?php 
	 	@$idCurso = getCursoUs($_SESSION["sesionIdUsuario"]);
	   $res = getCategoriaCurso(@$idCurso); 
	 if (@mysql_num_rows($res) > 0 ){
		while($row = mysql_fetch_array($res)){
				?>
	 
			 <li> <a href="foroCategoria.php?idCategoria=<?php echo $row["idTemaCategoria"];?>&amp;flag=<?php echo 1; ?>">
					<?php echo $row["nombreTemaCategoria"];?></a>
			  </li>
	  
	  
	  
	  <?php } 
	  }else{	 ?>
	 
		  No hay ninguna categoría disponible por el momento.<br /></td>
	 
	  <?php	   }?>



  </ul>
 </div>      
