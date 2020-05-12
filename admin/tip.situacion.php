<?php 
if (isset($_POST['asignar'])&& $_POST['asignar']=='Asignar' ){
	$id = $_POST["id"];
	$nombre = $_POST["situacion"];
	$esrechazo= $_POST["esrechazo"];
	$esaprobado= $_POST["esaprobado"];
	$query = $cnx->query("UPDATE tipo_situacion SET situacion = '$nombre',esrechazo = '$esrechazo' , esaprobado = '$esaprobado' WHERE id = $id");
	echo '<div class="confirmacion" title= "tipo_situacion"> Actualizado el Tipo de situacion '.$nombre.'!</div>';
}
elseif (isset($_POST['agregar'])&& $_POST['agregar']=='Agregar' ){
	$id = $_POST["id"];
	$nombre = $_POST["situacion"];
	$esrechazo= $_POST["esrechazo"];
	$esaprobado= $_POST["esaprobado"];
	$query = $cnx->query("INSERT INTO tipo_situacion(situacion,esrechazo,esaprobado) VALUES ('$nombre','$esrechazo','$esaprobado')");
	echo '<div class="confirmacion" title= "tipo_situacion"> Agregado el Tipo de situacion '.$nombre.'!</div>';
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
$query = $cnx->query("SELECT id FROM tipo_situacion");
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
	<div class="dialog" title="Agregar Tipo de situacion">
		<p class="validateTips"></p>
		<form action="index.php?module=tip.confe" method="POST" name="form">
			  <fieldset>
			  <label for="situacion">Nombre del Tipo de situacion:</label>
			<input id="situacion" name="situacion" size="50" type="text" value="" placeholder="Tipo de situacion" class="text ui-widget-content ui-corner-all"/>
			<label for="esrechazo">Valor Minimo:</label>
			<input id="esrechazo" name="esrechazo" size="50" type="text" value="" placeholder="Valor Minimo (Numero)" class="text ui-widget-content ui-corner-all"/>
			<label for="esaprobado">Valor Maximo:</label>
			<input id="esaprobado" name="esaprobado" size="50" type="text" value="" placeholder="Valor Maximo (Numero)" class="text ui-widget-content ui-corner-all"/>
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
					 <th>Es rechazado</th>
					 <th>Es aprobado</th>
				 </tr>
				<ul id="organizar" class="sortable boxy">
				<tbody>
<?php 
$query = $cnx->query("SELECT id,situacion,esrechazo,esaprobado FROM tipo_situacion");
$query->data_seek(0);
while($qog = $query->fetch_assoc())
{
?>
					<tr>
					<td>
					<div>
					<a href="#" class="table-actions-button ic-table-edit opener<?php echo $qog['id'];?>"></a>
					<a href="#" class="table-actions-button ic-table-delete"></a>
					<div class="dialog<?php echo $qog['id'];?>" title="<?php echo $qog['situacion']; ?>">
							<p class="validateTips"></p>
							<form action="index.php?module=tip.confe" method="POST" name="form<?php echo $qog['id'];?>">
								 <fieldset>
									<label for="situacion">Nombre del Tipo de situacion:</label>
									<input id="situacion" name="situacion" size="50" type="text" value="<?php echo $qog['situacion']; ?>" placeholder="Tipo de situacion" class="text ui-widget-content ui-corner-all"/>
									<label for="esrechazo">Es rechazado:</label>
									<input id="esrechazo" name="esrechazo" size="50" type="text" value="<?php echo $qog['esrechazo']; ?>" placeholder="Valor Minimo (Numero)" class="text ui-widget-content ui-corner-all"/>
									<label for="esaprobado">Es aprobado:</label>
									<input id="esaprobado" name="esaprobado" size="50" type="text" value="<?php echo $qog['esaprobado']; ?>" placeholder="Valor Maximo (Numero)" class="text ui-widget-content ui-corner-all"/>
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
					<td><?php echo $qog['situacion']; ?></td>
					<td><?php echo $qog['esrechazo']; ?></td>
					<td><?php echo $qog['esaprobado']; ?></td>
					</tr>
<?php
}
?>
				</ul>
			</tbody>	
		</table>
	</div>
 </div>