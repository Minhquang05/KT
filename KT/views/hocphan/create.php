<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaHP = $_POST['MaHP'];
    $TenHP = $_POST['TenHP'];
    $SoTinChi = $_POST['SoTinChi'];

    $sql = "INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) VALUES ('$MaHP', '$TenHP', '$SoTinChi')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thêm học phần</title>
</head>
<body>
    <h2>Thêm học phần</h2>
    <form method="POST">
        <label>Mã học phần:</label> 
        <input type="text" name="MaHP" required><br>

        <label>Tên học phần:</label> 
        <input type="text" name="TenHP" required><br>

        <label>Số tín chỉ:</label> 
        <input type="number" name="SoTinChi" required><br>

        <button type="submit">Thêm</button>
    </form>
</body>
</html>
