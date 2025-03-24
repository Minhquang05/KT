<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $MaHocPhan = $_POST['MaHocPhan'];

    // Kiểm tra xem sinh viên đã đăng ký học phần này chưa
    $checkQuery = $conn->query("SELECT * FROM registrations WHERE MaSV = '$MaSV' AND MaHocPhan = '$MaHocPhan'");
    if ($checkQuery->num_rows > 0) {
        echo "Lỗi: Sinh viên đã đăng ký học phần này!";
        exit();
    }

    // Đăng ký học phần
    $conn->query("INSERT INTO registrations (MaSV, MaHocPhan) VALUES ('$MaSV', '$MaHocPhan')");

    // Giảm số lượng slot còn lại trong học phần
    $conn->query("UPDATE courses SET available_slots = available_slots - 1 WHERE MaHocPhan = '$MaHocPhan' AND available_slots > 0");

    echo "Đăng ký thành công!";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đăng ký học phần</title>
</head>
<body>
    <h2>Đăng ký học phần</h2>
    <form method="POST">
        <label>Mã Sinh viên:</label> 
        <input type="text" name="MaSV" required><br>

        <label>Mã Học phần:</label> 
        <input type="text" name="MaHocPhan" required><br>

        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
