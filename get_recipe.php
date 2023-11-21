<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "username"; // Thay thế bằng tên người dùng MySQL của bạn
$password = "password"; // Thay thế bằng mật khẩu của bạn
$dbname = "recipes_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Truy vấn lấy danh sách công thức từ cơ sở dữ liệu
$sql = "SELECT * FROM recipes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<h3>'.$row['recipe_name'].'</h3>';
        echo '<p><strong>Nguyên liệu:</strong> '.$row['ingredients'].'</p>';
        echo '<p><strong>Hướng dẫn:</strong> '.$row['instructions'].'</p>';
    }
} else {
    echo "Không có công thức nào được tìm thấy.";
}

$conn->close();
?>
