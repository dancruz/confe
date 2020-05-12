<div id="container">
	<div>
		<ul id="cssmenu" >
			<li <?php if(isset($_GET['module'])&& $_GET['module']=='admin') { echo "class='active'"; } ?>><a href='index.php?module=admin'><span>Principal</span></a></li>
<?php
if($_SESSION['tipuser']!=1)
{
	$tipuser = $_SESSION['tipuser'];
	$query = $cnx->query("SELECT id, accion, nom_menu FROM menu WHERE tipusr = $tipuser AND tipmenu = 'menu'");
	$data = $query->data_seek(0);
	while ($menu_var = $query->fetch_array())
	{
		$id = $menu_var["id"];
		$accion = $menu_var["accion"];
		$nom_menu = $menu_var["nom_menu"];
		if(isset($_GET['module'])&& $_GET['module']==$accion) {
			$titulo = $menu_var["nom_menu"];
			$activo = "class='active'";
		}
		else  $activo = "";
		echo "<li $activo ><a href='index.php?module=$accion'><span>$nom_menu</span></a><ul>";		
		$query_submenu = $cnx->query("SELECT accion,nom_menu FROM menu WHERE tipusr = $tipuser AND tipmenu = 'submenu' AND depende = $id");
		$query_submenu->data_seek(0);
		while ($submenu_var = $query_submenu->fetch_array())
		{
			$accion_sub=$submenu_var["accion"];
			$nom_menu_sub=$submenu_var["nom_menu"];
			echo "<li $activo ><a href='index.php?module=$accion_sub'><span>$nom_menu_sub</span></a>";
		}
		echo "</ul></li>";
		
	}
}
?>
			<li id="logout"><a><span><?php echo $_SESSION['user']; ?></span></a>
				<ul>
				  <li><a href="index.php?module=aspirante"><span>Editar Datos Generales</span></a></li>
				  <li><a href="index.php?action=logout"><span>Salir</span></a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="clear"></div>
	<h1 id="titulo"><?php echo $titulo; ?></h1>
	