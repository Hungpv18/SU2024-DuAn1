<?php
// Khai báo biến để lưu trữ giá trị mặc định của trường input
$defaultKeyword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem biểu mẫu đã được gửi chưa
    $keyword = $_POST["keyw"]; // Lấy dữ liệu từ trường input có tên "keyw"

    // Lưu trữ giá trị của trường input
    $defaultKeyword = $keyword;
}
?>

<!-- Phân trang -->
<?php
// Truy vấn sử dụng PDO
$pdo = pdo_get_connection();

$stmt = $pdo->query("SELECT * FROM products WHERE status = 1 ORDER BY id DESC");
$listdm = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Tổng các bảng ghi
$total = count($listdm);

//Giới hạn hiển thị
$limit = 5;

//Tổng trang
$total_page = ceil($total / $limit);

// Lấy trang hiện tại
$cr_page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($cr_page - 1) * $limit;

// Hàm để lấy danh sách sản phẩm với giới hạn
$list_ = getSanpham_limit($start, $limit);


if (isset($_GET['page']) && !empty($_GET['page'])) {
    $listmonan = $list_monan;
}

?>

<div class="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">QUẢN LÝ MÓN ĂN</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">QUẢN LÝ MÓN ĂN</li>
            </ol>
            <form action="<?php
                            if (isset($_POST['delete']) && $_POST['delete']) {
                                echo 'index.php?act=delete_list_ma';
                            } else if (isset($_POST['listcheck']) && $_POST['listcheck']) {
                                echo 'index.php?act=dsma';
                            } else {
                                echo 'index.php?act=dsma&page=1';
                            }
                            ?>" method="POST">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Danh Sách
                        <div class="mb-12 float-end">
                            <a href="index.php?act=them" class="btn btn-primary btn-sm">Thêm mới</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-12 mb-3">
                            <div class="mb-4 col-4">
                                <label for="formSelect" class="form-label">Filter Danh mục</label>
                                <select name="danh_muc_id" class="form-select" id="formSelect">
                                    <option selected>Tất cả</option>
                                    <?php
                                    foreach ($listdanhmuc as $danhmuc) {
                                        extract($danhmuc);
                                        echo '<option value="' . $id . '" ' . ($category_id  == $id ? 'selected' : '') . '>' . $name . '</option>';
                                    }
                                    ?>
                                </select>
                                <input type="submit" class="btn btn-primary float-end mt-1" name="listcheck" value="Chọn">
                            </div>
                            <div class="col-4">
                                <label for="formSelect" class="form-label">Tìm kiếm</label>
                                <!-- Navbar Search-->
                                <div class=" input-group">
                                    <input class="form-control" type="text" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="btnNavbarSearch" name="keyw" value="<?php echo htmlspecialchars($defaultKeyword); ?>" />
                                    <input type="submit" class="btn btn-outline-warning" name="listcheck" value="Xác nhận">
                                </div>
                            </div>

                        </div>
            </form>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Tất cả</th>
                        <th scope="col">ID</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá niêm yết</th>
                        <th scope="col">Giá khuyến mãi</th>
                        <th scope="col">Hình sản phẩm</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $img_path = '/public/img/';
                    foreach ($listsanpham as $sanpham) {
                        // var_dump()
                        // var_dump($sanpham); die;
                        extract($sanpham);
                        $hinhpath = $img_path . $image;
                        if (is_file($hinhpath)) {
                            $image = "<img src='" . $hinhpath . "' height='60'>";
                        } else {
                            $image = "Không có hình ảnh";
                        }
                        $suasp = "index.php?act=suasp&id=" . $id;
                        $xoasp = "index.php?act=xoasp&id=" . $id;
                        echo '
                                <tr>
                                <td><input type="checkbox" name="check_del[]" class="checkbox" value="' . $id . '" /></td>
                                <th scope="row">' . $id . '</th>
                                    <td scope="row">' . $name . '</td>
                                    <td scope="row">' . number_format($price, 0, ',', '.') . 'đ</td>
                                    <td scope="row">' . $sale_price . 'đ</td>
                                    <td scope="row">' . $image . '</td>
                                    <td scope="row" class="text-center"><span class="btn btn-success btn-sm cs-default">Hoạt động</span></td>
                                    <td>
                                        <a href="' . $suasp . '" class="btn btn-primary">Sửa</a>
                                        <a href="' . $xoasp . '" class="btn btn-danger" onclick="return confirm(`Bạn có chắc muốn xóa không?`)">Xóa</a>
                                    </td>
                                </tr>
                                ';
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <label for="checkAll" class="btn btn-primary chon">Chọn tất cả</label>
            <label for="checkAll" class="btn btn-warning bochon" style="display: none;">Bỏ chọn</label>
            <input type="checkbox" hidden id="checkAll">
            <input class="btn btn-danger" type="submit" value="Xóa mục đã chọn" name="delete" onclick="return confirm(`Bạn có chắc muốn xóa không?`)">

            <!-- Phân trang  -->
            <div class="pag float-end">
                <nav aria-label="Page navigation example" class="pag">
                    <ul class="pagination">
                        <?php if ($cr_page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?act=dsma&page=<?= $cr_page - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                            <li class="page-item <?php echo (($cr_page == $i) ? 'active' : '') ?>">
                                <a class="page-link" href="index.php?act=dsma&page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($cr_page < $total_page) : ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?act=dsma&page=<?= $cr_page + 1 ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
</div>
</div>
</main>
</div>