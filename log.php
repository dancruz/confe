<?php
global $cnx;
//Login
if (isset($_GET['action']) && $_GET['action']=='logout')
{
	session_destroy();
	echo '$("<p>").text("Termino la sesion").appendTo("#highlight-list").asHighlight(); $(".menusection").css({ padding: "10px 0px 0px 0px" });';
} 
elseif (isset($_GET['action']) && $_GET['action']=='login' && isset($_POST["acceder"]) != "" && $_POST["acceder"] == 'Acceder')
{
	if(isset($_POST["login"])&& $_POST["login"]!= "" && isset($_POST["password"]) && $_POST["password"]!= "")
	{
		$nickN = $_POST['login'];
		$passN = $_POST['password'];

		$query = $cnx->query("SELECT email,passwd,tipusr FROM usuario WHERE user='$nickN'");
		$query->data_seek(0);
		if($login_var = $query->fetch_assoc())
		{
			if($passN == $login_var["passwd"])
			{
				$_SESSION['user']=$login_var["email"];
				$_SESSION['psw']=$login_var["passwd"];
				$_SESSION['tipuser']=$login_var["tipusr"];
				$_SESSION['token']=rand(111111111, 999999999);
				echo '$("<p>").text("Iniciando sesion...").appendTo("#highlight-list").asHighlight(); $(".menusection").css({ padding: "10px 0px 0px 0px" });';
				echo '$(location).attr("href","index.php?page=start");';
			}
			else
			{
				echo '$("<p>").text("La contrase\u00f1a no corresponde al usuario o es incorrecto: Revise que haya sido ingresado correctamente.").appendTo("#error-list").asError(); $(".menusection").css({ padding: "60px 0px 0px 0px" });';
				session_destroy();
			}
		}
		else
		{
		echo '$("<p>").text("Cuenta no existente: Revise que haya sido ingresado correctamente.").appendTo("#error-list").asError(); $(".menusection").css({ padding: "60px 0px 0px 0px" });';
		session_destroy();
		}
	}
	else
	{
		echo '$("<p>").text("Debe especificar tu usuario y tu password.").appendTo("#error-list").asError();';
		echo '$("<p>").text("Nota: Tu usuario es tu correo electronico.").appendTo("#highlight-list").asHighlight(); $(".menusection").css({ padding: "85px 0px 0px 0px" });';
		session_destroy();
	}
}
?>