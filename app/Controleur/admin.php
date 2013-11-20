<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Login </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
        <!--[if IE]>
            <script src="js/html5-ie.js"></script>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
    	<?php
    	// connection bdd
			try {
			    $bdd = new PDO('mysql:host=localhost;dbname=JsGallery', 'root', 'd4t4');
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
			else if($login != "admin") {
				echo('Desolee, '.$login.', vous n\'avez pas le droit d\'être ici');
			}
			else {
			    session_start();
			    $_SESSION['id'] = $resultat['id'];
			    $_SESSION['login'] = $login;
			    echo 'Vous êtes connecté !';
	    // Affichage des fonctionnalités admin
	    ?>

		    <h1> Bienvenue dans l'espace d'administration </h1>

		    <section>
	            <h2> Gestion des films </h2>

	            <table class="table table-bordered table-striped">
	            <thead>
	              <tr>
	                <th>Id</th>
	                <th>Catégorie</th>
	                <th>Titre</th>
	                <th>Réal</th>
	                <th>Année</th>
	                <th>Durée</th>
	                <th>Editer</th>
	                <th>Supprimer</th>
	              </tr>
	            </thead>
	            <tbody>
	            <?php 
	                $response = $bdd->query('SELECT * FROM movie ');
	                while($films = $response->fetch()){
	            ?>
	                <tr>
	                    <td><?php echo $films['id']; ?></td>
	                    <td><?php echo $films['category_id']; ?></td>
	                    <td><?php echo $films['name']; ?></td>
	                    <td><?php echo $films['director']; ?></td>
	                    <td><?php echo $films['year']; ?></td>
	                    <td><?php echo $films['length']; ?></td>
	                    <td><a href="update_movie.php">Editer</a></td>
	                    <td><?php echo $films['length']; ?></td>
	                </tr>
	              
	            <?php
	                }
	                $response->closeCursor(); // Termine le traitement de la requête
	            ?>
	               
	            </tbody>
	          </table>
	        </section>	
	        <section>
	        	<h2> Ajouter un film </h2>
	        </section> 			
		<?php
					}
		?>
		<p>Retourner à la <a href="index.php">page d'accueil</a>.</p>


	</body>
</html>
