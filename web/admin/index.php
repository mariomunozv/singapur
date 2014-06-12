<?php
require("_head.php");

?>
<style type="text/css">
body{
	background-color:#096; 
	}
#login_panel{
	background-color: transparent;
	background-image: url("images/login_ftp.png");
	background-repeat: no-repeat;
	background-attachment: scroll;
	background-position: 0% 0%;
	position: absolute;
	top: 50%;
	left: 50%;
	width: 300px;
	height: 290px;
	padding-top: 170px;
	padding-right: 0pt;
	padding-bottom: 0pt;
	padding-left: 20px;
	margin-left: -150px;
	margin-top: -200px;
}
</style>
<script language="javascript">
document.getElementById("usuario").focus();

function verificar(){
	if(val_obligatorio("usuario") == false){ return; }
	if(val_obligatorio("clave") == false){ return; } 
	var division = document.getElementById("lugar_login"); 
	var a = $(".campos").fieldSerialize();
	
	AJAXPOST("_acceder.php",a,division);	
	
	
} 
</script>

<div id="login_panel"> 
	<div id="tabla_login">
           <div id="lugar_login"></div> 
        <table border="0" cellpadding="0" cellspacing="0">
        
        <tbody> 
        <tr height="25">
        <th align="left"><strong>Usuario:&nbsp;&nbsp;</strong></th>
        <td><input type="text" name="usuario" id="usuario" class="campos" size="20" ></td>
        </tr>
        <tr height="25">
        <th align="left"><strong>Clave:&nbsp;&nbsp;</strong></th>
        <td><input name="clave" id="clave" class="campos" size="20" type="password"></td>
        </tr>
        <tr height="30">
        <td colspan="2" style="padding-left:120px;">
        <a class="button" href="javascript:verificar();"><span><div class="refresh">ENTRAR</div></span></a> 
        </td>
        </tr>
        </tbody>
        </table> 
	</div>
	
</div> 
</body>
</html>
