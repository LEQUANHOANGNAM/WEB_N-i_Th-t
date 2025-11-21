<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MongLinhStore</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #ce962e;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 3%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .navbar {
            display: flex;
            gap: 1.5rem;
        }

        .navbar a {
            color: white;
            font-weight: 500;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .navbar a:hover {
            background-color: #a8721a;
        }

        .icons {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .icons a {
            color: white;
            font-size: 1.2rem;
            text-decoration: none;
            position: relative;
        }

        .search-form input[type="search"] {
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
        }

        .search-form input[type="submit"] {
            padding: 6px 12px;
            background-color: #a8721a;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }

        .main-content {
            display: flex;
            padding: 20px 3%;
        }

        .products-section {
            width: 75%;
            padding-right: 20px;
        }

        .products-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .products-grid > div {
            flex: 1 1 calc(33.33% - 20px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
        }

        .sidebar {
            width: 25%;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            background-color: #ce962e;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .categories li,
        .brands li {
            list-style: none;
            background-color: #6c757d;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .categories li:hover,
        .brands li:hover {
            background-color: #495057;
        }

        .categories li a,
        .brands li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .credit {
            display: flex;
            justify-content: space-between;
            background-color: #333;
            color: white;
            padding: 20px 3%;
            flex-wrap: wrap;
        }

        .credit h3 {
            margin-top: 0;
        }

        .credit-left,
        .credit-right {
            width: 48%;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .products-section,
            .sidebar {
                width: 100%;
            }

            .products-grid > div {
                flex: 1 1 100%;
            }

            .credit {
                flex-direction: column;
                text-align: center;
            }

            .credit-left,
            .credit-right {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <section class="header">
        <a href="index.php" class="logo">SSS STore</a>
        <nav class="navbar">
            <a href="index.php">Trang Chủ</a>
            <a href="display_all.php">Sản Phẩm</a>
            <?php
                if(isset($_SESSION['username'])){
                    echo "<a href='./users_area/profile.php'>Tài Khoản</a>";
                } else {
                    echo "<a href='./users_area/user_register.php'>Đăng ký</a>";
                }
            ?>
            <a href="#contact">Liên Hệ</a>
        </nav>

        <div class="icons">
            <a href="cart.php"> 🛒<sup><?php cart_item();?></sup></a>
            <form class="search-form" action="search_product.php" method="get">
                <input type="search" name="search_data" placeholder="Tìm kiếm...">
                <input type="submit" name="search_data_product" value="Tìm Kiếm">
            </form>
            <?php
                if(!isset($_SESSION['username'])){
                    echo "<a href='./users_area/user_login.php'><i class='fas fa-user'></i></a>";
                } else {
                    echo "<a href='./users_area/logout.php'><i class='fa fa-sign-out-alt'></i></a>";
                }
            ?>
        </div>
    </section>

    <!-- Content -->
    <div class="main-content">
        <div class="products-section">
            <div class="products-grid">
                <?php
                    search_product();
                    get_unique_categories();
                    get_unique_brands();
                ?>
            </div>
        </div>

        <div class="sidebar">
            <ul class="categories">
                <li class="sidebar-header">Mục Hàng</li>
                <?php getcategories(); ?>
            </ul>
            <ul class="brands">
                <li class="sidebar-header">Thương Hiệu</li>
                <?php getbrands(); ?>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <section class="credit" id="contact">
        <div class="credit-left">
            <h3>Thông Tin Liên Hệ</h3>
            <p>Email: 2251120308 ( Nam )</p>
        </div>
        <div class="credit-right">
            <p>&copy; 2024 SSS STORE</p>
        </div>
    </section>
</body>

</html>