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

    if (count($_POST) > 0) {
        $lenom = $_POST['nom'];
        $leprenom = $_POST['prenom'];
        $lejour = $_POST["date"];
        $lesexe = isset($_POST['genre']) ? $_POST['genre'] : NULL;
        $letel = $_POST["tel"];
        $update_sql = "UPDATE `utilisateur` SET `Nom`= '$lenom' ,`Prenom`= '$leprenom' ,`Date_De_Naissance`= '$lejour' ,`tel`= '$letel' ,`sexe`= '$lesexe' WHERE `ID` = '". $USER_INFO->getID()."'";
        $update_res = $conn->query($update_sql);
        if ($update_res == true) {
            header('Location: compte.php');
        }
    }
    
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
                            <input type="text" value="<?= $USER_INFO->getNom() ?>" name="nom">
                        </div>
                    </div>
                    <hr class="separator">

                    <div class="modif-info">
                        <div class="">Prénom :<br>
                            <input type="text" value="<?= $USER_INFO->getPrenom() ?>" name="prenom">
                        </div>
                    </div>
                    <hr class=" separator">
                    <div class="modif-info">
                        <div class="">Email :<br>
                            <?= $USER_INFO->getEmail() ?></div>
                        <div class="modif"><button>Modifier</button></div>
                    </div>
                    <hr class="separator">
                    <div class="modif-info">
                        <div class="">Téléphone :<br>
                            <input type="tel" value="<?= $USER_INFO->getTel() ?>" name="tel">
                        </div>
                    </div>
                    <hr class="separator">
                    <div class="modif-info">
                        <div class="">Date de Naissance :<br>
                            <input type="date" value="<?= $USER_INFO->getDate_De_Naissance() ?>" name="date">
                        </div>
                    </div>
                    <hr class="separator">
                    <div class="modif-info">
                        <div class="">Genre :<br>
                            <select name="genre" id="gr">
                                <option value="1" <?= ($USER_INFO->getSexe() == 1 ? 'selected' : '') ?>>Homme</option>
                                <option value="2" <?= ($USER_INFO->getSexe() == 2 ? 'selected' : '') ?>>Femme</option>
                                <option value="3" <?= ($USER_INFO->getSexe() == 3 ? 'selected' : '') ?>>Personnalisé</option>
                            </select>
                        </div>
                    </div>
                    <hr class=" separator">
                    <div class="modif-info">
                        <div class="">Mot de Passe :<br>
                            **********</div>
                        <div class="modif"><button>Modifier</button></div>
                    </div>
                    <input type="submit">
                </form>
            </div>

        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>