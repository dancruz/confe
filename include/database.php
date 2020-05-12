<?php
function conexion($s,$u,$p,$d,$tipo)
{
	if($tipo=='mysqli')
	{
		$link = new mysqli($s,$p,$d,$u,3306);
		if ($link->connect_errno) {
			echo "Error conectando a la base de datos.";
			exit();
		}
	}
	else
	{
		if (!($link=mysql_connect($s,$p,$d)))
		{
			echo "Error conectando a la base de datos.";
			exit();
		}
		if (!mysql_select_db($u,$link))
		{
			echo "Error seleccionando la base de datos.";
			exit();
		}
	}
	return $link;
}
?> 