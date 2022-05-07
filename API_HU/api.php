<?php

function getusers(){
    $conn = getConnexion();
    $sql = "SELECT `ID`, `user`.`Nom`, `Prenom`, `Email`, `Droit`
    from utilisateur AS user INNER JOIN sexe s on user.sexe = s.ID_sex";
    $result = $conn->prepare($sql);
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    $result->closeCursor();
    sendJSON($users);
    
}

function getUserSup($id){
    $conn = getConnexion();
    $sql = "DELETE from utilisateur WHERE ID = :id";
    $result = $conn->prepare($sql);
    $result->bindValue(":id",$id,PDO::PARAM_STR);
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    $result->closeCursor();
    sendJSON($users);
}

function getUserById($id){
    $conn = getConnexion();
    $sql = "SELECT `ID`, `user`.`Nom`, `Prenom`, `Email`, `Date_De_Naissance`, `s`.`nom`, `Droit`, tel
    from utilisateur AS user INNER JOIN sexe s on user.sexe = s.ID_sex where ID = :id";
    $result = $conn->prepare($sql);
    $result->bindValue(":id",$id,PDO::PARAM_STR);
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    $result->closeCursor();
    sendJSON($users);
}

function getConnexion(){
    return new PDO("mysql:host=localhost;dbname=hardwareunit","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}

function sendJSON($info){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($info,JSON_UNESCAPED_UNICODE); // pour les acsents 
}
?>