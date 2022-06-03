<?php

require "config/constants.php";

$servername = "localhost";
$username = "root";
$password = "";
$db = "store_db";

// Criar conexão
$con = mysqli_connect($servername, $username, $password,$db);

// Verifique a conexão
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>