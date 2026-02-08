<?php

include 'db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = connectDatabase();

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['name'], $_POST['pas'], $_POST['mon'], $_POST['email'], $_POST['eee'], $_POST['eeee'], $_POST['safe'], $_POST['place'])) {
        $id = $conn->real_escape_string($_POST['id']);
        $name = $conn->real_escape_string($_POST['name']);
        $pas = $conn->real_escape_string($_POST['pas']);
        $mon = $conn->real_escape_string($_POST['mon']);
        $email = $conn->real_escape_string($_POST['email']);
        $eee = $conn->real_escape_string($_POST['eee']);
        $eeee = $conn->real_escape_string($_POST['eeee']);
        $safe = $conn->real_escape_string($_POST['safe']);
        $place = $conn->real_escape_string($_POST['place']);

        // 在更新之前，檢查該 ID 是否存在於 donations 表中
        $checkExistence = $conn->prepare("SELECT COUNT(1) FROM donations WHERE id=?");
        $checkExistence->bind_param("i", $id);
        $checkExistence->execute();
        $checkExistence->store_result(); // 保存結果以便使用 num_rows
        if ($checkExistence->num_rows == 0) {
            $response['status'] = 'error';
            $response['message'] = 'No donation record found with the provided ID.';
        } else {
            // 既然 ID 存在，就進行更新
            $updateQuery = "UPDATE donations SET name='{$name}', pas='{$pas}', mon='{$mon}', email='{$email}', eee='{$eee}', eeee='{$eeee}', safe='{$safe}', place='{$place}' WHERE id='{$id}'";
            $updateResult = $conn->query($updateQuery);
            if ($updateResult) {
                if ($conn->affected_rows > 0) {
                    $response['status'] = 'success';
                    $response['message'] = 'Update successful. Rows affected: ' . $conn->affected_rows;
                } else {
                    $response['status'] = 'no_change';
                    $response['message'] = 'No rows updated. It may be that the new data is the same as the existing data.';
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Update failed: ' . $conn->error;
            }
        }
        $checkExistence->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Missing one or more required POST parameters';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

if (isset($conn) && $conn) {
    $conn->close();
}

echo json_encode($response);

?>
