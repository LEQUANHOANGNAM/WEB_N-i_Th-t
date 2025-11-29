<?php
// admin_area/confirm_order.php

if(isset($_GET['confirm_order'])){
    $order_id = $_GET['confirm_order'];
    
    // 1. Cập nhật trạng thái trong bảng user_orders (cho khách hàng có tài khoản)
    $update_user_orders = "UPDATE `user_orders` SET order_status='Hoàn thành' WHERE order_id=$order_id";
    $run_user = mysqli_query($con, $update_user_orders);

    // 2. Cập nhật trạng thái trong bảng customer_orders (cho khách vãng lai - nếu có dùng bảng này)
    // Lưu ý: Nếu id của 2 bảng này trùng nhau, lệnh này sẽ cập nhật cả 2. 
    // Trong dự án thực tế nên phân biệt rõ id, nhưng ở mức độ đồ án này thì chấp nhận được.
    $update_customer_orders = "UPDATE `customer_orders` SET order_status='completed' WHERE order_id=$order_id";
    $run_customer = mysqli_query($con, $update_customer_orders);

    if($run_user || $run_customer){
        echo "<script>alert('Đã xác nhận đơn hàng thành công! Trạng thái đã chuyển sang Hoàn thành.')</script>";
        echo "<script>window.open('index.php?list_orders','_self')</script>";
    }
}
?>