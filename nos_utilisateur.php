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
    <title>Nos Utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="CSS/basket.css?v=<?= ver() ?>" />
    <link rel="icon" type="image/png" href="Image/HeadLogo.png" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    $users = json_decode(file_get_contents("http://localhost/dev/Hardware_Unit/API_HU/users"));
    if ($USER_INFO->getDroit() == 1) {
        require_once("header.php");

    ?>
        <div class="contenu">
            <table>
                <tr>
                    <td>ID</td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Email</td>
                    <td>Droit</td>
                    <td>Modifier</td>
                </tr>
                <?php foreach ($users as $user) :
                ?>

                    <tr class="users-list">
                        <div>
                            <td><?= $user->ID ?></td>
                            <td><?= $user->Nom ?></td>
                            <td><?= $user->Prenom ?></td>
                            <td><?= $user->Email ?></td>
                            <td>
                                <?php if ($user->Droit == 1) {
                                    echo 'Administrateur';
                                } else {
                                    echo 'Utilisateur';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="viewUsers.php?id=<?= $user->ID ?>">
                                    <button>voir</button>
                                </a>
                            </td>

                            <?php if ($user->Droit == 0) {
                            ?>
                                <td>
                                    <a href="supUser.php?id=<?= $user->ID ?>">
                                        <button class="btn-sup">
                                            Suprimier utilisateur
                                        </button>
                                    </a>
                                </td>
                            <?php
                            }
                            ?>

                        </div>
                    </tr>

                <?php endforeach; ?>
            </table>
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