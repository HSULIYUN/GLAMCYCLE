<?php
include 'db.php'; // 引入数据库配置

if (isset($_POST['save_event'])) {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];

    // 文件上传处理
    if (!empty($_FILES['event_image']['name'])) {
        $target_dir = "/images/events/"; // 上传目录
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES['event_image']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // 检查文件是否是图片
        $check = getimagesize($_FILES['event_image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['event_image']['tmp_name'], $target_file)) {
                $event_image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    } else {
        $event_image = ""; // 没有上传图片
    }

    if ($event_id) {
        // 更新活动
        if (empty($event_image)) {
            // 不更新图片字段
            $stmt = $conn->prepare("UPDATE events SET EventName = ?, EventDescription = ?, StartDateTime = ?, EndDateTime = ? WHERE EventID = ?");
            $stmt->bind_param("ssssi", $event_name, $event_description, $start_datetime, $end_datetime, $event_id);
        } else {
            // 更新包括图片字段
            $stmt = $conn->prepare("UPDATE events SET EventName = ?, EventDescription = ?, ImagePath = ?, StartDateTime = ?, EndDateTime = ? WHERE EventID = ?");
            $stmt->bind_param("sssssi", $event_name, $event_description, $event_image, $start_datetime, $end_datetime, $event_id);
        }
    } else {
        // 新增活动
        $stmt = $conn->prepare("INSERT INTO events (EventName, EventDescription, ImagePath, StartDateTime, EndDateTime) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $event_name, $event_description, $event_image, $start_datetime, $end_datetime);
    }

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // 重定向到活动列表页
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
