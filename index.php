<?php
	session_start();
	$db = mysqli_connect("192.168.1.95", "tchat", "tchat", "tchat");
	
	function __autoload($className){
		require('models/'.$className.'.class.php');
	}

	$error = '';
	$page = 'home';
	$access = ["home", "login", "register", "tchat", "logout"];
	// var_dump($page);
	
	if (isset($_GET['page']) && in_array($_GET['page'], $access))
	{
		$page = $_GET['page'];
	}

	$traitementList = [
		"login" => "user",
		"register" => "user",
		"logout"=>"user",
	];
	
	if(isset($traitementList[$page]))
	{
		require("apps/traitement_".$traitementList[$page].".php");
	}
	if (isset($_GET['ajax']))
		require('apps/recherche_res.php');
	else
		require("apps/skel.php");
?>