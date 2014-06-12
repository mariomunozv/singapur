<script>
function enviar(){
	
	document.forms[0].submit();
	}
function iSubmitEnter(oEvento, oFormulario){
     var iAscii;

     if (oEvento.keyCode)
         iAscii = oEvento.keyCode;
     else if (oEvento.which)
         iAscii = oEvento.which;
     else
         return false;

     if (iAscii == 13) document.forms[0].submit();

     return true;
} 

function CalcKeyCode(aChar) {
  var character = aChar.substring(0,1);
  var code = aChar.charCodeAt(0);
  return code;
}

function checkNumber(val) {
  var strPass = val.value;
  var strLength = strPass.length;
  var lchar = val.value.charAt((strLength) - 1);
  var cCode = CalcKeyCode(lchar);

  if ( (cCode < 48 || cCode > 57) && (cCode < 97 || cCode > 122) ) { 
    var myNumber = val.value.substring(0, (strLength) - 1);
    val.value = myNumber;
  }
  return false;
}

</script>
            <form id="form1" name="form1" method="post" action="sesion/login.php">
                <div class="titulo_div">Ingreso Usuario</div>
                <div class="info_div">Usuario</div> 
                <div class="info_div"><input type="text" name="usuario" id="usuario" onkeyup="javascript:checkNumber(this);" maxlength="8"/></div>  
                <div class="info_div">Password</div>  
                <div class="info_div"> <input type="password" name="password" id="password" onkeypress="iSubmitEnter(event, document.form1)" /></div>  
                <div class="info_div"><?php boton("Entrar", "enviar()"); ?><br /><br />
</div>    
            </form>   
      