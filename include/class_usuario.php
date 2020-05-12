<?php
include('config.php');
class Usuario{
function mostrar(data){
$qaspd = mysql_query("select name, lastnm, email,instedu,sitacad from usuario where email='".$this->data."'",$cnx);
if($qad = mysql_fetch_row($qaspd))
{
echo '<form action="" method="post"><ul>';
echo '<li><label for="nombre">Nombre completo:</label><br /><span><input id="nombre" name="name" size="50" type="text" value="'.$qad[0].'" placeholder="Nombre(s)"/></span><br /><span><input id="apellidos" name="lastnm" size="50" type="text" value="'.$qad[1].'" placeholder="Apellido Paterno, Apellido Materno"/></span></li>';
echo '<li><label for="almaMater">Institucion Educativa</label><br /><span><input id="almaMater" name="instedu" size="50" type="text" value="'.$qad[3].'" placeholder="Institucion" /></span></li>';
echo '<li><label for="estudios">Area de Estudio</label><br /><br /><span><input id="estudios" name="sitacad"  size="50" type="text" value="'.$qad[4].'" placeholder="Grado o Area de Estudio" /></span></li>';
echo '<li><label for="emailn">Correo electronico: </label><br /><span><input id="emailn" name="emailn" size="50" type="text"  value="'.$qad[2].'" placeholder="tucuenta@example.com" /></span></li>';
echo '<input type="hidden" name="email" value="'.$qad[2].'" /><input type="submit" name="guardar_datospers" value="Guardar Datos Personales"></form>';
 }
 mysql_free_result($qaspd);
}
function agregar(email,name,lastnm,instedu,sitacad,subject){
$this->resultado=mysql_query('INSERT INTO usuario (name,lastnm,instedu,sitacad,subject,email) VALUES (\''.$this->name.'\',\''.$this->lastnm.'\',\''.$this->instedu.'\',\''.$this->sitacad.'\',\''.$this->subject.'\',\''.$this->email.'\';',$cnx) or die('<p class="negacion">Consulta no v&aacute;lida: ' . mysql_error().'</p>');
}
function modificar(email,name,lastnm,instedu,sitacad,subject,emailn){
$this->resultado=mysql_query('UPDATE usuario SET name = \''.$this->name.'\', lastnm = \''.$this->lastnm.'\', instedu = \''.$this->instedu.'\', sitacad = \''.$this->sitacad.'\', subject = \''.$this->subject.'\', email = \''.$this->emailn.'\' WHERE email = \''.$this->email.'\';',$cnx) or die('<p class="negacion">Consulta no v&aacute;lida: ' . mysql_error().'</p>');
}
function eliminar(data){
$this->resultado=mysql_query('DELETE FROM usuario WHERE email = \''.$this->data.'\';',$cnx) or die('<p class="negacion">Consulta no v&aacute;lida: ' . mysql_error().'</p>');
}
}
?>