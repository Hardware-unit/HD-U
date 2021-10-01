<div class="header">
    <nav>
        <a href="index.php" class="Logo" title="Acceuil"><img src="Image/Logo.png" alt="logo"></a>
        <ul>
            <form action="searchPage.php" class="F_search" method="GET" id="myForm">
                <div class="D_search">
                    <li class="a_magnifying">
                        <div class="input_search">
                            <input type="search" class="search" name="searchBar" value="<?php if (isset($_GET['searchBar'])) { //le name et la value rentre dans l'url lors de l'envoi
                                                                                            echo $_GET['searchBar'];/* permet de laisser la recherche afficher en  cas de tris la page se recharge avec le meme element rechercher */
                                                                                        } ?>">
                        </div>
                        <input type="hidden" name="modeTri" value="RAND()"> <!-- cacher le input avec hidden on met un input pour metre dans l'url -->
                        <div class="D_button_search">
                            <button type="submit"><img src="Image/magnifying_glass.png" alt="magnifying" class="magnifying"></button>
                        </div>
                    </li>
                </div>
            </form>
            <span class="menu_toggle"><a href="javascript:void(0);" class="icon" onclick="myFunction()"> <img src="Image/menu.svg" alt="menu_phone"> </a></span>
            <div class="Block_Menu" id="myTopnav">
                <li><a href="product.php?tri=RAND()" class="link menu">Nos Produits</a></li>
                <li><a href="send.php" class="link menu">Vendre</a></li>
                <li class="a_basket"><a href="basket.php" class="menu"><img alt=" basket" src="Image/basket.png" class="basket">
                        <?php
                        if (isset($USER_INFO)) {
                        ?>
                            <span class="badge"><?= count($PANIER_INFO) ?></span>
                        <?php
                        } else { ?>
                        <?php
                        }
                        ?>
                    </a></li>
                <?php
                if (isset($USER_INFO)) {
                ?>
                    <li class="name1"><?= $USER_INFO["Nom"] ?>
                        <ul class="elements">
                            <li class="under1"><a href="compte.php">Mon compte</a></li>
                            <?php
                            if ($USER_INFO["Droit"] == 1) { ?>
                                <li class="under1"><a href="login/admin.php">Admin</a></li>
                            <?php
                            }
                            ?>
                            <li class="under1"><a href="login/deconnexion.php">Déconnexion</a></li>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="identify"><a href="login/connexion.php" class="link menu">Identifiez-vous</a></li>
                <?php
                }
                ?>
            </div>
        </ul>
    </nav>
    <hr class="ligne">
    <script type="text/javascript" src="js/searchPage.js?v=<?= ver() ?>"></script>
</div>
<!-- <div id='scroll_to_top' class='opacity'>
    <img src="{{ asset('images/collapse_arrow.svg') }}" alt="Retourner en haut">
</div> -->