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
    <title>Panier</title>
    <link rel="stylesheet" type="text/css" href="CSS/basket.css?v=<?= ver() ?>" />
    <link rel="icon" type="image/png" href="Image/HeadLogo.png" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    if ($USER_INFO->getID() >= 1) {
        require_once("header.php");
        $sql = "SELECT * ,s.nom AS genre FROM `utilisateur` AS u JOIN sexe AS s on u.sexe = s.ID_sex where `confirme` = 1";
        $result = $conn->query($sql);
    ?>
        <div class="contenu">
            <?php
            $c = mysqli_num_rows($result);
            while ($BLOC = $result->fetch_array()) {
            ?>
                <table>
                    <tr>
                        <td><?=
                            $BLOC['ID']
                            ?></td>
                        <td><?=
                            $BLOC['Nom']
                            ?></td>
                        <td><?=
                            $BLOC['Prenom']
                            ?></td>
                        <td><?=
                            $BLOC['Email']
                            ?></td>
                        <td><?=
                            $BLOC['Date_De_Naissance']
                            ?></td>
                        <td><?=
                            $BLOC['Droit']
                            ?></td>
                        <td><?=
                            $BLOC['tel']
                            ?></td>
                        <td><?=
                            $BLOC['genre']
                            ?></td>
                    </tr>
                    <?php if($BLOC['Droit']==0){
                        ?>
                    <td><button></button></td>
                    </tr>
                    <td><?=
                        $BLOC['genre']
                        ?></td>
                        <?php } ?>
                    </tr>
                </table>
                <div></div>


            <?php
            }

            ?>
            <?=
            $c
            ?>
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