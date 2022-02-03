<?php
function getPanierInfo(){
    global $PANIER_INFO, $conn;
    if(isset($_SESSION['user_id'])){
        $sql = "SELECT *, pr.nom AS produit_nom ,pr.prix  FROM `panier` AS pn JOIN `produits` AS pr ON pn.ID_article = pr.ID WHERE `ID_user` = '". $_SESSION["user_id"]."'"; // stock les info de l'utilisateur a partir de sont id
        $result = $conn->query($sql);
        $PANIER_INFO = [];
        while ($row = $result->fetch_array()){
            array_push($PANIER_INFO , $row); //Empile un ou plusieurs éléments à la fin d'un tableau     
        }
    }else{
        unset($PANIER_INFO);
    }
}
?>

