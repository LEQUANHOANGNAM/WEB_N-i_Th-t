<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thành Công</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .success-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
            animation: slideUp 0.5s ease-out;
        }
        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .icon-box {
            width: 100px;
            height: 100px;
            background: #d4edda;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px;
        }
        .icon-box i {
            font-size: 50px;
            color: #28a745;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 24px;
        }
        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .btn {
            padding: 15px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: block;
        }
        .btn-primary {
            background-color: #9b59b6;
            color: white;
        }
        .btn-primary:hover {
            background-color: #8e44ad;
            box-shadow: 0 5px 15px rgba(142, 68, 173, 0.4);
        }
        .btn-secondary {
            background-color: #f0f0f0;
            color: #555;
        }
        .btn-secondary:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>

    <div class="success-card">
        <div class="icon-box">
            <i class="fas fa-check"></i>
        </div>
        <h2>Đặt Hàng Thành Công!</h2>
        <p>Cảm ơn bạn đã mua sắm tại SSS STORE. Đơn hàng của bạn đã được hệ thống ghi nhận và đang chờ xử lý.</p>
        
        <div class="btn-group">
            <a href="profile.php?my_orders" class="btn btn-primary">
                <i class="fas fa-file-invoice"></i> Xem Đơn Hàng Chờ Xử Lý
            </a>
            
            <a href="../index.php" class="btn btn-secondary">
                Tiếp Tục Mua Sắm
            </a>
        </div>
    </div>

</body>
</html>