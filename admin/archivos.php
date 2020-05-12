<?php 
global $ponencia;
require("./include/upload.php");
if (isset($_POST["enviar"]) && $_POST["enviar"] == "Subir archivo")
{
    $fupload = new Upload();
    $fupload->setPath("./content/files/");
    $fupload->setFile("archivo");
    $fupload->save();
    echo $fupload->message;
	if ($fupload->message = "Archivo subido correctamente!"){
		$query = $cnx->query("INSERT INTO archivos (nombre,descripcion,access,ponencia,email) VALUES ('".$fupload->newfile."','".$_POST['descrip']."','".$fupload->newpath."',$ponencia,'".$_SESSION['user']."')");
	}
}
elseif (isset($_POST["eliminar"]) && $_POST["eliminar"] == "Eliminar")
{
	if(file_exists($_POST['dir']) && unlink($_POST['dir']))
	{
		$query = $cnx->query("DELETE FROM archivos WHERE nombre='".$_POST['descrip']."'");
		echo '<div class="confirmacion" title= "Archivos"> El archivo fue eliminado con exito</div>'; 
	} 
	else
	{
		echo '<div class="confirmacion" title= "Archivos"> Este archivo no existe</div>'; 
	}
}
?>
<h2>Archivos</h2>
<form action="index.php?module=aspirante" name="subirarch" method="POST" enctype="multipart/form-data">
 <table>
 <tr>
 <td>
 Se requiere que el archivo a adjuntar sea de formato PDF y que no exceda de los 300KB.<br />
 Para subir los archivos haga click en Seleccionar archivo.Obligatorio el nombre.<br />
 Nombre: <input name="descrip" type="text" id="descrip" /><br /> 
  <input name="archivo" type="file" id="archivo" /><br /> 
  <input name="email" type="hidden" />
  <input name="enviar" type="submit" id="enviar" value="Subir archivo"/>
 </td>
 </tr>
 <tr height="20px">
 <td colspan="3"></td>
 </tr>
  <tr>
  <td>Archivos</td>
  </tr>
  <tr>
 <td colspan="2">
 <div>
  <table id="tabladin" class="table" style="position: relative;">
  <thead>
  <tr>
  <th>
  <a class="bold" href="javascript:$('#tabladin').sortTable({ onCol: 1, keepRelationships: true})">Documento</a>
  </th>
  <th>
   <a class="bold" href="javascript:$('#tabladin').sortTable({ onCol: 2, keepRelationships: true})"></a>
  </th>
  </tr>
  </thead>
  <tbody>
 <?php 
$query = $cnx->query("SELECT nombre,access,descripcion,ponencia FROM archivos WHERE email='$emailo' AND ponencia = $ponencia");
$query->data_seek(0);
while($archivo_var = $query->fetch_assoc())
{
	echo '<tr><td><a href="'.$archivo_var['access'].$archivo_var['nombre'].'" target="_blank">'.$archivo_var['descripcion'].'</a></td>';
	echo '<td><form name="'.$archivo_var['descripcion'].'" action="" method="post"><input type="hidden" name="dir" value="'.$archivo_var['access'].$archivo_var['nombre'].'" /><input type="hidden" name="descrip" value="'.$archivo_var['nombre'].'" /><input type="submit" name="eliminar" value="Eliminar" /></form></a></td> </tr>';
}
?>
</tbody>
</table>
</div>
</td>
</tr>
</table>
</form>