<?php 

function tipusuario($val)
{
	$valores=array(1=>'Aspirante',10=>'Evaluador',100=>'Organizador');
	return $valores[$val];
}
if (isset($_POST['asignar'])&& $_POST['asignar']=='Asignar' ){
	$name = $_POST["name"];
	$lastnm = $_POST["lastnm"];
	$email = $_POST["email"];
	$emailn = $_POST["emailn"];
	$instedu = $_POST["instedu"];
	$sitacad = $_POST["sitacad"];
	$tipsu = $_POST["tipsu"];
	$query = $cnx->query("UPDATE usuario SET name = '$name', lastnm = '$lastnm' , instedu = '$instedu' , sitacad = '$sitacad', tipusr = '$tipsu' , email = '$emailn'  WHERE email = '$email'");
	echo '<div class="confirmacion" title= "Usuarios"> Actualizado el usuario'.$_POST['name'].'!</div>';
}
elseif (isset($_POST['agregar'])&& $_POST['agregar']=='Agregar' ){
	$name = $_POST["name"];
	$lastnm = $_POST["lastnm"];
	$email = $_POST["email"];
	$emailn = $_POST["emailn"];
	$instedu = $_POST["instedu"];
	$sitacad = $_POST["sitacad"];
	$tipsu = $_POST["tipsu"];
	$query = $cnx->query("INSERT INTO usuario (name,lastnm,instedu,sitacad,tipusr,email) VALUES ('$name','$lastnm','$instedu','$sitacad','$tipsu','$emailn')");
	echo '<div class="confirmacion" title= "Usuarios"> Agregado el usuario'.$_POST['name'].'!</div>';
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
$query = $cnx->query("SELECT id FROM usuario");
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
	<div class="dialog" title="Agregar Usuario">
		<p class="validateTips"></p>
		<form action="index.php?module=user" method="POST" name="form">
			  <fieldset>
			  <label for="fecha">Nombre Completo:</label>
			<span><input id="nombre" name="name" size="50" type="text" value="" placeholder="Nombre(s)" class="text ui-widget-content ui-corner-all"/></span>
			<span><input id="apellidos" name="lastnm" size="50" type="text" value="" placeholder="Apellido Paterno, Apellido Materno"class="text ui-widget-content ui-corner-all" /></span>
			<label for="hora">Correo Electronico:</label>
			<input type="text" id="emailn" name="emailn" size="50" type="text" placeholder="tucuenta@example.com" value=""/>
			<label for="hora">Institucion Educativa:</label>
			<input type="text" id="almaMater" name="instedu" style="width:300px" placeholder="Institucion" class="text ui-widget-content ui-corner-all" value=""/>
			<label for="hora">Carrera:</label>
			<input id="estudios" name="sitacad"  size="50" type="text" placeholder="Grado o Area de Estudio" class="text ui-widget-content ui-corner-all" value=""/>
			<label for="tipsu">Tipo de Usuario:</label>
			<select name="tipsu" placeholder="Selecciona el tipo de usuario a registrar" class="select ui-widget-content ui-corner-all">
					<option value="1" selected>Aspirante</option>
					<option value="10" >Evaluador</option>
					<option value="100" >Organizador</option>
					</select>
			<br />
			<br />
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
					 <th>Tipo de Usuario</th>
					 <th>Correo Electronico</th>
					 <th>Institucion Educativa</th>
					 <th>Carrera</th>
					 <th>Registro</th>
				 </tr>
				<ul id="organizar" class="sortable boxy">
				<tbody>
<?php 
$query = $cnx->query("SELECT id,name,lastnm,tipusr,email,instedu,sitacad,registro FROM usuario WHERE email!='".$_SESSION['user']."'");
$query->data_seek(0);
while($qog = $query->fetch_assoc())
{
?>
					<tr>
					<td>
					<div>
					<a href="#" class="table-actions-button ic-table-edit opener<?php echo $qog['id'];?>"></a>
					<a href="#" class="table-actions-button ic-table-delete"></a>
					<div class="dialog<?php echo $qog['id'];?>" title="<?php echo $qog['name']; ?>">
							<p class="validateTips"></p>
							<form action="index.php?module=user" method="POST" name="form<?php echo $qog['id'];?>">
								  <fieldset>
								  <label for="fecha">Nombre Completo:</label>
								<span><input id="nombre" name="name" size="50" type="text" value="<?php echo $qog['name']; ?>" placeholder="Nombre(s)" class="text ui-widget-content ui-corner-all"/></span>
								<span><input id="apellidos" name="lastnm" size="50" type="text" value="<?php echo $qog['lastnm']; ?>" placeholder="Apellido Paterno, Apellido Materno"class="text ui-widget-content ui-corner-all" /></span>
								<label for="hora">Correo Electronico:</label>
								<input type="text" id="emailn" name="emailn" size="50" type="text" placeholder="tucuenta@example.com" value="<?php echo $qog['email'];?>"/>
								<label for="hora">Institucion Educativa:</label>
								<input type="text" id="almaMater" name="instedu" style="width:300px" placeholder="Institucion" class="text ui-widget-content ui-corner-all" value="<?php echo $qog['instedu'];?>"/>
								<label for="hora">Carrera:</label>
								<input id="estudios" name="sitacad"  size="50" type="text" placeholder="Grado o Area de Estudio" class="text ui-widget-content ui-corner-all" value="<?php echo $qog['sitacad'];?>"/>
								<label for="tipsu">Tipo de Usuario:</label>
								<select name="tipsu" placeholder="Selecciona el tipo de usuario a registrar" class="select ui-widget-content ui-corner-all">
										<option value="1" <?php if ($qog['tipusr']=='1') echo 'selected';?>>Aspirante</option>
										<option value="10" <?php if ($qog['tipusr']=='10') echo 'selected';?>>Evaluador</option>
										<option value="100" <?php if ($qog['tipusr']=='100') echo 'selected';?>>Organizador</option>
										</select>
								<input type="hidden" name="email" value="<?php echo $qog['email'];?>" />
								<br />
								<br />
								<br />
								<input style="margin-left:25%;" type="submit" name="asignar" value="Asignar" />
								</fieldset>
							</form>
								
						</div>
						</div>
						</td>
					<td><?php echo $qog['name'].'<br />'.$qog['lastnm'] ; ?></td>
					<td><?php echo tipusuario($qog['tipusr']); ?></td>
					<td><?php echo $qog['email']; ?></td>
					<td><?php echo $qog['instedu']; ?></td>
					<td><?php echo $qog['sitacad']; ?></td>
					<td><?php echo $qog['registro']; ?></td>
					</tr>
<?php
}
?>
				</ul>
			</tbody>	
		</table>
	</div>
 </div>