<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 02</title>
    <style>
        /* Đặt lại các thuộc tính margin, padding */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        /* Màu nền của trang */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            color: #333;
        }

        /* Phần header */
        header {
            background-color: #00bcd4;
            padding: 2rem;
            text-align: center;
        }

        header h1 {
            font-size: 3rem;
            color: white;
            margin: 0;
        }

        /* Phần nội dung chính */
        .main-section {
            display: flex;
            justify-content: space-between;
            padding: 2rem;
            gap: 2rem;
        }

        /* Mỗi phần trong nội dung chính */
        .section {
            background-color: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        /* Tiêu đề của mỗi phần */
        .section h2 {
            color: #00796b;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        /* Phần footer */
        footer {
            background-color: #009688;
            color: white;
            padding: 1rem;
            text-align: center;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <h1>Bảng tin</h1>
    </header>

    <!-- Phần nội dung chính -->
    <div class="main-section">
        <div class="section">
            <?php require_once "lienketwebsite.php" ?>
        </div>
        <div class="section">
            <?php require_once "tinxemnhieu.php" ?>
        </div>
    </div>
</body>
</html>
