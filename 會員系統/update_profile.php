<?php

session_start();
include 'config.php'; 

if (isset($_POST['username'], $_POST['email'], $_POST['phone'], $_POST['user_birthday'], $_POST['user_gender'])) {
    $userId = $_SESSION['user_id'];
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $user_birthday = $conn->real_escape_string($_POST['user_birthday']);
    $user_gender = $conn->real_escape_string($_POST['user_gender']);


    $sql = "UPDATE users SET 
            username='$username', 
            email='$email', 
            phone='$phone', 
            user_birthday='$user_birthday', 
            user_gender='$user_gender' 
            WHERE id='$userId'";


    if ($conn->query($sql) === TRUE) {
 
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;
        $_SESSION['user_birthday'] = $user_birthday;
        $_SESSION['user_gender'] = $user_gender;

       
        echo "<script>alert('資料成功更新!'); window.location.href='edit_profile.php';</script>";
    } else {
        
        echo "Error updating record: " . $conn->error;
    }
} else {
   
    echo "All fields are required!";
}
$conn->close();
?>
