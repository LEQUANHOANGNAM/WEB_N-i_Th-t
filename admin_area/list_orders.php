<h3 class="text-center text-success fw-bold mb-4">
    <i class="fa-solid fa-box-open me-2"></i> TẤT CẢ ĐƠN HÀNG
</h3>

<div class="table-responsive">
    <table class="table table-hover table-bordered align-middle text-center shadow-sm">
        <thead class="table-info text-dark">
            <tr class="fw-semibold">
                <th>STT</th>
                <th>Đơn Giá</th>
                <th>Số Hóa Đơn</th>
                <th>Tổng Sản Phẩm</th>
                <th>Ngày Đặt</th>
                <th>Trạng Thái</th>
                <th>Duyệt</th> <th>Xóa</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            $get_orders = "
                SELECT order_id, amount_due AS total_price, invoice_number, total_products, order_date, order_status 
                FROM `user_orders`
                UNION
                SELECT order_id, total_price, invoice_number, total_products, order_date, order_status 
                FROM `customer_orders`
                ORDER BY order_date DESC
            ";
            $result = mysqli_query($con, $get_orders);
            $row_count = mysqli_num_rows($result);

            if ($row_count == 0) {
                echo "<tr><td colspan='8' class='text-danger text-center fw-semibold py-5'>Chưa có đơn hàng</td></tr>";
            } else {
                $number = 0;
                while ($row_data = mysqli_fetch_assoc($result)) {
                    $order_id = $row_data['order_id'];
                    $total_price = number_format($row_data['total_price'], 0, ',', '.') . ' ₫';
                    $invoice_number = $row_data['invoice_number'];
                    $total_products = $row_data['total_products'];
                    $order_date = date("d/m/Y", strtotime($row_data['order_date']));
                    $order_status_raw = $row_data['order_status']; // Lấy trạng thái gốc
                    
                    // Xử lý hiển thị trạng thái
                    if($order_status_raw == 'pending' || $order_status_raw == 'Pending'){
                        $order_status_display = '<span class="badge bg-warning text-dark">Chờ xử lý</span>';
                    } else {
                        $order_status_display = '<span class="badge bg-success">Hoàn thành</span>';
                    }

                    $number++;

                    echo "
                    <tr>
                        <td>$number</td>
                        <td class='text-primary fw-bold'>$total_price</td>
                        <td>$invoice_number</td>
                        <td>$total_products</td>
                        <td><i class='fa-regular fa-calendar'></i> $order_date</td>
                        <td>$order_status_display</td>
                        
                        <td>
                            <a href='index.php?confirm_order=$order_id' class='btn btn-sm btn-success' 
                               onclick=\"return confirm('Xác nhận đơn hàng này đã hoàn thành/đã giao?')\">
                                <i class='fa-solid fa-check'></i>
                            </a>
                        </td>

                        <td>
                            <a href='index.php?delete_orders=$order_id' class='btn btn-sm btn-danger' 
                               onclick=\"return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')\">
                                <i class='fa-solid fa-trash'></i>
                            </a>
                        </td>
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>