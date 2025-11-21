<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

// ====== CẬP NHẬT GIỎ HÀNG ======
function update_cart() {
    global $con;
    $get_ip_add = getIPAddress();

    if (isset($_POST['update_cart'])) {
        foreach ($_POST['qty'] as $product_id => $quantity) {
            if ($quantity > 0) {
                $update_cart = "UPDATE `cart_details` SET quantity='$quantity' WHERE product_id='$product_id' AND ip_address='$get_ip_add'";
                mysqli_query($con, $update_cart);
            }
        }
        echo "<script>window.location='cart.php';</script>";
    }

    if (isset($_POST['removeitem'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
            $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id AND ip_address='$get_ip_add'";
            mysqli_query($con, $delete_query);
        }
        echo "<script>window.location='cart.php';</script>";
    }

    if (isset($_POST['continue_shopping'])) {
        echo "<script>window.location='index.php';</script>";
    }
}
update_cart();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - SSS STORE</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --main-color: #ff6600;
            --bg-light: #f9f9f9;
            --dark-text: #333;
            --border-radius: 10px;
            --transition: 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--dark-text);
        }

        /* HEADER */
        header {
            background: #fff;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo img {
            height: 60px;
        }

        nav {
            display: flex;
            gap: 1.5rem;
        }

        nav a {
            color: var(--dark-text);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        nav a:hover {
            color: var(--main-color);
            text-decoration: none;
        }

        .icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .icons a {
            color: var(--dark-text);
            text-decoration: none;
            font-size: 1.1rem;
        }

        .icons a:hover {
            color: var(--main-color);
        }

        .icons form {
            display: flex;
        }

        .icons input[type="search"] {
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: var(--border-radius) 0 0 var(--border-radius);
        }

        .icons input[type="submit"] {
            background: var(--main-color);
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            cursor: pointer;
        }

        /* CART CONTAINER */
        .container {
            margin: 3rem auto;
            max-width: 1000px;
            background: #fff;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            text-align: center;
            padding: 14px;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: var(--main-color);
            color: white;
        }

        .cart_img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 10px;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .btn {
            background-color: var(--main-color);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn:hover {
            opacity: 0.8;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        .bg-danger:hover {
            opacity: 0.8;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .text-info {
            color: var(--main-color);
            font-weight: bold;
        }

        /* FOOTER */
        .footer {
            background: #222;
            color: white;
            padding: 2rem 5%;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer div {
            margin-bottom: 1rem;
        }

        .footer h3 {
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .container {
                margin: 2rem 1rem;
                padding: 20px;
            }

            .footer {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <a class="logo" href="index.php"><img src="./images/R.jpg" alt="Logo"></a>
        <nav>
            <a href="index.php">Trang Chủ</a>
            <a href="display_all.php">Sản Phẩm</a>
            <?php echo isset($_SESSION['username']) ? '<a href="./users_area/profile.php">Tài Khoản</a>' : '<a href="./users_area/user_register.php">Đăng ký</a>'; ?>
            <a href="#contact">Liên Hệ</a>
        </nav>
        <div class="icons">
            <a href="cart.php">🛒 <sup><?php cart_item(); ?></sup></a>
            <form action="search_product.php" method="get">
                <input type="search" placeholder="Tìm kiếm" name="search_data" />
                <input type="submit" value="Tìm" name="search_data_product" />
            </form>
            <?php echo isset($_SESSION['username']) ? '<a href="./users_area/logout.php"><i class="fa fa-sign-out-alt"></i></a>' : '<a href="./users_area/user_login.php"><i class="fas fa-user"></i></a>'; ?>
        </div>
    </header>

    <!-- MAIN CART -->
    <div class="container">
        <h2>Giỏ hàng của bạn</h2>
        <form action="" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Cập Nhật</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_ip_add = getIPAddress();
                    $total_price = 0;
                    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);

                    if ($result_count > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                            $result_products = mysqli_query($con, $select_products);
                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $product_price = $row_product_price['product_price'];
                                $product_title = $row_product_price['product_title'];
                                $product_image1 = $row_product_price['product_image1'];
                                $quantity = $row['quantity'];
                                $subtotal = $product_price * $quantity;
                                $total_price += $subtotal;
                    ?>
                                <tr>
                                    <td><?php echo $product_title ?></td>
                                    <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" class="cart_img"></td>
                                    <td><input type="number" name="qty[<?php echo $product_id; ?>]" value="<?php echo $quantity; ?>" min="1" step="1"></td>
                                    <td><?php echo number_format($product_price, 0, ',', '.'); ?><sup>đ</sup></td>
                                    <td><input type="submit" value="Cập Nhật" class="btn" name="update_cart"></td>
                                    <td><button type="submit" name="removeitem[]" value="<?php echo $product_id ?>" class="bg-danger btn">Xóa</button></td>
                                </tr>
                    <?php
                            }
                        }
                    } else {
                        echo "<tr><td colspan='6'>Giỏ hàng của bạn đang trống.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="d-flex">
                <?php
                if ($result_count > 0) {
                    echo "<h4>Tổng cộng: <span class='text-info'>" . number_format($total_price, 0, ',', '.') . "<sup>đ</sup></span></h4>
                          <input type='submit' value='Tiếp tục mua hàng' class='btn' name='continue_shopping'>
                          <a href='./users_area/checkout.php' class='btn'>Thanh toán</a>";
                } else {
                    echo "<input type='submit' value='Tiếp tục mua hàng' class='btn' name='continue_shopping'>";
                }
                ?>
            </div>
        </form>
    </div>

    <!-- FOOTER -->
    <footer class="footer" id="contact">
        <div>
            <h3>Thông Tin</h3>
            <p>Email: 2251120308@ut.edu.vn</p>
            <p>Địa chỉ: 70 Tô Ký, P. Tân Chánh Hiệp, Q12, TP.HCM</p>
        </div>
        <div>
            <h3>&copy; 2025 SSS STORE</h3>
        </div>
    </footer>
</body>

</html>
