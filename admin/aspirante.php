<?php 
global $cnx;
if (isset($_POST['enviar'])&& $_POST['enviar']=='Enviar' )
{
	$codigo = ob_get_contents(); 
	$codigo = (isset($_POST['miembros']))?addslashes($_POST['miembros']):''; 
	$name = $_POST["name"];
	$lastnm = $_POST["lastnm"];
	$email = $_POST["email"];
	$emailn = $_POST["emailn"];
	$instedu = $_POST["instedu"];
	$sitacad = $_POST["sitacad"];
	$subject = (isset($_POST["subject"]))?$_POST["subject"]:'';
	$pass_anterior = $_POST["passwd_a"];
	$pass_nuevo = $_POST["passwd_n"];
	$cpass_nuevo = $_POST["passwd_rn"];
	$query = $cnx->query("UPDATE usuario SET name = '$name', lastnm = '$lastnm' , instedu = '$instedu' , sitacad = '$sitacad', email = '$emailn'  WHERE email = '$email'");
	$query = $cnx->query("UPDATE ponencias SET nom_ponencia = '$subject', miembros = '$codigo' WHERE email = '$email'");
	echo '<div class="confirmacion" title= "Datos Generales"> Actualizado!</div>';
	if ($pass_nuevo == $cpass_nuevo) 
	{
		$query = $cnx->query("UPDATE usuario SET passwd = '$pass_nuevo' WHERE passwd = '$pass_anterior'");
		if ($query) echo '<div class="confirmacion" title= "Datos Generales"> Contrase&ntilde;a actualizada!</div>';
		else echo '<div class="confirmacion" title= "Datos Generales ERROR"> Contrase&ntilde;a anterior no corresponde al de la base de datos!</div>';
	}
	$_SESSION['user']==$_POST['emailn'];
}
$query = $cnx->query("SELECT name, lastnm, email,instedu,sitacad,tipusr FROM usuario WHERE email='".$_SESSION['user']."'");
$query->data_seek(0);
if($usuario_var = $query->fetch_assoc())
{
	$nombre=$usuario_var["name"];
	$apellidos=$usuario_var["lastnm"];
	$emailo=$usuario_var["email"];
	$inst=$usuario_var["instedu"];
	$sit=$usuario_var["sitacad"];
	$tipo=$usuario_var["tipusr"];
}
$query = $cnx->query("SELECT id,nom_ponencia,onsevd,situa,miembros,dates,hours FROM ponencias WHERE email='$emailo'");
$query->data_seek(0);
if($ponencia_var = $query->fetch_assoc())
{
	$ponencia=$ponencia_var["id"];
	$tema=$ponencia_var["nom_ponencia"];
	$observaciones=$ponencia_var["onsevd"];
	$situa=$ponencia_var["situa"];
	$miembros=$ponencia_var["miembros"];
	$dia=$ponencia_var["dates"];
	$hora=$ponencia_var["hours"];
}
else
{
	$tema=$observaciones=$dia=$hora=$situa=$miembros="";
}
?>
<style>
ul, li {
	margin:0;
	padding:0;
	list-style-type:none;
}
form ul li {
	margin:10px 20px;

}
</style>
<div class="maincontent left" id="content">
 <form action="" method="post">
	<script type="text/javascript">
	jQuery(function($){
		//variables
		var pass1 = $('[name=passwd_n]');
		var pass2 = $('[name=passwd_rn]');
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
	<ul>
		<li>
		<label for="nombre">Nombre completo:</label><br />
		<span><input id="nombre" name="name" size="50" type="text" value="<?php echo $nombre; ?>" placeholder="Nombre(s)"/></span><br />
		<span><input id="apellidos" name="lastnm" size="50" type="text" value="<?php echo $apellidos; ?>" placeholder="Apellido Paterno, Apellido Materno"/></span>
		</li>
		<li>
		<label for="almaMater">Institucion Educativa</label><br />
		<span><input id="almaMater" name="instedu" size="50" type="text" value="<?php echo $inst; ?>" placeholder="Institucion" /></span>
		</li>
		<li>
		<label for="estudios">Area de Estudio</label><br /><br />
		<span><input id="estudios" name="sitacad"  size="50" type="text" value="<?php echo $sit; ?>" placeholder="Grado o Area de Estudio" /></span>
		</li>
		<?php if($tipo==1){ ?>
		<li>
		<label for="tema">Titulo de la exposicion: </label><br />
		<span><input id="tema" name="subject" size="50" type="text"  value="<?php echo $tema; ?>" placeholder="Escribe el titulo o tema a exponer" /></span>
		</li>
		<?php } ?>
		<li>
		<label for="emailn">Correo electronico: </label><br />
		<span><input id="emailn" name="emailn" size="50" type="text"  value="<?php echo $emailo; ?>" placeholder="tucuenta@example.com" /></span>
		</li>
		<li>
		<label for="passwd_a">Contrase&ntilde;a Anterior: </label><br>
		<span><input id="passwd_a" name="passwd_a" size="50" type="password" min="6" max="10" placeholder="Escriba la contrase&ntilde;a" value=""></span>
		</li>
		<li>
		<label for="passwd_n">Contrase&ntilde;a Nueva: </label><br>
		<span><input id="passwd_n" name="passwd_n" size="50" type="password" min="6" max="10" placeholder="Escriba la contrase&ntilde;a nueva" value=""></span>
		</li>
		<li>
		<label for="passwd_rn">Repetir Contrase&ntilde;a Nueva: </label><br>
		<span><input id="passwd_rn" name="passwd_rn" size="50" type="password" min="6" max="10" placeholder="Escriba de nuevo la contrase&ntilde;a nueva" value=""></span>
		</li>
	</ul>
	<?php if($tipo==1) {?>
	<label>Miembros: </label><br /><textarea name="miembros" cols="20" rows="10"> $miembros </textarea><br />";
	<?php } ?>
	<input type="hidden" name="email" value="<?php echo $emailo; ?>" />
<input type="submit" name="enviar" value="Enviar">
</form>
</div>
<?php 
if($tipo==1){
	echo "
	<div class='maincontent right' id='content'>
	<table>
	<tbody>
	<tr><td style='vertical-align: top;'><h2>Observaciones</h2></td></tr>
	<tr><td>$observaciones</td></tr>
	";
	echo "<tr><td>Situacion: $situa<br />";
	if($ponencia_var["situa"]=="Se asigno horario de exposicion"){
		echo "Dia: $dia Hora: $hora <br />";
	}
	echo "</td></tr></tbody></table><hr>";
	include("./admin/archivos.php"); 
	echo '</div><p style="text-align: center;"></p>';
}
?>