<?php
$query = $cnx->query("SELECT nombre,opcion FROM configuracion");
$query->data_seek(0);
while($aviso_var = $query->fetch_assoc()){
	if ($aviso_var["nombre"]=='emailadmin')
	{
		$email = $aviso_var["opcion"]; 
	}
}
?>
<link rel="stylesheet" href="content/css/style.css" type="text/css" />
<form action="include/send.php" method="post">
  <fieldset id="email">
	<label for="email" >Ingresa tu direcci&oacute;n de correo electr&oacute;nico:</label>
	<input type="text" id="email" name="email" autocomplete="on" style="width:200px;" placeholder="Debe tener este formato :example@example.com"><input type="submit" name="enviar" value="Enviar">
	<p>Necesitas ayuda? <a href="mailo:<?php echo $email; ?>">Por favor, contacta al Soporte T&eacute;cnico</a>.</p>
  </fieldset>
</form>