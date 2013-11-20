<?php
      require_once("../../../ressources/templates/admin/header.php");    
?>

<?php
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
	    // Affichage des fonctionnalités admin
			}
	    ?>
		    <div class="row height-full">
			  <div class="col-md-3 gallery-part">
			  	<div class="gallery-header">
			  		<div class="btn btn-default  pull-right">
			  			<a href="addGallery.php">Ajouter galerie</a>
			  		</div>
			  		<h3>Galeries</h3>
			  		
			  	</div>
			  </div>
			  <div class="col-md-9 picture-part">
			  	<div class="picture-header">
			  		<div class="btn btn-default pull-right">
			  			<a href="addPicture.php">Ajouter image</a>
			  		</div>
			  		<h3>Images</h3>
			  		
			  	</div>
			  </div>
			</div>

	
	</body>
</html>
