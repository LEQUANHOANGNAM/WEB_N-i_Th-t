<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            overflow-x: hidden;
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            height: 100vh;
            background: #343a40;
            color: #fff;
            position: fixed;
            width: 250px;
            transition: all 0.3s;
        }

        .sidebar .nav-link {
            color: #cfd8dc;
            padding: 15px 20px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #495057;
            color: #ffffff;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .admin_image {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffffff;
        }

        .admin-name {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
        }

        .footer {
            margin-left: 250px;
            padding: 1rem;
            text-align: center;
            background-color: #ffffff;
            border-top: 1px solid #dee2e6;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column align-items-center py-4">
        <img src="../images/R.jpg" alt="Admin" class="admin_image">
        <div class="admin-name">
            <?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Tên Quản Trị'; ?>
        </div>
        <nav class="nav flex-column w-100 mt-4 px-3">
            <a class="nav-link" href="index.php?insert_product"><i class="fa fa-plus me-2"></i>Thêm Sản Phẩm</a>
            <a class="nav-link" href="index.php?view_products"><i class="fa fa-eye me-2"></i>Xem Sản Phẩm</a>
            <a class="nav-link" href="index.php?insert_category"><i class="fa fa-list me-2"></i>Thêm Mục Hàng</a>
            <a class="nav-link" href="index.php?view_categories"><i class="fa fa-table me-2"></i>Xem Mục Hàng</a>
            <a class="nav-link" href="index.php?insert_brand"><i class="fa fa-tags me-2"></i>Thêm Thương Hiệu</a>
            <a class="nav-link" href="index.php?view_brands"><i class="fa fa-building me-2"></i>Xem Thương Hiệu</a>
            <a class="nav-link" href="index.php?list_orders"><i class="fa fa-shopping-cart me-2"></i>Tất Cả Đơn Hàng</a>
            <a class="nav-link" href="index.php?list_payments"><i class="fa fa-credit-card me-2"></i>Tất Cả Thanh Toán</a>
            <a class="nav-link" href="index.php?list_users"><i class="fa fa-users me-2"></i>Danh Sách Users</a>
            <a class="nav-link text-danger" href="logout.php"><i class="fa fa-sign-out-alt me-2"></i>Đăng Xuất</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid justify-content-between">
                <h4 class="fw-bold text-primary">Admin Dashboard</h4>
                <div>
                    <span class="me-3">👋 <?php echo isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Chào bạn'; ?></span>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="my-4">
            <?php 
            if(isset($_GET['insert_category'])) include('insert_categories.php');
            if(isset($_GET['insert_product'])) include('insert_product.php');
            if(isset($_GET['insert_brand'])) include('insert_brands.php');
            if(isset($_GET['view_products'])) include('view_products.php');
            if(isset($_GET['edit_products'])) include('edit_products.php');
            if(isset($_GET['hide_product'])) include('hide_product.php');
            if(isset($_GET['view_categories'])) include('view_categories.php');
            if(isset($_GET['view_brands'])) include('view_brands.php');
            if(isset($_GET['edit_category'])) include('edit_category.php');
            if(isset($_GET['edit_brands'])) include('edit_brands.php');
            if(isset($_GET['delete_category'])) include('delete_category.php');
            if(isset($_GET['delete_brands'])) include('delete_brands.php');
            if(isset($_GET['list_orders'])) include('list_orders.php');
            if(isset($_GET['delete_orders'])) include('delete_orders.php');
            if(isset($_GET['list_payments'])) include('list_payments.php');
            if(isset($_GET['delete_payments'])) include('delete_payments.php');
            if(isset($_GET['list_users'])) include('list_users.php');
            ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <?php include("../includes/footer.php"); ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>