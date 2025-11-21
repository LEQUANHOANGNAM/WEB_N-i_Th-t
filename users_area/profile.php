<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ - <?php echo htmlspecialchars($username); ?> | SSS STORE</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --main-color: #ff6600;
            --bg-light: #f9f9f9;
            --dark-text: #333;
            --light-text: #777;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            margin: 0;
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
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--main-color);
        }

        .icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .icons form {
            display: flex;
        }

        .icons input[type="search"] {
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 8px 0 0 8px;
        }

        .icons input[type="submit"] {
            background: var(--main-color);
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
        }

        /* MAIN LAYOUT */
        .profile-container {
            display: flex;
            flex-wrap: wrap;
            padding: 40px 5%;
            gap: 30px;
        }

        /* SIDEBAR */
        .sidebar {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 25px 20px;
            flex: 1 1 280px;
            max-width: 280px;
            height: fit-content;
            text-align: center;
        }

        .sidebar img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid var(--main-color);
            margin-bottom: 10px;
        }

        .sidebar h3 {
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .sidebar a {
            display: block;
            color: var(--dark-text);
            font-weight: 500;
            padding: 10px 12px;
            border-radius: 8px;
            text-decoration: none;
            margin: 6px 0;
            transition: all 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: var(--main-color);
            color: #fff;
        }

        /* CONTENT */
        .content {
            flex: 3;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
            min-height: 500px;
        }

        /* FOOTER */
        footer {
            background: #222;
            color: white;
            padding: 2rem 5%;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        footer div {
            margin-bottom: 1rem;
        }

        footer h3 {
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .profile-container {
                flex-direction: column;
            }

            .sidebar {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <a class="logo" href="../index.php"><img src="../images/R.jpg" alt="Logo"></a>
        <nav>
            <a href="../index.php">Trang Chủ</a>
            <a href="../display_all.php">Sản Phẩm</a>
            <a href="./profile.php" class="active">Tài Khoản</a>
            <a href="#contact">Liên Hệ</a>
        </nav>
        <div class="icons">
            <a href="../cart.php">🛒 <sup><?php cart_item(); ?></sup></a>
            <form action="../search_product.php" method="get">
                <input type="search" placeholder="Tìm kiếm" name="search_data" />
                <input type="submit" value="Tìm" name="search_data_product" />
            </form>
            <?php echo isset($_SESSION['username']) ? '<a href="logout.php"><i class="fa fa-sign-out-alt"></i></a>' : '<a href="user_login.php"><i class="fas fa-user"></i></a>'; ?>
        </div>
    </header>

    <!-- Profile Section -->
    <section class="profile-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <?php
            $stmt = $con->prepare("SELECT user_image FROM user_table WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_image = $result->fetch_assoc()['user_image'] ?? 'default_avatar.png';
            ?>
            <img src="./user_images/<?php echo htmlspecialchars($user_image); ?>" alt="Ảnh đại diện">
            <h3><?php echo htmlspecialchars($username); ?></h3>
            <?php
            $current = isset($_GET['edit_account']) ? 'edit' : (isset($_GET['my_orders']) ? 'orders' : (isset($_GET['delete_account']) ? 'delete' : 'default'));
            ?>
            <a href="profile.php" class="<?php echo $current == 'default' ? 'active' : ''; ?>"><i class="fa-solid fa-clock"></i> Đơn hàng chờ xử lý</a>
            <a href="profile.php?edit_account" class="<?php echo $current == 'edit' ? 'active' : ''; ?>"><i class="fa-solid fa-user-gear"></i> Cài đặt tài khoản</a>
            <a href="profile.php?my_orders" class="<?php echo $current == 'orders' ? 'active' : ''; ?>"><i class="fa-solid fa-box"></i> Đơn hàng của tôi</a>
            <a href="profile.php?delete_account" class="<?php echo $current == 'delete' ? 'active' : ''; ?>"><i class="fa-solid fa-trash"></i> Xóa tài khoản</a>
            <hr>
            <a href="logout.php" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
        </aside>

        <!-- Main Content -->
        <div class="content">
            <?php
            if (isset($_GET['edit_account'])) {
                include('edit_account.php');
            } elseif (isset($_GET['my_orders'])) {
                include('user_orders.php');
            } elseif (isset($_GET['delete_account'])) {
                include('delete_account.php');
            } else {
                echo "<h3>Xin chào, " . htmlspecialchars($username) . "!</h3><p>Bạn có thể xem và quản lý tài khoản tại đây.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div>
            <h3>Thông Tin</h3>
            <p>Email: 2251120308@ut.edu.vn</p>
            <p>Địa chỉ: 70 Tô Ký, P. Tân Chánh Hiệp, Q12, TP.HCM</p>
        </div>
        <div>
            <h3>&copy; 2025 SSS STORE</h3>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
