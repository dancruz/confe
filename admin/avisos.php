<?php 
?>
 <div id="container">
<div class="maincontent" id="content">
<?php
if (isset($_POST['guardar_av'])&& $_POST['guardar_av']=='Guardar' ){
$codigo = ob_get_contents(); 
$codigo = addslashes($_POST['contenido']); 
$resultado=mysql_query('UPDATE conferencias SET opcion = \''.$codigo.'\' WHERE nombre = "aviso_principal";UPDATE conferencias SET opcion = "'.$_POST['habtipusr'].'" WHERE nombre="hab_tip_usur";',$cnx);
if ($resultado) {
echo '<p class="confirmacion"> Actualizado </p>';
}
}
?>
<form name="avisos" method="POST" action="avisos.php">
<?php
$rdopt = mysql_query("SELECT nombre,opcion FROM conferencias",$cnx);
echo '<p>Mensaje para la p&aacute;gina principal</p>';
while($ropt = mysql_fetch_row($rdopt)){
if ($ropt[0]=='aviso_principal'){
 echo '<textarea name="contenido" cols="100" rows="30">'.$ropt[1].'</textarea><br />';
}
else if($ropt[0]=='hab_tip_usur'){
?>
<p>Aparecer campo "Tipo de Usuario" 
<select name="habtipusr">
<option value="0" <?php if ($ropt[1]=='0') { echo 'selected'; } ?>>Inhabilitar</option>
<option value="1" <?php if ($ropt[1]=='1') { echo 'selected'; } ?>>Habilitar</option>
</select></p>
<?php
}
}
mysql_free_result($rdopt);
?>
<input type="submit" name="guardar_av" value="Guardar" />
</form>
 </div>
<?php
mysql_close();
?>