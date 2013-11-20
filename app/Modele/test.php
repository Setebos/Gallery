<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8"/>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/> 
		<link rel="stylesheet" type="text/css" href="../css/public.css"/>
	</head>
	<body>

<?php 

include 'Gallery.php';
include 'GalleryManager.php';


include("../../ressources/config.php");
try {
   $db = new PDO($config["db"]["dbengine"].':host='.$config["db"]["host"].';dbname='.$config["db"]["dbname"], $config["db"]["username"], $config["db"]["password"]);
}
catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
}

$manager = new GalleryManager($db);

/*$gallery = new Gallery(array(
	'id' => null,
	'name' => 'Gallerie Test',
	'description' => 'Beep boop beep'
));

$manager->createGallery($gallery);

$gallery2 = $manager->getGallery(6);
var_dump($gallery2);
$gallery2->setName("Test Update");
$manager->updateGallery($gallery2);*/


/*$request = $db->query('SELECT id, name, description FROM gallery');
    
while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
{
  // On passe les données (stockées dans un tableau) concernant le personnage au constructeur de la classe.
  // On admet que le constructeur de la classe appelle chaque setter pour assigner les valeurs qu'on lui a données aux attributs correspondants.
  $gallery = new Gallery($donnees);
        
  echo $gallery->getName(), ' + ', $gallery->getDescription();
}*/

/*$listGalleries = $manager->getListGalleries();

foreach ($listGalleries as $gallery) {
	echo $gallery->getName(), ' + ', $gallery->getDescription(), '<br/>';
}*/

/*$gallery2 = $manager->getGallery(4);
$manager->deleteGallery($gallery2);
echo 'fini';
*/

?>

<style type="text/css">
	.dialog-confirm {
		display: none;
	}

	.dialog-confirm p {
		display: none;
	}
</style>

<script>
	$( document ).ready(function() {
		 $("#delete-button").click(function() {
		 	$("#dialog-confirm").css("display", "block")
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:300,
				width: 300,
				modal: true,
				buttons: {
					"Confirmer": function() {
						<?php
						$gallery2 = $manager->getGallery(9);
						$manager->deleteGallery($gallery2);
						?>
						$( this ).dialog( "close" );
					},
					"Annuler": function() {
						$( this ).dialog( "close" );
					}
				}
			});
		});
	});
</script>

<div id="dialog-confirm" title="Supprimer la galerie ?">
	<p>
		 <span class="glyphicon glyphicon-warning-sign"></span>
		Supprimer la galerie détruira toutes les images la composant. Êtes-vous sur de vouloir effectuer cette action?
	</p>
</div>

<button id="delete-button" type="button" class="btn btn-warning">Supprimer</button>

	</body>
</html>
