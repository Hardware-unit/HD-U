<?php

function random_code($str_length = 6, $chars = "0123456789abcdefghijklmnopqrstuvwxyz")
{
    $chars_str_length = strlen($chars);
    $code = "";
    for ($i = 0; $i < $str_length; $i++) $code .= $chars[rand(0, $chars_str_length - 1)];//prendre un caractère de la chaine chars -1 car on commence a 0
    return $code;
}
function format_str($str, $variables = [])
{
    foreach ($variables as $variable => $value) $str = str_replace("%$variable%", $value, $str); // chager le %% par des variable
    return $str;
}
function read($path)
{
    return file_get_contents("$path"); //lire le contenur d'un fichier 
}
?>