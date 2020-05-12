<?php
include('config.php');
class Ponencia{
function observ(data){
$obresult= mysql_query("SELECT onsevd,situa,dates,hours FROM ponencias WHERE email='".$emailo."'",$cnx);
if($obsd = mysql_fetch_row($obresult))
{
echo '<table class="observ"><tbody><tr><td style="vertical-align: top;">';
echo '<h2>Observaciones</h2></td></tr><tr><td>'.$obsd[0].'<br />Dia: '.$obsd[1].'<br />Hora: '.$obsd[2].'<br />';
echo '</td></tr><tr><td>Situacion: '.$obsd[3].'</td></tr></tbody></table>';
}
mysql_free_result($obresult);
}
function orgalist(data){
$qorg = mysql_query("SELECT nom_confe, dates, hours,ortog, presen, explic, refere, onsevd, situa, email  FROM ponencias",$cnx);
while($qog = mysql_fetch_row($qorg))
{
echo '<tr class="view">';
echo '<td><div><div id="button"><input type="button" value="Agendar" /></div><div id="popupContact"><a id="popupContactClose">x</a>';
echo '<form action="" method="POST" name="form11"><p id="contactArea">Tras la calificacion efectuada por el evaluador, asigna una fecha y hora para que exponga el aspirante, y especifica la situacion del mismo.</p><p id="contactArea">Fecha de exposicion:</p><input type="text" name="fecha" style="width:300px" placeholder="Debe ser formato: AAAA-MM-DD" /><p id="contactArea">Hora a exponer:</p><input type="text" name="hora" style="width:300px" placeholder="Debe ser formato: HH:MM:SS (24 horas)" /><p id="contactArea">Situacion:</p><select name="sitaca" placeholder="Selecciona el tipo de usuario a registrar"><option value="Pendiente de horario de exposicion">Pendiente de horario de exposicion</option><option value="Se asigno horario de exposicion">Se asigno horario de exposicion</option></select><input type="hidden" name="email" value="'.$qog[9].'" /><input type="submit" name="agendar" value="Agendar" /></form>';
echo '</div><div id="backgroundPopup"></div></div></td>';
echo '<td>'.$qog[0].'</td><td>'.$qog[1].'<br />'.$qog[2].'</td>';
echo '<td>'.$qog[3].'</td><td>'.$qog[4].'</td><td>'.$qog[5].'</td>';
echo '<td>'.$qog[6].'</td><td>'.$qog[7].'</td><td>'.$qog[8].'</td>';
echo '</tr>';
}
mysql_free_result($qorg);
}
function orgadd(email,fecha,hora,sitaca){
$this->resultado=mysql_query('UPDATE ponencias SET dates = \''.$this->fecha.'\', hours = \''.$this->hora.'\', situa = \''.$this->sitaca.'\' WHERE email = \''.$this->email.'\'',$cnx) or die('<p class="negacion">Consulta no v&aacute;lida: ' . mysql_error().'</p>');;
}
function exposiv(data){
$obresult= mysql_query("SELECT nom_confe,tipo,miembrosFROM ponencias WHERE email='".$this->data."'",$cnx);
if($obsd = mysql_fetch_row($obresult))
{
echo '<form action="" method="post"><ul>';
echo '<li><label for="tema">Titulo de la exposicion: </label><br /><span><input id="tema" name="subject" size="50" type="text"  value="'.$obsd[0].'" placeholder="Escribe el titulo o tema a exponer" /></span></li>';
echo '<li><label for="tipo">Tipo de Exposicion: </label><br /><textarea name="tipo" cols="20" rows="10">'.$obsd[1]'.</textarea></li>';
echo '<li><label for="miembros">Miembros: </label><br /><textarea name="miembros" cols="20" rows="10">'.$obsd[2].'</textarea></li>';
echo '</ul><input type="hidden" name="email" value="'.$this->data.'" /><input type="submit" name="guardar_expo" value="Guardar Informacion"></form>';
}
mysql_free_result($obresult);
}
function eval_add(email,ortog,presen,explic,refere,opinion){
$resultado=mysql_query('UPDATE ponencias SET ortog = \''.$this->ortog.'\', presen = \''.$this->presen.'\', explic = \''.$this->explic.'\', refere = \''.$this->refere.'\', onsevd = \''.$this->opinion.'\' WHERE email = \''.$this->email.'\'',$cnx) or die('<p class="negacion">Consulta no v&aacute;lida: ' . mysql_error().'</p>');;
}
function eval_list(data){
$qorg = mysql_query("select nom_confe,email,miembros from ponencias",$cnx);
while($qog = mysql_fetch_row($qorg))
{
?>
<tr>
<td>
<div>
<div id="button"><input type="submit" value="Calificar" /></div>
	<div id="popupContact">
		<a id="popupContactClose">x</a>
		<h1><?php echo $qog[2];?></h1>
		<form action="" method="POST" name="form11">
		<p><?php echo $qog[0];?></p>
		<p id="contactArea">
		La siguiente tabla se evaluara el trabajo del aspirante, pero debe contestar honestamente y 
		explicar con sus propias palabras lo que se entendio del trabajo.</p>
			<table>
			<tr>
			<td></td>
			<td>Elemental</td>
			<td>Regular</td>
			<td>Sobresaliente</td>
			<td>Excelente</td>
			</tr>
			<tr>
			<td>Ortografia</td>
			<td><input type="radio" name="ortog" value="0"></td>
			<td><input type="radio" name="ortog" value="1"></td>
			<td><input type="radio" name="ortog" value="2"></td>
			<td><input type="radio" name="ortog" value="3"></td>
			</tr>
			<tr>
			<td>Presentacion</td>
			<td><input type="radio" name="presen" value="0"></td>
			<td><input type="radio" name="presen" value="1"></td>
			<td><input type="radio" name="presen" value="2"></td>
			<td><input type="radio" name="presen" value="3"></td>
			</tr>
			<tr>
			<td>Explicacion</td>
			<td><input type="radio" name="explic" value="0"></td>
			<td><input type="radio" name="explic" value="1"></td>
			<td><input type="radio" name="explic" value="2"></td>
			<td><input type="radio" name="explic" value="3"></td>
			</tr>
			<tr>
			<td>Referencias</td>
			<td><input type="radio" name="refere" value="0"></td>
			<td><input type="radio" name="refere" value="1"></td>
			<td><input type="radio" name="refere" value="2"></td>
			<td><input type="radio" name="refere" value="3"></td>
			</tr>
			</table>
			<p id="contactArea">Explique:</p>
			<textarea name="opinion" ></textarea><br />
			<input type="hidden" name="email" value="<?php echo $qog[1];?>" />
			<input type="submit" name="calificar" value="Calificar" />
		<form>
			
	</div>
	<div id="backgroundPopup"></div>
	</div>
	</td>

<td><?php echo $qog[0];?></td>
<?php 
$qads=mysql_query('select name,lastnm from usuario where email="'.$qog[1].'"',$cnx);
if($qapwa = mysql_fetch_row($qads))
{
$gh=$qapwa[0];
$df=$qapwa[1];
}
?>
<td><?php echo $gh .'   '.$df; ?></td>
<td>
<table>
    <?php 
 $fileresult= mysql_query('SELECT nombre,access,descripcion FROM archivos WHERE email="'.$qog[1].'"',$cnx);
while($fl = mysql_fetch_row($fileresult))
{
 ?>
 <tr>
 <?php 
 echo '<td><a href="'.$dir.$fl[1].$fl[0].'" target="_blank">'.$fl[2].'</a></td>';
 ?>
 </tr>
 <?php
 }
 ?>
 </table>
</td>
</tr>
<?php
}
?>
}
}
?>