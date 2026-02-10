<?php
$host = 'localhost';
$port = 3308;
$dbname = 'cycle';
$username = 'root';
$password = '';

$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);



if (isset($_GET['start']) && isset($_GET['end'])) {

    $startDate = $_GET['start'];
    $endDate = $_GET['end'];


    error_log("開始日期: " . $startDate);
    error_log("結束日期: " . $endDate);


    $stmt = $conn->prepare("SELECT * FROM events WHERE StartDateTime >= :startDate AND StartDateTime <= :endDate ORDER BY StartDateTime");
    $stmt->execute([':startDate' => $startDate, ':endDate' => $endDate]);
} else {

    $stmt = $conn->prepare("SELECT * FROM events ORDER BY StartDateTime");
    $stmt->execute();
}

$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($events);


?>
