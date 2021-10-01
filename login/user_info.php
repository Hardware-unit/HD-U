<?php
function getUserInfo(){
    global $USER_INFO, $conn;
    if(isset($_SESSION['user_id'])){
        $sql = "SELECT *, sex.nom AS `sn` FROM `utilisateur` AS user JOIN `sexe` AS sex ON user.sexe = sex.ID_sex WHERE `ID` = '". $_SESSION["user_id"]."'"; // stock les info de l'utilisateur a partir de sont id
        $result = mysqli_query($conn , $sql);
        $USER_INFO = mysqli_fetch_array($result);
        
    }else{
        unset($USER_INFO);
    }
}

?>