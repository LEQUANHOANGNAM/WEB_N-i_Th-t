<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();

// Nếu có click add_to_cart
cart();
?>

<!DOCTYPE html>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất Cả Sản Phẩm - SSS STORE</title>
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
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-light); color: var(--dark-text); }
        a { text-decoration: none; color: inherit; }
        header { background: #fff; padding: 1rem 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1000; }
        .logo img { height: 60px; }
        nav { display: flex; gap: 1.5rem; }
        nav a { color: var(--dark-text); font-weight: 600; transition: var(--transition); }
        nav a:hover { color: var(--main-color); }
        .icons { display: flex; align-items: center; gap: 1rem; }
        .icons form { display: flex; }
        .icons input[type="search"] { padding: 5px 10px; border: 1px solid #ccc; border-radius: var(--border-radius) 0 0 var(--border-radius); }
        .icons input[type="submit"] { background: var(--main-color); color: white; border: none; padding: 5px 15px; border-radius: 0 var(--border-radius) var(--border-radius) 0; cursor: pointer; }
        .product-page { display: flex; padding: 3rem 5%; gap: 2rem; }
        .sidebar { flex: 1; min-width: 220px; background: #fff; border-radius: var(--border-radius); box-shadow: 0 0 10px rgba(0,0,0,0.05); padding: 1rem; height: fit-content; }
        .sidebar h3 { margin-bottom: 1rem; color: var(--main-color); font-size: 1.3rem; }
        .sidebar ul { list-style: none; }
        .sidebar ul li { padding: 8px 10px; border-radius: var(--border-radius); margin-bottom: 5px; transition: var(--transition); }
        .sidebar ul li:hover { background: var(--main-color); color: white; cursor: pointer; }
        .product-list { flex: 3; }
        .product-list h1 { font-size: 2rem; margin-bottom: 1.5rem; }
        .box-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; }
        .box { background: white; border-radius: var(--border-radius); overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.05); transition: transform var(--transition); display: flex; flex-direction: column; justify-content: space-between; }
        .box:hover { transform: translateY(-5px); }
        .box img { width: 100%; height: 200px; object-fit: cover; }
        .box-content { padding: 1rem; display: flex; flex-direction: column; gap: 10px; }
        .box-content h3 { font-size: 1.2rem; height: 3rem; overflow: hidden; }
        .box-content p { color: var(--main-color); font-weight: bold; }
        .box-content a, .box-content input[type="submit"] { padding: 8px 16px; border-radius: var(--border-radius); cursor: pointer; border: none; text-align: center; display: inline-block; }
        .btn-cart { background-color: #28a745; color: white; }
        .btn-detail { background-color: #007bff; color: white; text-decoration: none; }
        footer { background:#222; color:white; padding:2rem 5%; display:flex; justify-content:space-between; flex-wrap:wrap; margin-top:3rem; }
        footer div{ margin-bottom:1rem; }
        footer h3{ margin-bottom:0.5rem; }
    </style>
</head>
<body>
<header>
    <a class="logo" href="index.php"><img src="./images/R.jpg" alt="Logo"></a>
    <nav>
        <a href="index.php">Trang Chủ</a>
        <a href="display_all.php" style="color: var(--main-color);">Sản Phẩm</a>
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

<section class="product-page">
    <div class="sidebar">
        <h3>Danh Mục</h3>
        <ul><?php getcategories(); ?></ul>
        <h3>Thương Hiệu</h3>
        <ul><?php getbrands(); ?></ul>
    </div>

```
<div class="product-list">
    <h1>Tất Cả Sản Phẩm</h1>
    <div class="box-container">
        <?php
        if(isset($_GET['category'])){
            get_unique_categories();
        } elseif(isset($_GET['brand'])){
            get_unique_brands();
        } else {
            get_all_products();
        }
        ?>
    </div>
</div>
```

</section>

<footer class="footer">
    <div>
        <h3>Thông Tin</h3>
        <p>Email: 2251120308@ut.edu.vn </p>
        <p>Địa chỉ: 70 Tô Ký, P. Tân Chánh Hiệp, Q12, TP.HCM</p>
    </div>
    <div>
        <h3>&copy; 2025 SSS STORE</h3>
    </div>
</footer>

</body>
</html>
