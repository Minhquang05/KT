<?php
include 'config.php';

$MaSV = $_GET['id'];

// Lấy thông tin sinh viên
$studentQuery = $conn->query("SELECT * FROM SinhVien WHERE MaSV = '$MaSV'");
$student = $studentQuery->fetch_assoc();

// Lấy danh sách học phần đã đăng ký
$coursesQuery = $conn->query("
    SELECT courses.TenHocPhan 
    FROM registrations 
    JOIN courses ON registrations.course_id = courses.MaHocPhan 
    WHERE registrations.student_id = '$MaSV'
");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Chi tiết sinh viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Thông tin sinh viên</h2>
    <a href="index.php" class="btn btn-secondary">Quay lại</a>
    <table class="table mt-3">
        <tr>
            <th>Mã SV:</th>
            <td><?= $student['MaSV'] ?></td>
        </tr>
        <tr>
            <th>Họ Tên:</th>
            <td><?= $student['HoTen'] ?></td>
        </tr>
        <tr>
            <th>Giới tính:</th>
            <td><?= $student['GioiTinh'] ?></td>
        </tr>
        <tr>
            <th>Ngày sinh:</th>
            <td><?= $student['NgaySinh'] ?></td>
        </tr>
        <tr>
            <th>Hình ảnh:</th>
            <td>
                <img src="uploads/<?= $student['Hinh'] ?>" alt="Hình ảnh" width="150">
            </td>
        </tr>
        <tr>
            <th>Mã Ngành:</th>
            <td><?= $student['MaNganh'] ?></td>
        </tr>
    </table>

    <h3>Học phần đã đăng ký</h3>
    <ul class="list-group">
        <?php while ($course = $coursesQuery->fetch_assoc()) { ?>
            <li class="list-group-item"><?= $course['TenHocPhan'] ?></li>
        <?php } ?>
    </ul>
</div>
</body>
</html>
