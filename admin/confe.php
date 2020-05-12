<?php 

function tipoconferencia($val)
{
	$valores=array(1=>'Libre', 2=>'Ponencia', 3=>'Carteles', 4=>'Trabajo Artistico', 5=>'Otro');
	return $valores[$val];
}
if (isset($_POST['aceptar'])&& $_POST['aceptar']=='Aceptar' ){
	$id = $_POST["id"];
	$nombre = $_POST["nomconfe"];
	$descripcion = $_POST["descripcion"];
	$tipo = $_POST["tipo"];
	$fechainicio = $_POST["fechainicio"];
	$fechafinal = $_POST["fechafinal"];
	$query = $cnx->query("UPDATE conferencias SET nom_confe = '$nombre' , descripcion = '$descripcion', tipo = '$tipo', fecha_inicio = '$fechainicio' , fecha_final = '$fechafinal' WHERE id = '$id'");
	echo '<div class="confirmacion" title= "Conferencias"> Actualizada la conferencia '.$_POST["nomconfe"].'!</div>';
}
elseif (isset($_POST['agregar'])&& $_POST['agregar']=='Agregar' ){
	$nombre = $_POST["nomconfe"];
	$descripcion = $_POST["descripcion"];
	$tipo = $_POST["tipo"];
	$fechainicio = $_POST["fechainicio"];
	$fechafinal = $_POST["fechafinal"];
	$query = $cnx->query("INSERT INTO conferencias (nom_confe,descripcion,tipo,fecha_inicio,fecha_final) VALUES('$nombre','$descripcion','$tipo','$fechainicio','$fechafinal')");
	echo '<div class="confirmacion" title= "Conferencias"> Agregado la conferencia '.$_POST["nomconfe"].'!</div>';
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
		
		$(".exportar").click(function(e) {
			window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('.content-module-main').html()));
			e.preventDefault();
		});
    });
    </script>
  <?php
  echo '<script>
  $.fx.speeds._default = 100;
  $(function() {';
$query = $cnx->query("SELECT id FROM conferencias");
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
    });
	
	$( "#fechainicio'.$ids['id'].'" ).datepicker({
		altField: "#fechainicio'.$ids['id'].'",
		altFormat: "yy-mm-dd"
	});
	
	$( "#fechafinal'.$ids['id'].'" ).datepicker({
		altField: "#fechafinal'.$ids['id'].'",
		altFormat: "yy-mm-dd"
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
	
	$( "#fechainicio" ).datepicker({
		altField: "#fechainicio",
		altFormat: "yy-mm-dd"
	});
	
	$( "#fechafinal" ).datepicker({
		altField: "#fechafinal",
		altFormat: "yy-mm-dd"
	});
  });
  </script>';
  ?>
<script src="<?php echo $dir; ?>/content/js/sorting.js" ></script>
<div class="maincontent" id="content">
<ul class="temporary-button-showcase">
    <li><a class="button round blue image-right ic-add text-upper agregar">Agregar</a></li>
	<div class="dialog" title="Agregar Conferencia">
		<p class="validateTips"></p>
		<form action="index.php?module=confe" method="POST" name="form">
			  <fieldset>
			  <label for="nomconfe">Nombre de la Conferencia/Congreso:</label>
			<span><input id="nomconfe" name="nomconfe" size="50" type="text" value="" placeholder="Escriba el nombre de la conferencia" class="text ui-widget-content ui-corner-all" /></span><br />
			<label for="descripcion">Descripcion: </label><br />
			<textarea id="descripcion" name="descripcion" class="text ui-widget-content ui-corner-all" ></textarea><br />
			<label for="tipo">Tipo de concurso:</label>
			<select name="tipo" placeholder="Selecciona el tipo de entrega " class="select ui-widget-content ui-corner-all">
					<option value="1">Trabajo Libre</option>
					<option value="2">Ponencia</option>
					<option value="3">Carteles</option>
					<option value="4">Trabajo Artistico</option>
					<option value="5" selected >Otro</option>
			</select><br />
			<label for="fechainicio">Fecha de Inicio:</label>
			<input id="fechainicio" name="fechainicio"  size="50" type="text" placeholder="Formato: AAAA-MM-DD" class="text ui-widget-content ui-corner-all" value=""/><br />
			<label for="fechafinal">Fecha de Final:</label>
			<input id="fechafinal" name="fechafinal"  size="50" type="text" placeholder="Formato: AAAA-MM-DD" class="text ui-widget-content ui-corner-all" value=""/><br />
			<br />
			<input style="margin-left:25%;" type="submit" name="agregar" value="Agregar" />
			</fieldset>
		</form>
	</div>
    <li><a class="button round blue image-right ic-download text-upper exportar">Exportar</a></li>
    <li><a class="button round blue image-right ic-print text-upper" onClick="window.print()">Imprimir</a></li>
    <li><a class="button round blue image-right ic-refresh text-upper" onClick="document.location.reload(true)">Actualizar</a></li>
    <li><a class="button round blue image-right ic-search text-upper">Buscar</a></li>
  </ul>
	<div class="content-module-main" style="display: block;">
		<table>
			<thead>
				 <tr>
					 <th>Acciones</th>
					 <th>Nombre</th>
					 <th>Descripcion</th>
					 <th>Tipo</th>
					 <th>Fecha Inicio - Fecha Fin</th>
				 </tr>
				<ul id="organizar" class="sortable boxy">
				<tbody>
<?php 
$query = $cnx->query("SELECT id, nom_confe, descripcion, tipo, fecha_inicio, fecha_final FROM conferencias");
$query->data_seek(0);
while($qog = $query->fetch_assoc())
{
?>
					<tr>
					<td>
					<div>
					<a href="#" class="table-actions-button ic-table-edit opener<?php echo $qog['id'];?>"></a>
					<a href="#" class="table-actions-button ic-table-delete"></a>
					<div class="dialog<?php echo $qog['id'];?>" title="<?php echo $qog['nom_confe']; ?>">
							<p class="validateTips"></p>
							<form action="index.php?module=confe" method="POST" name="form<?php echo $qog['id'];?>">
								  <fieldset>
								  <label for="nomconfe">Nombre de la Conferencia/Congreso:</label>
								<span><input id="nomconfe" name="nomconfe" size="50" type="text" value="<?php echo $qog['nom_confe']; ?>" placeholder="Escriba el nombre de la conferencia" class="text ui-widget-content ui-corner-all" /></span><br />
								<label for="descripcion">Descripcion: </label><br />
								<textarea id="descripcion" name="descripcion" class="text ui-widget-content ui-corner-all" ><?php echo $qog['descripcion'];?></textarea><br />
								<label for="tipo">Tipo de concurso:</label>
								<select name="tipo" placeholder="Selecciona el tipo de entrega " class="select ui-widget-content ui-corner-all">
										<option value="1" <?php if ($qog['tipo']=='1') echo 'selected';?>>Trabajo Libre</option>
										<option value="2" <?php if ($qog['tipo']=='2') echo 'selected';?>>Ponencia</option>
										<option value="3" <?php if ($qog['tipo']=='3') echo 'selected';?>>Carteles</option>
										<option value="4" <?php if ($qog['tipo']=='4') echo 'selected';?>>Trabajo Artistico</option>
										<option value="5" <?php if ($qog['tipo']=='5') echo 'selected';?>>Otro</option>
								</select><br />
								<label for="fechainicio">Fecha de Inicio:</label>
								<input id="fechainicio<?php echo $qog['id'];?>" name="fechainicio"  size="50" type="text" placeholder="Formato: AAAA-MM-DD" class="text ui-widget-content ui-corner-all" value="<?php echo $qog['fecha_inicio'];?>"/><br />
								<label for="fechafinal">Fecha de Final:</label>
								<input id="fechafinal<?php echo $qog['id'];?>" name="fechafinal"  size="50" type="text" placeholder="Formato: AAAA-MM-DD" class="text ui-widget-content ui-corner-all" value="<?php echo $qog['fecha_final'];?>"/><br />
								<br />
								<input type="hidden" name="id" value="<?php echo $qog['id'];?>" />
								<input style="margin-left:25%;" type="submit" name="aceptar" value="Aceptar" />
								</fieldset>
							</form>
								
						</div>
						</div>
						</td>
					<td><?php echo $qog['nom_confe']; ?></td>
					<td><?php echo $qog['descripcion']; ?></td>
					<td><?php echo tipoconferencia($qog['tipo']); ?></td>
					<td><?php echo $qog['fecha_inicio'].'<br />'.$qog['fecha_final'] ; ?></td>
					</tr>
<?php
}
?>
				</ul>
			</tbody>	
		</table>
	</div>
 </div>