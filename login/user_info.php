<?php
function getUserInfo(){
    global $USER_INFO, $conn;
    if(isset($_SESSION['user_id'])){
        $sql = "SELECT *, sex.nom AS `sn` FROM `utilisateur` AS user JOIN `sexe` AS sex ON user.sexe = sex.ID_sex WHERE `ID` = '". $_SESSION["user_id"]."'"; // stock les info de l'utilisateur a partir de sont id
        $result = $conn->query($sql);
        $res = $result->fetch_array( MYSQLI_ASSOC); //pour pas avoir les index 0 / 1 / 2.. 

        $USER_INFO = new User($res);
    }else{
        unset($USER_INFO);
    }
}

?>