<div class="maincontent" id="content">
<?php
//Activar mas tarde
if(isset($_POST["login"]) != "" && isset($_POST["password"]) != "")/*inicio if 1*/
{
$nickN = quitar($_POST['login']);
$passN = quitar($_POST['password']);
$result = $cnx->query("SELECT email,passwd,tipusr FROM usuario WHERE user='$nickN'",$cnx);
$data = $result->data_seek(0);
if($row = $result->fetch_assoc()) /*inicio if 2*/
{
	if($passN == $row[1]) /*inicio if 3*/
	{
		$_SESSION['user']=$row[0];
		$_SESSION['psw']=$row[1];
		$_SESSION['tipuser']=$row[2];
		$_SESSION['token']=rand(111111111, 999999999);
		echo '<script type="text/javascript"> window.location="index.php"; </script>';
	}
	else
	{
?>
  <h2 style="text-align: center;">La contrase&ntilde;a no corresponde al usuario o es incorrecto</h2>
  <p style="text-align: center;">Revise que su contrase&ntilde;a sea ingresado correctamente.</p>
  <p style="text-align: center;"><a href="index.php">Regresar</a></p>
<?php
	session_destroy();
	} /*fin if 3*/
}
else
{
?>
  <h2 style="text-align: center;">Cuenta no existente</h2>
  <p style="text-align: center;">Revise que haya sido ingresado correctamente.</p>
  <p style="text-align: center;"><a href="index.php">Regresar</a></p>
<?php
session_destroy();
} /*fin if 2*/
mysql_free_result($result);
mysql_close();
}
else
{
?>
  <h2 style="text-align: center;">Debe especificar tu usuario y tu password</h2>
<p style="text-align: center;">Nota: Tu usuario es tu correo electronico</p>
<p style="text-align: center;"><a href="index.php">Regresar</a></p>
<?php
session_destroy();
} /*fin if 1*/
?>