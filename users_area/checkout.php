<?php
include('../includes/connect.php');
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    include('user_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán - SSS</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e0f7fa);
        }

        .header {
            background-color: #0d6efd;
            padding: 16px 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            font-size: 22px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .header .navbar a {
            margin: 0 12px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .header .navbar a:hover {
            color: #ffc107;
        }

        .icons {
            display: flex;
            align-items: center;
        }

        .search-form input[type="search"] {
            padding: 6px 10px;
            border: none;
            border-radius: 4px 0 0 4px;
            outline: none;
        }

        .search-form input[type="submit"] {
            padding: 6px 12px;
            background-color: #ffc107;
            border: none;
            color: black;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        .checkout-section {
            margin: 100px auto 40px;
            max-width: 1000px;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .checkout-section .row {
            font-size: 18px;
        }

        .credit {
            display: flex;
            justify-content: space-between;
            padding: 40px 60px;
            background-color: #0d6efd;
            color: white;
            flex-wrap: wrap;
        }

        .credit h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .credit p {
            font-size: 14px;
            margin: 4px 0;
        }

        a {
            text-decoration: none !important;
        }

        @media (max-width: 768px) {
            .credit {
                flex-direction: column;
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar {
                margin-top: 10px;
            }

            .search-form {
                margin-top: 10px;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <section class="header">
        <a href="#" class="logo"><i class="fas fa-chair"></i> SSSStore</a>
        <nav class="navbar">
            <a href="../index.php">Trang Chủ</a>
            <a href="../display_all.php">Sản Phẩm</a>
            <a href="#contact">Liên Hệ</a>
        </nav>
        <div class="icons">
            <?php echo "<a class='nav-link' href='logout.php' style='color:white; margin-right: 10px;'>Đăng Xuất</a>"; ?>
            <form class="search-form" action="../search_product.php" method="get">
                <input type="search" placeholder="Tìm kiếm" aria-label="Search" name="search_data" required>
                <input type="submit" value="Tìm Kiếm" name="search_data_product">
            </form>
        </div>
    </section>

    <!-- Checkout Content -->
    <div class="checkout-section">
        <div class="col-md-12">
            <div class="row">
                <?php include('payment.php'); ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <section class="credit">
        <div class="credit-left">
            <h3>Thông Tin Liên Hệ</h3>
            <p>0819139541:Nam</p>
        </div>
        <div class="credit-right">
            <h3>Bản quyền</h3>
            <p>&copy; 2024 SSSStore. All Rights Reserved.</p>
            <p>Địa chỉ: 70 Tô Ký, Phường Tân Chánh Hiệp, Quận 12, TP.HCM</p>
        </div>
    </section>
</body>

</html>
