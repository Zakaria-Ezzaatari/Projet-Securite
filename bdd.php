<?php
	session_start();
	//Connexion Locale
	//$db_host = "localhost";
	//$db_name = "tp_securite";
	//$db_user = "root";
	//$db_pass = "";

	$db_host = "mysql-theroot163.alwaysdata.net";
	$db_name = "theroot163_tpsecurite";
	$db_user = "241507";
	$db_pass = "20131777@Smo";
	
	$bdd=mysqli_connect("$db_host","$db_user","$db_pass","$db_name");
	if (mysqli_connect_errno())
	{
		printf("Échec de la connexion : %s\n", mysqli_connect_error());
		exit();
	}
	else
	{
		$utf=("SET NAMES utf8");
		$resul=mysqli_query($bdd,$utf);
	}
?>
