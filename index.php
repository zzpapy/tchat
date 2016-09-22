<?php
	session_start();
	//var_dump($_POST);
	$db = mysqli_connect("192.168.1.95", "tchat", "tchat", "tchat");
	
	$error = '';
	$page = 'home';
	$access = ["home", "login", "register", "tchat"];
	
	if (isset($_GET['page']) && in_array($_GET['page'], $access))
	{
		$page = $_GET['page'];
	}
	
	$accessTraitement = [""];
	
	if (in_array($page, $accessTraitement))
		require('apps/traitement_'.$page.'.php');
	require('apps/skel.php');
?>