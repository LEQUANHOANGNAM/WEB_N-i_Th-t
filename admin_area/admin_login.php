<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập Quản Trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 1000px;
            width: 100%;
            margin: auto;
        }

        .login-image {
            max-width: 100%;
            border-radius: 10px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            background: #17a2b8;
            color: white;
            font-weight: 600;
            border-radius: 30px;
            width: 100%;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #138496;
        }

        .link-danger {
            text-decoration: none;
        }

        .link-danger:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row align-items-center">
            <div class="col-lg-6 d-none d-lg-block">
                <img src="../images/login.png" alt="Admin Login" class="login-image">
            </div>
            <div class="col-lg-6">
                <h2 class="text-center mb-4 fw-bold text-info">
                    <i class="fa-solid fa-user-shield"></i> Đăng Nhập Quản Trị
                </h2>
                <form method="post">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" id="username" name="username" class="form-control"
                            placeholder="Nhập tên đăng nhập" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="admin_login" class="btn btn-login py-2">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Đăng Nhập
                        </button>
                    </div>
                    <p class="text-center small">
                        Bạn chưa có tài khoản? 
                        <a href="admin_register.php" class="link-danger fw-semibold">Đăng ký</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0 && password_verify($password, $row_data['admin_password'])) {
        $_SESSION['admin_name'] = $username;
        echo "<script>window.open('index.php','_self')</script>";
    } else {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng.')</script>";
    }
}
?>
