<?php
    require_once("../db.php");
?>

<!DOCTYPE html>


<html>
<h1>un administrateur va vérifier votre vente</h1>
<?php
    if (count($_POST) > 0) {
        $letitre = $_POST["titre_annonce"];
        $lenom = $_POST["nom"];
        $image = $_POST["file-input"];
        $leprix = $_POST["prix"];
        $lemarque = $_POST["marque"];
        $chipset = $_POST["chipset"];
        $memory = $_POST["taille_de_memoire"];
        $descrip = $_POST["description"]; 
    }
    echo "<img src = '" . $image . "' alt='' class='image' >";
    

    echo ( "$letitre, $lenom, $leprix, $lemarque, $chipset, $memory, $descrip");

?>
<div>
    <form action="submit.php" method="POST">
        <input type="submit" value="valider">
    </form>
</div>
<div>
<form action="deny.php" method="POST">
    <input type="submit" value="refuser">
</div>
</html>