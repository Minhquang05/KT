<?php
require_once "models/SinhVien.php";

class SinhVienController {
    private $sinhVienModel;

    public function __construct() {
        $this->sinhVienModel = new SinhVien();
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        $sinhViens = $this->sinhVienModel->getAllSinhViens();
        include "views/sinhvien/index.php";
    }

    // Hiển thị chi tiết sinh viên
    public function detail($id) {
        $sinhVien = $this->sinhVienModel->getSinhVienById($id);
        include "views/sinhvien/detail.php";
    }

    // Thêm sinh viên mới
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maSV = $_POST['maSV'];
            $hoTen = $_POST['hoTen'];
            $gioiTinh = $_POST['gioiTinh'];
            $ngaySinh = $_POST['ngaySinh'];
            $hinh = $_FILES['hinh']['name'];
            $maNganh = $_POST['maNganh'];

            move_uploaded_file($_FILES['hinh']['tmp_name'], "uploads/" . $hinh);

            $this->sinhVienModel->addSinhVien($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
            header("Location: index.php?controller=sinhvien");
        }
        include "views/sinhvien/create.php";
    }

    // Sửa thông tin sinh viên
    public function edit($id) {
        $sinhVien = $this->sinhVienModel->getSinhVienById($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maSV = $_POST['maSV'];
            $hoTen = $_POST['hoTen'];
            $gioiTinh = $_POST['gioiTinh'];
            $ngaySinh = $_POST['ngaySinh'];
            $hinh = $_FILES['hinh']['name'] ?: $sinhVien['Hinh'];
            $maNganh = $_POST['maNganh'];

            if ($_FILES['hinh']['name']) {
                move_uploaded_file($_FILES['hinh']['tmp_name'], "uploads/" . $hinh);
            }

            $this->sinhVienModel->updateSinhVien($id, $maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
            header("Location: index.php?controller=sinhvien");
        }
        include "views/sinhvien/edit.php";
    }

    // Xóa sinh viên
    public function delete($id) {
        $this->sinhVienModel->deleteSinhVien($id);
        header("Location: index.php?controller=sinhvien");
    }
}
?>
