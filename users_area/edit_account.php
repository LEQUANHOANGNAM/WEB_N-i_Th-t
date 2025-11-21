<?php
// Lấy thông tin tài khoản hiện tại
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];
    $current_image = $row_fetch['user_image'] ? $row_fetch['user_image'] : 'default_avatar.png';
}

// Xử lý khi bấm nút Cập nhật
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $username = htmlspecialchars($_POST['user_username']); // Thêm htmlspecialchars để bảo mật
    $user_email = htmlspecialchars($_POST['user_email']);
    $user_address = htmlspecialchars($_POST['user_address']);
    $user_mobile = htmlspecialchars($_POST['user_mobile']);
    
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    
    if(!empty($user_image)){
        // Upload ảnh mới
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $update_query = "UPDATE `user_table` SET username=?, user_email=?, user_image=?, user_address=?, user_mobile=? WHERE user_id=?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("sssssi", $username, $user_email, $user_image, $user_address, $user_mobile, $update_id);
    } else {
        // Giữ nguyên ảnh cũ
        $update_query = "UPDATE `user_table` SET username=?, user_email=?, user_address=?, user_mobile=? WHERE user_id=?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param("ssssi", $username, $user_email, $user_address, $user_mobile, $update_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thông tin thành công!')</script>";
        echo "<script>window.open('profile.php?edit_account','_self')</script>"; 
    } else {
         echo "<script>alert('Có lỗi xảy ra. Vui lòng thử lại.')</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa tài khoản</title>
    <style>
        .edit-account-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .edit-title {
            text-align: center;
            color: #ff6600; /* Màu chủ đạo */
            margin-bottom: 30px;
            font-weight: 700;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            text-align: left; /* Căn trái nhãn */
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
            box-sizing: border-box; /* Quan trọng để padding không làm vỡ layout */
        }

        .form-input:focus {
            outline: none;
            border-color: #ff6600;
        }

        /* --- Style cho phần ảnh đại diện --- */
        .image-upload-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
        }

        .image-preview-container {
            width: 150px;
            height: 150px;
            margin-bottom: 15px;
            position: relative;
            border-radius: 50%; /* Làm khung tròn */
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
            overflow: hidden; /* Ẩn phần ảnh thừa ra ngoài khung tròn */
        }

        .edit-image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ảnh lấp đầy khung tròn, cắt bớt phần thừa */
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn-file {
            border: 1px solid #ddd;
            color: #555;
            background-color: #f9f9f9;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-file:hover {
             background-color: #eee;
             color: #ff6600;
        }

        .file-input-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }
        /* ----------------------------------- */

        .btn-update {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: #ff6600;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-update:hover {
            background-color: #e65c00;
        }
        
        .btn-update:active {
             transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="edit-account-container">
        <h3 class="edit-title">Cập Nhật Thông Tin</h3>
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="image-upload-section">
                <div class="image-preview-container">
                    <img src="./user_images/<?php echo htmlspecialchars($current_image); ?>" 
                         alt="Ảnh đại diện" class="edit-image-preview">
                </div>
                <div class="file-input-wrapper">
                    <button class="btn-file">Chọn ảnh mới...</button>
                    <input type="file" name="user_image" onchange="previewImage(this);">
                </div>
            </div>

            <div class="form-group">
                <label for="user_username" class="form-label">Tên đăng nhập</label>
                <input type="text" id="user_username" class="form-input" value="<?php echo htmlspecialchars($username) ?>" name="user_username" required>
            </div>
            
            <div class="form-group">
                <label for="user_email" class="form-label">Email</label>
                <input type="email" id="user_email" class="form-input" value="<?php echo htmlspecialchars($user_email) ?>" name="user_email" required>
            </div>

            <div class="form-group">
                <label for="user_address" class="form-label">Địa chỉ</label>
                <input type="text" id="user_address" class="form-input" value="<?php echo htmlspecialchars($user_address) ?>" name="user_address" required>
            </div>
            
            <div class="form-group">
                <label for="user_mobile" class="form-label">Số điện thoại</label>
                <input type="text" id="user_mobile" class="form-input" value="<?php echo htmlspecialchars($user_mobile) ?>" name="user_mobile" required>
            </div>
            
            <input type="submit" value="Lưu Thay Đổi" class="btn-update" name="user_update">
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('.edit-image-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>