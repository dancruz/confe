<?php 
if (isset($_POST['asignar'])&& $_POST['asignar']=='Asignar' ){
	$id = $_POST["id"];
	$nombre = $_POST["ponderacion"];
	$query = $cnx->query("UPDATE tipo_ponderacion SET ponderacion = '$nombre' WHERE id = $id");
	echo '<div class="confirmacion" title= "Tipo de Ponderacion"> Actualizado el Tipo de Ponderacion '.$nombre.'!</div>';
}
elseif (isset($_POST['agregar'])&& $_POST['agregar']=='Agregar' ){
	$id = $_POST["id"];
	$nombre = $_POST["ponderacion"];
	$query = $cnx->query("INSERT INTO tipo_ponderacion(ponderacion) VALUES ('$nombre')");
	echo '<div class="confirmacion" title= "Tipo de Ponderacion"> Agregado el Tipo de Ponderacion '.$nombre.'!</div>';
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
$query = $cnx->query("SELECT id FROM tipo_ponderacion");
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
  ?>
<script src="<?php echo $dir; ?>/content/js/sorting.js" ></script>
<div class="maincontent" id="content">
<ul class="temporary-button-showcase">
    <li><a class="button round blue image-right ic-add text-upper agregar">Agregar</a></li>
	<div class="dialog" title="Agregar Tipo de Ponderacion">
		<p class="validateTips"></p>
		<form action="index.php?module=tip.confe" method="POST" name="form">
			  <fieldset>
			  <label for="ponderacion">Nombre del Tipo de Ponderacion:</label>
			<input id="ponderacion" name="ponderacion" size="50" type="text" value="" placeholder="Tipo de Ponderacion" class="text ui-widget-content ui-corner-all"/>
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
					 <th>Nombre</th>
				 </tr>
				<ul id="organizar" class="sortable boxy">
				<tbody>
<?php 
$query = $cnx->query("SELECT id,ponderacion FROM tipo_ponderacion");
$query->data_seek(0);
while($qog = $query->fetch_assoc())
{
?>
					<tr>
					<td>
					<div>
					<a href="#" class="table-actions-button ic-table-edit opener<?php echo $qog['id'];?>"></a>
					<a href="#" class="table-actions-button ic-table-delete"></a>
					<div class="dialog<?php echo $qog['id'];?>" title="<?php echo $qog['ponderacion']; ?>">
							<p class="validateTips"></p>
							<form action="index.php?module=tip.confe" method="POST" name="form<?php echo $qog['id'];?>">
								 <fieldset>
									<label for="ponderacion">Nombre del Tipo de Ponderacion:</label>
									<input id="ponderacion" name="ponderacion" size="50" type="text" value="<?php echo $qog['ponderacion']; ?>" placeholder="Tipo de Ponderacion" class="text ui-widget-content ui-corner-all"/>
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
					<td><?php echo $qog['ponderacion']; ?></td>
					</tr>
<?php
}
?>
				</ul>
			</tbody>	
		</table>
	</div>
 </div>