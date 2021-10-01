<?php
require_once("../db.php");
require_once("user_info.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf8" />
    <link rel="stylesheet" href="../CSS/connexion.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="../Image/HeadLogo.png">
</head>

<body class="back">
    <?php
    if (count($_POST) > 0) {
        $email = $_POST["email"];
        $lemdp = $_POST["pwd1"];
        $email = mysqli_real_escape_string($conn, $email); // eviter injection sql
        $lemdp = mysqli_real_escape_string($conn, $lemdp);
        $sql = "SELECT ID, MotDePasse, confirme FROM utilisateur WHERE Email =  '$email' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        if (password_verify($lemdp, $row['MotDePasse'])) {

            if ($row['confirme']) {
                $_SESSION["user_id"] = $row['ID'];
                header("location:../index.php");
                exit();
            }else{
                header("location:inscription_verif.php");
                exit();            
            }
        } else {

            $_SESSION['ERROR'] = "L’e-mail ou le mot de passe entré est incorecte. <a href='inscription.php' style='color:black;'><u>Veuillez  créer un compte.</u></a>";
            header("location:connexion.php");
            exit();
        }
        getUserInfo();
    }
    ?>
    <div class="register">
        <form action="connexion.php" method="POST" onsubmit="return checker2()">
            <div>
                <h1>Connexion</h1><a href="../index.php" class="cross1"><img src="../Image/checkmark.png" alt="cross" class="cross"></a>
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
            <div class="e-mail">
                <input type="text" placeholder="Email" name="email">
            </div>
            <div class="Pwd">
                <input type="password" placeholder="Mot de passe" name="pwd1">
            </div>
            <hr>
            <div class="connexion"><input type="submit" value="connexion" onsubmit="">
                <div><a href="">Mot de passe oublié ?</a></div>
            </div>
            <div class="listing"><a href="inscription.php">Pas encore inscrit ? Cliquez ici !</a></div>
        </form>
    </div>
</body>
<script type="text/javascript" src="../js/inscription.js?v=<?= ver() ?>"></script>

</html>