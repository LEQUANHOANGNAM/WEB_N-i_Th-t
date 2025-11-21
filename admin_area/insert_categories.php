<?php
include('../includes/connect.php');

if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    // Kiểm tra mục hàng đã tồn tại
    $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('Mục hàng đã tồn tại')</script>";
    } else {
        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Mục hàng đã thêm thành công')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Mục Hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Custom Style -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .form-container {
            background: #ffffff;
            padding: 30px;
            margin: 60px auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 600px;
        }
        .form-title {
            font-weight: 600;
            color: #2c3e50;
        }
        .btn-teal {
            background-color: #1abc9c;
            color: white;
        }
        .btn-teal:hover {
            background-color: #16a085;
            color: white;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <h2 class="text-center form-title mb-4"><i class="fa-solid fa-plus"></i> Thêm Mục Hàng</h2>

    <form action="" method="post">
        <div class="mb-3">
            <label for="cat_title" class="form-label">Tên mục hàng</label>
            <div class="input-group">
                <span class="input-group-text bg-info text-white" id="basic-addon1">
                    <i class="fa-solid fa-receipt"></i>
                </span>
                <input type="text" class="form-control" name="cat_title" placeholder="Nhập tên mục hàng" aria-label="Categories" aria-describedby="basic-addon1" required>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" name="insert_cat" class="btn btn-teal px-4 py-2">
                <i class="fa-solid fa-check"></i> Thêm Mục Hàng
            </button>
        </div>
    </form>
</div>

</body>
</html>
