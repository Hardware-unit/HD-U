<?php
include_once "class/user.php";
$conn = new mysqli("localhost", "root", "", "hardwareunit");
$conn->query("SET CHARACTER SET utf8");
session_start();

function ver()
{
	return time();
}
?>
