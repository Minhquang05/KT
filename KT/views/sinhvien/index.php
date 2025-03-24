<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../config.php';
$result = $conn->query("SELECT * FROM SinhVien");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Danh sách sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Danh sách sinh viên</h2>
    <a href="create.php" class="btn btn-primary">Thêm sinh viên</a>
    <table class="table mt-3">
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Hình</th>
            <th>Mã ngành</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['MaSV'] ?></td> 
                <td><?= $row['HoTen'] ?></td> 
                <td><?= $row['GioiTinh'] ?></td> 
                <td><?= $row['NgaySinh'] ?></td> 
                <td>
                    <img src="../../uploads/<?= $row['Hinh'] ?>" alt="Hình ảnh" width="50"> 
                </td>
                <td><?= $row['MaNganh'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['MaSV'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete.php?id=<?= $row['MaSV'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
