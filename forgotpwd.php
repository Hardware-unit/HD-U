<?php
require_once("db.php");
require_once("login/user_info.php")
?>
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf8" />
    <link rel="stylesheet" href="CSS/connexion.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
</head>

<body class="back">
    <?php
    if (count($_POST) > 0) {
        $emailTel = $_POST["email"];
        $emailTel = mysqli_real_escape_string($conn, $emailTel); // eviter injection sql
        $sql = "SELECT ID, confirme FROM utilisateur WHERE Email =  '$emailTel' or tel ='$emailTel' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row[0] > 0) {
            if ($row['confirme']) {
                $_SESSION["user_id"] = $row['ID'];
                header("location:modifpwd.php");
                exit();
            } else {
                header("location:inscription_verif.php");
                exit();
            }
        } else {

            $_SESSION['ERROR'] = "L’e-mail ou le numéro de téléphone entré est incorecte. <a href='inscription.php' style='color:black;'><u>Veuillez  créer un compte.</u></a>";
            header("location:forgotpwd.php");
            exit();
        }
        getUserInfo();
    }
    ?>
    <div class="register">

        <form action="forgotpwd.php" method="POST" onsubmit="return checker2()">
            <div>
                <h1>Aide avec le mot de passe</h1><a href="" class="cross1"><img src="Image/checkmark.png" alt="cross" class="cross"></a>
                <br>

                <div>
                    <?php if (isset($_SESSION['ERROR'])) {
                    ?>
                        <div> <?= $_SESSION["ERROR"] ?></div>
                    <?php
                        unset($_SESSION["ERROR"]);
                    }
                    ?>
                </div>
            </div>
            <hr>
            <h3>Saisissez l'adresse e-mail ou le numéro de téléphone portable associé à votre compte HardwareUnit.</h3>
            <div class="e-mail">
                <input type="text" placeholder="Adresse e-mail ou numéro de téléphone portable" name="email">
            </div>
            <hr>
            <div class="connexion"><input type="submit" value="Continuer" onsubmit=""></div>
        </form>
    </div>
</body>
<script type="text/javascript" src="../js/inscription.js?v=<?= ver() ?>"></script>

</html>