<?php 
if(isset($_POST["message"])){
		
			$manager = new UserManager($db);
			try
			{
			
				$author = $manager->findById($_SESSION["id"]);
				$manager = new MessageManager($db);
				$manager->create($_POST['message'],$author);
		

				
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
				var_dump($error);
			}
	}
?>
