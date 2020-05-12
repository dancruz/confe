<?php
// Index / Inicio
$contenido = (isset($_GET['page']))? $_GET['page'] : 'start';
$modulo = (isset($_GET['module']))? $_GET['module'] : 'index';
$action = (isset($_GET['action']))? $_GET['action'] : 'none';
session_start();
require("config.php");
include("./include/header.php");
if(isset($_SESSION['tipuser']) && $_SESSION['tipuser']==1 && $action=='none'){
	include("include/menu.php");
	include("admin/aspirante.php");
}
elseif(isset($_SESSION['token']) && $action=='none'){
	include("include/menu.php");
	$query = $cnx->query("SELECT nom_menu FROM menu WHERE tipusr='".$_SESSION['tipuser']."' AND accion='$modulo'");
	$query->data_seek(0);
	if ($menu_var = $query->fetch_assoc())
	{
		include("admin/$modulo.php");
	}
	else 
	{
		if($modulo=='aspirante')
		{
			include("admin/$modulo.php");
		}
		elseif($contenido!='start' AND $modulo!='index' AND $modulo!='admin')
		{
			echo "<div class='confirmacion' title= 'Error'> El modulo no esta permitido o no existe</div>";
			include("admin/admin.php");
		}
		else
		{
			include("admin/admin.php");
		}
	}
} 
else {
	include("$contenido.php");
}
include("./include/footer.php");
?>