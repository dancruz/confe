<?php
$query = $cnx->query("SELECT nombre,opcion FROM configuracion");
$query->data_seek(0);
while($aviso_var = $query->fetch_assoc()){
	if ($aviso_var["nombre"]=='emailadmin')
	{
		$email = $aviso_var["opcion"]; 
	}
}
?>
<link rel="stylesheet" href="content/css/style.css" type="text/css" />
<table width="500px" border="0" align="center">
  <tbody>
    <tr>
      <td width="100%" align="center" valign="middle"><p align="center"><span >Acerca de las cuentas</span></p>
        <p align="left" ><span>1. Si soy usuario y no conozco mi cuenta y contrase&ntilde;a para ingresar al CNFE, Que debo hacer?</span> <span>Favor de enviar un mensaje a <?php echo $email;?> para resetear contrase&ntilde;a, unicamente.</span></p>
        <p align="left" ><span>2. Si soy usuario y se me perdio mi contrase&ntilde;a para ingresar al CNFE, Como la puedo recuperar?</span> <span>Favor de enviar un mensaje a <?php echo $email;?> para resetear contrase&ntilde;a, unicamente.</span></p>
        <p align="left"><span>3. Si soy usuario y quiero modificar mis datos personales, Que debo hacer para que se habilite?</span> <span>Por motivos de organizacion, no se puede modificar, por lo que puedes enviar un mensaje al organizador para rectificar.</span></p>
        <p align="left"><span>4. Si soy usuario, Puedo cambiar mi contrase&ntilde;a?</span> <span>La contrase&ntilde;a no se puede cambiar, pero si no te acuerdas de ella, puedes enviar un mensaje para resetear tu contrase&ntilde;a.</span></p>
        <p align="center" >Lo Tecnico </p>
        <p align="left"><span>5. Que navegadores puedo usar para ingresar al CNFE y no tener problemas de compatibilidad?</span> <span>Los navegadores compatibles y probados con el CNFE son Internet Explorer, Google Chrome y Firefox.</span></p>
</td>
    </tr>
  </tbody>
</table>