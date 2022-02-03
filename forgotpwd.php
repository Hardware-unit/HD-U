<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("mail.php");
require_once("login/common.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf8" />
    <link rel="stylesheet" href="CSS/connexion.css?v=<?= ver() ?>">
    <link rel="stylesheet" href="CSS/mail.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
</head>

<body class="back">
    <?php
    $STATUS = 1;
    if (count($_POST) > 0) {
        $emailTel = $_POST["email"];
        $emailTel = $conn->real_escape_string($emailTel); // eviter injection sql
        $sql = "SELECT ID, confirme, Email, Nom, Prenom FROM utilisateur WHERE Email =  '$emailTel' or tel ='$emailTel' ";
        $result = $conn->query($sql);
        $row = $result->fetch_array();
        if ($row[0] > 0) {
            if ($row["confirme"]) {
                $code_unique = false;
                while (!$code_unique) {
                    $code = random_code(6); // créer un code random de 6 charactères 

                    $check_sql = "SELECT COUNT(*) FROM `verif` WHERE `verif`.`Code` = '$code'"; //cherche si c'est égale à 1 ou a 0
                    $check_result = $conn->query($check_sql);
                    if ($check_result != false) { //verifie si la requete fonctionne en fonction du code
                        $check_row = $check_result->fetch_array();
                        if ($check_row[0] == 0) { // verifie que le code n'est pas deja existant 
                            $code_unique = true;
                        }
                    }
                }
                $sql2 = "DELETE FROM `verif` WHERE `verif`.`Users` = " . $row["ID"]; // supprimer tous les code deja utiliser PAR l'utilisateur utilise l'id pour le trouver
                $date_Fin  = new DateTime();
                $date_Fin->add(new DateInterval("P1D"));
                $date_Fin = $date_Fin->format('Y-m-d H:i:s');
                $sql3 = "INSERT INTO `verif` (`ID`, `Code`, `Users`,`date_fin`) VALUES (NULL, '$code', " . $row["ID"] . ",'$date_Fin')";
                $result2 = $conn->query($sql2);
                $result3 = $conn->query($sql3);
                if ($result3 == true) {
                    send_mail(
                        $to = $row["Email"],
                        $subject = "HardwareUnit | Changement de mot de passe",
                        $body = format_str(read('mail/mail-pwd.html'), [ // permet de lire le mail d'inscription
                            "firstName" => $row["Nom"],
                            "lastname" => $row["Prenom"],
                            "code" => strtoupper($code),
                            "pageUrl" => "http://" . $_SERVER["HTTP_HOST"] . "/dev/Hardware_Unit/modifpwd.php" // addresse du seveur donc (localhost) . le chemin 

                        ])
                    );
                    $STATUS = 0;
                } else {
                    $_SESSION["CONFIRM_EMAIL_error_msg"] = "La création du code de confirmation a échoué";
                }
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
        <?php if ($STATUS == 0) {
        ?>
            <div class="mailmessage"> Un mail a été envoyé a l'adresse suivante <u><?= $row["Email"]
                                                                                    ?></u> ; vérifiez vos mails ou vos spams.</div>
        <?php } ?>
        <form action="forgotpwd.php" method="POST" onsubmit="return checker2()">
            <div>
                <h1>Changer de mot de passe</h1><a href="login/connexion.php" class="cross2"><img src="Image/checkmark.png" alt="cross" class="cross"></a>
                <br>

                <div>
                    <?php if (isset($_SESSION['ERROR'])) {
                    ?>
                        <div class="errormsg"><?= $_SESSION["ERROR"] ?></div>
                    <?php
                        unset($_SESSION["ERROR"]);
                    }
                    ?>

                </div>
            </div>
            <hr>
            <h3 class="msgSaisi">Saisissez l'adresse e-mail ou le numéro de téléphone portable associé à votre compte HardwareUnit.</h3>
            <div class="e-mail">
                <input type="text" placeholder="Adresse e-mail ou numéro de téléphone portable" name="email">
            </div>
            <hr>
            <div class="connexion"><input type="submit" value="Continuer" ></div>
        </form>
    </div>
</body>
<script type="text/javascript" src="../js/inscription.js?v=<?= ver() ?>"></script>

</html>