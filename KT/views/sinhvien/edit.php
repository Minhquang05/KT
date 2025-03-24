<?php
include '../../config.php';

$MaSV = $_GET['id'];
$result = $conn->query("SELECT * FROM SinhVien WHERE MaSV='$MaSV'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $MaNganh = $_POST['MaNganh'];

    if (!empty($_FILES["Hinh"]["name"])) {
        $targetDir = "../../uploads/";
        $fileName = basename($_FILES["Hinh"]["name"]);
        $newFileName = uniqid() . "." . pathinfo($fileName, PATHINFO_EXTENSION);
        $targetFilePath = $targetDir . $newFileName;

        if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFilePath)) {
            if (!empty($row['Hinh']) && file_exists("../../uploads/" . $row['Hinh'])) {
                unlink("../../uploads/" . $row['Hinh']);
            }
            $conn->query("UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$newFileName', MaNganh='$MaNganh' WHERE MaSV='$MaSV'");
        }
    } else {
        $conn->query("UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', MaNganh='$MaNganh' WHERE MaSV='$MaSV'");
    }

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Sửa sinh viên</title>
</head>
<body>
    <h2>Sửa thông tin sinh viên</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Họ Tên:</label> <input type="text" name="HoTen" value="<?= $row['HoTen'] ?>" required><br>
        <label>Giới tính:</label> 
        <select name="GioiTinh">
            <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
        </select><br>
        <label>Ngày sinh:</label> <input type="date" name="NgaySinh" value="<?= $row['NgaySinh'] ?>" required><br>
        <label>Hình ảnh:</label> <input type="file" name="Hinh"><br>
        <?php if (!empty($row['Hinh'])) { ?>
            <img src="../../uploads/<?= $row['Hinh'] ?>" alt="Hình ảnh" width="100"><br>
        <?php } ?>
        <label>Mã Ngành:</label> <input type="text" name="MaNganh" value="<?= $row['MaNganh'] ?>" required><br>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>
