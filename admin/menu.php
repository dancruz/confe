<?php 
if (isset($_POST['asignar'])&& $_POST['asignar']=='Asignar' ){
	$id = $_POST["id"];
	$menu = $_POST["menu"];
	$tipo = $_POST["tipo"];
	$depende = $_POST["depende"];
	$accion = $_POST["accion"];
	$usuario = "";
	foreach ($_POST["tipusr"] as $usr)
	{
		$usuario .= $usr.',';
	}
	$query = $cnx->query("UPDATE menu SET nom_menu = '$menu', tipmenu = '$tipo' , depende = '$depende' , accion = '$accion', tipusr = '$usuario'  WHERE id = $id");
	echo '<div class="confirmacion" title= "Menu"> Actualizado el menu '.$_POST['menu'].'!</div>';
}
elseif (isset($_POST['agregar'])&& $_POST['agregar']=='Agregar' ){
	$menu = $_POST["menu"];
	$tipo = $_POST["tipo"];
	$depende = $_POST["depende"];
	$accion = $_POST["accion"];
	$usuario = "";
	foreach ($_POST["tipusr"] as $usr)
	{
		$usuario .= $usr.',';
	}
	$query = $cnx->query("INSERT INTO menu(nom_menu,tipmenu,depende,accion,tipusr) VALUES ('$menu','$tipo','$depende','$accion','$usuario')");
	echo '<div class="confirmacion" title= "Menu"> Agregado el menu '.$_POST['menu'].'!</div>';
}
?>
<script>
    $(function() {
        $( "#organizar" ).sortable({
            revert: true
        });
        $( "#draggable" ).draggable({
            connectToSortable: "#sortable",
            helper: "clone",
            revert: "invalid"
        });
        $( "ul, li" ).disableSelection();
    });
    </script>
  <?php
  echo '<script>
  $.fx.speeds._default = 100;
  $(function() {';
$query = $cnx->query("SELECT id FROM menu");
$query->data_seek(0);
while($ids = $query->fetch_assoc())
{
echo '$( ".dialog'.$ids['id'].'" ).dialog({
      autoOpen: false,
	  minHeight: 290,
	  minWidth: 390,
      show: "blind",
      hide: "blind"
    });
 
    $( ".opener'.$ids['id'].'" ).click(function() {
      $( ".dialog'.$ids['id'].'" ).dialog( "open" );
      return false;
    });';
}
  echo '
  $( ".dialog" ).dialog({
      autoOpen: false,
	  minHeight: 290,
	  minWidth: 390,
      show: "blind",
      hide: "blind"
    });
 
    $( ".agregar" ).click(function() {
      $( ".dialog" ).dialog( "open" );
      return false;
    });
  
  });
  </script>';
  $select_menu = '';
  $query = $cnx->query("SELECT id, nom_menu FROM menu WHERE tipmenu='menu'");
  $query->data_seek(0);
  while($ids = $query->fetch_assoc())
  {
		$select_menu.='<option value="'.$ids['id'].'">'.$ids['nom_menu'].'</option>';
  }
  $select_tipusr = '';
  $query = $cnx->query("SELECT id, nom_usuario FROM tipo_usuario");
  $query->data_seek(0);
  while($ids = $query->fetch_assoc())
  {
		$select_tipusr.='<option value="'.$ids['id'].'">'.$ids['nom_usuario'].'</option>';
  }
  ?>
<script src="<?php echo $dir; ?>/content/js/sorting.js" ></script>
<div class="maincontent" id="content">
<ul class="temporary-button-showcase">
    <li><a class="button round blue image-right ic-add text-upper agregar">Agregar</a></li>
	<div class="dialog" title="Agregar Menu">
		<p class="validateTips"></p>
		<form action="index.php?module=menu" method="POST" name="form">
			  <fieldset>
			  <label for="menunombre">Nombre del Menu:</label>
			<input id="menunombre" name="menu" size="50" type="text" value="" placeholder="Nombre de Menu" class="text ui-widget-content ui-corner-all"/>
			<label for="tipo">Tipo de Menu:</label>
			<select name="tipo" placeholder="Selecciona el tipo de menu" class="select ui-widget-content ui-corner-all">
					<option value="menu" selected>Menu</option>
					<option value="submenu" >Submenu</option>
			</select><br />
			<label for="depende">Menu al que depende:</label>
			<select name="depende" placeholder="Selecciona el tipo de usuario permitidos para el menu" class="select ui-widget-content ui-corner-all">
				<?php echo $select_menu; ?>
			</select><br />
			<label for="hora">Accion:</label>
			<input id="estudios" name="sitacad"  size="50" type="text" placeholder="Nombre del archivo (sin '.php')" class="text ui-widget-content ui-corner-all" value=""/>
			<label for="tipsu">Tipo de Usuario permitidos:</label><br />
			<select name="tipusr[]" multiple="multiple" placeholder="Selecciona el tipo de usuario permitidos para el menu" class="select ui-widget-content ui-corner-all">
				<?php echo $select_tipusr; ?>
			</select>
			<br />
			<br />
			<br />
			<input style="margin-left:25%;" type="submit" name="agregar" value="Agregar" />
			</fieldset>
		</form>
			
	</div>
    <li><a class="button round blue image-right ic-refresh text-upper" onClick="document.location.reload(true)">Actualizar</a></li>
    <li><a class="button round blue image-right ic-search text-upper">Buscar</a></li>
  </ul>
	<div class="content-module-main" style="display: block;">
		<table>
			<thead>
				 <tr>
					 <th>Acciones</th>
					 <th>Menu</th>
					 <th>Tipo de menu</th>
					 <th>Menu al que depende</th>
					 <th>Accion</th>
					 <th>Tipo(s) de Usuario(s)</th>
				 </tr>
				<ul id="organizar" class="sortable boxy">
				<tbody>
<?php 
$query = $cnx->query("SELECT id,nom_menu,tipmenu,depende,accion,tipusr FROM menu");
$query->data_seek(0);
while($qog = $query->fetch_assoc())
{
?>
					<tr>
					<td>
					<div>
					<a href="#" class="table-actions-button ic-table-edit opener<?php echo $qog['id'];?>"></a>
					<a href="#" class="table-actions-button ic-table-delete"></a>
					<div class="dialog<?php echo $qog['id'];?>" title="<?php echo $qog['nom_menu']; ?>">
							<p class="validateTips"></p>
							<form action="index.php?module=menu" method="POST" name="form<?php echo $qog['id'];?>">
								 <fieldset>
									<label for="menunombre">Nombre del Menu:</label>
									<span><input id="menunombre" name="menu" size="50" type="text" value="<?php echo $qog['nom_menu'];?>" placeholder="Nombre de Menu" class="text ui-widget-content ui-corner-all"/></span>
									<label for="tipo">Tipo de Menu:</label>
									<select name="tipo" placeholder="Selecciona el tipo de menu" class="select ui-widget-content ui-corner-all">
											<option value="menu" <?php if($qog['nom_menu']=='menu') echo 'selected'; ?> >Menu</option>
											<option value="submenu" <?php if($qog['nom_menu']=='submenu') echo 'selected'; ?> >Submenu</option>
									</select><br />
									<label for="depende">Menu al que depende:</label>
									<select name="depende" placeholder="Selecciona el tipo de usuario permitidos para el menu" class="select ui-widget-content ui-corner-all">
										<?php echo $select_menu; ?>
									</select><br />
									<label for="accion">Accion:</label>
									<span><input id="accion" name="accion"  size="50" type="text" placeholder="Nombre del archivo (sin '.php')" class="text ui-widget-content ui-corner-all" value="<?php echo $qog['accion'];?>"/></span>
									<label for="tipsu">Tipo de Usuario permitidos:</label><br />
									<select name="tipusr[]" multiple="multiple" placeholder="Selecciona el tipo de usuario permitidos para el menu" class="select ui-widget-content ui-corner-all">
										<?php echo $select_tipusr; ?>
									</select>
									<br />
									<br />
									<br />
									<input type="hidden" name="id" value="<?php echo $qog['id'];?>" />
									<input style="margin-left:25%;" type="submit" name="asignar" value="Asignar" />
								</fieldset>
							</form>
								
						</div>
						</div>
						</td>
					<td><?php echo $qog['nom_menu']; ?></td>
					<td><?php echo $qog['tipmenu']; ?></td>
					<td><?php echo $qog['depende']; ?></td>
					<td><?php echo $qog['accion']; ?></td>
					<td><?php echo $qog['tipusr']; ?></td>
					</tr>
<?php
}
?>
				</ul>
			</tbody>	
		</table>
	</div>
 </div>