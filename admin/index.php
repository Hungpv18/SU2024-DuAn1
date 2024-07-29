<?php
session_start();
ob_start();

include '../dao/pdo.php';
include '../dao/danhmuc.php';
include '../dao/khachhang.php';
include '../dao/sanpham.php';

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
                $khachhang = loadone_khachhang($_GET['id']);
            }
            include('./modules/khachhang/sua.php');
            break;

            // *Bắt đầu chức năng danh mục
        case 'dsdm':
            $listdanhmuc = loadall_danhmuc();
            require './modules/danhmuc/danhsach.php';
            break;
        case 'themdm':
            require './modules/danhmuc/them.php';
            break;
        case 'xoadm':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            }
            include('./modules/danhmuc/danhsach.php');
            break;
        case 'suadm';
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            }
            include('./modules/danhmuc/sua.php');
            break;
        case 'capnhatdm':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $tenDanhMuc = $_POST['tenDanhMuc'];
                $id = $_POST['id'];
                echo '<script>alert("Cập nhật thành công")</script>';
            }
            header('location: index.php?act=dsdm&page=1');
            include('./modules/danhmuc/danhsach.php');
            break;
            // *Bắt đầu chức năng sản phẩm
        case 'dssp':
            if (isset($_POST['listcheck']) && ($_POST['listcheck'])) {
                $keyw = $_POST['keyw'];
                $category_id  = $_POST['danh_muc_id'];
            } else {
                $keyw = '';
                $category_id  = 0;
            }

            $listsanpham = loadall_sanpham($keyw, $category_id );
            $listdanhmuc = loadall_danhmuc();
            require './modules/sanpham/danhsach.php';
            break;
            // *Bắt đầu chức năng đơn hàng
        case 'dsdh':
            require './modules/donhang/danhsach.php';
            break;
    }
}

include './view/footer.php';
