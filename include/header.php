<?php
include("include/plantilla.php");
$query = $cnx->query("SELECT nombre,opcion FROM configuracion");
$query->data_seek(0);
while($opcion = $query->fetch_assoc()){
	switch($opcion['nombre'])
	{
		case 'header_template':
			$cabecera = $opcion['opcion'];
			break;
		case 'nombre_cnfe':
			$title = $opcion['opcion'];
			break;
	}
}
$header=str_replace('__TITULO__',$title,$header);
$header=str_replace('__DIR__',$dir,$header);
$header=str_replace('__HEADER__',$cabecera,$header);
echo $header;
?>