<?php
include('../includes/connect.php');

if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];
    $get_data = "SELECT * FROM `products` WHERE product_id = $edit_id";
    $result = mysqli_query($con, $get_data);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_keywords = $row['product_keywords'];
        $category_id = $row['category_id'];
        $brand_id = $row['brand_id'];
        $product_image1 = $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_price = $row['product_price'];

        // Lấy tên danh mục
        $select_category = "SELECT * FROM `categories` WHERE category_id = $category_id";
        $result_category = mysqli_query($con, $select_category);
        $row_category = mysqli_fetch_assoc($result_category);
        $category_title = $row_category['category_title'] ?? '';

        // Lấy tên thương hiệu
        $select_brand = "SELECT * FROM `brands` WHERE brand_id = $brand_id";
        $result_brand = mysqli_query($con, $select_brand);
        $row_brand = mysqli_fetch_assoc($result_brand);
        $brand_title = $row_brand['brand_title'] ?? '';
    } else {
        echo "<script>alert('Sản phẩm không tồn tại'); window.location.href='index.php';</script>";
        exit();
    }
}
?>

<style>
    .product_img {
        width: 100px;
        height: auto;
        object-fit: cover;
        margin-left: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center">Chỉnh Sửa Sản Phẩm</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Tên sản phẩm -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Tên Sản Phẩm</label>
            <input type="text" name="product_title" value="<?= $product_title ?>" class="form-control" required>
        </div>

        <!-- Mô tả -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Mô Tả Sản Phẩm</label>
            <input type="text" name="product_desc" value="<?= $product_description ?>" class="form-control" required>
        </div>

        <!-- Từ khóa -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Từ Khóa Sản Phẩm</label>
            <input type="text" name="product_keywords" value="<?= $product_keywords ?>" class="form-control" required>
        </div>

        <!-- Danh mục -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Mục Sản Phẩm</label>
            <select name="product_category" class="form-select">
                <option value="<?= $category_id ?>"><?= $category_title ?></option>
                <?php
                $select_category_all = "SELECT * FROM `categories`";
                $result_category_all = mysqli_query($con, $select_category_all);
                while ($row = mysqli_fetch_assoc($result_category_all)) {
                    $id = $row['category_id'];
                    $title = $row['category_title'];
                    if ($id != $category_id) {
                        echo "<option value='$id'>$title</option>";
                    }
                }
                ?>
            </select>
        </div>

        <!-- Thương hiệu -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Thương Hiệu</label>
            <select name="product_brands" class="form-select">
                <option value="<?= $brand_id ?>"><?= $brand_title ?></option>
                <?php
                $select_brand_all = "SELECT * FROM `brands`";
                $result_brand_all = mysqli_query($con, $select_brand_all);
                while ($row = mysqli_fetch_assoc($result_brand_all)) {
                    $id = $row['brand_id'];
                    $title = $row['brand_title'];
                    if ($id != $brand_id) {
                        echo "<option value='$id'>$title</option>";
                    }
                }
                ?>
            </select>
        </div>

        <!-- Ảnh sản phẩm 1 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Ảnh 1</label>
            <div class="d-flex align-items-center">
                <input type="file" name="product_image1" class="form-control w-75">
                <img src="./product_images/<?= $product_image1 ?>" class="product_img ms-2">
            </div>
        </div>

        <!-- Ảnh sản phẩm 2 -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Ảnh 2</label>
            <div class="d-flex align-items-center">
                <input type="file" name="product_image2" class="form-control w-75">
                <img src="./product_images/<?= $product_image2 ?>" class="product_img ms-2">
            </div>
        </div>

        <!-- Giá -->
        <div class="form-outline w-50 m-auto mb-4">
            <label class="form-label">Giá Sản Phẩm</label>
            <input type="text" name="product_price" value="<?= $product_price ?>" class="form-control" required>
        </div>

        <!-- Nút cập nhật -->
        <div class="w-50 m-auto">
            <input type="submit" name="edit_product" value="Cập nhật sản phẩm" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>

<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_desc'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];

    // Ảnh mới
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];

    // Nếu không chọn ảnh mới thì giữ ảnh cũ
    if (empty($product_image1)) {
        $product_image1 = $row['product_image1'];
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
    }

    if (empty($product_image2)) {
        $product_image2 = $row['product_image2'];
    } else {
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
    }

    $update_product = "UPDATE `products` SET 
        product_title='$product_title',
        product_description='$product_desc',
        product_keywords='$product_keywords',
        category_id='$product_category',
        brand_id='$product_brands',
        product_image1='$product_image1',
        product_image2='$product_image2',
        product_price='$product_price',
        date=NOW()
        WHERE product_id=$edit_id";

    $result_update = mysqli_query($con, $update_product);
    if ($result_update) {
        echo "<script>alert('Chỉnh sửa sản phẩm thành công!')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}
?>
