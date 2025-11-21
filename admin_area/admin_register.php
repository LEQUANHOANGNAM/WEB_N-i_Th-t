<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Quản Trị</title>
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

        .register-container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 1000px;
            width: 100%;
            margin: auto;
        }

        .register-image {
            max-width: 100%;
            border-radius: 10px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-register {
            background: #17a2b8;
            color: white;
            font-weight: 600;
            border-radius: 30px;
            width: 100%;
            transition: 0.3s;
        }

        .btn-register:hover {
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
    <div class="container register-container">
        <div class="row align-items-center">
            <div class="col-lg-6 d-none d-lg-block">
                <img src="../images/resister.png" alt="Admin Register" class="register-image">
            </div>
            <div class="col-lg-6">
                <h2 class="text-center mb-4 fw-bold text-info">
                    <i class="fa-solid fa-user-plus"></i> Đăng Ký Quản Trị
                </h2>
                <form method="post">
                    <div class="form-outline mb-3">
                        <label for="username" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" id="username" name="username" class="form-control"
                            placeholder="Nhập tên đăng nhập" required>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Nhập email" required>
                    </div>
                    <div class="form-outline mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                            placeholder="Nhập lại mật khẩu" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="admin_register" class="btn btn-register py-2">
                            <i class="fa-solid fa-user-plus me-2"></i>Đăng Ký
                        </button>
                    </div>
                    <p class="text-center small">
                        Bạn đã có tài khoản?
                        <a href="admin_login.php" class="link-danger fw-semibold">Đăng nhập</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['admin_register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username' OR admin_email='$email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('Tên đăng nhập hoặc email đã tồn tại.')</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Mật khẩu không khớp.')</script>";
    } else {
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password) 
                         VALUES ('$username', '$email', '$hash_password')";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('Đăng ký thành công!')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại.')</script>";
        }
    }
}
?>
