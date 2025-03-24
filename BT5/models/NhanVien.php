<?php
class NhanVien {
    public $hoTen;
    public $ngaySinh;
    public $gioiTinh;
    public $soCon;
    public $ngayVaoLam;
    public $heSoLuong;
    public $loaiNV;
    public $soNgayVang;
    public $soSanPham;
    public $tangCa;
    
    const LUONG_CO_BAN = 1000000; // 1,000,000 VNĐ
    const TRO_CAP_CON = 200000;   // 200,000 VNĐ/con
    const TRO_CAP_TANG_CA = 500000; // 500,000 VNĐ
    
    public function __construct($data) {
        $this->hoTen = $data['hoTen'];
        $this->ngaySinh = $data['ngaySinh'];
        $this->gioiTinh = $data['gioiTinh'];
        $this->soCon = $data['soCon'];
        $this->ngayVaoLam = $data['ngayVaoLam'];
        $this->heSoLuong = $data['heSoLuong'];
        $this->loaiNV = $data['loaiNV'];
        $this->soNgayVang = $data['soNgayVang'] ?? 0;
        $this->soSanPham = $data['soSanPham'] ?? 0;
        $this->tangCa = isset($data['tangCa']) ? true : false;
    }

    public function tinhLuong() {
        $luong = self::LUONG_CO_BAN * $this->heSoLuong;
        
        if ($this->loaiNV == "vanphong") {
            $luong *= (26 - $this->soNgayVang) / 26; // Trừ lương theo số ngày vắng
        } elseif ($this->loaiNV == "sanxuat") {
            $luong += $this->soSanPham * 20000; // 20,000 VNĐ mỗi sản phẩm
        }

        return max(0, $luong); // Đảm bảo lương không âm
    }

    public function tinhTroCap() {
        $troCap = $this->soCon * self::TRO_CAP_CON;
        if ($this->tangCa) {
            $troCap += self::TRO_CAP_TANG_CA;
        }
        return $troCap;
    }

    public function tinhThucLinh() {
        return $this->tinhLuong() + $this->tinhTroCap();
    }
}
?>
