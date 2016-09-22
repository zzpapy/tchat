<?php

	$manager=new MessageManager($db);
	$messages=$manager->findAll();
	$count=0;
	
	while($count<sizeof($messages))
	{
		$message=$messages[$count];
		require('views/list_message.phtml');
		
		$count++;
		}

?>