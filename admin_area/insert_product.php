<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Accessing image
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];

    // Temporary image
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];

    // Validation
    if(
        $product_title == '' || $description == '' || $product_keywords == '' ||
        $product_category == '' || $product_brands == '' || $product_price == '' ||
        $product_image1 == '' || $product_image2 == ''
    ){
        echo "<script>alert('Vui lòng nhập đủ thông tin!')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");

        // Insert query
        $insert_products = "INSERT INTO `products` 
        (product_title, product_description, product_keywords, category_id, brand_id, 
        product_image1, product_image2, product_price, date, status) 
        VALUES 
        ('$product_title', '$description', '$product_keywords', '$product_category', '$product_brands', 
        '$product_image1', '$product_image2', '$product_price', NOW(), '$product_status')";
        
        $result_query = mysqli_query($con, $insert_products);
        if($result_query){
            echo "<script>alert('Đã thêm sản phẩm thành công!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        body {
            background: #edf1f5;
            font-family: 'Segoe UI', sans-serif;
        }
        .form-container {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: 50px;
        }
        h2 {
            color: #1abc9c;
            font-weight: 700;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn-submit {
            background-color: #1abc9c;
            color: #fff;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>

<div class="container w-75">
    <div class="form-container">
        <h2 class="text-center mb-4"><i class="fa-solid fa-plus"></i> Thêm Sản Phẩm</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="product_title" class="form-label">Tên sản phẩm</label>
                    <input type="text" name="product_title" id="product_title" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="product_keywords" class="form-label">Từ khóa sản phẩm</label>
                    <input type="text" name="product_keywords" id="product_keywords" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
                </div>

                <div class="col-md-6">
                    <label for="product_category" class="form-label">Danh mục</label>
                    <select name="product_category" class="form-select" required>
                        <option value="">Chọn mục hàng</option>
                        <?php
                        $select_query = "SELECT * FROM `categories`";
                        $result_query = mysqli_query($con, $select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="product_brands" class="form-label">Thương hiệu</label>
                    <select name="product_brands" class="form-select" required>
                        <option value="">Chọn thương hiệu</option>
                        <?php
                        $select_query = "SELECT * FROM `brands`";
                        $result_query = mysqli_query($con, $select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="product_image1" class="form-label">Ảnh sản phẩm 1</label>
                    <input type="file" name="product_image1" id="product_image1" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="product_image2" class="form-label">Ảnh sản phẩm 2</label>
                    <input type="file" name="product_image2" id="product_image2" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label for="product_price" class="form-label">Giá sản phẩm</label>
                    <input type="text" name="product_price" id="product_price" class="form-control" required>
                </div>

                <div class="col-md-12 text-center mt-4">
                    <button type="submit" name="insert_product" class="btn btn-submit">
                        <i class="fa-solid fa-upload"></i> Thêm sản phẩm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
