<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
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
    require_once("header.php");
    ?>
    <div class="contenu">
        <?php
        if (isset($USER_INFO->get)) {
            if (count($_GET) > 0) {
                $quantite = $_GET["qte"];
                $sql = "INSERT INTO `panier`(`ID`, `ID_article`, `Qte`, `ID_user`) VALUES (NULL," . $_GET["produit"] . ",$quantite," . $USER_INFO->getID() . ")";
                $result = mysqli_query($conn, $sql);
                header("Location: basket.php"); // si on ajoute on rechage si produit ajouté
                exit();
            }
            $sql2 = "SELECT ROUND(pa.Qte * p.prix, 2) AS prix_produit, pa.Qte, p.* FROM `panier` AS pa JOIN `produits` AS p ON pa.ID_article = p.ID WHERE pa.ID_user = " . $USER_INFO->getID();
            $result2 = mysqli_query($conn, $sql2);
            $c = mysqli_num_rows($result2); // compter le nombre d'articles
            if ($result2 != Null && mysqli_num_rows($result2) > 0) {

        ?>
                <div class="basket1">
                    <h1 class="your_product">Votre panier</h1>
                    <div>
                        <a href="delete_all_Product.php?id=<?= $USER_INFO->getID() ?>">Supprimer tous les éléments</a>
                    </div><br>
                    <hr>
                    <?php
                    $prix_total = 0;
                    while ($row = mysqli_fetch_array($result2)) {
                        $prix_total += round($row["prix_produit"], 2);
                    ?>

                        <div class="product_add">
                            <div>
                                <div class="img_product">
                                    <?php
                                    $cheminimg = "Image/" . $row['ID'] . "_1";
                                    echo "<img src='$cheminimg' alt='' class='image'>";
                                    ?>
                                </div>
                            </div>
                            <div class="info_prd">
                                <div class="Title_product">
                                    <strong><?= $row["nom"] ?></strong>
                                </div>
                                <div class="P_I">
                                    Prix :
                                    <?= $row["prix"] ?> €
                                </div>
                                <div class="P_I">
                                    <form action="basket.php" method="GET">
                                        <label for="qte">Quantité :</label>
                                        <select name="qte" onchange="this.parentNode.submit();" id="qte">
                                            <?php $i = 0;
                                            while ($i < 10) {
                                                $i++;
                                            ?>
                                                <option value="<?= $i ?>" <?php if (isset($row["Qte"]) && $row["Qte"] == $i) {
                                                                                echo "selected";
                                                                            } ?>><?= $i ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </div>
                                <div class="P_I">
                                    Prix total article
                                    <?= $row["prix_produit"] ?> €
                                </div>
                                <div>
                                    <a href="delete.php?id=<?= $row["ID"] ?>">supprimer</a>
                                </div>
                            </div>
                        </div>

                        <hr>
                    <?php
                    }
                    ?>
                    <div class="total_price">
                        Prix total (<?= $c ?> articles) :
                        <?= $prix_total ?>€
                    </div>
                    <a href="buy.php"><button>payer</button></a>
                </div>
            <?php
            } else {
            ?><div class="info_noArticle">
                    <div class="no_Article">Aucun article n'a été selectionné</div>
                </div>
            <?php
            }
            ?>
        <?php
        } else {
        ?>
            <div class="info_noConnect">
                <div class="no_connect">Vous n'êtes pas connecté(es).<a href="login/connexion.php">Veuillez vous connecter</a></div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php
    require_once("footer.php");
    ?>
</body>

</html>