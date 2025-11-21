<?php
include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background-color: #f8f9fa;
        }

        .product_img {
            width: 80px;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }

        .table-hover tbody tr:hover {
            background-color: #dbeafe;
        }

        .table thead {
            background: linear-gradient(to right, #0ea5e9, #38bdf8);
            color: white;
        }

        td i {
            transition: transform 0.2s;
        }

        td i:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h3 class="text-center text-primary mb-4">Tất Cả Sản Phẩm</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Đã Bán</th>
                        <th>Trạng Thái</th>
                        <th>Chỉnh Sửa</th>
                        <th>Ẩn</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <?php
                    $get_products = "SELECT * FROM `products`";
                    $result = mysqli_query($con, $get_products);
                    $number = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_image1 = $row['product_image1'];
                        $product_price = $row['product_price'];
                        $status = $row['status'];
                        $number++;

                        // Đếm số lượng đã bán
                        $get_count = "SELECT * FROM `orders_pending` WHERE product_id=$product_id";
                        $result_count = mysqli_query($con, $get_count);
                        $rows_count = mysqli_num_rows($result_count);
                    ?>
                    <tr>
                        <td><?php echo $number; ?></td>
                        <td class="text-start"><?php echo $product_title; ?></td>
                        <td><img src='./product_images/<?php echo $product_image1; ?>' class='product_img'></td>
                        <td><?php echo number_format($product_price, 0, ',', '.'); ?> đ</td>
                        <td><?php echo $rows_count; ?></td>
                        <td>
                            <?php echo $status === 'true' ? "<span class='badge bg-success'>Hiện</span>" : "<span class='badge bg-danger'>Ẩn</span>"; ?>
                        </td>
                        <td>
                            <a href='index.php?edit_products=<?php echo $product_id ?>' class='text-primary'>
                                <i class='fa-solid fa-pen-to-square'></i>
                            </a>
                        </td>
                        <td>
                            <a href='index.php?hide_product=<?php echo $product_id ?>' class='text-secondary'>
                                <?php if ($status == 'false'): ?>
                                <i class='fa-solid fa-eye-slash'></i>
                                <?php else: ?>
                                <i class='fa-solid fa-eye'></i>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td>
                            <a href='view_products.php?delete_product=<?php echo $product_id ?>'
                                class='text-danger'
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                <i class='fa-solid fa-cart-shopping'></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- PHP xử lý xóa sản phẩm -->
    <?php
    if (isset($_GET['delete_product'])) {
        $delete_id = $_GET['delete_product'];

        $delete_query = "DELETE FROM `products` WHERE product_id = $delete_id";
        $result_delete = mysqli_query($con, $delete_query);

        if ($result_delete) {
            echo "<script>alert('Sản phẩm đã được xóa thành công!');</script>";
            echo "<script>window.location.href='index.php?view_products';</script>";
        } else {
            echo "<script>alert('Xóa thất bại. Vui lòng thử lại.');</script>";
        }
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
