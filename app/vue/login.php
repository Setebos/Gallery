<?php
     require_once("ressources/templates/header.php");
?>
        <container>
            <section class="form_login">
                <h2>Authentification</h2>
                <div class="well">
                    <form id="loginForm" method="post" action="<?= "index.php?section=login_controller "?>" role="form">
                        <div class="form-group">
                            <label name="login"> Saisissez votre identifiant</label>
                            <input class="form-control input-sm" id="inputLogin" type="text" name="login" />
                        </div>
                        <div class="form-group">
                            <label name="password"> Saisissez votre mot de passe</label>
                            <input class="form-control input-sm" id="inputPassword" type="password" name="password" />
                            <br/><span id="loginError">Identifiant ou mot de passe incorrect</span>
                        </div>
                        <button type="submit" class="btn btn-default">Valider</button>
                    </form>
                </div>

            </section>
        </container>
    </body>
    <script type="text/javascript" src="app/js/admin.js"></script>
</html>
