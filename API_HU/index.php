<?php
require_once("./api.php");



try {
    if (!empty($_GET['demande'])) {
        $url = explode("/", filter_var($_GET["demande"],FILTER_SANITIZE_URL));
        switch ($url[0]) {
            case "users":
                if(empty($url[1])){
                    getUsers();
                } else {
                    getUserById($url[1]);
                }
                break;
            case "user":
                if (!empty($url[1])) {

                    getUserSup($url[1]);
                } else {
                    throw new Exception("vous n'avez pas selectionné d'utilisateur");
                }
                
                break;
            default :
                throw new Exception("la demande n'est pas valide verifier l'url");
        }
    } else {
        throw new Exception("Probleme de récupération de données");
    }
} catch (Exception $exp) {
    $erreur = [
        "message" => $exp->getMessage(),

    ];
    print_r($erreur);
}
