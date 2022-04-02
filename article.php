<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8" />
    <title>Article</title>
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>" />
    <link rel="stylesheet" type="text/css" href="CSS/1article.css?v=<?= ver() ?>" />
</head>

<body>
    <?php
    getUserInfo();
    getPanierInfo();
    require_once('header.php');
    ?>
    <div class="contenu">
        <?php
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $get_id = htmlspecialchars($_GET['id']);
            $sql = "SELECT p.*, m.nom AS NomMarque FROM `produits` AS p JOIN `marques` AS m JOIN `chipsets` AS c JOIN `taille_de_memoire` AS tm ON p.marque = m.ID AND p.chipset = c.ID AND p.taille_de_memoire = tm.ID WHERE p.ID = $get_id";
            $result = $conn->query($sql);
            //if ($result) {
            //$sql .= " AND p.dispo = 1";
            $row = $result->fetch_array();
            if ($row['dispo'] == 1) {
        ?>
                <div class="bloc1">
                    <div class="articles">
                        <div class="block_image">
                            <div class="Img_prod">
                                <?php
                                $cheminimg = "Image/" . $row['ID'] . "_1";
                                echo "<img src = '$cheminimg' alt='' class='image' >";
                                ?>
                            </div>
                        </div>
                        <div class="block_info">
                            <table align="center" width=90% class="table">
                                <div class="name">
                                    <td colspan="2" align="center">
                                        <h3><?= $row["nom"] ?></h3>
                                    </td>
                                </div>
                                <tr align="left">
                                    <div class="">
                                        <td id="">
                                            <?php if ($row["dispo"] == 1) { ?>
                                                <div>En stock</div>
                                            <?php
                                            } else {
                                            ?>
                                                <div>En rupture de stock</div>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </div>
                                </tr>
                                <tr align="left">
                                    <div class="brand">
                                        <td>
                                            Marque :
                                        </td>
                                        <td>
                                            <?= $row["NomMarque"] ?>
                                        </td>
                                    </div>
                                </tr>
                                <tr align="left">
                                    <div class="">
                                        <td>
                                            Chipset :
                                        </td>
                                        <td id="">
                                            <?= $row["chipset"] ?>
                                        </td>
                                    </div>
                                </tr>
                                <tr align="left">
                                    <div class="">
                                        <td>
                                            Reférence :
                                        </td>
                                        <td id="">
                                            <?= $row["reference"] ?>
                                        </td>
                                    </div>
                                </tr>
                                <tr align="left">
                                    <div class="">
                                        <td>
                                            Prix :
                                        </td>
                                        <td id="prix">
                                            <?= $row["prix"] ?>€
                                        </td>
                                    </div>
                                </tr>

                            </table>
                        </div>
                        <div class="bloc_q">
                            <form action="basket.php" method="GET">
                                <h4>Quantité :
                                    <select name="qte">
                                        <?php $i = 0;
                                        while ($i < 10) {
                                            $i++;
                                        ?>

                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </h4>
                                <br>
                                <input type="hidden" name="produit" value="<?= $get_id ?>">
                                <input type="submit" class="basket" value="ajouter au panier">
                            </form>
                        </div>
                    </div>
                    <div class="ligne_prod">
                        <hr>
                    </div>
                    <div class="description">
                        <div>
                            <h3>Description :</h3>
                        </div>
                        <div><?= $row["description"] ?></div>
                    </div>
                    <div class="ligne_prod">
                        <hr>
                    </div>
                </div>
                <?php
            } else {
                ?>rupture<div class="articles">
                    <div class="block_image">
                        <div>
                            <?php
                            $cheminimg = "Image/" . $row['ID'] . "_1";
                            echo "<img src = '" . $cheminimg . "' alt='' class='image' >";
                            ?>
                        </div>
                    </div>
                    <div class="block_info">
                        <table align="center" width=90% class="table">
                            <tr>
                                <div class="name">
                                    <td colspan="2" align="center">
                                        <?= $row["nom"] ?>
                                    </td>
                                </div>
                            </tr>
                            <tr align="left">
                                <div class="brand">
                                    <td>
                                        Marque :
                                    </td>
                                    <td>
                                        <?= $row["NomMarque"] ?>
                                    </td>
                                </div>
                            </tr>
                            <tr align="left">
                                <div class="price">
                                    <td>
                                        Prix :
                                    </td>
                                    <td id="prix">
                                        <?= $row["prix"] ?>€
                                    </td>
                                </div>
                            </tr>
                        </table>
                    </div>
                </div>
        <?php }
        }
        ?>

    </div>
    <?php
    require_once('footer.php');
    ?>
</body>

</html>