<?php
	// var_dump($_POST);
	if (isset($_GET['page']) && $_GET['page'] == 'logout')
	{
		session_destroy();
		header("Location: index.php");
		exit;
	}
	if(isset($_POST["login"], $_POST['password'])){
		
		if(!empty($_POST['login'] && !empty($_POST['password']))){

			$manager = new UserManager($db);
			$user = $manager->findByLogin($_POST['login']);
			if($user){
				if ($user->verifPassword($_POST['password']))
				{
					$_SESSION['id'] = $user->getIdUser();
					$_SESSION['login'] = $user->getLogin();
					
					// $_SESSION['caddy'] = $caddy->getCaddy();
					header('Location: index.php');
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

	if(isset($_POST["register"], $_POST['password'])){
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
				var_dump($error);
			}
	}

?>