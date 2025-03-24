<?php
require_once "config.php"; // Kết nối database

class SinhVien {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Lấy danh sách tất cả sinh viên
    public function getAllSinhViens() {
        $sql = "SELECT * FROM SinhVien";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy thông tin sinh viên theo ID
    public function getSinhVienById($id) {
        $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Thêm sinh viên mới
    public function addSinhVien($maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);
        return $stmt->execute();
    }

    // Cập nhật thông tin sinh viên
    public function updateSinhVien($id, $maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh) {
        $sql = "UPDATE SinhVien SET MaSV=?, HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh, $id);
        return $stmt->execute();
    }

    // Xóa sinh viên
    public function deleteSinhVien($id) {
        $sql = "DELETE FROM SinhVien WHERE MaSV=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
}
?>
