<?php
	session_start();
	$db = mysqli_connect("192.168.1.95", "tchat", "tchat", "tchat");
	
	function __autoload($className){
		require('models/'.$className.'.class.php');
	}

	$error = '';
	$page = 'home';

	$access = ["home", "login", "register", "logout"];
	$accessUser = ["home", "tchat", "logout","list_message"];

	if(isset($_SESSION['login']))
	{
		if(isset($_GET["page"]) && in_array($_GET["page"], $accessUser))
		{
			$page = $_GET["page"];
		}
	}
	else

	{
		if(isset($_GET["page"]) && in_array($_GET["page"], $access))
		{
			$page = $_GET["page"];
		}	
	}

	$traitementList = [
		"login" => "user",
		"register" => "user",
		"logout"=>"user",
		"tchat"=>"tchat"
	];
	
	if(isset($traitementList[$page]))
	{
		require("apps/traitement_".$traitementList[$page].".php");
	}
	if (isset($_GET['ajax']))
		require('apps/'.$page.'.php');
	else
		require("apps/skel.php");
?>