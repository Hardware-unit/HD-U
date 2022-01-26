<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8" />
    <title>Mon compte</title>
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>">
    <link rel="stylesheet" type="text/css" href="CSS/compte.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">

</head>


<body>
    <?php
    getUserInfo();
    getPanierInfo();
    require_once("header.php");
    ?>
    <div class="contenu">
        <div class="Profil">
            <div class="VotreProfil">
                <h1>Votre profil</h1>
            </div>
            <div class="InfoPeople">
                <div class="modif-info">
                    <div class="">Nom : <br>
                        <?= $USER_INFO->getNom() ?></div>
                    <div class="modif"><a href="modif_lastname.php"><button>Modifier</button></a></div>
                </div>
                <hr class="separator">
                <div class="modif-info">
                    <div class="">Prénom :<br>
                        <?= $USER_INFO->getPrenom() ?></div>
                    <div class="modif"><a href="modif_firstname.php?id"><button>Modifier</button></a></div>
                </div>
                <hr class="separator">
                <div class="modif-info">
                    <div class="">Email :<br>
                        <?= $USER_INFO->getEmail() ?></div>
                    <div class="modif"><button>Modifier</button></div>
                </div>
                <hr class="separator">
                <div class="modif-info">
                    <div class="">Téléphone :<br>
                        <?= $USER_INFO->getTel() ?></div>
                    <div class="modif"><button>Modifier</button></div>
                </div>
                <hr class="separator">
                <div class="modif-info">
                    <div class="">Date de Naissance :<br>
                        <?= $USER_INFO->getDate_De_Naissance() ?></div>
                    <div class="modif"><button>Modifier</button></div>
                </div>
                <hr class="separator">
                <div class="modif-info">
                    <div class="">Mot de Passe :<br>
                        **********</div>
                    <div class="modif"><button>Modifier</button></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>