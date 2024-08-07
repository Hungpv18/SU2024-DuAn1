<?php
if (is_array($sanpham)) {
    extract($sanpham);
}
$img_path = 'uploads/'; // Khởi tạo biến $img_path với đường dẫn tới thư mục chứa hình ảnh
$hinhpath  = $img_path . $image;
if (is_file($hinhpath)) {
    $hinhanh = "<img src='" . $hinhpath . "' height='80'>";
} else {
    $hinhanh = "Không có hình ảnh";
}
?>
<div class="container mt-5">
    <h1 class="mb-4">SỬA MÓN ĂN</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php?act=dssp">QUẢN LÝ MÓN ĂN</a></li>
            <li class="breadcrumb-item active" aria-current="page">SỬA MÓN ĂN</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i> Chỉnh sửa món ăn
        </div>
        <form class="p-4" method="post" action="index.php?act=updatesp" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Mã Sản Phẩm</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="id" placeholder="Mã tự động" disabled value="<?= $id ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tên Sản Phẩm</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?= $name ?>">
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Giá Niêm Yết <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="price" value="<?= $price ?>">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="exampleFormControlInput2" class="form-label">Giá Khuyến Mãi <span class="text-danger">(*)</span></label>
                    <input type="text" class="form-control" id="exampleFormControlInput2" name="sale_price" value="<?= $sale_price ?>">
                </div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Ảnh Sản Phẩm</label>
                <input class="form-control" type="file" id="formFile" name="image">
                <div class="mt-2">
                    <?= $hinhanh ?> (Hình cũ)
                </div>
            </div>
            <div class="mb-3">
                <label for="summernote" class="form-label">Mô Tả</label>
                <textarea id="summernote" class="form-control" placeholder="Nhập nội dung ở đây" name="desc_c"><?= $desc_c ?></textarea>
            </div>
            <div class="mb-3">
                <label for="formSelect" class="form-label">Danh Mục</label>
                <select name="category_id" class="form-select">
                    <option value="0" selected>Vui lòng chọn danh mục</option>
                    <?php
                    foreach ($listdanhmuc as $danhmuc) {
                        extract($danhmuc);
                        echo '<option value="' . $id . '" ' . ($category_id == $id ? 'selected' : '') . '>' . $name . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <input type="hidden" name="id" value="<?= $sanpham['id'] ?>">
                <input type="submit" class="btn btn-info me-2" name="capnhat" value="Lưu thay đổi">
                <input type="reset" class="btn btn-warning" value="Nhập lại">
            </div>
        </form>
    </div>
</div>
