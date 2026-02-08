<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cycle";
$port = 3308; 


$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}


$conn->set_charset("utf8mb4");

?>
