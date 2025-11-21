<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản - SSS STORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 0;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: flex;
            flex-wrap: wrap;
        }

        /* --- CỘT TRÁI: BRANDING SSS STORE --- */
        .register-image {
            flex: 1;
            background: linear-gradient(135deg, #ff6600 0%, #ff8533 100%); /* Màu cam chủ đạo SSS Store */
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-width: 320px;
        }

        .register-image img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 25px;
            border: 4px solid rgba(255,255,255,0.3);
            background: white;
        }

        .register-image h2 {
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .register-image p {
            font-size: 1rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-outline-light-custom {
            border: 2px solid white;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-outline-light-custom:hover {
            background: white;
            color: #ff6600;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* --- CỘT PHẢI: FORM ĐĂNG KÝ --- */
        .register-form-container {
            flex: 1.5;
            padding: 50px;
            background: white;
        }

        .form-title {
            color: #333;
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 26px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #eee;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            transition: all 0.3s;
            font-size: 14px;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #ff6600;
            box-shadow: 0 0 0 4px rgba(255, 102, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
            font-size: 0.9rem;
            display: block;
        }

        /* UPLOAD ẢNH ĐẠI DIỆN */
        .image-upload-wrapper {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .preview-container {
            width: 110px;
            height: 110px;
            margin: 0 auto 15px;
            position: relative;
            border-radius: 50%;
            background-color: #f0f2f5;
            border: 3px dashed #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: all 0.3s;
        }
        
        .preview-container:hover {
            border-color: #ff6600;
            background-color: #fff5f0;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none; /* Ẩn mặc định */
        }
        
        .default-icon {
            color: #bbb;
            font-size: 40px;
            transition: color 0.3s;
        }
        
        .custom-file-upload {
            display: inline-block;
            padding: 8px 20px;
            cursor: pointer;
            background-color: white;
            color: #ff6600;
            border: 1px solid #ff6600;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.3s;
        }

        .custom-file-upload:hover {
            background-color: #ff6600;
            color: white;
        }

        /* NÚT ĐĂNG KÝ */
        .btn-register {
            width: 100%;
            padding: 15px;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 15px;
            box-shadow: 0 4px 10px rgba(255, 102, 0, 0.2);
        }

        .btn-register:hover {
            background-color: #e65c00;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 102, 0, 0.3);
        }

        @media (max-width: 900px) {
            .register-card { flex-direction: column; max-width: 95%; }
            .register-image { padding: 40px 20px; min-height: auto; }
            .register-image img { width: 100px; height: 100px; }
            .register-form-container { padding: 40px 20px; }
        }
    </style>
</head>
<body>

<div class="register-card">
    <div class="register-image">
        <img src="../images/R.jpg" alt="SSS Store Logo">
        <h2>SSS STORE</h2>
        <p>Khám phá không gian nội thất đẳng cấp cùng SSS Store. Đăng ký thành viên ngay hôm nay để nhận nhiều ưu đãi đặc biệt!</p>
        <a href="user_login.php" class="btn-outline-light-custom">Đã có tài khoản? Đăng nhập</a>
    </div>

    <div class="register-form-container">
        <h3 class="form-title">Đăng Ký Thành Viên</h3>
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="image-upload-wrapper">
                <div class="preview-container" onclick="document.getElementById('user_image').click()">
                    <div class="default-icon" id="defaultIcon"><i class="fas fa-camera"></i></div>
                    <img id="imagePreview" class="preview-image" src="#" alt="Avatar">
                </div>
                <label for="user_image" class="custom-file-upload">
                    <i class="fas fa-upload"></i> Tải ảnh đại diện
                </label>
                <input type="file" id="user_image" name="user_image" accept="image/*" style="display: none;" onchange="previewFile()">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-outline">
                        <label for="user_username" class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                        <input type="text" id="user_username" class="form-control" placeholder="Username" name="user_username" required="required">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-outline">
                        <label for="user_contact" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" id="user_contact" class="form-control" placeholder="09xxx..." name="user_contact" required="required">
                    </div>
                </div>
            </div>

            <div class="form-outline">
                <label for="user_email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" id="user_email" class="form-control" placeholder="example@gmail.com" name="user_email" required="required">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-outline">
                        <label for="user_password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" id="user_password" class="form-control" placeholder="******" name="user_password" required="required">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-outline">
                        <label for="conf_user_password" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="******" name="conf_user_password" required="required">
                    </div>
                </div>
            </div>

            <div class="form-outline">
                <label for="user_address" class="form-label">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                <input type="text" id="user_address" class="form-control" placeholder="Số nhà, Tên đường, Phường/Xã..." name="user_address" required="required">
            </div>

            <div class="text-center">
                <input type="submit" value="Đăng Ký Ngay" class="btn-register" name="user_register">
            </div>
            
            <p class="small fw-bold mt-3 pt-1 mb-0 text-center d-block d-lg-none" style="color:#666;">
                Đã có tài khoản? <a href="user_login.php" style="color:#ff6600;">Đăng nhập</a>
            </p>
        </form>
    </div>
</div>

<script>
    function previewFile() {
        var preview = document.getElementById('imagePreview');
        var defaultIcon = document.getElementById('defaultIcon');
        var file = document.getElementById('user_image').files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            preview.style.display = "block";
            defaultIcon.style.display = "none";
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            preview.style.display = "none";
            defaultIcon.style.display = "block";
        }
    }
</script>

</body>
</html>

<?php
// XỬ LÝ PHP ĐĂNG KÝ
if(isset($_POST['user_register'])){
    $user_username = mysqli_real_escape_string($con, $_POST['user_username']);
    $user_email = mysqli_real_escape_string($con, $_POST['user_email']);
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = mysqli_real_escape_string($con, $_POST['user_address']);
    $user_contact = mysqli_real_escape_string($con, $_POST['user_contact']);
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    // Kiểm tra user tồn tại
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);

    if($rows_count > 0){
        echo "<script>alert('Tên đăng nhập hoặc Email đã tồn tại!')</script>";
    } elseif($user_password != $conf_user_password){
        echo "<script>alert('Mật khẩu xác nhận không khớp!')</script>";
    } else {
        // Upload ảnh
        if (!empty($user_image)) {
            move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        } else {
            $user_image = "default_avatar.png"; // Ảnh mặc định nếu không chọn
        }
        
        // Insert dữ liệu
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
                        VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        
        $sql_execute = mysqli_query($con, $insert_query);

        if($sql_execute){
            // Tự động đăng nhập hoặc chuyển hướng
            echo "<script>alert('Chào mừng đến với SSS STORE! Đăng ký thành công.')</script>";
            echo "<script>window.open('user_login.php','_self')</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra, vui lòng thử lại.')</script>";
        }
    }
}
?>