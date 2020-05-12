<?php 
if (isset($_POST['asignar'])&& $_POST['asignar']=='Asignar' ){
	$id = $_POST["id"];
	$nombre = $_POST["nom_tipoeval"];
	$valmin= $_POST["valmin"];
	$valmax= $_POST["valmax"];
	$query = $cnx->query("UPDATE tipo_evaluacion SET nom_tipoeval = '$nombre',valmin = '$valmin' , valmax = '$valmax' WHERE id = $id");
	echo '<div class="confirmacion" title= "tipo_evaluacion"> Actualizado el Tipo de evaluacion '.$nombre.'!</div>';
}
elseif (isset($_POST['agregar'])&& $_POST['agregar']=='Agregar' ){
	$id = $_POST["id"];
	$nombre = $_POST["nom_tipoeval"];
	$valmin= $_POST["valmin"];
	$valmax= $_POST["valmax"];
	$query = $cnx->query("INSERT INTO tipo_evaluacion(nom_tipoeval,valmin,valmax) VALUES ('$nombre','$valmin','$valmax')");
	echo '<div class="confirmacion" title= "tipo_evaluacion"> Agregado el Tipo de evaluacion '.$nombre.'!</div>';
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
$query = $cnx->query("SELECT id FROM tipo_evaluacion");
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
	<div class="dialog" title="Agregar Tipo de evaluacion">
		<p class="validateTips"></p>
		<form action="index.php?module=tip.confe" method="POST" name="form">
			  <fieldset>
			  <label for="nom_tipoeval">Nombre del Tipo de evaluacion:</label>
			<input id="nom_tipoeval" name="nom_tipoeval" size="50" type="text" value="" placeholder="Tipo de evaluacion" class="text ui-widget-content ui-corner-all"/>
			<label for="valmin">Valor Minimo:</label>
			<input id="valmin" name="valmin" size="50" type="text" value="" placeholder="Valor Minimo (Numero)" class="text ui-widget-content ui-corner-all"/>
			<label for="valmax">Valor Maximo:</label>
			<input id="valmax" name="valmax" size="50" type="text" value="" placeholder="Valor Maximo (Numero)" class="text ui-widget-content ui-corner-all"/>
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
					 <th>Valor Minimo</th>
					 <th>Valor Maximo</th>
				 </tr>
				<ul id="organizar" class="sortable boxy">
				<tbody>
<?php 
$query = $cnx->query("SELECT id,nom_tipoeval,valmin,valmax FROM tipo_evaluacion");
$query->data_seek(0);
while($qog = $query->fetch_assoc())
{
?>
					<tr>
					<td>
					<div>
					<a href="#" class="table-actions-button ic-table-edit opener<?php echo $qog['id'];?>"></a>
					<a href="#" class="table-actions-button ic-table-delete"></a>
					<div class="dialog<?php echo $qog['id'];?>" title="<?php echo $qog['nom_tipoeval']; ?>">
							<p class="validateTips"></p>
							<form action="index.php?module=tip.confe" method="POST" name="form<?php echo $qog['id'];?>">
								 <fieldset>
									<label for="nom_tipoeval">Nombre del Tipo de evaluacion:</label>
									<input id="nom_tipoeval" name="nom_tipoeval" size="50" type="text" value="<?php echo $qog['nom_tipoeval']; ?>" placeholder="Tipo de evaluacion" class="text ui-widget-content ui-corner-all"/>
									<label for="valmin">Valor Minimo:</label>
									<input id="valmin" name="valmin" size="50" type="text" value="<?php echo $qog['valmin']; ?>" placeholder="Valor Minimo (Numero)" class="text ui-widget-content ui-corner-all"/>
									<label for="valmax">Valor Maximo:</label>
									<input id="valmax" name="valmax" size="50" type="text" value="<?php echo $qog['valmax']; ?>" placeholder="Valor Maximo (Numero)" class="text ui-widget-content ui-corner-all"/>
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
					<td><?php echo $qog['nom_tipoeval']; ?></td>
					<td><?php echo $qog['valmin']; ?></td>
					<td><?php echo $qog['valmax']; ?></td>
					</tr>
<?php
}
?>
				</ul>
			</tbody>	
		</table>
	</div>
 </div>