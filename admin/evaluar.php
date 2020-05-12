<?php 
if (isset($_POST['calificar'])&& $_POST['calificar']=='Calificar' ){
$ortografia=$_POST['ortog'];
$presentacion=$_POST['presen'];
$explicacion=$_POST['explic'];
$referencia=$_POST['refere'];
$opinion=$_POST['opinion'];

$query=$cnx->query("UPDATE ponencias SET ortog = '$ortografia', presen = '$presentacion', explic = '$explicacion', refere = '$referencia', onsevd = '$opinion' WHERE email = '".$_POST['email']."'");
if ($query) {
echo '<div class="confirmacion" title= "Evaluacion"> Evaluado la ponencia '.$_POST['confe'].'!</div>';
}
}

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
	  minWidth: 340,
      show: "blind",
      hide: "blind"
    });
 
    $( ".opener'.$ids['id'].'" ).click(function() {
      $( ".dialog'.$ids['id'].'" ).dialog( "open" );
      return false;
    });';
}
  echo '
  $(".exportar").click(function(e) {
			window.open("data:application/vnd.ms-excel," + encodeURIComponent($(".content-module-main").html()));
			e.preventDefault();
		});
  });
  </script>';
  ?>
<script src="<?php echo $dir; ?>content/js/sorting.js" ></script>
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
					  <th>Acciones</th>
					  <th>Titulo</th>
					  <th>Ponente/Autor</th>
					  <th>Documentos</th>
				 </tr>
			</thead>
			<tbody>
 <?php 
$query = $cnx->query("SELECT p.id AS `id`,p.nom_ponencia AS `nom_ponencia`, p.email AS `email`,p.miembros AS `miembros`, p.ortog AS `ortog`, p.presen AS `presen`, p.explic AS `explic`, p.refere AS `refere`, p.onsevd AS `onsevd`,u.name AS `name`, u.lastnm AS `lastnm` FROM ponencias p JOIN usuario u ON (u.email=p.email)");
$query->data_seek(0);
while($eval_var = $query->fetch_assoc())
{
?>
<tr>
<td>
<div>
	<a href="#" class="table-actions-button ic-table-edit opener<?php echo $eval_var['id'];?>"></a>
	<a href="#" class="table-actions-button ic-table-delete"></a>
	<div class="dialog<?php echo $eval_var['id'];?>" title="<?php echo $eval_var['nom_ponencia']; ?>">
		<form action="index.php?module=evaluar" method="POST" name="form11">
		<fieldset>
		<p class="validateTips">La siguiente tabla se evaluara el trabajo del aspirante, pero debe contestar honestamente y 
		explicar con sus propias palabras lo que se entendio del trabajo.</p>
			<table>
			<tr>
			<td></td>
			<td>Elemental</td>
			<td>Regular</td>
			<td>Sobresaliente</td>
			<td>Excelente</td>
			</tr>
			<tr>
			<td>Ortografia</td>
			<td><input type="radio" name="ortog" value="0" <?php if($eval_var['ortog']==0) echo 'checked'; ?>></td>
			<td><input type="radio" name="ortog" value="1" <?php if($eval_var['ortog']==1) echo 'checked'; ?>></td>
			<td><input type="radio" name="ortog" value="2" <?php if($eval_var['ortog']==2) echo 'checked'; ?>></td>
			<td><input type="radio" name="ortog" value="3" <?php if($eval_var['ortog']==3) echo 'checked'; ?>></td>
			</tr>
			<tr>
			<td>Presentacion</td>
			<td><input type="radio" name="presen" value="0" <?php if($eval_var['presen']==0) echo 'checked'; ?>></td>
			<td><input type="radio" name="presen" value="1" <?php if($eval_var['presen']==1) echo 'checked'; ?>></td>
			<td><input type="radio" name="presen" value="2" <?php if($eval_var['presen']==2) echo 'checked'; ?>></td>
			<td><input type="radio" name="presen" value="3" <?php if($eval_var['presen']==3) echo 'checked'; ?>></td>
			</tr>
			<tr>
			<td>Explicacion</td>
			<td><input type="radio" name="explic" value="0" <?php if($eval_var['explic']==0) echo 'checked'; ?>></td>
			<td><input type="radio" name="explic" value="1" <?php if($eval_var['explic']==1) echo 'checked'; ?>></td>
			<td><input type="radio" name="explic" value="2" <?php if($eval_var['explic']==2) echo 'checked'; ?>></td>
			<td><input type="radio" name="explic" value="3" <?php if($eval_var['explic']==3) echo 'checked'; ?>></td>
			</tr>
			<tr>
			<td>Referencias</td>
			<td><input type="radio" name="refere" value="0" <?php if($eval_var['refere']==0) echo 'checked'; ?>></td>
			<td><input type="radio" name="refere" value="1" <?php if($eval_var['refere']==1) echo 'checked'; ?>></td>
			<td><input type="radio" name="refere" value="2" <?php if($eval_var['refere']==2) echo 'checked'; ?>></td>
			<td><input type="radio" name="refere" value="3" <?php if($eval_var['refere']==3) echo 'checked'; ?>></td>
			</tr>
			</table>
			<br />
			<label for="sitaca">Explique:</label>
			<textarea id= "sitaca" name="opinion" ><?php echo $eval_var['onsevd'];?></textarea><br />
			<input type="hidden" name="confe" value="<?php echo $eval_var['nom_ponencia'];?>" />
			<input type="hidden" name="email" value="<?php echo $eval_var['email'];?>" />
			<br />
			<br />
			<input type="submit" name="calificar" value="Calificar" />
			</fieldset>
		</form>
	</div>
</div>
</td>

<td><?php echo $eval_var['nom_ponencia'];?></td>
<td><?php echo $eval_var['name'].' '.$eval_var['name'].'<br>'.$eval_var['miembros']; ?></td>
<td>
<table>
 <tr>
 <?php 
 $query2 = $cnx->query("SELECT access, nombre, descripcion FROM archivos WHERE email='".$eval_var['email']."' AND ponencia =".$eval_var['id']."");
$query2->data_seek(0);
while($eval_file = $query2->fetch_assoc())
{
 echo '<td><a href="'.$dir.$eval_file['access'].$eval_file['nombre'].'" target="_blank">'.$eval_file['descripcion'].'</a></td>';
}
 ?>
 </tr>
 </table>
</td>
</tr>
<?php
}
?>
</tbody>
 </table>
       </div>
    </div>