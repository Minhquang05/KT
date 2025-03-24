<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './models/NhanVien.php';

class NhanVienController {
    public function tinhLuongNhanVien() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['form_data'] = $_POST; // Lưu dữ liệu vào SESSION

            $nhanVien = new NhanVien($_POST);
            $_SESSION['luong'] = $nhanVien->tinhLuong();
            $_SESSION['troCap'] = $nhanVien->tinhTroCap();
            $_SESSION['thucLinh'] = $nhanVien->tinhThucLinh();
        }

        require './views/nhanvien_form.php';
    }
}
?>
