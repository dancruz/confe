<?php
$qaspd = mysql_query("select name, lastnm, email, instedu, sitacad from usuario where nom_user='".$_SESSION['user']."'",$cnx);
if($qad = mysql_fetch_row($qaspd))
{
$nombre=$qad[0];
$apellidos=$qad[1];
$emailo=$qad[2];
$inst=$qad[3];
$sit=$qad[4];
 }
 mysql_free_result($qaspd);
 $obresult= mysql_query("SELECT nom_confe,onsevd, situa FROM `confe_tabla` WHERE email='".$emailo."'",$cnx);
if($obsd = mysql_fetch_row($obresult))
{
$tema=$obsd[0];
$obs1=$obsd[1];
$situa=$obsd[2];
 }
 mysql_free_result($obresult);
 
?>
<div id="main">
 <div id="submain">
 <div class="maincontent" id="content">
 <h2 style="text-align: center;">Aspirante</h2>
 <table>
 <tr>
 <td width="400px">
 <table>
 <tr>
 <td>
 <p> <?php echo $apellidos .' '.$nombre.'<br />'.$row[2]; ?></p>
 </td>
 </tr>
 <tr>
 <td>
 <p> <?php echo $inst .'<br />'.$sit; ?></p>
 </td>
 </tr>
  <?php 

 ?>
 <tr>
 <td>
<p> <?php echo 'Tema: '.$tema; ?></p>
 </td>
 </tr>
 </table>
 </td>
 <td rowspan="2">
 <table>
 <tr><td>Observaciones</td></tr>
  <tr><td><hr></td></tr>
 <tr><td><?php echo $obs1; ?><td></tr>
 <tr><td><hr></td></tr>
 <tr><td>Situacion</td></tr>
 <tr><td><input type="text" disabled=disabled value="<?php echo $situa; ?>" /></td></tr> 
 </table>
 </td>
 </tr>
 <tr height="100px">
 <td colspan="3"></td>
 </tr>
 <tr>
 <form action="index.php?action=upload.php" name="subirarch" method="POST" enctype="multipart/form-data">
 <table>
 <tr>
 <td>
 Para subir los archivos haga click en Seleccionar archivo.<br />
  <input type="file" name="archivo" /><br /> 
  <input type="submit" name="enviar1" value="Subir archivo"/>
  
 </td>
 </tr>
 <tr height="20px">
 <td colspan="3"></td>
 </tr>
 </table>
 </tr>
  <tr>
  <td>Archivos</td>
  </tr>
  <tr>
 <td colspan="2">
    <?php 
 $fileresult= mysql_query("SELECT nombre,access FROM `confe_files` WHERE email='".$emailo."'",$cnx);
while($fl = mysql_fetch_row($fileresult))
{
 ?>
 <table>
 <tr>
 <?php 
 echo '<td><a href="<?php echo $dir; ?>content/files/'.$fl[1].'" target="_blank">'.$fl[0].'</a></td>';
 echo '<td><a href="#" >Eliminar</a></td>';?>
 </tr>
 </table>
 </form>
 <?php
 }
mysql_free_result($fileresult);
?>
 </td>
 </tr>
 <?php
mysql_close();
?>
 </table>
<p style="text-align: center;"></p>
</div>