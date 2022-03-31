<?php
include_once "class/user.php";
include_once "class/panier.php";
$conn = new mysqli("localhost", "root", "", "hardwareunit");
$conn->query("SET CHARACTER SET utf8");
session_start();

function ver()
{
	return time();
}
?>
