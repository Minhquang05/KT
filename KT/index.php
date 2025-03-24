<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống quản lý</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Hệ thống quản lý sinh viên và học phần</h2>
        <div class="d-flex justify-content-center mt-4">
            <a href="views/sinhvien/index.php" class="btn btn-primary mx-2">Quản lý Sinh Viên</a>
            <a href="views/hocphan/index.php" class="btn btn-success mx-2">Quản lý Học Phần</a>
        </div>
    </div>
</body>
</html>
