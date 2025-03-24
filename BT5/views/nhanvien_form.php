<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #343a40; margin-bottom: 20px; }
        .form-check-label { margin-left: 5px; }
        .btn-primary { width: 100%; }
        .result { background: #e9f5e9; padding: 15px; border-radius: 8px; margin-top: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Quản Lý Nhân Viên</h2>
    <form method="post">
        <?php $data = $_SESSION['form_data'] ?? []; ?>

        <div class="mb-3">
            <label class="form-label">Họ và tên:</label>
            <input type="text" name="hoTen" class="form-control" value="<?= $data['hoTen'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày sinh:</label>
            <input type="date" name="ngaySinh" class="form-control" value="<?= $data['ngaySinh'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giới tính:</label>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="gioiTinh" value="Nam" <?= isset($data['gioiTinh']) && $data['gioiTinh'] == "Nam" ? "checked" : "" ?>>
                    <label class="form-check-label">Nam</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gioiTinh" value="Nữ" <?= isset($data['gioiTinh']) && $data['gioiTinh'] == "Nữ" ? "checked" : "" ?>>
                    <label class="form-check-label">Nữ</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Số con:</label>
            <input type="number" name="soCon" class="form-control" min="0" value="<?= $data['soCon'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày vào làm:</label>
            <input type="date" name="ngayVaoLam" class="form-control" value="<?= $data['ngayVaoLam'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hệ số lương:</label>
            <input type="number" step="0.1" name="heSoLuong" class="form-control" value="<?= $data['heSoLuong'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại nhân viên:</label>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="loaiNV" value="vanphong" <?= isset($data['loaiNV']) && $data['loaiNV'] == "vanphong" ? "checked" : "" ?>>
                    <label class="form-check-label">Văn phòng</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="loaiNV" value="sanxuat" <?= isset($data['loaiNV']) && $data['loaiNV'] == "sanxuat" ? "checked" : "" ?>>
                    <label class="form-check-label">Sản xuất</label>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Số ngày vắng:</label>
            <input type="number" name="soNgayVang" class="form-control" min="0" value="<?= $data['soNgayVang'] ?? '' ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Số sản phẩm (nếu là nhân viên sản xuất):</label>
            <input type="number" name="soSanPham" class="form-control" min="0" value="<?= $data['soSanPham'] ?? '' ?>">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="tangCa" <?= isset($data['tangCa']) ? "checked" : "" ?>>
            <label class="form-check-label">Tăng ca</label>
        </div>

        <button type="submit" class="btn btn-primary">Tính lương</button>
    </form>

    <?php if (isset($_SESSION['thucLinh'])): ?>
    <div class="result">
        <h4>Kết quả lương</h4>
        <p><strong>Lương:</strong> <?= number_format($_SESSION['luong']) ?> VNĐ</p>
        <p><strong>Trợ cấp:</strong> <?= number_format($_SESSION['troCap']) ?> VNĐ</p>
        <p><strong>Thực lĩnh:</strong> <?= number_format($_SESSION['thucLinh']) ?> VNĐ</p>
    </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
