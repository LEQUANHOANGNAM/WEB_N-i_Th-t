<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của tôi</title>
</head>
<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * from `user_table` where username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];
    ?>
    
    <h3 class="text-success mb-4">Lịch sử đơn hàng</h3>
    
    <table class="table table-bordered mt-5 text-center">
        <thead class="bg-info text-light">
            <tr>
                <th>STT</th>
                <th>Giá trị đơn</th>
                <th>Số lượng SP</th>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tình trạng</th>
            </tr>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $get_order_details = "SELECT * from `user_orders` where user_id=$user_id ORDER BY order_id DESC";
            $result_orders = mysqli_query($con, $get_order_details);
            $number = 1;
            
            while($row_orders = mysqli_fetch_assoc($result_orders)){
                $order_id = $row_orders['order_id'];
                $amount_due = $row_orders['amount_due'];
                $total_products = $row_orders['total_products'];
                $invoice_number = $row_orders['invoice_number'];
                $order_status = $row_orders['order_status'];
                $order_date = date("d/m/Y", strtotime($row_orders['order_date']));
                $amount_due_format = number_format($amount_due, 0, ',', '.');
                
                if($order_status == 'pending'){
                    $order_status_display = 'Đang xử lý';
                    // Trạng thái chờ: Màu vàng cảnh báo
                    $action_display = "<span class='badge bg-warning text-dark'>Chờ duyệt</span>"; 
                } else {
                    $order_status_display = 'Hoàn thành';
                    // Trạng thái xong: Màu xanh lá nổi bật (SỬA Ở ĐÂY)
                    $action_display = "<span class='badge bg-success p-2'><i class='fa fa-check-circle'></i> Đã giao hàng</span>";
                }

                echo "
                <tr>
                    <td>$number</td>
                    <td>$amount_due_format đ</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>
                    <td>$order_status_display</td>
                    <td>$action_display</td>
                </tr>";
                
                $number++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>