<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - SSS STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 90%;
            max-width: 900px;
            display: flex;
            min-height: 550px;
        }

        /* --- CỘT TRÁI: BRANDING --- */
        .login-branding {
            flex: 1;
            background: linear-gradient(135deg, #ff6600 0%, #ff8533 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
            position: relative;
        }

        .login-branding::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('../images/pattern.png');
            opacity: 0.1;
        }

        .brand-logo {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            padding: 5px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            z-index: 2;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .login-branding h2 {
            font-weight: 800;
            font-size: 2.2rem;
            margin-bottom: 10px;
            z-index: 2;
        }

        .login-branding p {
            font-size: 1rem;
            opacity: 0.9;
            max-width: 300px;
            z-index: 2;
            margin-bottom: 30px;
        }

        .btn-register-switch {
            border: 2px solid white;
            color: white;
            padding: 10px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            z-index: 2;
        }

        .btn-register-switch:hover {
            background: white;
            color: #ff6600;
            transform: translateY(-2px);
        }

        /* --- CỘT PHẢI: FORM ĐĂNG NHẬP --- */
        .login-form-section {
            flex: 1.2;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: white;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h3 {
            color: #333;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .form-header span {
            color: #777;
            font-size: 14px;
        }

        .input-group-custom {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group-custom label {
            position: absolute;
            left: 15px;
            top: -10px;
            background: white;
            padding: 0 5px;
            font-size: 13px;
            color: #ff6600;
            font-weight: 600;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 20px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: #ff6600;
            box-shadow: 0 0 0 4px rgba(255, 102, 0, 0.1);
        }

        .forgot-pass {
            text-align: right;
            margin-bottom: 25px;
        }

        .forgot-pass a {
            color: #777;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-pass a:hover {
            color: #ff6600;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 5px 15px rgba(255, 102, 0, 0.2);
        }

        .btn-login:hover {
            background-color: #e65c00;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 102, 0, 0.3);
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
                min-height: auto;
            }
            .login-branding {
                padding: 30px 20px;
                flex: none;
            }
            .brand-logo { width: 80px; height: 80px; }
            .login-branding h2 { font-size: 1.8rem; }
            .login-form-section { padding: 40px 25px; }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-branding">
            <div class="brand-logo">
                <img src="../images/R.jpg" alt="Logo SSS Store">
            </div>
            <h2>SSS STORE</h2>
            <p>Chào mừng bạn quay trở lại. Đăng nhập để tiếp tục mua sắm và quản lý đơn hàng.</p>
            <a href="user_register.php" class="btn-register-switch">Tạo tài khoản mới</a>
        </div>

        <div class="login-form-section">
            <div class="form-header">
                <h3>Đăng Nhập</h3>
                <span>Vui lòng nhập thông tin tài khoản của bạn</span>
            </div>
            
            <form action="" method="post">
                <div class="input-group-custom">
                    <label for="user_username">Tên đăng nhập</label>
                    <input type="text" id="user_username" name="user_username" 
                           class="form-control-custom" placeholder="Nhập tên đăng nhập..." 
                           required="required" autocomplete="off">
                </div>

                <div class="input-group-custom">
                    <label for="user_password">Mật khẩu</label>
                    <input type="password" id="user_password" name="user_password" 
                           class="form-control-custom" placeholder="Nhập mật khẩu..." 
                           required="required" autocomplete="off">
                </div>

                <div class="forgot-pass">
                    <a href="#">Quên mật khẩu?</a>
                </div>

                <input type="submit" value="Đăng Nhập Ngay" class="btn-login" name="user_login">
                
                <div class="text-center mt-4 d-block d-md-none">
                    <span style="font-size: 14px; color: #666;">Chưa có tài khoản? </span>
                    <a href="user_register.php" style="color: #ff6600; font-weight: 600; text-decoration: none;">Đăng ký ngay</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php
// XỬ LÝ LOGIC PHP ĐĂNG NHẬP
if(isset($_POST['user_login'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    
    // Tìm user trong database
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    
    // Lấy IP để kiểm tra giỏ hàng
    $user_ip = getIPAddress();

    // Kiểm tra xem IP này có đang giữ giỏ hàng nào không
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if($row_count > 0){
        if(password_verify($user_password, $row_data['user_password'])){
            // Mật khẩu đúng
            $_SESSION['username'] = $user_username;
            
            if($row_count == 1 && $row_count_cart == 0){
                // Trường hợp 1: Đăng nhập đúng + KHÔNG CÓ HÀNG -> Về thẳng Trang Chủ (../index.php)
                echo "<script>window.open('../index.php','_self')</script>";
            } else {
                // Trường hợp 2: Đăng nhập đúng + CÓ HÀNG trong giỏ -> Về trang Thanh Toán
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            // Mật khẩu sai thì vẫn báo lỗi
            echo "<script>alert('Mật khẩu không chính xác!')</script>";
        }
    } else {
        // Tên đăng nhập sai thì vẫn báo lỗi
        echo "<script>alert('Tên đăng nhập không tồn tại!')</script>";
    }
}
?>