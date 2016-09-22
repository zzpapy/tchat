<?php
	if (isset($_GET['page']) && $_GET['page'] == 'logout')
	{
		session_destroy();
		header("Location: index.php");
		exit;
	}
	if(isset($_POST["log"],$_POST["login"], $_POST['password'])){
		
		
		if(!empty($_POST['login'] && !empty($_POST['password']))){

			$manager = new UserManager($db);
			$user = $manager->findByLogin($_POST['login']);
			// var_dump(mysqli_error($db));
			if($user){
	// var_dump($_POST);
	// die;
				if ($user->verifPassword($_POST['password']))
				{
					$_SESSION['id'] = $user->getId();
					$_SESSION['login'] = $user->getLogin();
					
					// $_SESSION['caddy'] = $caddy->getCaddy();
					
					header("Location: index.php?page=tchat");
					exit;
				}
				else{
					$error = 'mot de passe incorrect';
					var_dump($error);
				}

			}
			else{
				$error = 'Utilisateur inconnu';
				var_dump($error);
			}

		}
		else{
			$error = "Veuillez remplir tout les champs";
			var_dump($error);
		}
	}

	if(isset($_POST["register"], $_POST['password2'])){
		$admin = 0;

		// var_dump($_POST);
			$manager = new UserManager($db);
			try
			{
				$manager->create($_POST['password'], $_POST['login']);
				
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
			header("Location: index.php?page=login");
		exit;
	}

?>