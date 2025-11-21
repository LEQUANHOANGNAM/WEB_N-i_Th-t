<?php
session_start();
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thành Công - SSS STORE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .success-card {
            background: white;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            text-align: center;
            max-width: 480px;
            width: 90%;
            animation: popIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes popIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .icon-container {
            width: 100px;
            height: 100px;
            background-color: #e8f5e9;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px;
        }
        .icon-container i {
            color: #2e7d32;
            font-size: 48px;
        }
        h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 26px;
        }
        p {
            color: #666;
            margin-bottom: 35px;
            line-height: 1.6;
        }
        .btn-action {
            display: block;
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #ff6600;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e65c00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 102, 0, 0.3);
        }
        .btn-secondary {
            background-color: #f8f9fa;
            color: #555;
            border: 1px solid #ddd;
        }
        .btn-secondary:hover {
            background-color: #e9ecef;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="success-card">
        <div class="icon-container">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2>Đặt Hàng Thành Công!</h2>
        <p>Cảm ơn bạn đã tin tưởng SSS STORE. Đơn hàng của bạn đã được hệ thống ghi nhận và sẽ sớm được xử lý.</p>
        
        <a href="profile.php?my_orders" class="btn-action btn-primary">
            <i class="fas fa-file-invoice-dollar"></i> Xem Đơn Hàng Chờ Xử Lý
        </a>
        
        <a href="../display_all.php" class="btn-action btn-secondary">
            <i class="fas fa-arrow-left"></i> Tiếp Tục Mua Sắm
        </a>
    </div>

</body>
</html> 