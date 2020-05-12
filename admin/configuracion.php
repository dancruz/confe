<?php 
?>
<div class="maincontent" id="content">
<?php
if (isset($_POST['guardar_av'])&& $_POST['guardar_av']=='Guardar' ){
$codigo = ob_get_contents(); 
$codigo = addslashes($_POST['header']); 
$query = $cnx->query("UPDATE configuracion SET opcion = '$codigo' WHERE nombre = 'header_template';");
$codigo = addslashes($_POST['mensaje']); 
$query = $cnx->query("UPDATE configuracion SET opcion = '$codigo' WHERE nombre = 'mensaje';");
$codigo = addslashes($_POST['footer']); 
$query = $cnx->query("UPDATE configuracion SET opcion = '$codigo' WHERE nombre = 'footer_template';");
$query = $cnx->query("UPDATE configuracion SET opcion = '".$_POST['inscripcion']."' WHERE nombre='inscr_modulo';");
$query = $cnx->query("UPDATE configuracion SET opcion = '".$_POST['nombrecnfe']."' WHERE nombre='nombre_cnfe';");
$query = $cnx->query("UPDATE configuracion SET opcion = '".$_POST['email']."' WHERE nombre='emailadmin';");
echo '<div class="confirmacion" title= "Archivos"> Actualizado </div>';
}
?>
<script>
  $(function() {
    $( "#configuracion" ).accordion({
      heightStyle: "content"
    });
  });
  </script>
<?php
$query = $cnx->query("SELECT nombre,opcion FROM configuracion");
$query->data_seek(0);
while($opcion = $query->fetch_assoc()){
	switch($opcion['nombre'])
	{
		case 'header_template':
			$header = $opcion['opcion'];
			break;
		case 'inscr_modulo':
			$inscripcion = $opcion['opcion'];
			break;
		case 'emailadmin':
			$emailadmin = $opcion['opcion'];
			break;
		case 'footer_template':
			$footer = $opcion['opcion'];
			break;
		case 'mensaje':
			$mensaje = $opcion['opcion'];
			break;
		case 'nombre_cnfe':
			$nombrecnfe = $opcion['opcion'];
			break;
	}
}
?>
<form name="avisos" method="POST" action="index.php?module=configuracion">
	<div id="configuracion">
		<h3>Cabecera del sitio</h3>
		<div>
			<p>Edita la plantilla mediante el &aacute;rea HTML.</p>
			<textarea name="header" cols="100" rows="10"><?php echo $header; ?></textarea>
		</div>
		<h3>Mensaje en el Acceso</h3>
		<div>
			<p>Edita la plantilla mediante el &aacute;rea HTML.</p>
			<textarea name="mensaje" cols="100" rows="10"><?php echo $mensaje; ?></textarea>
		</div>
		<h3>Pie de p&aacute;gina del sitio</h3>
		<div>
			<p>Edita la plantilla mediante el &aacute;rea HTML.</p>
			<textarea name="footer" cols="100" rows="10"><?php echo $footer; ?></textarea>
		</div>
		<h3>Registrar</h3>
		<div>
			<p>Aparecer modulo Registrar</p>
			<select name="inscripcion" class="select ui-widget-content ui-corner-all">
				<option value="0" <?php if ($inscripcion=='0') { echo 'selected'; } ?>>Inhabilitar</option>
				<option value="1" <?php if ($inscripcion=='1') { echo 'selected'; } ?>>Habilitar</option>
			</select>
		</div>
		<h3>Nombre del Sitio</h3>
		<div>
			<p>Escriba el nombre del sitio, este aparecera en el titulo de la pagina</p>
			<input id="nombrecnfe" name="nombrecnfe" size="50" type="text"  value="<?php echo $nombrecnfe; ?>" />
		</div>
		<h3>Correo del Sitio</h3>
		<div>
			<p>Escriba el correo del administrador del sitio para futuras aclaraciones y dar un mejor soporte externo a sus usuarios</p>
			<input id="emailn" name="email" size="50" type="text"  value="<?php echo $emailadmin; ?>" placeholder="tucuenta@example.com" />
		</div>
	</div>
	<input type="submit" name="guardar_av" value="Guardar" />
</form>
 </div>