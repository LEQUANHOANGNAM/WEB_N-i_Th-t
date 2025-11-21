<?php
session_start();
include_once __DIR__ . '/functions/common_function.php';

// Xử lý giỏ hàng
cart();
?>

<!DOCTYPE html>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS STORE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        body { background-color: var(--bg-light); color: var(--dark-text); line-height: 1.6; }
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
        .home { background: url('./images/anh_nen.jpg') center/cover no-repeat; height: 450px; display: flex; justify-content: center; align-items: center; color: white; text-shadow: 1px 1px 5px black; }
        .home .content { text-align: center; }
        .home h1 { font-size: 3rem; }
        .home span { font-size: 1.2rem; display: block; margin-top: 1rem; }
        .product { padding: 4rem 5%; background: #fff; }
        .product .heading { text-align: center; font-size: 2.5rem; margin-bottom: 2rem; }
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
        .contact { padding: 4rem 5%; background: var(--bg-light); }
        .contact .row { display: flex; flex-wrap: wrap; gap: 2rem; align-items: center; }
        .contact .image img { max-width: 100%; border-radius: var(--border-radius); }
        .contact form { flex: 1; }
        .contact form .box, .contact form textarea { width: 100%; margin-bottom: 1rem; padding: 10px; border: 1px solid #ccc; border-radius: var(--border-radius); }
        .contact form .btn { background: var(--main-color); color: white; border: none; padding: 10px 20px; border-radius: var(--border-radius); cursor: pointer; }
        footer { background: #222; color: white; padding: 2rem 5%; display: flex; justify-content: space-between; flex-wrap: wrap; }
        footer div { margin-bottom: 1rem; }
        footer h3 { margin-bottom: 0.5rem; }
    </style>
</head>
<body>

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

<section class="home">
    <div class="content">
        <h1>SSS STORE</h1>
    </div>
</section>

<section class="product">
    <h1 class="heading">Sản Phẩm Nổi Bật</h1>
    <div class="box-container">
        <?php
        get_all_products();
        if(isset($_GET['category'])){ get_unique_categories(); }
        if(isset($_GET['brand'])){ get_unique_brands(); }
        ?>
    </div>
</section>

<section class="contact" id="contact">
    <h1 class="heading">Liên Hệ Chúng Tôi</h1>
    <div class="row">
        <div class="image">
            <img src="./images/LIENHE.jpg" alt="Liên hệ">
        </div>
        <form action="">
            <input type="text" class="box" placeholder="Họ và tên">
            <input type="number" class="box" placeholder="Số điện thoại">
            <input type="email" class="box" placeholder="Email">
            <textarea class="box" placeholder="Nội dung"></textarea>
            <input type="submit" class="btn" value="Gửi">
        </form>
    </div>
</section>

<footer>
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
