<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();

// Lấy thông tin người dùng đăng nhập
$user_ip = getIPAddress();
$username = $_SESSION['username'];
$get_user = "SELECT * FROM `user_table` WHERE username='$username'";
$result = mysqli_query($con, $get_user);
$run_query = mysqli_fetch_array($result);

$user_id = $run_query['user_id'];
$name = $run_query['username'];
$email = $run_query['user_email'];
$address = $run_query['user_address'];
$phone = $run_query['user_mobile'];

// Xử lý khi bấm nút ĐẶT HÀNG
if (isset($_POST['user_checkout'])) {
    $new_address = $_POST['user_address'];
    $new_mobile = $_POST['user_mobile'];
    $payment_mode = $_POST['payment_mode'];
    $note = $_POST['order_note']; 

    // Bước 1: Cập nhật lại địa chỉ/SĐT mới nhất vào bảng user
    $update_query = "UPDATE `user_table` SET user_address='$new_address', user_mobile='$new_mobile' WHERE user_id=$user_id";
    mysqli_query($con, $update_query);

    // Bước 2: Chuyển hướng sang trang xử lý đơn hàng (order.php)
    echo "<script>window.open('order.php?user_id=$user_id', '_self')</script>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán - SSS STORE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f8f9fa; margin: 0; padding: 20px; }
        .checkout-container { max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 30px; }
        
        /* CỘT TRÁI */
        .col-left { flex: 1.5; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        /* CỘT PHẢI */
        .col-right { flex: 1; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); height: fit-content; border: 1px solid #e0e0e0; }

        h3 { margin-top: 0; margin-bottom: 20px; font-size: 18px; text-transform: uppercase; color: #333; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; color: #555; font-size: 14px; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; outline: none; transition: border-color 0.3s; }
        .form-group input:focus, .form-group textarea:focus { border-color: #9b59b6; }
        .row-input { display: flex; gap: 15px; }
        .row-input .form-group { flex: 1; }

        /* Order Item */
        .order-item { display: flex; align-items: center; margin-bottom: 15px; border-bottom: 1px dashed #eee; padding-bottom: 15px; }
        .order-item img { width: 60px; height: 60px; object-fit: cover; border-radius: 5px; border: 1px solid #eee; margin-right: 15px; }
        .item-info { flex: 1; }
        .item-info h4 { margin: 0; font-size: 14px; color: #333; font-weight: 600; }
        .item-info p { margin: 5px 0 0; font-size: 13px; color: #777; }
        .item-price { font-weight: bold; color: #d35400; font-size: 14px; }

        /* Summary */
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; color: #666; }
        .summary-total { border-top: 2px solid #eee; padding-top: 15px; margin-top: 15px; font-size: 18px; font-weight: bold; color: #333; display: flex; justify-content: space-between; }

        /* Payment */
        .payment-methods { margin-top: 25px; }
        .payment-option { display: flex; align-items: center; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 10px; cursor: pointer; transition: all 0.3s; }
        .payment-option:hover { border-color: #9b59b6; background: #fdfaff; }
        .payment-option input { margin-right: 10px; accent-color: #9b59b6; transform: scale(1.2); }

        .btn-checkout { width: 100%; padding: 15px; background-color: #d35400; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; text-transform: uppercase; margin-top: 20px; transition: background 0.3s; }
        .btn-checkout:hover { background-color: #e67e22; }

        /* QR Code */
        #qr-section { display: none; text-align: center; margin-top: 15px; background: #f8f9fa; padding: 15px; border-radius: 10px; border: 1px solid #eee; }
        #qr-section img { max-width: 200px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 10px; }
        .bank-info p { margin: 5px 0; font-size: 14px; color: #555; }
        .bank-info strong { color: #333; }

        @media (max-width: 768px) { .checkout-container { flex-direction: column; } .row-input { flex-direction: column; gap: 0; } }
    </style>
</head>

<body>
    <h2 style="text-align: center; margin-bottom: 30px; color: #333;">XÁC NHẬN THANH TOÁN</h2>
    <form action="" method="post">
        <div class="checkout-container">
            <div class="col-left">
                <h3><i class="fas fa-map-marker-alt"></i> Thông tin giao hàng</h3>
                <div class="form-group">
                    <label>Họ và tên người nhận</label>
                    <input type="text" name="user_name" value="<?php echo $name ?>" required readonly style="background: #f9f9f9;">
                </div>
                <div class="row-input">
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="user_mobile" value="<?php echo $phone ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="user_email" value="<?php echo $email ?>" required readonly style="background: #f9f9f9;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Địa chỉ giao hàng</label>
                    <input type="text" name="user_address" value="<?php echo $address ?>" required placeholder="Số nhà, đường, phường/xã...">
                </div>
                <div class="form-group">
                    <label>Ghi chú đơn hàng (Tùy chọn)</label>
                    <textarea name="order_note" rows="3" placeholder="Ví dụ: Giao giờ hành chính, gọi trước khi giao..."></textarea>
                </div>
            </div>

            <div class="col-right">
                <h3><i class="fas fa-shopping-bag"></i> Đơn hàng của bạn</h3>
                <div class="order-list">
                    <?php
                    $total_price = 0;
                    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
                    $result_cart = mysqli_query($con, $cart_query);
                    while($row_cart = mysqli_fetch_array($result_cart)){
                        $product_id = $row_cart['product_id'];
                        $quantity = $row_cart['quantity'];
                        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                        $result_products = mysqli_query($con, $select_products);
                        while($row_product = mysqli_fetch_array($result_products)){
                            $product_title = $row_product['product_title'];
                            $product_price = $row_product['product_price'];
                            $product_img = $row_product['product_image1'];
                            $subtotal = $product_price * $quantity;
                            $total_price += $subtotal;
                    ?>
                    <div class="order-item">
                        <img src="../admin_area/product_images/<?php echo $product_img ?>" alt="Product">
                        <div class="item-info">
                            <h4><?php echo $product_title ?></h4>
                            <p>SL: x<?php echo $quantity ?></p>
                        </div>
                        <div class="item-price"><?php echo number_format($subtotal, 0, ',', '.') ?>đ</div>
                    </div>
                    <?php } } ?>
                </div>

                <div class="summary-row"><span>Tạm tính</span><span><?php echo number_format($total_price, 0, ',', '.') ?>đ</span></div>
                <div class="summary-row"><span>Phí vận chuyển</span><span>Miễn phí</span></div>
                <div class="summary-total"><span>Tổng cộng</span><span style="color: #d35400;"><?php echo number_format($total_price, 0, ',', '.') ?>đ</span></div>

                <div class="payment-methods">
                    <h3>Phương thức thanh toán</h3>
                    <label class="payment-option">
                        <input type="radio" name="payment_mode" value="cod" checked onclick="toggleQR(false)">
                        <div><strong>Thanh toán khi nhận hàng (COD)</strong></div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_mode" value="bank" onclick="toggleQR(true)">
                        <div><strong>Chuyển khoản ngân hàng</strong></div>
                    </label>

                    <div id="qr-section">
                        <p style="font-size: 13px; margin-bottom: 10px; font-weight: 500;">Quét mã để thanh toán:</p>
                        
                        <img src="../images/vcb_qr.jpg" alt="QR Vietcombank">
                        
                        <div class="bank-info" style="text-align: left; margin-top: 10px; padding-top: 10px; border-top: 1px dashed #ddd;">
                            <p>Ngân hàng: <strong>TP Bank</strong></p>
                            <p>Số tài khoản: <strong>0945222971</strong></p>
                            <p>Chủ tài khoản: <strong>NGUYEN NGOC LIEU</strong></p>
                            <p>Nội dung: <strong><?php echo $username ?> thanh toan</strong></p>
                        </div>
                    </div>
                </div>

                <button type="submit" name="user_checkout" class="btn-checkout">ĐẶT HÀNG NGAY</button>
                <a href="../cart.php" style="display: block; text-align: center; margin-top: 10px; color: #777; font-size: 13px;">Quay lại giỏ hàng</a>
            </div>
        </div>
    </form>

    <script>
        function toggleQR(show) {
            const qr = document.getElementById('qr-section');
            qr.style.display = show ? 'block' : 'none';
        }
    </script>
</body>
</html>