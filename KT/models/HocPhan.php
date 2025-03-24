<?php
require_once "config.php"; // Kết nối database

class HocPhan {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Lấy danh sách tất cả học phần
    public function getAllHocPhans() {
        $sql = "SELECT * FROM HocPhan";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy thông tin một học phần theo ID
    public function getHocPhanById($id) {
        $sql = "SELECT * FROM HocPhan WHERE MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Thêm mới học phần
    public function addHocPhan($maHP, $tenHP, $soTinChi) {
        $sql = "INSERT INTO HocPhan (MaHP, TenHP, SoTinChi) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $maHP, $tenHP, $soTinChi);
        return $stmt->execute();
    }

    // Cập nhật học phần
    public function updateHocPhan($id, $maHP, $tenHP, $soTinChi) {
        $sql = "UPDATE HocPhan SET MaHP=?, TenHP=?, SoTinChi=? WHERE MaHP=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $maHP, $tenHP, $soTinChi, $id);
        return $stmt->execute();
    }

    // Xóa học phần
    public function deleteHocPhan($id) {
        $sql = "DELETE FROM HocPhan WHERE MaHP=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }
}
?>
