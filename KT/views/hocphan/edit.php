<?php
include '../../config.php';

$MaHP = $_GET['id'];
$result = $conn->query("SELECT * FROM HocPhan WHERE MaHP='$MaHP'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenHP = $_POST['TenHP'];
    $SoTinChi = $_POST['SoTinChi'];

    $sql = "UPDATE HocPhan SET TenHP='$TenHP', SoTinChi='$SoTinChi' WHERE MaHP='$MaHP'";

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
    <title>Sửa học phần</title>
</head>
<body>
    <h2>Sửa học phần</h2>
    <form method="POST">
        <label>Tên học phần:</label> 
        <input type="text" name="TenHP" value="<?= $row['TenHP'] ?>" required><br>

        <label>Số tín chỉ:</label> 
        <input type="number" name="SoTinChi" value="<?= $row['SoTinChi'] ?>" required><br>

        <button type="submit">Lưu</button>
    </form>
</body>
</html>
