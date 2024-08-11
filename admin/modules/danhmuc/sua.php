<?php
if (is_array($danhMuc)) {
    extract($danhMuc);
}
?>

<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">SỬA DANH MỤC</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="index.php?act=dsdm">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.php?act=dsdm&page=1">QUẢN LÝ DANH MỤC</a>
                </li>
                <li class="breadcrumb-item active">SỬA DANH MỤC</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    SỬA DANH MỤC
                </div>
                <form class="row g-3 p-3" action="index.php?act=capnhatdm" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="idInput" class="form-label">Mã Danh Mục</label>
                            <input type="text" class="form-control" id="idInput" name="id" value="<?php if (isset($id) && ($id != "")) echo $id ?>" disabled>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nameInput" class="form-label">Tên Danh Mục</label>
                            <input type="text" class="form-control" id="nameInput" name="name" value="<?php if (isset($name) && ($name != "")) echo $name ?>">
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <input type="hidden" name="id" value="<?php if (isset($id) && ($id > 0)) echo $id ?>">
                        <input type="submit" class="btn btn-info me-2" name="capnhat" value="Lưu thay đổi">
                        <input type="reset" class="btn btn-warning me-2" value="Nhập lại">
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
