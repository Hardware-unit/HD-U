<?php
require_once("db.php");
require_once("login/user_info.php");
require_once("info_panier.php");
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="utf-8" />
    <title>vendre</title>
    <link rel="stylesheet" type="text/css" href="CSS/HomePage.css?v=<?= ver() ?>">
    <link rel="stylesheet" type="text/css" href="CSS/send.css?v=<?= ver() ?>">
    <link rel="icon" type="image/png" href="Image/HeadLogo.png">
</head>

<body>

    <!-- on met le contenue de la page -->
    <?php
    getUserInfo();
    getPanierInfo();
    require_once("header.php");
    ?>
    <div class="contenu">
        <?php
        if (count($_POST) > 0) {
            $letitre = $_POST["titre_annonce"];
            $lenom = $_POST["nom"];
            $leprix = $_POST["prix"];
            $marque = $_POST["marque"];
            $chipset = $_POST["chipset"];
            $memory = $_POST["taille_de_memoire"];
            $descrip = $_POST["description"];


            $sql = "INSERT into produits values (NULL, NULL, $leprix, '$lenom', '$descrip', $marque,0,$chipset,$memory,'" . $USER_INFO['Nom'] . "',0)";

            $result = mysqli_query($conn, $sql);

            $tmp_name = $_FILES["file-input"]["tmp_name"];
            $newname = $conn->insert_id . "_1";
            $uploads_dir = 'Image';
            $desti = $uploads_dir . "/" . $newname;

            move_uploaded_file($tmp_name, $desti);


            header("location:index.php");
        }
        ?>
        <div>
            <h2>Seul les cartes graphique sont acceptées à la vente</h2>
            <h2>En cas de non respect HardwareUnit s'autorise à supprimer votre annonce</h2>
        </div>
        <table border="1px" style="margin: auto;">
            <form action="send.php" method="POST" class="form_vente" enctype="multipart/form-data">
                <tr>
                    <th colspan="2" id="tableau">
                        Titre de l'annonce
                        <br />
                        <input type="text" name="titre_annonce" placeholder="titre">
                    </th>
                </tr>
                <tr>
                    <td rowspan="5">
                        <div class="image-upload">
                            <label for="file-input">
                                <img src="image/download_black.svg" id="upload" alt="" />
                            </label>

                            <input id="file-input" name="file-input" type="file" onchange="show_img();" />
                        </div>
                    </td>
                    <td>
                        Nom du produit
                        <br />
                        <input type="text" name="nom">
                    </td>
                </tr>
                <tr>
                    <td>
                        Prix
                        <br>
                        <input type="text" name="prix">
                    </td>
                </tr>
                <tr>
                    <td>
                        Marque
                        <br>
                        <select name="marque">
                            <?php
                            $sql = "SELECT `ID`, `nom` FROM `marques`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?= $row["ID"] ?>"><?= $row["nom"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Chipset
                        <br>
                        <select name="chipset">
                            <?php
                            $sql = "SELECT `ID`, `puce` FROM `chipsets`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?= $row["ID"] ?>"><?= $row["puce"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Taille de mémoire
                        <br>
                        <select name="taille_de_memoire">
                            <?php
                            $sql = "SELECT `ID`, `Giga` FROM `taille_de_memoire`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?= $row["ID"] ?>"><?= $row["Giga"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" id="tableau">
                        <div>
                            Description
                        </div>
                        <br>
                        <div class="block_desc">
                            <textarea name="description" class="description" style="width: 100%;"></textarea>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <input type="submit">
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <?php
    require_once("footer.php");
    ?>



    <script type="text/javascript" src="js/send.js?v=<?= ver() ?>"></script>
</body>

</html>