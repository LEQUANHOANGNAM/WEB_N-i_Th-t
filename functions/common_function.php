<?php
include_once __DIR__ . '/../includes/connect.php';

// ================== SẢN PHẨM ==================
function get_all_products($limit = 0)
{
  global $con;
  // Nếu muốn random chỉ khi có limit (ví dụ show featured)
  if ($limit > 0) {
    $sql = "SELECT * FROM products WHERE status='true' ORDER BY RAND() LIMIT $limit";
  } else {
    // Thứ tự ổn định (mới nhất trước)
    $sql = "SELECT * FROM products WHERE status='true' ORDER BY product_id DESC";
  }

  $res = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['product_id'];
    $title = $row['product_title'];
    $desc = $row['product_description'];
    $img = $row['product_image1'];
    $price = number_format($row['product_price'], 0, ',', '.');
    echo "
        <div class='box'>
            <img src='./admin_area/product_images/$img' alt='".htmlspecialchars($title, ENT_QUOTES)."'/>
            <div class='box-content'>
                <h3>".htmlspecialchars($title, ENT_QUOTES)."</h3>
                <p>$price ₫</p>
                <div style='display:flex;gap:10px;'>
                    <a href='display_all.php?add_to_cart=$id' class='btn-cart'>Thêm vào giỏ hàng</a>
                    <a href='product_details.php?product_id=$id' class='btn-detail'>Xem chi tiết</a>
                </div>
            </div>
        </div>";
  }
}


function get_unique_categories()
{
  global $con;
  $cat_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
  if ($cat_id <= 0) {
    echo "<h2>Danh mục không hợp lệ</h2>";
    return;
  }
  $res = mysqli_query($con, "SELECT * FROM products WHERE category_id=$cat_id AND status='true'");
  if (mysqli_num_rows($res) == 0) {
    echo "<h2>Danh mục trống</h2>";
  }
  while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['product_id'];
    $title = $row['product_title'];
    $desc = $row['product_description'];
    $img = $row['product_image1'];
    $price = number_format($row['product_price'], 0, ',', '.');
    echo "
        <div class='box'>
            <img src='./admin_area/product_images/$img' alt='$title'/>
            <div class='box-content'>
                <h3>$title</h3>
                <p>$price ₫</p>
                <div style='display:flex;gap:10px;'>
                    <a href='display_all.php?add_to_cart=$id&category=$cat_id' class='btn-cart'>Thêm vào giỏ hàng</a>
                    <a href='product_details.php?product_id=$id' class='btn-detail'>Xem chi tiết</a>
                </div>
            </div>
        </div>";
  }
}

function get_unique_brands()
{
  global $con;
  $brand_id = $_GET['brand'];
  $res = mysqli_query($con, "SELECT * FROM products WHERE brand_id=$brand_id AND status='true'");
  if (mysqli_num_rows($res) == 0) {
    echo "<h2>Thương hiệu trống</h2>";
  }
  while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['product_id'];
    $title = $row['product_title'];
    $desc = $row['product_description'];
    $img = $row['product_image1'];
    $price = number_format($row['product_price'], 0, ',', '.');
    echo "
        <div class='box'>
            <img src='./admin_area/product_images/$img' alt='$title'/>
            <div class='box-content'>
                <h3>$title</h3>
                <p>$price ₫</p>
                <div style='display:flex;gap:10px;'>
                    <a href='display_all.php?add_to_cart=$id&brand=$brand_id' class='btn-cart'>Thêm vào giỏ hàng</a>
                    <a href='product_details.php?product_id=$id' class='btn-detail'>Xem chi tiết</a>
                </div>
            </div>
        </div>";
  }
}

// ================== DANH MỤC – THƯƠNG HIỆU ==================
function getcategories()
{
  global $con;
  $res = mysqli_query($con, "SELECT * FROM categories");
  while ($row = mysqli_fetch_assoc($res)) {
    echo "<li><a href='display_all.php?category=" . $row['category_id'] . "'>" . $row['category_title'] . "</a></li>";
  }
}

function getbrands()
{
  global $con;
  $res = mysqli_query($con, "SELECT * FROM brands");
  while ($row = mysqli_fetch_assoc($res)) {
    echo "<li><a href='display_all.php?brand=" . $row['brand_id'] . "'>" . $row['brand_title'] . "</a></li>";
  }
}

// ================== CART ==================
function getIPAddress()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $ip = getIPAddress();
    $prod_id = (int)$_GET['add_to_cart']; // cast int để an toàn

    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
    $check = mysqli_query($con, "SELECT * FROM cart_details WHERE ip_address='".mysqli_real_escape_string($con,$ip)."' AND product_id=$prod_id");
    if (mysqli_num_rows($check) > 0) {
      // Nếu có rồi, cộng thêm 1 vào quantity
      mysqli_query($con, "UPDATE cart_details SET quantity = quantity + 1 WHERE ip_address='".mysqli_real_escape_string($con,$ip)."' AND product_id=$prod_id");
    } else {
      // Nếu chưa có, thêm mới
      mysqli_query($con, "INSERT INTO cart_details(product_id, ip_address, quantity) VALUES($prod_id,'".mysqli_real_escape_string($con,$ip)."',1)");
    }

    // Redirect về trang hiện tại — giữ nguyên query string (nếu có)
    $redirect_to = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'display_all.php');
    // Nếu REQUEST_URI chứa add_to_cart param, ta xóa param add_to_cart để tránh loop
    $url_parts = parse_url($redirect_to);
    $qs = '';
    if (isset($url_parts['query'])) {
      parse_str($url_parts['query'], $query_array);
      // loại bỏ add_to_cart nếu còn
      unset($query_array['add_to_cart']);
      $qs = http_build_query($query_array);
    }
    $base = isset($url_parts['path']) ? $url_parts['path'] : 'display_all.php';
    $final = $base . ($qs !== '' ? "?$qs" : '');
    header("Location: $final");
    exit();
  }
}



function cart_item()
{
  global $con;
  $ip = getIPAddress();
  $res = mysqli_query($con, "SELECT * FROM cart_details WHERE ip_address='$ip'");
  $total_items = 0;
  while ($row = mysqli_fetch_assoc($res)) {
    $total_items += $row['quantity'];
  }
  echo $total_items;
}


function total_cart_price()
{
  global $con;
  $ip = getIPAddress();
  $total = 0;
  $res = mysqli_query($con, "SELECT * FROM cart_details WHERE ip_address='$ip'");
  while ($row = mysqli_fetch_assoc($res)) {
    $prod_id = $row['product_id'];
    $qty = $row['quantity'];
    $price_row = mysqli_fetch_assoc(mysqli_query($con, "SELECT product_price FROM products WHERE product_id=$prod_id"));
    $total += $price_row['product_price'] * $qty;
  }
  echo number_format($total, 0, ',', '.');
}


// ================== SEARCH ==================
function search_product()
{
  global $con;
  if (isset($_GET['search_data_product'])) {
    $value = $_GET['search_data'];
    $res = mysqli_query($con, "SELECT * FROM products WHERE product_keywords LIKE '%$value%' AND status='true'");
    if (mysqli_num_rows($res) == 0) {
      echo "<h2>Không tìm thấy kết quả</h2>";
    }
    while ($row = mysqli_fetch_assoc($res)) {
      $id = $row['product_id'];
      $title = $row['product_title'];
      $desc = $row['product_description'];
      $img = $row['product_image1'];
      $price = number_format($row['product_price'], 0, ',', '.');
      echo "
            <div class='box'>
                <img src='./admin_area/product_images/$img' alt='$title'/>
                <div class='box-content'>
                    <h3>$title</h3>
                    <p>$price ₫</p>
                    <div style='display:flex;gap:10px;'>
                        <a href='display_all.php?add_to_cart=$id' class='btn-cart'>Thêm vào giỏ hàng</a>
                        <a href='product_details.php?product_id=$id' class='btn-detail'>Xem chi tiết</a>
                    </div>
                </div>
            </div>";
    }
  }
}


function view_details()
{
  global $con;
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $res = mysqli_query($con, "SELECT * FROM products WHERE product_id=$product_id AND status='true'");
    if (mysqli_num_rows($res) > 0) {
      $row = mysqli_fetch_assoc($res);
      $title = $row['product_title'];
      $desc = $row['product_description'];
      $img = $row['product_image1'];
      $price = number_format($row['product_price'], 0, ',', '.');

      echo "
        <div class='box-detail'>
            <img src='./admin_area/product_images/$img' alt='$title'/>
            <div class='box-detail-content'>
                <h3>$title</h3>
                <p>$desc</p>
                <p>$price ₫</p>
                <a href='display_all.php?add_to_cart=$product_id' class='btn-cart'>Thêm vào giỏ hàng</a>
            </div>
        </div>";
    } else {
      echo "<h2>Sản phẩm không tồn tại</h2>";
    }
  }
}
