<?php
session_start(); // Kích hoạt session
require_once './controllers/NhanVienController.php';

$controller = new NhanVienController();
$controller->tinhLuongNhanVien();
?>
