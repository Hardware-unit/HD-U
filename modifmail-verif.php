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
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">

</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    require_once("header.php");

    if (count($_POST) > 0) {
        $thenewmail = $_POST['NewMail'];
        $sql = "SELECT count(*) FROM utilisateur WHERE Email = '$thenewmail'";
        $recup_sql = $conn->query($sql);
        if ($recup_sql == true) {
            header('Location:send_mail_modif.php');
        }
    }

    ?>
    <div class="contenu">
        <div class="Profil">
            <div class="VotreProfil">
                <h1>Votre nouveaux mail</h1>
            </div>
            <div class="InfoPeople">
                <form action="compte.php" method="POST">
                    <div class="modif-info">
                        <div class="">Nouveaux Mail : <br>
                            <input type="email" value="<?= $USER_INFO->getEmail() ?>" name="NewMail">
                        </div>
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