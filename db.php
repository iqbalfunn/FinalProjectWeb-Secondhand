<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "secondhandsell";

//membuat koneksi
$con = mysqli_connect($servername, $username, $password,$db);

//check koneksi
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
