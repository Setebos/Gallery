<?php
     require_once("../ressources/templates/header.php");
?>
        <section>
            <h2>Authentification</h2>

            <form method="post" action="admin.php">
                <label name="login"> Saisissez votre login</label>
                <input type="text" name="login" />
                <br/>
                <label name="password"> Saisissez votre mot de passe</label>
                <input type="text" name="password" />
                <input type="submit" value="Valider" />
            </form>

        </section>
       
         

         
        <?php
        /* Encore du PHP
        Toujours du PHP */
        ?>
    </body>
</html>
