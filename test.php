<?php 
include_once("db.php");

$sql = "SELECT *, sex.nom AS `sn` FROM `utilisateur` AS user JOIN `sexe` AS sex ON user.sexe = sex.ID_sex WHERE `ID` = 3"; // stock les info de l'utilisateur a partir de sont id
$result = mysqli_query($conn, $sql);
$res =  mysqli_fetch_array($result ,MYSQLI_ASSOC);

$user = new User($res);

echo $user->getNom();


?>