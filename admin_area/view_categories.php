<h3 class="text-center my-4 text-primary fw-bold">
    <i class="fa-solid fa-layer-group"></i> TẤT CẢ MỤC HÀNG
</h3>

<div class="table-responsive">
    <table class="table table-bordered text-center align-middle shadow-sm">
        <thead class="table-info text-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên Mục Hàng</th>
                <th scope="col">Chỉnh Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            $select_cat = "SELECT * FROM `categories`";
            $result = mysqli_query($con, $select_cat);
            $number = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];
                $number++;
            ?>
                <tr>
                    <td class="fw-semibold"><?php echo $number; ?></td>
                    <td class="text-capitalize"><?php echo $category_title; ?></td>
                    <td>
                        <a href='index.php?edit_category=<?php echo $category_id ?>' class='btn btn-sm btn-outline-primary'>
                            <i class='fa-solid fa-pen-to-square'></i> Sửa
                        </a>
                    </td>
                    <td>
                        <a href='index.php?delete_category=<?php echo $category_id ?>' class='btn btn-sm btn-outline-danger' onclick="return confirm('Bạn có chắc muốn xóa mục hàng này không?');">
                            <i class='fa-solid fa-trash'></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
