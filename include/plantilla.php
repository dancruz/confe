<?php
$query = $cnx->query("SELECT nombre,opcion FROM configuracion");
$query->data_seek(0);
while($opcion = $query->fetch_assoc()){
	switch($opcion['nombre'])
	{
		case 'header_template':
			$header = $opcion['opcion'];
			break;
		case 'inscr_modulo':
			$inscripcion = $opcion['opcion'];
			break;
		case 'emailadmin':
			$emailadmin = $opcion['opcion'];
			break;
		case 'footer_template':
			$footer = $opcion['opcion'];
			break;
		case 'mensaje':
			$mensaje = $opcion['opcion'];
			break;
		case 'nombre_cnfe':
			$nombrecnfe = $opcion['opcion'];
			break;
		case 'descrip_cnfe':
			$nombrecnfe = $opcion['opcion'];
			break;
	}
}
//MENSAJES
$cuerpomsg ='
<html>
<head>
  <title>Olvide mi contraseña</title>
</head>
<body>
<p>Hola __NOMBRE__ __APELLIDOS__! ,te envio tu contraseña de acuerdo al correo electronico registrado en el sistema</p>
  <table>
    <tr>
      <td><b>Tu correo:</b><br></td>
	  <td>__EMAIL__</td>
    </tr>
	<tr>
      <td><b>Contraseña:</b><br></td>
	  <td>__INSTITUCION__</td>
    </tr>
      <td></td>
  </table>
  <p>&copy; __ANIO__ __SUBTITULO__ Uso Academico.</p>
</body>
</html>
 ';

//HEADER AND FOOTER
$header='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>__TITULO__</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<base id="enlace" href="__DIR__">
<link rel="stylesheet" href="content/css/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="content/css/menu.css" type="text/css" />
<link rel="stylesheet" href="content/css/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="content/css/jquery-ui.css" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="content/js/jquery.min.js" type="text/javascript" ></script>
<script src="content/js/chosen.jquery.min.js" type="text/javascript" ></script>
<script src="content/js/thickbox.js" type="text/javascript" ></script>
<script src="content/js/jquery.menu.js" type="text/javascript"></script>
<script src="content/js/jquery.ui.js" type="text/javascript" ></script>
<script src="include/tinymce/tinymce.min.js" type="text/javascript" ></script>
<script src="content/js/sorting.js" type="text/javascript"></script>
<script src="include/tinymce/tiny_mce_gzip.js" type="text/javascript" ></script>
<script src="content/js/script.js" type="text/javascript" ></script>
</head>
<body>
<div id="header">
__HEADER__
</div>
';

$footer='
<div class="clear">&nbsp;</div>
<div class="push"></div>
</div>
<div id="footer">
__FOOTER__
<div style="clear:both"></div>
</div>
</div>
</body>
</html>
';
?>