<?php
require_once('db.php');
require_once("mail.php");
require_once("login/user_info.php");
require_once("login/common.php");

$STATUS = -1;
if (isset($_GET["code"])) {// losque l'on viens de cette meme page
    $code = strtolower($conn->escape_string($_GET["code"]));
    $sql = "SELECT * FROM `verif` WHERE `verif`.`Code` = '$code';";
    $res = $conn->query($sql);
    if ($res != false) {
        $row = $res->fetch_array();
        if ($row) {
            $user_id = $row["Users"];
            $update_sql = "UPDATE `utilisateur` SET `utilisateur`.`confirme` = 1 WHERE `utilisateur`.`ID` = $user_id";
            $delete_sql = "DELETE FROM `verif` WHERE `verif`.`Users` = $user_id";
            $update_res = $conn->query($update_sql);
            $delete_sql = $conn->query($delete_sql);
            if ($update_res == true) {
                $STATUS = 1;
            } else {
                $_SESSION["CONFIRM_EMAIL_error_msg"] = "L'activation du compte a échoué";
            }
        } else {
            $_SESSION["CONFIRM_EMAIL_error_msg"] = "Code incorrect";
        }
    } else {
        $_SESSION["CONFIRM_EMAIL_error_msg"] = "La connexion au serveur a échoué";
    }
} elseif (isset($_SESSION['email_verif'])) { // losque l'on viens du formulaire d'inscription
    $login = $_SESSION['email_verif'];
    unset($_SESSION['email_verif']); // on la suprime pour eviter que la session se recréer 
    $sql = "SELECT * From `utilisateur` where `utilisateur`.`Email` = '$login'";
    $result = $conn->query($sql);
    if ($result != false) {//verifie si la requete fonctionne en fonction du mail
        $row = $result->fetch_array(); 
        if (!$row["confirme"]) {
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
            if ($result == true) {
                send_mail(
                    $to = $row["Email"],
                    $subject = "Votre code de confirmation",
                    $body = format_str(read('mail/mail-inscription.html'), [ // permet de lire le mail d'inscription
                        "firstName" => $row["Nom"],
                        "lastname" => $row["Prenom"],
                        "code" => strtoupper($code),
                        "pageUrl" => "http://" . $_SERVER["HTTP_HOST"] . "/dev/Hardware_Unit/inscription_verif.php" // addresse du seveur donc (localhost) . le chemin 

                        ])
                       
                );
                $STATUS = 0;
            } else {
                $_SESSION["CONFIRM_EMAIL_error_msg"] = "La création du code de confirmation a échoué";
            }
        } else {
            $STATUS = 2;
        }
    } else {
        $_SESSION["CONFIRM_EMAIL_error_msg"] = "La connexion au serveur a échoué";
    }
}
getUserInfo();
?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8">
    <title>Confirmez votre adresse e-mail — Hardware Unit</title>
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css" />
</head>

<body>
    <?php require_once("header.php"); ?>

    <?php
    if ($STATUS == 1) {
    ?>
        <h3>Votre compte a été activé !</h3>
    <?php
    } elseif ($STATUS == 2) {
    ?>
        <h3>Votre compte est déjà actif !</h3>
        <?php
    } else {
        if ($STATUS == 0) {
        ?>
            <h3>Un code de confirmation vient de vous être envoyé à l'adresse <?= $row["Email"] ?>. Il peut mettre quelques instants à parvenir jusqu'à votre boîte mail. Vérifiez également vos mails indésirables.</h3>
        <?php
        }
        ?>
        <table>
            <form action="inscription_verif.php" method="GET" onsubmit="return check_form();">
                <tr>
                    <td><label for="code">Code de confirmation</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" id="code" name="code" oninput="format_activation_code();" onblur="check_activation_code();">
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Envoyer"></td>
                </tr>
                <tr>
                    <td>
                        <span class="error-msg <?php if (!isset($_SESSION["CONFIRM_EMAIL_error_msg"])) echo "invisible"; ?>" id="general-error-msg"><?php
                            if (isset($_SESSION["CONFIRM_EMAIL_error_msg"])) {
                                echo $_SESSION["CONFIRM_EMAIL_error_msg"];
                                unset($_SESSION["CONFIRM_EMAIL_error_msg"]);
                            } else {
                                echo "Tout va bien !";
                            }
                            ?></span>
                    </td>
                </tr>
            </form>
        </table>
    <?php
    }
    ?>

    <?php require_once("footer.php"); ?>
    <script type="text/javascript" src="../js/confirm-email.js"></script>
</body>
<!-- merci thomas léveillé -->
</html>