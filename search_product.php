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
    <title>Tìm Kiếm Sản Phẩm - SSS STORE</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

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
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* HEADER (Giữ nguyên style header của bạn hoặc đồng bộ) */
        .header {
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333; /* Đổi màu logo cho nổi trên nền trắng */
        }
        
        .header .logo img { height: 60px; } /* Nếu có ảnh logo */

        .navbar {
            display: flex;
            gap: 1.5rem;
        }

        .navbar a {
            color: var(--dark-text);
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 5px;
            transition: var(--transition);
        }

        .navbar a:hover {
            color: var(--main-color);
        }

        .icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-form {
            display: flex;
        }

        .search-form input[type="search"] {
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: var(--border-radius) 0 0 var(--border-radius);
            outline: none;
        }

        .search-form input[type="submit"] {
            padding: 5px 15px;
            background-color: var(--main-color);
            border: none;
            color: white;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            cursor: pointer;
        }

        /* LAYOUT CHÍNH */
        .main-content {
            display: flex;
            padding: 3rem 5%;
            gap: 2rem;
        }

        /* CSS CHO PHẦN SẢN PHẨM (QUAN TRỌNG: Đã thêm style cho .box) */
        .products-section {
            flex: 3; /* Chiếm 3 phần */
        }
        
        .products-section h1 {
            font-size: 2rem; 
            margin-bottom: 1.5rem;
        }

        /* Grid layout cho sản phẩm */
        .box-container { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 2rem; 
        }

        /* Style cho từng thẻ sản phẩm */
        .box { 
            background: white; 
            border-radius: var(--border-radius); 
            overflow: hidden; 
            box-shadow: 0 0 15px rgba(0,0,0,0.05); 
            transition: transform var(--transition); 
            display: flex; 
            flex-direction: column; 
            justify-content: space-between; 
        }
        
        .box:hover { 
            transform: translateY(-5px); 
        }
        
        /* Style ảnh sản phẩm để không bị vỡ */
        .box img { 
            width: 100%; 
            height: 200px; 
            object-fit: cover; 
        }
        
        .box-content { 
            padding: 1rem; 
            display: flex; 
            flex-direction: column; 
            gap: 10px; 
        }
        
        .box-content h3 { 
            font-size: 1.2rem; 
            height: 3rem; 
            overflow: hidden; 
        }
        
        .box-content p { 
            color: var(--main-color); 
            font-weight: bold; 
        }
        
        .box-content a, .box-content input[type="submit"] { 
            padding: 8px 16px; 
            border-radius: var(--border-radius); 
            cursor: pointer; 
            border: none; 
            text-align: center; 
            display: inline-block; 
            font-size: 0.9rem;
        }
        
        .btn-cart { background-color: #28a745; color: white; }
        .btn-detail { background-color: #007bff; color: white; text-decoration: none; }


        /* SIDEBAR (Đã áp dụng fix lỗi click) */
        .sidebar {
            flex: 1; /* Chiếm 1 phần */
            min-width: 220px;
            background: #fff;
            border-radius: var(--border-radius);
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            height: fit-content;
        }

        .sidebar h3 {
            margin-bottom: 1rem;
            color: var(--main-color);
            font-size: 1.3rem;
            margin-top: 1rem;
        }
        .sidebar h3:first-child { margin-top: 0; }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin-bottom: 5px;
        }

        /* Style thẻ a trong sidebar */
        .sidebar ul li a {
            display: block;
            padding: 8px 10px;
            border-radius: var(--border-radius);
            transition: var(--transition);
            color: var(--dark-text);
            background: transparent;
        }

        .sidebar ul li a:hover {
            background: var(--main-color);
            color: white;
        }

        /* FOOTER */
        .footer {
            background: #222;
            color: white;
            padding: 2rem 5%;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 3rem;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <section class="header">
        <a href="index.php" class="logo">SSS STORE</a>
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
                <input type="submit" name="search_data_product" value="Tìm">
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

    <div class="main-content">
        <div class="sidebar">
            <h3>Danh Mục</h3>
            <ul>
                <?php getcategories(); ?>
            </ul>
            <h3>Thương Hiệu</h3>
            <ul>
                <?php getbrands(); ?>
            </ul>
        </div>

        <div class="products-section">
            <h1>Kết Quả Tìm Kiếm</h1>
            <div class="box-container">
                <?php
                    search_product();
                ?>
            </div>
        </div>
    </div>

    <section class="footer" id="contact">
        <div>
            <h3>Thông Tin Liên Hệ</h3>
            <p>Email: 2251120308@ut.edu.vn</p>
            <p>Địa chỉ: 70 Tô Ký, P. Tân Chánh Hiệp, Q12, TP.HCM</p>
        </div>
        <div>
            <p>&copy; 2025 SSS STORE</p>
        </div>
    </section>
</body>

</html>