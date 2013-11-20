    	<?php
    	// connection bdd
		try {
		   $db = new PDO($config["db"]["dbengine"].':host='.$config["db"]["host"].';dbname='.$config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"]);
		}
		catch (Exception $e) {
		      die('Erreur : ' . $e->getMessage());
		}

		// Authentification
		$login = $_POST['login'];
		$password = $_POST['password'];
		$req = $bdd->prepare('SELECT id FROM user WHERE login = :login AND password = :password');
		$req->execute(array(
		    'login' => $login,
		    'password' => $password)
		) or die(print_r($req->errorInfo()));
		 
		$resultat = $req->fetch();
		 
		if (!$resultat) {
		    echo 'Mauvais identifiant ou mot de passe !';
		}
		else {
		    session_start();
		    $_SESSION['id'] = $resultat['id'];
		    $_SESSION['login'] = $login;
    ?>
