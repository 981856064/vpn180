<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "VPN180";
// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);

// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
$sql = "SELECT id FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]."\r\n";
    }
} else {
    echo "0 结果";
}
$conn->close();
