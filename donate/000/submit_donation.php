<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cycle';
$port = 3308; 

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$pas = $_POST['pas']; 
$mon = $_POST['mon'];
$email = $_POST['email'];
$eee = $_POST['eee']; 
$eeee = $_POST['eeee']; 
$safe = $_POST['safe']; 
$place = $_POST['place']; 
$donation_date = date('Y-m-d H:i:s'); 


$sql = "INSERT INTO donations (name, pas, mon, email, eee, eeee, safe, place, donation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssissssss", $name, $pas, $mon, $email, $eee, $eeee, $safe, $place, $donation_date);

if ($stmt->execute()) {

    header("Location: 送出.html?name={$name}&mon={$mon}&email={$email}");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$secretKey = '6Lew6pMpAAAAAFFQ4yCqti3W7tMoYH_6J_U8d_m8';
$recaptchaResponse = $_POST['g-recaptcha-response']; 

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $recaptchaResponse);
$responseKeys = json_decode($response, true);

if (isset($responseKeys["success"]) && $responseKeys["success"] && isset($responseKeys["score"]) && $responseKeys["score"] >= 0.5) {
    $feedback = $_POST['feedback']; 
    $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
    if ($conn->query($sql) === TRUE) {
        header('Location: thank_you.php');
        exit();
    } else {
        echo "錯誤: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "驗證失敗或懷疑是機器人行為";
}


$stmt->close();
$conn->close();
?>
