<h3 class="text-center text-success fw-bold my-4">
    <i class="fa-solid fa-tags"></i> TẤT CẢ THƯƠNG HIỆU
</h3>

<div class="table-responsive">
    <table class="table table-bordered table-hover mt-3 shadow-sm">
        <thead class="bg-info text-center text-white">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên Thương Hiệu</th>
                <th scope="col">Chỉnh Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody class="bg-light text-center align-middle">
            <?php
            $select_brand = "SELECT * FROM `brands`";
            $result = mysqli_query($con, $select_brand);
            $number = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                $brand_id = $row['brand_id'];
                $brand_title = $row['brand_title'];
                $number++;
            ?>
                <tr>
                    <td><?php echo $number; ?></td>
                    <td class="fw-semibold"><?php echo $brand_title; ?></td>
                    <td>
                        <a href='index.php?edit_brands=<?php echo $brand_id ?>' class='text-warning fs-5'>
                            <i class='fa-solid fa-pen-to-square'></i>
                        </a>
                    </td>
                    <td>
                        <a href='index.php?delete_brands=<?php echo $brand_id ?>' class='text-danger fs-5'>
                            <i class='fa-solid fa-trash'></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
