<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SSS STORE<?= isset($page_title) ? " - $page_title" : "" ?></title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<section class="header">
  <a href="index.php" class="logo">SSS STORE</a>
  <nav class="navbar">
    <a href="index.php">Trang Chủ</a>
    <a href="display_all.php">Sản Phẩm</a>
    <?php if (isset($_SESSION['username'])): ?>
      <a href="./users_area/profile.php">Tài Khoản</a>
    <?php else: ?>
      <a href="./users_area/user_register.php">Đăng ký</a>
    <?php endif; ?>
    <a href="#contact">Liên Hệ</a>
  </nav>
  <div class="icons">
    <a href="cart.php">
      <i class="fas fa-shopping-cart"></i>
      <sup><?php cart_item(); ?></sup>
    </a>
    <form class="search-form" action="search_product.php" method="get">
      <input type="search" name="search_data" placeholder="Tìm kiếm...">
      <input type="submit" name="search_data_product" value="Tìm Kiếm">
    </form>
    <?php if (!isset($_SESSION['username'])): ?>
      <a href="./users_area/user_login.php"><i class="fas fa-user"></i></a>
    <?php else: ?>
      <a href="./users_area/logout.php"><i class="fa fa-sign-out-alt"></i></a>
    <?php endif; ?>
  </div>
</section>
