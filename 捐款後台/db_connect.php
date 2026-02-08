<?php
// db_connect.php
function connectDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = 'cycle'; // 注意這裡的變數名稱是 $database
    $port = 3308;


    // Create connection
    $conn = new mysqli($servername, $username, $password, $database, $port); // 應該使用 $database 而不是 $dbname

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
