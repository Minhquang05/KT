<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../config.php';
$result = $conn->query("SELECT * FROM HocPhan");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Danh sách học phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Danh sách học phần</h2>
    <a href="create.php" class="btn btn-primary">Thêm học phần</a>
    <table class="table mt-3">
        <tr>
            <th>Mã học phần</th>
            <th>Tên học phần</th>
            <th>Số tín chỉ</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['MaHP'] ?></td> 
                <td><?= $row['TenHP'] ?></td> 
                <td><?= $row['SoTinChi'] ?></td> 
                <td>
                    <a href="edit.php?id=<?= $row['MaHP'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete.php?id=<?= $row['MaHP'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
