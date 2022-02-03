<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <title>Hardware Unit</title>
    <meta charset="utf8">
    <link rel="stylesheet" type="text/css" href="CSS/index.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
    <link rel="stylesheet" type="text/css" href="CSS/product.css?v=<?= ver() ?>" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    require_once("header.php");
    ?>
    <?php
    $sql = "SELECT p.ID,p.*, p.nom as prodnom, p.prix as prodprix, m.nom as marquenom from produits as p join marques as m on p.marque = m.ID WHERE p.dispo = 1 ORDER BY RAND() LIMIT 3";
    $result = $conn->query($sql);
    ?>

    <div class="contenu">
        <h1>Top Achats</h1>
        <div class="best_product">
            <?php
            while ($row = $result->fetch_array()) {
            ?>
                <a href="article.php?id=<?= $row['ID'] ?>">
                    <div class="container">
                        <?php
                        if ($row['vendeur'] == "HardwareUnit") {
                        ?>
                            <div class="block_image">
                                <?php
                                $cheminimg = "Image/" . $row['ID'] . "_1";
                                echo "<img src = '" . $cheminimg . "' alt='' class='image' >";
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="block_seller">
                                <?php
                                $cheminimg = "Image/" . $row['ID'] . "_1";
                                echo "<img src = '" . $cheminimg . "' alt='' class='image' >";
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="price"><?= $row['prodnom'] . "<br>" . $row['prodprix'] ?>€</div>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>
    </div>

    <?php
    require_once("footer.php");
    ?>
</body>

</html>