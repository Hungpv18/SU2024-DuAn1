<?php
session_start();
ob_start();

include '../dao/pdo.php';
include '../dao/danhmuc.php';
include '../dao/khachhang.php';
include '../dao/sanpham.php';
include '../dao/donhang.php';

// Giao diện
include 'view/header.php';
include 'view/navbar.php';

$previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {

        case 'dashboard':
            include './modules/dashboard.php';
            break;

            // *Bắt đầu chức năng Khách hàng
        case 'dskh':
            $list_dskh = loadall_dskh();
            include './modules/khachhang/danhsach.php';
            break;

        case 'suakh':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $khachhang = loadone_khachhang($_GET['id']);
            }
            include('./modules/khachhang/sua.php');
            break;

        case 'capnhatkh':
            if (isset($_POST['updatekh']) && ($_POST['updatekh'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                echo '<script>alert("Cập nhật thành công")</script>';
                update_dskh($id, $name, $email, $phone, $address);
                $list_dskh = loadall_dskh();
                header('Location: index.php?act=dskh&page=1');
                exit();
            }
            break;


            // *Bắt đầu chức năng danh mục
        case 'themdm':
            if (isset($_POST['them']) && ($_POST['them'])) {
                $name = $_POST['name'];
                $check = 1;
                if ($name == "") {
                    $_SESSION['error']['name']['invalid'] = 'Không được để trống';
                    $check = 0;
                }

                if (strlen($name) < 3) {
                    $_SESSION['error']['name']['numbers_word'] = 'Phải có ít nhất 3 ký tự';
                    $check = 0;
                }

                if ($check == 1) {
                    insert_danhmuc($name);
                    echo '<script>alert("Thêm thành công!")</script>';
                }
            }
            include './modules/danhmuc/them.php';
            break;
        case 'dsdm':
            $listdanhmuc = loadall_danhmuc();
            include './modules/danhmuc/danhsach.php';
            break;
        case 'xoadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_danhmuc($_GET['id']);
            }
            $listdanhmuc = loadall_danhmuc();
            include('./modules/danhmuc/danhsach.php');
            break;
        case 'suadm';
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $danhMuc = loadone_danhmuc($_GET['id']);
            }
            include('./modules/danhmuc/sua.php');
            break;
        case 'capnhatdm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $name = $_POST['name'];
                $id = $_POST['id'];
                update_danhmuc($id, $name);
                echo '<script>alert("Cập nhật thành công")</script>';
            }
            $listdanhmuc = loadall_danhmuc();
            header('location: index.php?act=dsdm&page=1');
            break;

            // *Bắt đầu chức năng sản phâm
        case 'dssp':
            if (isset($_POST['listcheck']) && ($_POST['listcheck'])) {
                $keyw = $_POST['keyw'];
                $category_id  = $_POST['category_id'];
            } else {
                $keyw = '';
                $category_id  = 0;
            }

            $listsanpham = loadall_sanpham($keyw, $category_id);
            $listdanhmuc = loadall_danhmuc();
            require './modules/sanpham/danhsach.php';
            break;

        case 'themsp':
            if (isset($_POST['them']) && ($_POST['them'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $sale_price = $_POST['sale_price'];
                $desc_c = $_POST['desc_c'];
                $category_id = $_POST['category_id'];
                $image = $_FILES['image']['name'];
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($image);
                $max_size = 5242880;
                $uploadOk = 1;


                // Kiểm tra các giá trị trống
                if ($name == "") {
                    $_SESSION['error']['name'] = 'Không được để trống';
                    $uploadOk = 0;
                } else {
                    unset($_SESSION['error']['name']);
                }

                if ($price == "" || $price < 0) {
                    $_SESSION['error']['price'] = 'Không được để trống hoặc giá trị âm';
                    $uploadOk = 0;
                } else {
                    unset($_SESSION['error']['price']);
                }

                if ($sale_price == $price || $price < 0) {
                    $_SESSION['error']['sale_price'] = 'Không được trùng với giá niêm yết hoặc giá trị âm';
                    $uploadOk = 0;
                } else {
                    unset($_SESSION['error']['sale_price']);
                }

                if (empty($image)) {
                    $_SESSION['error']['image']['required'] = 'Ảnh không được trống';
                    $uploadOk = 0;
                }

                // Kiểm tra định dạng file
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" && $imageFileType != "dng" && $imageFileType != "webp"
                ) {
                    $_SESSION['error']['image']['incorrect'] = 'Định dạng ảnh không phù hợp';
                    $uploadOk = 0;
                }

                // Kiểm tra dung lượng file
                if ($_FILES['image']['size'] > $max_size) { // kiểm tra 1MB = 1048576 Bytes
                    $_SESSION['error']['image']['maxSize'] = 'Hình không vượt quá 1MB';
                    $uploadOk = 0;
                }


                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        insert_sanpham($name, $price, $sale_price, $image, $desc_c, $category_id);
                        echo '<script>alert("Sản phẩm đã được thêm")</script>';
                    }
                }
            }
            $listdanhmuc = loadall_danhmuc();
            include('./modules/sanpham/them.php');
            break;

        case 'xoasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                delete_sanpham($_GET['id']);
                header("Location: $previousPage");
            }
            $listmonan = loadall_sanpham();

            include('./modules/sanpham/danhsach.php');
            break;

        case 'suasp':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $sanpham = loadone_sanpham($_GET['id']);
            }
            $listsanpham = loadall_sanpham();
            $listdanhmuc = loadall_danhmuc();
            include('./modules/sanpham/sua.php');
            break;

        case 'updatesp':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $id = $_POST['id'];
                $category_id = $_POST['category_id'];

                $name = $_POST['name'];
                $price = $_POST['price'];
                $sale_price = $_POST['sale_price'];
                $desc_c = $_POST['desc_c'];
                $image = $_FILES['image']['name'];
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($image);
                $max_size = 5242880;
                $uploadOk = 1;

                if ($price < 0) {
                    $_SESSION['error']['price'] = 'Không được để giá trị âm';
                    $uploadOk = 0;
                } else {
                    unset($_SESSION['error']['giasp']);
                }

                if ($sale_price == $price || $price < 0) {
                    $_SESSION['error']['sale_price'] = 'Không được trùng với giá niêm yết hoặc giá trị âm';
                    $uploadOk = 0;
                } else {
                    unset($_SESSION['error']['sale_price']);
                }


                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                }
                if ($uploadOk == 1) {
                    update_sanpham($id, $category_id, $name, $price, $sale_price, $desc_c, $image);
                    echo '<script>alert("Cập nhật thành công")</script>';
                }
            }

            $listsanpham = loadall_sanpham();
            $listdanhmuc = loadall_danhmuc();
            include('./modules/sanpham/danhsach.php');
            break;

            // Đơn hàng
            // case 'dsdh':
            //     if (isset($_POST['listcheck']) && ($_POST['listcheck'])) {
            //         $keyw = $_POST['keyw'];
            //         $user_id  = $_POST['category_id'];
            //     } else {
            //         $keyw = '';
            //         $user_id  = 0;
            //     }
    
            //     $listdonhang = loadall_donhang($keyw, $user_id);
            //     require './modules/donhang/danhsach.php';
            //     break;
    }
}

include 'view/footer.php';
