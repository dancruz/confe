<?php 
function evaluar($val)
{
	$valores = array(0 => 'Elemental', 1 => 'Regular', 2 =>'Sobresaliente', 3 =>'Excelente', NULL =>'Sin calificacion');
	return $valores[$val];
}
if (isset($_POST['agendar'])&& $_POST['agendar']=='Agendar' )
{
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$sitaca = $_POST['sitaca'];
$query=$cnx->query("UPDATE ponencias SET dates = '$fecha', hours = '$hora', situa = '$sitaca' WHERE email = '".$_POST['email']."'");
if ($query) {
echo '<div class="confirmacion" title= "Organizacion"> La ponencia '.$_POST['confe'].' fue agendada con exito!</div>';
}
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
$query = $cnx->query("SELECT id FROM ponencias");
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
    $( "#fecha'.$ids['id'].'" ).datepicker({
		altField: "#fecha'.$ids['id'].'",
		altFormat: "yy-mm-dd"
	});';
}
  echo '});
  </script>';
  ?>
<script src="<?php echo $dir; ?>/content/js/sorting.js" ></script>
<div class="maincontent" id="content">
<ul class="temporary-button-showcase">
    <li><a class="button round blue image-right ic-download text-upper exportar">Exportar</a></li>
    <li><a class="button round blue image-right ic-print text-upper" onClick="window.print()">Imprimir</a></li>
    <li><a class="button round blue image-right ic-refresh text-upper" onClick="document.location.reload(true)">Actualizar</a></li>
    <li><a class="button round blue image-right ic-search text-upper">Buscar</a></li>
  </ul>
	<div class="content-module-main" style="display: block;">
		<table>
			<thead>
				 <tr>
					 <th rowspan="2">Acciones</th>
					 <th rowspan="2">Conferencia</th>
					 <th rowspan="2">Titulo</th>
					 <th rowspan="2">Ponente/Autor</th>
					 <th rowspan="2">Fecha/Hora</th>
					 <th colspan="4">Calificacion</th>
					 <th rowspan="2">Opinion del Evaluador</th>
					 <th rowspan="2">Situacion</th>
				 </tr>
				 <tr>
					 <th>Ortografia</th>
					 <th>Presentacion</th>
					 <th>Explicacion</th>
					 <th>Referencia</th>
				 </tr>
			</thead>
			<ul id="organizar" class="sortable boxy">
			<tbody>
<?php 
$query = $cnx->query("SELECT p.id AS `id`, p.nom_ponencia AS `nom_ponencia`, c.nom_confe AS `nom_confe`, p.email AS `email`, p.miembros AS `miembros`, p.ortog AS `ortog`, p.presen AS `presen`, p.explic AS `explic`, p.refere AS `refere`, p.onsevd AS `onsevd`, p.dates AS `dates`, p.hours AS `hours`, p.situa AS `situa`,u.name AS `name`, u.lastnm AS `lastnm` FROM ponencias p LEFT JOIN usuario u ON (u.email=p.email) LEFT JOIN conferencias c ON (c.id = p.id_confe)");
$query->data_seek(0);
while($organ_var = $query->fetch_assoc())
{
?>
				
					<tr>
						<td>
							<div>
							<a href="#" class="table-actions-button ic-table-edit opener<?php echo $organ_var['id'];?>"></a>
							<a href="#" class="table-actions-button ic-table-delete"></a>
							<div class="dialog<?php echo $organ_var['id'];?>" title="<?php echo $organ_var['nom_ponencia']; ?>">
								<p class="validateTips">Tras la calificacion efectuada por el evaluador, asigna una fecha y hora para que exponga el aspirante, y especifica la situacion del mismo.</p>
								<form action="index.php?module=organizar" method="POST" name="form<?php echo $organ_var['id'];?>">
									  <fieldset>
									<label for="sitaca">Situacion:</label>
									<select name="sitaca" placeholder="Selecciona el tipo de situacion para la ponencia" class="select ui-widget-content ui-corner-all">
											<option value="Rechazado, no cumple con los criterios de evaluacion" <?php if ($organ_var['situa']=='Rechazado, no cumple con los criterios de evaluacion') echo 'selected';?>>Rechazado, no cumple con los criterios de evaluacion</option>
											<option value="Pendiente de horario de exposicion" <?php if ($organ_var['situa']=='Pendiente de horario de exposicion') echo 'selected';?>>Pendiente de horario de exposicion</option>
											<option value="Se asigno horario de exposicion" <?php if ($organ_var['situa']=='Se asigno horario de exposicion') echo 'selected';?>>Se asigno horario de exposicion</option>
									</select><br />
									<label for="fecha">Fecha de exposicion:</label>
									<input id="fecha<?php echo $organ_var['id'];?>" type="text" name="fecha" style="width:300px" placeholder="Debe ser formato: AAAA-MM-DD" class="text ui-widget-content ui-corner-all fecha" value="<?php echo $organ_var['dates'];?>"/><br />
									<label for="hora">Hora a exponer:</label>
									<input type="text" name="hora" style="width:300px" placeholder="Debe ser formato: HH:MM:SS (24 horas)" class="text ui-widget-content ui-corner-all" value="<?php echo $organ_var['hours'];?>"/><br />
									<input type="hidden" name="email" value="<?php echo $organ_var['email'];?>" />
									<input type="hidden" name="confe" value="<?php echo $organ_var['nom_ponencia'];?>" />
									<br />
									<input style="margin-left:25%;" type="submit" name="agendar" value="Agendar" />
									</fieldset>
								</form>
									
							</div>
							</div>
						</td>
						<td><?php echo $organ_var['nom_confe']; ?></td>
						<td><?php echo $organ_var['nom_ponencia']; ?></td>
						<td><?php echo $organ_var['name'].' '.$organ_var['lastnm'].'<br />'.$organ_var['miembros']; ?></td>
						<td><?php echo $organ_var['dates'].'<br />'.$organ_var['hours']; ?></td>
						<td><?php echo evaluar($organ_var['ortog']); ?></td>
						<td><?php echo evaluar($organ_var['presen']); ?></td>
						<td><?php echo evaluar($organ_var['explic']); ?></td>
						<td><?php echo evaluar($organ_var['refere']); ?></td>
						<td><?php echo $organ_var['onsevd']; ?></td>
						<td><?php echo $organ_var['situa']; ?></td>
					</tr>
<?php
}
?>
				</ul>
			</tbody>	
		</table>
	</div>
 </div>