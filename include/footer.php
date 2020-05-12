<?php
include("include/plantilla.php");
$query = $cnx->query("SELECT nombre,opcion FROM configuracion");
$query->data_seek(0);
while($opcion = $query->fetch_assoc()){
	switch($opcion['nombre'])
	{
		case 'footer_template':
			$piepagina = $opcion['opcion'];
			break;
	}
}
$footer=str_replace('__ANIO__',date('Y'),$footer);
$footer=str_replace('__FOOTER__',$piepagina,$footer);
echo $footer;
$cnx->close();
?>