<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost"; 
$username = "root";
$password = "";
$basename = "jutarnji";
$port = 3307; 

$dbc = mysqli_connect($servername, $username, $password, $basename, $port) or die('Error connecting to MySQL server.'.mysqli_error($dbc));
mysqli_set_charset($dbc, "utf8");
?>
