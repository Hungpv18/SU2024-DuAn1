<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
    ob_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="public/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.ico">

    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/templatemo.css">
    <link rel="stylesheet" href="./public/css/custom.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="./public/css/fontawesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include './dao/product.php';



    $action = "home";
    if (isset($_GET['act']))
        $action = $_GET['act'];

    switch ($action) {
        case "home":
            include './client/index.php';
            break;
        case "shop":
            include './client/shop.php';
            break;
        case "shop-single";
            include './client/shop-single.php';
            break;
        case "contact";
            include './client/contact.php';
            break;
        case "about";
            include './client/about.php';
            break;
        case "search":
            include './client/search.php';
            break;
        case "cart";
            include './client/cart.php';
            break;
        case "add_to_cart":
            // Xử lý việc thêm sản phẩm vào giỏ hàng
            if (isset($_GET['id'])) {
                $product_id = intval($_GET['id']);
                $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

                // Lấy thông tin sản phẩm từ cơ sở dữ liệu
                $product = getProductBy($product_id);

                if ($product) {
                    // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                    if (isset($_SESSION['cart'][$product_id])) {
                        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
                    } else {
                        // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
                        $_SESSION['cart'][$product_id] = [
                            'name' => $product['name'],
                            'price' => $product['price'],
                            'quantity' => $quantity,
                            'image' => $product['image']
                        ];
                    }
                }
                // Chuyển hướng về trang giỏ hàng sau khi thêm
                header('Location: index.php?act=cart');
                exit();
            }
            break;

            case "remove_from_cart":
                // Kiểm tra xem có ID sản phẩm để xóa hay không
                if (isset($_GET['id'])) {
                    $product_id = intval($_GET['id']);
                    
                    // Nếu sản phẩm tồn tại trong giỏ hàng, tiến hành xóa
                    if (isset($_SESSION['cart'][$product_id])) {
                        unset($_SESSION['cart'][$product_id]);
                    }
                    
                    // Chuyển hướng người dùng về trang giỏ hàng sau khi xóa
                    header('Location: index.php?act=cart');
                    exit();
                }
                break;


        case "sigin":
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                // Băm mật khẩu trước khi lưu
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                // Kết nối cơ sở dữ liệu và thực hiện truy vấn
                $sql = "INSERT INTO users (username, password, address, phone, email) VALUES (:username, :password, :address, :phone, :email)";
                pdo_query1($sql, [
                    'username' => $username,
                    'password' => $hashed_password,
                    'address' => $address,
                    'phone' => $phone,
                    'email' => $email
                ]);
                // Chuyển hướng về trang đăng nhập sau khi đăng ký thành công
                header('Location: index.php?act=login');
                exit();
            }

            include './client/sigin.php';
            break;


        case "login":
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Hàm để xác thực người dùng với cơ sở dữ liệu
                $user = getuser($username, $password);
                if ($user) {
                    $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session
                    header('Location: index.php?act=home');
                    exit();
                } else {
                    echo "<p>Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại.</p>";
                }
            }

            if (isset($_SESSION['user'])) {
                include './client/account.php';
                include './client/updateuser.php';
                // 

            } else {
                include './client/login.php';
            }
            break;


        case "logout";
            // Xóa tất cả các biến phiên
            $_SESSION = [];
            // Nếu sử dụng cookie để lưu phiên, xóa cookie
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
            // Hủy phiên
            session_destroy();
            header('Location: index.php?act=home');
            exit();
            break;



        case "updateuser";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $user_id = $_SESSION['user']['id'];

                // Cập nhật thông tin người dùng
                $sql = "UPDATE users SET address = :address, phone = :phone, email = :email WHERE id = :id";
                $stmt = pdo_query1($sql, [
                    'address' => $address,
                    'phone' => $phone,
                    'email' => $email,
                    'id' => $user_id
                ]);

                // Cập nhật session
                $_SESSION['user']['address'] = $address;
                $_SESSION['user']['phone'] = $phone;
                $_SESSION['user']['email'] = $email;

                echo "<p>Cập nhật thông tin thành công!</p>";
                header('Location: index.php?act=home');
                exit();
            }
            break;
    }



    ?>



    <script src="./public/js/jquery-1.11.0.min.js"></script>
    <script src="./public/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/templatemo.js"></script>
    <script src="./public/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>