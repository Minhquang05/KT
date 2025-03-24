<?php
require_once "models/HocPhan.php";

class HocPhanController {
    private $hocPhanModel;

    public function __construct() {
        $this->hocPhanModel = new HocPhan();
    }

    // Hiển thị danh sách học phần
    public function index() {
        $hocPhans = $this->hocPhanModel->getAllHocPhans();
        include "views/hocphan/index.php";
    }

    // Hiển thị chi tiết một học phần
    public function detail($id) {
        $hocPhan = $this->hocPhanModel->getHocPhanById($id);
        include "views/hocphan/detail.php";
    }

    // Thêm mới học phần
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maHP = $_POST['maHP'];
            $tenHP = $_POST['tenHP'];
            $soTinChi = $_POST['soTinChi'];

            $this->hocPhanModel->addHocPhan($maHP, $tenHP, $soTinChi);
            header("Location: index.php?controller=hocphan");
        }
        include "views/hocphan/create.php";
    }

    // Sửa thông tin học phần
    public function edit($id) {
        $hocPhan = $this->hocPhanModel->getHocPhanById($id);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $maHP = $_POST['maHP'];
            $tenHP = $_POST['tenHP'];
            $soTinChi = $_POST['soTinChi'];

            $this->hocPhanModel->updateHocPhan($id, $maHP, $tenHP, $soTinChi);
            header("Location: index.php?controller=hocphan");
        }
        include "views/hocphan/edit.php";
    }

    // Xóa học phần
    public function delete($id) {
        $this->hocPhanModel->deleteHocPhan($id);
        header("Location: index.php?controller=hocphan");
    }
}
?>
