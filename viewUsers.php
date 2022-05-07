<?php
require_once "db.php";
require_once "login/user_info.php";
require_once "class/user.php";
require_once "info_panier.php";
?>
<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="UTF-8">
    <title>Profil utilisateur</title>
    <link rel="stylesheet" type="text/css" href="CSS/basket.css?v=<?= ver() ?>" />
    <link rel="icon" type="image/png" href="Image/HeadLogo.png" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
    <link rel="stylesheet" type="text/css" href="CSS/compte.css?v=<?= ver() ?>">
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    $user = json_decode(file_get_contents("http://localhost/dev/Hardware_Unit/API_HU/users/" . $_GET['id']))[0];
    if ($USER_INFO->getDroit() == 1) {
        require_once("header.php");

    ?>
        <div class="contenu">
            <div class="Profil">
                <div class="VotreProfil">
                    <h1>Votre profil</h1>
                </div>
                <div class="InfoPeople">
                    <form action="compte.php" method="POST">
                        <div class="modif-info">
                            <div class="">Nom : <br>
                                <?= $user->Nom ?>
                            </div>
                        </div>
                        <hr class="separator">

                        <div class="modif-info">
                            <div class="">Prénom :<br>
                                <?= $user->Prenom ?>
                            </div>
                        </div>
                        <hr class=" separator">
                        <div class="modif-info">
                            <div class="">Email :<br>
                                <?= $user->Email ?>
                            </div>
                        </div>
                        <hr class="separator">
                        <div class="modif-info">
                            <div class="">Téléphone :<br>
                                <?= $user->tel ?>
                            </div>
                        </div>
                        <hr class="separator">
                        <div class="modif-info">
                            <div class="">Date de Naissance :<br>
                                <?php
                                $date = new DateTime($user->Date_De_Naissance);
                                echo $date->format('d/m/Y');
                                ?>
                            </div>
                        </div>
                        <hr class="separator">
                        <div class="modif-info">
                            <div class="">Genre :<br>
                                <?= $user->nom ?>
                            </div>
                        </div>
                        <hr class=" separator">

                        <input type="submit">
                    </form>
                </div>

            </div>
        </div>
    <?php
        require_once("footer.php");
    } else {
    ?>
        <div class="info_noConnect">
            <div class="no_connect">Vous n'êtes pas connecté(es).<a href="../login/connexion.php">Veuillez vous connecter</a> ou vous ne disposer pas de droit permettent d'ouvrir cette page.</div>
        </div>
    <?php
    }
    ?>
    <script type="text/javascript" src="js/admin.js"></script>
</body>


</html>