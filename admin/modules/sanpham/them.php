<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">THÊM SẢN PHẨM</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="index.php?act=dssp">QUẢN LÝ SẢN PHẨM</a></li>
                <li class="breadcrumb-item active">THÊM SẢN PHẨM</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Thêm sản phẩm mới
                </div>

                <form class="row g-3" method="post" action="index.php?act=themsp" enctype="multipart/form-data">
                    <div class="card-body">
                        <p><span class="thongbao">(*) Trường bắt buộc</span></p>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Tên Sản Phẩm
                                <span class="thongbao">(*)</span>
                            </label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="">
                            <div class="thongbao mt-2">
                                <span><?php echo (isset($_SESSION['error']['name'])) ? $_SESSION['error']['name'] : '' ?></span>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="mb-3 col-6">
                                <label for="exampleFormControlInput1" class="form-label">Giá Niêm Yết
                                    <span class="thongbao">(*)</span>
                                </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" name="price" placeholder="90000">
                                <div class="thongbao mt-2">
                                    <span><?php echo (isset($_SESSION['error']['price'])) ? $_SESSION['error']['price'] : '' ?></span>
                                </div>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="exampleFormControlInput2" class="form-label">Giá Khuyến Mãi
                                    <span class="thongbao">(*)</span>
                                </label>
                                <input type="text" class="form-control" id="exampleFormControlInput2" name="sale_price" placeholder="9000">
                                <div class="thongbao mt-2">
                                    <span><?php echo (isset($_SESSION['error']['sale_price'])) ? $_SESSION['error']['sale_price'] : '' ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Ảnh Sản Phẩm
                                <span class="thongbao">(*)</span>
                            </label>
                            <input class="form-control" type="file" id="formFile" name="image">
                            <div class="thongbao mt-2">
                                <?php
                                if (isset($_SESSION['error']['image']) && $_SESSION['error']['image'] != "") {
                                    if (isset($_SESSION['error']['image']['required'])) {
                                        echo $_SESSION['error']['image']['required'];
                                        unset($_SESSION['error']['image']);
                                    }
                                    if (isset($_SESSION['error']['image']['incorrect'])) {
                                        echo $_SESSION['error']['image']['incorrect'];
                                        unset($_SESSION['error']['image']);
                                    }
                                    if (isset($_SESSION['error']['image']['maxSize'])) {
                                        echo $_SESSION['error']['image']['maxSize'];
                                        unset($_SESSION['error']['image']);
                                    }
                                } else {
                                    unset($_SESSION['error']['image']);
                                }
                                ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="editor" class="form-label">Mô Tả</label>
                            <textarea id="summernote" class="form-control" placeholder="Nhập nội dung ở đây" name="desc_c"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="formSelect" class="form-label">Danh Mục
                                <span class="thongbao">(*)</span>
                            </label>
                            <select name="category_id" class="form-select" id="formSelect">
                                <option selected>Vui lòng chọn danh mục</option>
                                <?php
                                foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    echo '<option value="' . $id . '" ' . ($category_id == $id ? 'selected' : '') . '>' . $name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer mb-12 text-center">
                        <input type="submit" class="btn btn-info me-lg-2" name="them" value="Thêm mới">
                        <input type="reset" class="btn btn-warning me-2" value="Nhập lại">
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>