<?php
include_once __DIR__ . '/../includes/connect.php';

// ================== SẢN PHẨM ==================
function get_all_products($limit = 0)
{
  global $con;
  $sql = "SELECT * FROM products WHERE status='true'";
  if ($limit > 0) {
    $sql .= " ORDER BY RAND() LIMIT $limit";
  } else {
    $sql .= " ORDER BY RAND()";
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

function get_unique_categories()
{
  global $con;
  $cat_id = $_GET['category'];
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
    $prod_id = $_GET['add_to_cart'];

    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
    $check = mysqli_query($con, "SELECT * FROM cart_details WHERE ip_address='$ip' AND product_id=$prod_id");
    if (mysqli_num_rows($check) > 0) {
      // Nếu có rồi, cộng thêm 1 vào quantity
      mysqli_query($con, "UPDATE cart_details SET quantity = quantity + 1 WHERE ip_address='$ip' AND product_id=$prod_id");
    } else {
      // Nếu chưa có, thêm mới
      mysqli_query($con, "INSERT INTO cart_details(product_id, ip_address, quantity) VALUES($prod_id,'$ip',1)");
    }

    // Reload lại trang hiện tại
    header("Location: " . $_SERVER['PHP_SELF']);
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
