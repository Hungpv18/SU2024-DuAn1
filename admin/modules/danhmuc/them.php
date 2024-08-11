<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">THÊM DANH MỤC</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="index.php?act=dsdm">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="index.php?act=dsdm&page=1">QUẢN LÝ DANH MỤC</a>
                </li>
                <li class="breadcrumb-item active">THÊM DANH MỤC</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    THÊM DANH MỤC
                </div>
                <form class="p-3" action="index.php?act=themdm" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <p><span class="thongbao">* Trường bắt buộc</span></p>
                            <div class="mb-2">
                                <label for="nameInput" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="nameInput" name="name" placeholder="">
                                <div class="thongbao mt-2 text-danger">
                                    <?php
                                    if (isset($_SESSION['error']['name']) && $_SESSION['error']['name'] != "") {
                                        if (isset($_SESSION['error']['name']['invalid'])) {
                                            echo $_SESSION['error']['name']['invalid'];
                                            unset($_SESSION['error']['name']);
                                        }

                                        if (isset($_SESSION['error']['name']['numbers_word'])) {
                                            echo $_SESSION['error']['name']['numbers_word'];
                                            unset($_SESSION['error']['name']);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input type="submit" class="btn btn-info me-2" name="them" value="Thêm mới">
                            <input type="reset" class="btn btn-warning" value="Nhập lại">
                        </div>
                </form>
            </div>
        </div>
    </main>
</div>