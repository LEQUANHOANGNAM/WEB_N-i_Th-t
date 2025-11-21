<h3 class="text-center text-success fw-bold my-4">
    <i class="fa-solid fa-users"></i> TẤT CẢ USER
</h3>

<?php
$get_users = "SELECT * FROM `user_table`";
$result = mysqli_query($con, $get_users);
$row_count = mysqli_num_rows($result);

if ($row_count == 0) {
    echo "<h4 class='text-danger text-center mt-5'>Chưa có user nào</h4>";
} else {
    echo "
    <div class='table-responsive'>
        <table class='table table-bordered table-hover mt-3 shadow-sm'>
            <thead class='bg-info text-white text-center'>
                <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Tên User</th>
                    <th scope='col'>Email</th>
                    <th scope='col'>Ảnh</th>
                    <th scope='col'>Địa Chỉ</th>
                    <th scope='col'>Điện Thoại</th>
                </tr>
            </thead>
            <tbody class='bg-light text-center align-middle'>
    ";
    $number = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_address = $row['user_address'];
        $user_mobile = $row['user_mobile'];
        $number++;

        echo "
            <tr>
                <td>$number</td>
                <td class='fw-semibold'>$username</td>
                <td>$user_email</td>
                <td>
                    <img src='../users_area/user_images/$user_image' alt='$username' 
                         class='rounded-circle' style='width: 60px; height: 60px; object-fit: cover;'>
                </td>
                <td>$user_address</td>
                <td>$user_mobile</td>
            </tr>
        ";
    }
    echo "</tbody></table></div>";
}
?>
