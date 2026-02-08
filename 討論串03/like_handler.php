<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit;
}

include '../會員系統/auth0.php';

$conn = new mysqli("localhost", "root", "", "cycle", 3308);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

$postId = isset($_POST['id']) ? intval($_POST['id']) : 0;
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

// Attempt to insert like, handle any errors for duplicate likes
$insertQuery = $conn->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE id=id");
$insertQuery->bind_param("ii", $postId, $userId);
$insertQuery->execute();

if ($insertQuery->error) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to like: ' . $insertQuery->error]);
    exit;
}

// Return the new like count
$likesQuery = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?");
$likesQuery->bind_param("i", $postId);
$likesQuery->execute();
$likesResult = $likesQuery->get_result();
$likesCount = $likesResult->fetch_assoc()['like_count'];

echo json_encode(['status' => 'ok', 'likes' => $likesCount]);
?>
