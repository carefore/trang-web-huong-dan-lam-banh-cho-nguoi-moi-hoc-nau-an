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

// Lấy dữ liệu từ form
$recipeName = $_POST['recipeName'];
$ingredients = $_POST['ingredients'];
$instructions = $_POST['instructions'];

// Lưu dữ liệu vào cơ sở dữ liệu
$sql = "INSERT INTO recipes (recipe_name, ingredients, instructions)
VALUES ('$recipeName', '$ingredients', '$instructions')";

if ($conn->query($sql) === TRUE) {
    // Truy vấn lấy thông tin công thức vừa lưu để hiển thị trên trang
    $last_id = $conn->insert_id;
    $sql = "SELECT * FROM recipes WHERE id = $last_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<h3>'.$row['recipe_name'].'</h3>';
        echo '<p><strong>Nguyên liệu:</strong> '.$row['ingredients'].'</p>';
        echo '<p><strong>Hướng dẫn:</strong> '.$row['instructions'].'</p>';
    }
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
