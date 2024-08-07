<?php
if (is_array($khachhang)) {
    extract($khachhang);
}
var_dump($khachhang);
?>

<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">SỬA THÔNG TIN KHÁCH HÀNG</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="index.php?act=dskh">Dashboard</a>
                </li>
                <a href="index.php?act=dskh" class="breadcrumb-item">QUẢN LÝ KHÁCH HÀNG</a>
                <li class="breadcrumb-item active">SỬA THÔNG TIN KHÁCH HÀNG</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    SỬA DANH MỤC
                </div>
                <form class="row g-3" action="index.php?act=capnhatds" method="post" enctype="multipart/form-data">

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="mb-2">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?=$users['name']?>">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?=$users['email']?>">
                            </div>
                            <div class="mb-2">
                                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?=$users['phone']?>">
                                <div class="thongbao">
                                    <?php echo (isset($_SESSION['error']['phone'])) ? $_SESSION['error']['phone'] : '' ?>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="<?=$users['address']?>">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer mb-12" style="float:right;">
                        <input type="hidden" name="id" value="<?=$users['id']?>">
                        <input type="submit" class="btn btn-info me-lg-2 float-end" name="updateds"
                            value="Lưu thay đổi">
                        <input type="reset" class="btn btn-warning me-2 float-end" value="Nhập lại">
                    </div>
                </form>

            </div>
        </div>
    </main>
</div>