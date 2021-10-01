<!DOCTYPE html>
<html>
<head>


</head>

<body>
    
    
</body>


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

    $sql = "INSERT INTO produit VALUES ()";
    mysqli_query($conn, $sql);
    header("location:../index.php");

?>
</html>