<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nos Produits</title>
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
    <link rel="stylesheet" type="text/css" href="CSS/product.css?v=<?= ver() ?>" />
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
</head>

<body>
    <div class="contenu">
        <?php
        getUserInfo();
        getPanierInfo();
        require_once("header.php");
        ?>
        <?php
        if (isset($_GET["tri"])) {
            $sql = "SELECT p.ID, p.* ,p.nom as prodnom, p.prix as prodprix, m.nom as marquenom from produits p join marques m on p.marque = m.ID WHERE p.dispo = 1 ORDER BY " . $_GET["tri"];
            $result = mysqli_query($conn, $sql);
        ?>
            <div class="block1">
                <?php
                $c = mysqli_num_rows($result);
                while ($BLOC = mysqli_fetch_array($result)) {

                ?>
                    <div class="articles">
                        <a href="article.php?id=<?= $BLOC['ID'] ?>">
                            <?php
                            if ($BLOC['vendeur'] == "HardwareUnit") {
                            ?>
                                <div class="block_image">
                                    <div>
                                        <?php
                                        $cheminimg = "Image/" . $BLOC['ID'] . "_1";
                                        echo "<img src = '" . $cheminimg . "' alt='' class='image' >";
                                        ?>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="block_seller">
                                    <div>
                                        <?php
                                        $cheminimg = "Image/" . $BLOC['ID'] . "_1";
                                        echo "<img src = '" . $cheminimg . "' alt='' class='image' >";
                                        ?>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="block_info">
                                <table align=center width=90% class="table">
                                    <tr>
                                        <div class="name">
                                            <td colspan="2" align="center">
                                                <?= $BLOC["prodnom"] ?>
                                            </td>
                                        </div>
                                    </tr>
                                    <tr align="left">
                                        <div class="brand">
                                            <td>
                                                Marque :
                                            </td>
                                            <td>
                                                <?= $BLOC["marquenom"] ?>
                                            </td>
                                        </div>
                                    </tr>
                                    <tr align="left">
                                        <div class="price">
                                            <td>
                                                Prix :
                                            </td>
                                            <td>
                                                <?= $BLOC["prodprix"] ?>€
                                            </td>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
                <div class="numberArticle">
                    <div class="infoArticles"> Nous proposons : <?= $c ?> articles</div>
                    <div class="tri">
                        <form action="product.php" method="GET">
                            <select name="tri" onchange="this.parentNode.submit();">
                                <!-- permet de submit l'ellement parent -->
                                <option value="RAND()">trier par : </option>
                                <option value="p.prix ASC" <?php if (isset($_GET["tri"]) && $_GET["tri"] == "p.prix ASC") {
                                                                echo "selected";
                                                            } ?>> prix : ordre croissant</option>
                                <option value="p.prix DESC" <?php if (isset($_GET["tri"]) && $_GET["tri"] == "p.prix DESC") {
                                                                echo "selected";
                                                            } ?>>prix : ordre décroissant</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>