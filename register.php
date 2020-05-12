<link rel="stylesheet" type="text/css" media="all" href="content/css/registro.css" />
<script>
$(function() {
<?php
if (isset($_POST['regis']) && $_POST['regis'] = 'Registrar'){
	if(($_POST["passwd"] == $_POST["cpasswd"]) && $_POST["email"] != "")
	{
		$query = $cnx->query("SELECT id FROM usuario WHERE email='".$_POST["email"]."'");
		$query->data_seek(0);
		if($query->fetch_assoc())
		{
			echo '$("<p>").text("Error, Correo ya escogido por otro usuario.").appendTo("#email-msg").asError(); $("#email-msg").css({ padding: "10px 0px 0px 0px" }); $("#email").focus();';
		}
		else
		{
			$passwd = $_POST['passwd'];
			$cpasswd = $_POST['cpasswd'];
			$name = $_POST['name'];
			$lastnm = $_POST['lastnm'];
			$email = $_POST['email'];
			$instedu = $_POST['instedu'];
			$sitacad = $_POST['sitacad'];

			$query=$cnx->query("INSERT INTO usuario (`passwd`,`name`,`lastnm`,`email`,`instedu`,`sitacad`) VALUES ('$passwd','$name','$lastnm','$email','$instedu','$sitacad')");
			if($query)
			{
				echo '$("<p>").text("Registro exitoso!").appendTo("#cnx-msg").asHighlight();$("#cnx-msg").css({ padding: "10px 0px 0px 0px" });';
				echo '$(location).attr("href","index.php");';
			}
			else 
			{
				echo '$("<p>").text("Error, Conexion invalida a la base de datos.").appendTo("#cnx-msg").asError(); $("#cnx-msg").css({ padding: "10px 0px 0px 0px" });';
			}
		}
	}
	else
	{
		echo '$("<p>").text("Password no coincide.").appendTo("#pswd-msg").asError(); $("#pswd-msg").css({ padding: "10px 0px 0px 0px" }); $("#pswd").focus();';
	}
}
elseif(isset($_POST['regre']))
{
	echo '$(location).attr("href","index.php");';
}
?>
});
</script>
<script type="text/javascript">
jQuery(function($){
	//variables
	var pass1 = $('[name=passwd]');
	var pass2 = $('[name=cpasswd]');
	var confirmacion = "Las contrase\xF1as si coinciden";
	var longitud = "La contrase\xF1a debe estar formada entre 6-10 caracteres (ambos inclusive)";
	var conf_long = "Las contrase\xF1as si coinciden pero debe estar formada entre 6-10 caracteres";
	var negacion = "No coinciden las contrase\xF1as";
	var vacio = "La contrase\xF1a no puede estar vacia";
	//oculto por defecto el elemento span
	var span = $('<span></span>').insertAfter(pass2);
	span.hide();
	//función que comprueba las dos contrase&ntilde;as
	function coincidePassword(){
		var valor1 = pass1.val();
		var valor2 = pass2.val();
		//muestro el span
		span.show().removeClass();
		//condiciones dentro de la función
		if(valor1 != valor2){
			span.text(negacion).addClass('negacion');	
		}
		if(valor1.length==0 || valor1==""){
			span.text(vacio).addClass('negacion');	
		}
		if((valor1.length<6 || valor1.length>10)){
			span.text(longitud).addClass('negacion');
		}
		if(valor1.length!=0 && valor1==valor2){
			if((valor2.length<6 || valor2.length>10))
			{
				span.text(conf_long).addClass('negacion');
			}
			else
			{
				span.text(confirmacion).addClass('confirmacion');
			}
		}
	}
	//ejecuto la función al soltar la tecla
	pass2.keyup(function(){
	coincidePassword();
	});
});
</script>
<div class="maincontent" id="content">
	<div id="cnx-msg"></div>
	<form name="registro" action="index.php?page=register" method="post" >
		<ul>
			<li>
			<label for="nombre">Nombre(s)</label>
			<span><input id="nombre" name="name" type="text" autofocus="autofocus" placeholder="Teclee su nombre o nombres"/></span>
			</li>
			<li>
			<label for="apellidos">Apellido(s)</label>
			<span><input id="apellidos" name="lastnm" type="text" placeholder="Apellido Paterno, Apellido Materno"/></span>
			</li>
			<li>
			<label for="email">Direcci&oacute;n de Correo Electr&oacute;nico</label>
			<span><div id="email-msg"></div></span>
			<span><input id="email" name="email" type="text" placeholder="Debe tener este formato :example@example.com"/></span>
			</li>
			<li>
			<label for="almaMater">Instituci&oacute;n Educativa(s)</label>
			<span><input id="almaMater" name="instedu" type="text" placeholder="Escribe el nombre de la institucion" /></span>
			</li>
			<li>
			<label for="estudios">Grado de Estudios o &aacute;rea de Conocimiento</label>
			<span><input id="estudios" name="sitacad" type="text" placeholder="Escribe tu grado o area de estudio" /></span>
			</li>
			<li>
			<label for="pswd">Contrase&ntilde;a</label>
			<span><input id="pswd" name="passwd" type="password" min="6" max="10" placeholder="Escriba la contrase&ntilde;a" /></span>
			<span><div id="pswd-msg"></div></span>
			<span><input id="cpswd" name="cpasswd" type="password" min="6" max="10" placeholder="Vuelva a escribir la contrase&ntilde;a" /></span>
			</li>
			<li><button type="submit" name="regis"><span>Registrar</span></button>
			<button type="submit" name="regre"><span>Regresar</span></button>
			</li>
		</ul>
	</form>
</div>