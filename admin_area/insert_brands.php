<?php
include('../includes/connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    // Kiểm tra tồn tại
    $select_query = "SELECT * FROM `brands` WHERE brand_title = '$brand_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('Thương hiệu đã tồn tại')</script>";
    } else {
        $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Thương hiệu đã thêm thành công')</script>";
        }
    }
}
?>

<h2 class="text-center text-primary fw-bold my-4">
    <i class="fa-solid fa-tags"></i> Thêm Thương Hiệu
</h2>

<form action="" method="post" class="w-50 mx-auto shadow p-4 rounded bg-white">
    <!-- Input thương hiệu -->
    <div class="form-outline mb-4">
        <label for="brand_title" class="form-label fw-semibold">Tên thương hiệu</label>
        <div class="input-group">
            <span class="input-group-text bg-info text-white">
                <i class="fa-solid fa-tag"></i>
            </span>
            <input type="text" class="form-control" name="brand_title" id="brand_title"
                   placeholder="Nhập tên thương hiệu" autocomplete="off" required>
        </div>
    </div>

    <!-- Submit -->
    <div class="text-center">
        <input type="submit" class="btn btn-info text-white px-4" name="insert_brand" value="Thêm Thương Hiệu">
    </div>
</form>
