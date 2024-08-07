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
            // *Bắt đầu chức năng Khách hàng
        case 'dskh':
            $list_dskh = loadall_dskh();
            require './modules/khachhang/danhsach.php';
            break;

        case 'suakh':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $users = loadone_khachhang($_GET['id']);
            }
            include('./modules/khachhang/sua.php');
            break;

        case 'capnhatds':
            if (isset($_POST['updateds']) && ($_POST['updateds'])) {
                // Retrieve form data
                $id = $_POST['id'];
                $name = $_POST['ten'];
                $email = $_POST['email'];
                $phone = $_POST['sdt'];
                $address = $_POST['dia_chi'];
                $check = 1;
                $phonePattern = '/^(84|0[35789])+([0-9]{8})\b$/';

                update_dskh($id, $name, $email, $phone, $address);
                echo '<script>
                        alert("Cập nhật thành công!");
                        setTimeout(function() {
                            window.location.href = "index.php?act=dskh&page=1";
                        }, 0); // Đợi 0 giây (1 giây = 1000 milliseconds)
                     </script>';
            }
            break;

            // *Bắt đầu chức năng danh mục
        case 'dsdm':
            $listdanhmuc = loadall_danhmuc();
            require './modules/danhmuc/danhsach.php';
            break;
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
            require './modules/danhmuc/them.php';
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

            $listmonan = loadall_sanpham();
            $listdanhmuc = loadall_danhmuc();
            include('./modules/sanpham/danhsach.php');
            break;

            // *Bắt đầu chức năng đơn hàng
        case 'dsdh':
            if (isset($_POST['listcheck']) && ($_POST['listcheck'])) {
                $keyw = $_POST['keyw'];
                $category_id = $_POST['category_id'];
            } else {
                $keyw = '';
                $danh_muc_id = 0;
            }

            $listdsdh = loadall_dskh($keyw, $category_id);
            $listdanhmuc = loadall_danhmuc();
            require './modules/donhang/danhsach.php';
            break;
    }
}

include './view/footer.php';
