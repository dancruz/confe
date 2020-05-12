<script>
$(function() {
	$( ".contra" ).dialog({
      autoOpen: false,
	  minHeight: 130,
	  minWidth: 340,
      show: "blind",
      hide: "blind"
    });
	
	$( ".ayuda" ).dialog({
      autoOpen: false,
	  minHeight: 130,
	  minWidth: 600,
      show: "blind",
      hide: "blind"
    });
 
    $( 'a[name="contra"]' ).click(function() {
      $( ".contra" ).dialog( "open" );
      return false;
    });
	$( 'a[name="ayuda"]' ).click(function() {
      $( ".ayuda" ).dialog( "open" );
      return false;
    });
	<?php
	include ("log.php");
	?>
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
		case 'descrip_cnfe':
			$nombrecnfe = $opcion['opcion'];
			break;
	}
}
?>
<div class="maincontent" id="content">
<?php echo $mensaje; ?>
<div class="ayuda" title="Ayuda (FAQ)"><?php include("ayuda.php"); ?></div>
<div class="contra" title="Olvide mi contrase&ntilde;a?"><?php include("reset.php"); ?></div>
<div class="menu" id="menu">    
<form action="index.php?action=login" method="post" name="formLogin" id="formLogin">
<label for="login">Usuario</label>
<input size="17" name="login" type="text" />
<label for="password">Contrase&ntilde;a</label>
<input size="17" name="password" type="password" />
<input type="submit" name="acceder" value="Acceder" />
<div id="error-list"></div>
<div id="highlight-list"></div>
<div class="clear">&nbsp;</div>
</form>
<div class="menusection">
<ul class="menulist">
<?php if ($inscripcion=='1') { echo '<li><a href="index.php?page=register">Registrar</a></li>'; } ?>
<li><a name="contra" href="#" >Olvide mi contrase&ntilde;a</a></li>
<li><a name="ayuda" href="#" >Ayuda (FAQ)</a></li>
</ul>
</div>
</div>
</div>