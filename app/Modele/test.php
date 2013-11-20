<!DOCTYPE html>
<html>
    <head>
    	<meta charset="UTF-8"/>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

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

<script>
	$( document ).ready(function() {
		 $(function() {
			$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:300,
				width: 300,
				modal: true,
				buttons: {
					"Confirmer": function() {
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
		<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
		Supprimer la galerie détruira les images la composant. Êtes-vous sur de vouloir effectuer cette action ?
	</p>
</div>

	</body>
</html>
