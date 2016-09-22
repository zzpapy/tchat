<?php


	$userManager=new UserManager($db);
	$user=$userManager->FindById($_SESSION["id"]);


	require('views/tchat.phtml');

?>