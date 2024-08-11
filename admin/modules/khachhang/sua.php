<?php
if (is_array($khachhang)) {
    extract($khachhang);
}
?>

<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">SỬA THÔNG TIN KHÁCH HÀNG</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="index.php?act=dskh">Dashboard</a>
                </li>
                <a href="index.php?act=dskh&page=1" class="breadcrumb-item">QUẢN LÝ KHÁCH HÀNG</a>
                <li class="breadcrumb-item active">SỬA THÔNG TIN KHÁCH HÀNG</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    SỬA KHÁCH HÀNG
                </div>
                <form class="row g-3 p-4" action="index.php?act=capnhatkh" method="post" enctype="multipart/form-data">

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="nameInput" name="name" value="<?php if (isset($name) && ($name != "")) echo $name ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="emailInput" name="email" value="<?php if (isset($email) && ($email != "")) echo $email ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phoneInput" name="phone" value="<?php if (isset($phone) && ($phone != "")) echo $phone ?>">
                                <div class="text-danger">
                                    <?= isset($_SESSION['error']['phone']) ? $_SESSION['error']['phone'] : '' ?>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="addressInput" name="address" value="<?php if (isset($address) && ($address != "")) echo $address ?>">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <input type="hidden" name="id" value="<?php if (isset($id) && ($id > 0)) echo $id ?>">
                        <input type="submit" class="btn btn-info" name="updatekh" value="Lưu thay đổi">
                        <button type="reset" class="btn btn-warning">Nhập lại</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>