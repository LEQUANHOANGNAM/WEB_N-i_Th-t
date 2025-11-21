<h3 class="text-center text-success fw-bold my-4">
    <i class="fa-solid fa-money-bill-wave"></i> TẤT CẢ THANH TOÁN
</h3>

<?php
$get_payments = "
    SELECT payment_id, order_id, amount, invoice_number, payment_mode, date 
    FROM `user_payments`
    UNION
    SELECT order_id AS payment_id, order_id, total_price AS amount, invoice_number, 'Tiền mặt' AS payment_mode, order_date AS date 
    FROM `customer_orders`
    ORDER BY date DESC
";
$result = mysqli_query($con, $get_payments);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    echo "<h4 class='text-danger text-center mt-5'>Chưa nhận thanh toán nào</h4>";
} else {
    echo "
    <div class='table-responsive'>
        <table class='table table-bordered table-hover mt-3 shadow-sm'>
            <thead class='bg-info text-white text-center'>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Số Hóa Đơn</th>
                    <th scope='col'>Đơn Giá</th>
                    <th scope='col'>Hình Thức Thanh Toán</th>
                    <th scope='col'>Ngày Đặt</th>
                    <th scope='col'>Xóa</th>
                </tr>
            </thead>
            <tbody class='bg-light text-center align-middle'>
    ";
    $number = 0;
    while ($row_data = mysqli_fetch_assoc($result)) {
        $payment_id = $row_data['payment_id'];
        $invoice_number = $row_data['invoice_number'];
        $amount = number_format($row_data['amount'], 0, ',', '.') . "₫";
        $payment_mode = $row_data['payment_mode'];
        $date = date('d/m/Y', strtotime($row_data['date']));
        $number++;

        echo "
            <tr>
                <td>$number</td>
                <td class='fw-semibold'>$invoice_number</td>
                <td class='text-success fw-bold'>$amount</td>
                <td>$payment_mode</td>
                <td>$date</td>
                <td>
                    <a href='index.php?delete_payments=$payment_id' class='text-danger fs-5'>
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>
        ";
    }
    echo "</tbody></table></div>";
}
?>
