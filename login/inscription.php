<?php
require_once("../db.php");
require_once("../reCaptcha/autoload.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Page d'inscription</title>
    <meta charset="utf8" />
    <link rel="stylesheet" href="../CSS/inscription.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="../Image/HeadLogo.png">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body class="back" onload="init();">
    <?php
    
    $recaptcha = new \ReCaptcha\ReCaptcha('6Lf6ZawcAAAAAFKnjmTxFezTSjaX9-VBZ79RKs_y');
    $resp = $recaptcha->setExpectedHostname('recaptcha-demo.appspot.com')
        ->verify($_POST['g-recaptcha-response']);
    if ($resp->isSuccess()) {
        // Verified!
    } else {
        $errors = $resp->getErrorCodes();
    }

    if (count($_POST) > 0) {
        $lenom = $_POST["nom"];
        $leprenom = $_POST["prenom"];
        $email = $_POST["email"];
        $lepass = $_POST["pwd1"];
        $lejour = $_POST["day"];
        $lemois = $_POST["month"];
        $leannee = $_POST["year"];
        $lesexe = isset($_POST['hf']) ? $_POST['hf'] : NULL;
        $letel = $_POST["tel"];
        $lepass = password_hash($lepass, PASSWORD_DEFAULT);

        $sql2 = "SELECT count(*) FROM utilisateur WHERE Email = '$email' or tel = '$letel' ";

        $result = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_array($result);

        if ($row[0] > 0) { // le premier element du tableau qui sont deja existant 
            echo "<script>alert(\"information: Email ou téléphone déjà utilisé. Avez vous déjà un compte ?\")</script>";
        } else {
            $sql = "INSERT INTO utilisateur VALUES (NULL, '$lenom', '$leprenom', '$email', '$lepass', '$leannee-$lemois-$lejour',0,'$letel' ,'$lesexe',0)";
            mysqli_query($conn, $sql);
            $_SESSION["email_verif"] = $email;
            header("location:../inscription_verif.php");
        }
    }
    ?>
    <div class="register">
        <div>
            <h1>S'inscrire</h1><a href="connexion.php" class="cross1"><img src="../Image/checkmark.png" alt="cross" class="cross"></a>
            <br>
        </div>
        <hr class="hr1">
        <form action="inscription.php" method="POST" onsubmit="return checker()">
            <div class="name">
                <input placeholder="Nom" type="text" name="nom" onblur="check_family_name();" />
                <input placeholder="Prénom" type="text" name="prenom" onblur="check_name();" />
            </div>
            <div class="e-mail">
                <input placeholder="Email" type="text" name="email" onblur="check_email();" />
            </div>
            <span id="error-Email"></span>
            <div class="Tel">
                <input placeholder="Téléphone" type="text" name="tel" onblur="check_tel();" />
            </div>
            <div class="Pwd">
                <input placeholder="Mot de passe" type="password" name="pwd1" onblur="check_pwd();" />
            </div>
            <div class="Pwd">
                <input placeholder="Confirmer le mot de passe" type="password" name="pwd2" onblur="check_pwd2();" />
                <span class="Error-Message" id="pwderror">les mots de passe ne correspondent pas</span>
            </div>
            <div class="Birth" id="birth_date">
                <span class="birth_title"> &nbsp;Date de naissance :</span>
                <table>
                    <td>
                        <label hidden for="birth-day">Jour de naissance</label>
                        <select id="birth-day" name="day" oninput="check_birth_date();"></select>
                    </td>
                    <td>
                        <label hidden for=" birth-month">Mois de naissance</label>
                        <select id="birth-month" name="month" oninput="gen_birth_days();check_birth_date();">
                            <option value="1">janvier</option>
                            <option value="2">février</option>
                            <option value="3">mars</option>
                            <option value="4">avril</option>
                            <option value="5">mai</option>
                            <option value="6">juin</option>
                            <option value="7">juillet</option>
                            <option value="8">août</option>
                            <option value="9">septembre</option>
                            <option value="10">octobre</option>
                            <option value="11">novembre</option>
                            <option value="12">décembre</option>
                        </select>
                    </td>
                    <td>
                        <label hidden for="birth-year">Année de naissance</label>
                        <select id="birth-year" name="year" oninput="gen_birth_days();check_birth_date();"></select>
                    </td>
                </table>
            </div>
            <span class="Genre"> &nbsp;Genre :</span>
            <div class="H_F">
                <div class="genre" onclick="this.querySelector('input').checked = true;">
                    <label for="sexe1">Homme : </label><input type="radio" name="hf" id="sexe1" value="1" oninput="check_sex();" />
                </div>
                <div class="genre" onclick="this.querySelector('input').checked = true;">
                    <label for="sexe2">Femme : </label><input type="radio" name="hf" id="sexe2" value="2" oninput="check_sex();" />
                </div>
                <div class="genre" onclick="this.querySelector('input').checked = true;">
                    <label for="sexe3">Personnalisé : </label><input type="radio" name="hf" id="sexe3" value="3" oninput="check_sex();" />
                </div>
            </div>
            <div class="g-recaptcha" data-sitekey="6Lf6ZawcAAAAAAWS-IUyjj5MLjOJIu_onfS7JKGN"></div>
            <br />
            <hr>
            <div class="listing">
                <input type="submit" value="S'inscrire" class="listing">
            </div>



        </form>
    </div>
    <script type="text/javascript" src="../js/inscription.js?v=<?= ver() ?>"></script>
</body>


</html>