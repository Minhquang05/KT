<?php
// Khai báo biến
$name = $math = $physics = $chemistry = $region = "";
$resultName = $resultTotal = $resultClassification = $priorityBonus = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = trim($_POST["name"]);
    $math = floatval($_POST["math"]);
    $physics = floatval($_POST["physics"]);
    $chemistry = floatval($_POST["chemistry"]);
    $region = $_POST["region"];

    // Kiểm tra điểm có hợp lệ không
    if ($math > 10 || $math < 0) {
        $errors['math'] = "Điểm Toán phải từ 0 đến 10!";
    }
    if ($physics > 10 || $physics < 0) {
        $errors['physics'] = "Điểm Lý phải từ 0 đến 10!";
    }
    if ($chemistry > 10 || $chemistry < 0) {
        $errors['chemistry'] = "Điểm Hóa phải từ 0 đến 10!";
    }

    // Nếu không có lỗi mới xử lý tiếp
    if (empty($errors)) {
        // Xác định điểm ưu tiên
        if ($region === "KV1" || $region === "KV2") {
            $priorityBonus = 5;
        } elseif ($region === "KV3") {
            $priorityBonus = 3;
        } else {
            $priorityBonus = 0;
        }

        // Tính tổng điểm (bao gồm điểm ưu tiên)
        $totalScore = $math + $physics + $chemistry + $priorityBonus;

        // Xếp loại theo tổng điểm
        if ($totalScore >= 24) {
            $classification = "Giỏi";
        } elseif ($totalScore >= 18) {
            $classification = "Khá";
        } elseif ($totalScore >= 12) {
            $classification = "Trung bình";
        } else {
            $classification = "Yếu";
        }

        // Lưu kết quả
        $resultName = htmlspecialchars($name);
        $resultTotal = $totalScore;
        $resultClassification = $classification;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xếp Loại Tuyển Sinh</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center text-primary">Xếp Loại Tuyển Sinh</h2>
        <form method="post">
            <div class="mb-3">
                <label for="math" class="form-label">Điểm Toán:</label>
                <input type="number" id="math" name="math" class="form-control" min="0" max="10" step="0.1" required value="<?= $math ?>">
                <?php if (isset($errors['math'])) : ?>
                    <div class="text-danger"><?= $errors['math'] ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="physics" class="form-label">Điểm Lý:</label>
                <input type="number" id="physics" name="physics" class="form-control" min="0" max="10" step="0.1" required value="<?= $physics ?>">
                <?php if (isset($errors['physics'])) : ?>
                    <div class="text-danger"><?= $errors['physics'] ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="chemistry" class="form-label">Điểm Hóa:</label>
                <input type="number" id="chemistry" name="chemistry" class="form-control" min="0" max="10" step="0.1" required value="<?= $chemistry ?>">
                <?php if (isset($errors['chemistry'])) : ?>
                    <div class="text-danger"><?= $errors['chemistry'] ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="region" class="form-label">Khu vực:</label>
                <select id="region" name="region" class="form-control">
                    <option value="none" <?= $region == "none" ? "selected" : "" ?>>Không ưu tiên</option>
                    <option value="KV1" <?= $region == "KV1" ? "selected" : "" ?>>KV1 (+5 điểm)</option>
                    <option value="KV2" <?= $region == "KV2" ? "selected" : "" ?>>KV2 (+5 điểm)</option>
                    <option value="KV3" <?= $region == "KV3" ? "selected" : "" ?>>KV3 (+3 điểm)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Xếp Loại</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) : ?>
        <div class="mt-4 p-4 bg-light border rounded">
            <h3 class="text-success">Kết Quả:</h3>
            <p><strong>Điểm Ưu Tiên:</strong> <?= $priorityBonus ?> điểm</p>
            <p><strong>Tổng Điểm:</strong> <?= $resultTotal ?></p>
            <p><strong>Xếp Loại:</strong> <span class="text-danger"><?= $resultClassification ?></span></p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
