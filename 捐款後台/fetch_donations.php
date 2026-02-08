<?php
// fetch_donations.php
include 'db_connect.php';

$conn = connectDatabase();

$sql = "SELECT id, name, pas, mon, email, eee, eeee, safe, place FROM donations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["pas"]."</td>
                <td>".$row["mon"]."</td>
                <td>".$row["email"]."</td>
                <td>".$row["eee"]."</td>
                <td>".$row["eeee"]."</td>
                <td>".$row["safe"]."</td>
                <td>".$row["place"]."</td>
                <td>
                   <button class='edit-btn' data-id='".$row["id"]."'>編輯</button> | 
                   <span class='delete' data-id='".$row["id"]."'>刪除</span>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>沒有資料</td></tr>";
}


$conn->close();
?>



