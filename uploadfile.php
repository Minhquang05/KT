<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Multiple Files</title>
</head>
<body>
    <h2>Upload Multiple Images or PDFs</h2>
    <form id="uploadForm" method="POST" enctype="multipart/form-data">
        <label for="fileInput">Choose multiple files (JPG, PNG, GIF, WEBP, PDF):</label><br>
        <input type="file" id="fileInput" name="images[]" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" multiple required><br><br>
        <button type="submit">Upload Files</button>
    </form>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    $uploadDir = __DIR__ . '/uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['images'])) {
        $files = $_FILES['images'];
        $numFiles = count($files['name']);

        for ($i = 0; $i < $numFiles; $i++) {
            $fileName = $files['name'][$i];
            $fileTmp = $files['tmp_name'][$i];
            $fileSize = $files['size'][$i];
            $fileType = $files['type'][$i];
            $fileError = $files['error'][$i];

            if ($fileError !== 0) {
                echo "❌ Lỗi khi tải lên tệp: $fileName - Mã lỗi: $fileError<br>";
                continue;
            }

            if (!in_array($fileType, $allowedTypes)) {
                echo "❌ File không hợp lệ: $fileName (Chỉ hỗ trợ JPG, PNG, GIF, WEBP, PDF)<br>";
                continue;
            }

            if ($fileSize > $maxSize) {
                echo "❌ File quá lớn: $fileName (Giới hạn 5MB)<br>";
                continue;
            }

            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $uniqueFileName = time() . '-' . rand(1000, 9999) . '.' . $fileExtension;
            $targetFile = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($fileTmp, $targetFile)) {
                $uploadedFilePath = 'uploads/' . $uniqueFileName;
                echo "<h3>✅ Tệp đã tải lên thành công: $fileName</h3>";

                if (strpos($fileType, 'image') !== false) {
                    echo "<img src='$uploadedFilePath' alt='Uploaded Image' style='max-width: 300px; margin-right: 10px;'>";
                } elseif ($fileType === 'application/pdf') {
                    echo "<p><a href='$uploadedFilePath' target='_blank'>📄 Click để xem file PDF: $fileName</a></p>";
                }
            } else {
                echo "❌ Không thể di chuyển tệp: $fileName<br>";
            }
        }
    }
    ?>
</body>
</html>
