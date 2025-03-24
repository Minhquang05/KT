<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    // Xử lý upload ảnh
    $targetDir = "../../uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["Hinh"]["name"]);
    $newFileName = uniqid() . "." . pathinfo($fileName, PATHINFO_EXTENSION);
    $targetFilePath = $targetDir . $newFileName;

    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$newFileName', '$MaNganh')";

if ($conn->query($sql)) {
    header("Location: index.php");
    exit();
} else {
    die("Lỗi SQL: " . $conn->error);
}

    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thêm sinh viên</title>
</head>
<body>
    <h2>Thêm sinh viên</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Mã SV:</label> <input type="text" name="MaSV" required><br>
        <label>Họ Tên:</label> <input type="text" name="HoTen" required><br>
        <label>Giới tính:</label> 
        <select name="GioiTinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select><br>
        <label>Ngày sinh:</label> <input type="date" name="NgaySinh" required><br>
        <label>Hình ảnh:</label> <input type="file" name="Hinh" required><br>
        <label>Mã Ngành:</label> <input type="text" name="MaNganh" required><br>
        <button type="submit">Thêm</button>
    </form>
</body>
</html>
