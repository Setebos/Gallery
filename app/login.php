<?php
     require_once("../ressources/templates/header.php");
?>
        <container>
            <section class="form_login">
                <h2>Authentification</h2>
                <div class="well">
                    <form method="post" action="admin.php" role="form">
                        <div class="form-group">
                            <label name="login"> Saisissez votre login</label>
                            <input type="text" name="login" />
                        </div>
                        <div class="form-group">
                            <label name="password"> Saisissez votre mot de passe</label>
                            <input type="password" name="password" />
                        </div>
                        <button type="submit" class="btn btn-default">Valider</button>
                    </form>
                </div>

            </section>
        </container>
    </body>
</html>
