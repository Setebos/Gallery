<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Test Gallery js </title>
        <link rel="stylesheet" type="text/css" href="css/projet-01.css"/>
        <!--[if IE]>
            <script src="js/html5-ie.js"></script>
            <script src="js/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        try {
             $bdd = new PDO('mysql:host=localhost;dbname=JsGallery', 'root', 'd4t4');
        }
        catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
        }

        ?>

        <header>
             <h1>Paye ton film</h2> 

            <form method="post" action="admin.php">
                <label name="login"> Saisissez votre login</label>
                <input type="text" name="login" />
                <br/>
                <label name="password"> Saisissez votre mot de passe</label>
                <input type="text" name="password" />
                <input type="submit" value="Valider" />
            </form>
        </header>
        <section>
            <h2> Films en stock </h2>

            <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Id</th>
                <th>Catégorie</th>
                <th>Titre</th>
                <th>Réal</th>
                <th>Année</th>
                <th>Durée</th>
              </tr>
            </thead>
            <tbody>
            <?php 
                $response = $bdd->query('SELECT * FROM movie LEFT JOIN category ON movie.category_id = category.id');
                while($films = $response->fetch()){
            ?>
                <tr>
                    <td><?php echo $films['id']; ?></td>
                    <td><?php echo $films['category_id']; ?></td>
                    <td><?php echo $films['name']; ?></td>
                    <td><?php echo $films['director']; ?></td>
                    <td><?php echo $films['year']; ?></td>
                    <td><?php echo $films['length']; ?></td>
                </tr>
              
            <?php
                }
                $response->closeCursor(); // Termine le traitement de la requête
            ?>
               
            </tbody>
          </table>

        </section>
       
         

         
        <?php
        /* Encore du PHP
        Toujours du PHP */
        ?>
    </body>
</html>
