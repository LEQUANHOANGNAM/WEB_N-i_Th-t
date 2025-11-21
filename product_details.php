<?php
session_start();
include_once 'functions/common_function.php';
cart(); // xử lý thêm vào giỏ hàng
?>

<!DOCTYPE html>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--main-color:#ff6600;--bg-light:#f9f9f9;--dark-text:#333;--border-radius:10px;--transition:0.3s ease}
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Inter',sans-serif;}
        body{background-color:var(--bg-light);color:var(--dark-text);line-height:1.6;}
        a{text-decoration:none;color:inherit;}
        header{background:#fff;padding:1rem 5%;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 10px rgba(0,0,0,.05);position:sticky;top:0;z-index:1000;}
        .logo img{height:60px;}
        nav{display:flex;gap:1.5rem;}
        nav a{color:var(--dark-text);font-weight:600;transition:var(--transition);}
        nav a:hover{color:var(--main-color);}
        .icons{display:flex;align-items:center;gap:1rem;}
        .icons a{position:relative;}
        .icons sup{position:absolute;top:-10px;right:-10px;background:red;color:white;padding:2px 6px;border-radius:50%;font-size:0.7rem;}
        .product-details-container{padding:4rem 5%; display:flex; flex-wrap:wrap; gap:2rem;}
        .box-detail{background:white;border-radius:var(--border-radius);box-shadow:0 0 15px rgba(0,0,0,.05);display:flex;flex-wrap:wrap;gap:2rem;padding:2rem;}
        .box-detail img{width:300px;height:300px;object-fit:cover;border-radius:var(--border-radius);}
        .box-detail-content{flex:1; display:flex; flex-direction:column; justify-content:space-between;}
        .box-detail-content h3{font-size:2rem;margin-bottom:1rem;}
        .box-detail-content p{margin-bottom:1rem;font-size:1.1rem;}
        .btn-cart{background:var(--main-color);color:white;border:none;padding:10px 20px;border-radius:var(--border-radius);cursor:pointer;width:max-content;}
        .footer{background:#222;color:white;padding:2rem 5%;display:flex;justify-content:space-between;flex-wrap:wrap;}
        .footer div{margin-bottom:1rem;}
        .footer h3{margin-bottom:.5rem;}
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
        <?php echo isset($_SESSION['username']) ? '<a href="./users_area/logout.php"><i class="fa fa-sign-out-alt"></i></a>' : '<a href="./users_area/user_login.php"><i class="fas fa-user"></i></a>'; ?>
    </div>
</header>

<section class="product-details-container">
    <?php
    // Hiển thị chi tiết sản phẩm
    view_details();
    ?>
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
