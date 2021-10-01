<?php
require_once('db.php');
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8" />
    <title><?php if (isset($_GET["searchBar"]) && !empty($_GET["searchBar"])) {
                echo "HardwareUnit : " . $_GET["searchBar"];
            } else {
                header("location: index.php");
                exit();
            } ?></title>

    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
    <link rel="stylesheet" type="text/css" href="CSS/product.css?v=<?= ver() ?>" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    require_once('header.php');
    ?>
    <div class="contenu">
        <div class="block1">
            <?php
            if (isset($_GET['searchBar']) && isset($_GET["modeTri"])) { //si on viens du form
                $search = htmlspecialchars($_GET['searchBar']); //eviter les injection sql
                $search_array = explode(" ", $search); // separre la recherche 
                $sql = "SELECT p.ID, p.*,p.nom AS prodnom, p.prix AS prodprix, m.nom AS marquenom FROM `produits` AS p JOIN `marques` AS m ON p.marque = m.ID WHERE p.dispo = 1"; // %=mot avent et apres
                $sql .= " AND (";
                $tableauVide = array();
                foreach ($search_array as $mot) {
                    array_push($tableauVide, "p.nom LIKE '%$mot%'");
                }
                $sql .= join(" OR ", $tableauVide);
                $sql .= ")";

                //$sql .= " ORDER BY " . $_GET["modeTri"];
                $result = mysqli_query($conn, $sql);
                $c = mysqli_num_rows($result); // nombre d'info trouver
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['confirmation'] == 1) {


            ?>
                        <a href="article.php?id=<?= $row['ID'] ?>">
                            <!--get id de la page article = a celui-ci-->
                            <div class="articles">
                                <?php
                                if ($row['vendeur'] == "HardwareUnit") {
                                ?>
                                    <div class="block_image">
                                        <div>
                                            <?php
                                            $cheminimg = "Image/" . $row['ID'] . "_1";
                                            echo "<img src = '" . $cheminimg . "' alt='image' class='image' >";
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="block_seller">
                                        <div>
                                            <?php
                                            $cheminimg = "Image/" . $row['ID'] . "_1";
                                            echo "<img src = '" . $cheminimg . "' alt='image' class='image' >";
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="block_info">
                                    <table align="center" width="90%" class="table">
                                        <tr>
                                            <div class="name">
                                                <td colspan="2" align="center">
                                                    <?= $row["prodnom"] ?>
                                                </td>
                                            </div>
                                        </tr>
                                        <tr align="left">
                                            <div class="brand">
                                                <td>
                                                    Marque :
                                                </td>
                                                <td>
                                                    <?= $row["marquenom"] ?>
                                                </td>
                                            </div>
                                        </tr>
                                        <tr align="left">
                                            <div class="price">
                                                <td>
                                                    Prix :
                                                </td>
                                                <td id="prix">
                                                    <?= $row["prodprix"] ?>€
                                                </td>
                                            </div>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </a>
                    <?php

                    }
                }
                if ($c == 0) {
                    ?>
                    <div class="notArticle">
                        <H1>Aucun article trouver</H1>
                    </div>
                <?php
                } else if ($c == 1) {
                ?>
                    <div class="numberArticle">
                        <div class="infoArticle">Nombre d'article trouvé : <?= $c ?></div>
                    </div>
                <?php
                } else if ($c > 1) {
                ?>
                    <div class="numberArticle">
                        <div class="infoArticles"> Nombres d'articles trouvés : <?= $c ?> </div>
                        <div class="tri">
                            <select id="tri" oninput="recup();">
                                <option value="RAND()">trier par : </option>
                                <option value="p.prix ASC" <?php if (isset($_GET["modeTri"]) && $_GET["modeTri"] == "p.prix ASC") {
                                                                echo "selected";
                                                            } ?>> prix : ordre croissant</option>
                                <option value="p.prix DESC" <?php if (isset($_GET["modeTri"]) && $_GET["modeTri"] == "p.prix DESC") {
                                                                echo "selected";
                                                            } ?>>prix : ordre décroissant</option>
                            </select>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
    require_once('footer.php');
    ?>
</body>

</html>