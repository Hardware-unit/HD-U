<?php
function getFacInfo(){
    global $FAC_INFO, $conn;
    if(isset($_SESSION['user_id'])){
        $sql = "SELECT * FROM `info_facture` AS fac  WHERE `ID_user` = '". $_SESSION["user_id"]."'"; // stock les info de l'utilisateur a partir de sont id
        $result = $conn->query($sql);
        $FAC_INFO = $result->fetch_array();
    }else{
        unset($FAC_INFO);
    }
}
