<?php
include("../include/plantilla.php");
include('../config.php');
$query = $cnx->query("SELECT nombre,opcion FROM configuracion");
$query->data_seek(0);
while($aviso_var = $query->fetch_assoc()){
	if ($aviso_var["nombre"]=='emailadmin')
	{
		$email = $aviso_var["opcion"]; 
	}
}
$seEnvio;		//Para determinar si se envio o no el correo
$destinatario = $_POST['email'];		//A quien se envia
$elmensaje = str_replace("\n.", "\n..", $_POST['elmsg']);     //por si el mensaje empieza con un punto ponerle 2
$elmensaje = wordwrap($elmensaje, 70);                       //dividir el mensaje en trozos de 70 cols
//Recupear el asunto
$asunto = 'Tu contrase&ntilde;a en CNFE';
//Formatear un poco el texto que escribio el usuario (asunto) en la caja
//de comentario con ayuda de HTML
$email = $_POST['email'];
$query = $cnx->("SELECT name, lastnm, email, passwd FROM usuario WHERE email='$email'");
$query->data_seek(0);
if($correo_envio = $query->fetch_assoc())
{
	$cuerpomsg=str_replace('__NOMBRE__',$correo_envio["name"],$cuerpomsg);
	$cuerpomsg=str_replace('__APELLIDOS__',$correo_envio["lastnm"],$cuerpomsg);
	$cuerpomsg=str_replace('__EMAIL__',$correo_envio["email"],$cuerpomsg);
	$cuerpomsg=str_replace('__INSTITUCION__',$correo_envio["passwd"],$cuerpomsg);
	$cuerpomsg=str_replace('__ANIO__',date('Y'),$cuerpomsg);
	$cuerpomsg=str_replace('__SUBTITULO__',$descripcion,$cuerpomsg);
	echo $cuerpomsg;
}
//Establecer cabeceras para la funcion mail()
//version MIME
$cabeceras = "MIME-Version: 1.0\r\n";
//Tipo de info
$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
//direccion del remitente
$cabeceras .= "From: CNFE ".$email;
if(mail($destinatario,$asunto,$cuerpomsg,$cabeceras))
	$seEnvio = true;
else
	$seEnvio = false;

//Enviar el estado del envio (por metodo GET ) y redirigir navegador al archivo index.php
echo (mail($destinatario,$asunto,$cuerpomsg,$cabeceras) == true)?'<p>Correo enviado</p>':'<p>No se envio el correo</p>';
?>