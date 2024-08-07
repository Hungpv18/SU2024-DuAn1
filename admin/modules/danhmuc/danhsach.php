<?php
// Truy vấn sử dụng PDO
$pdo = pdo_get_connection();

$stmt = $pdo->query("SELECT * FROM categories WHERE status = 1 ORDER BY id DESC");
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
$listdanhmuc_limit = getDanhMuc_limit($start, $limit);

$listdanhmuc = [];

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $listdanhmuc = $listdanhmuc_limit;
}

?>
<div class="container-fluid">
    <h1 class="mt-4">QUẢN LÝ DANH MỤC</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">QUẢN LÝ DANH MỤC</li>
    </ol>
    <form action="<?php
                    if (isset($_POST['delete']) && $_POST['delete'])
                        echo 'index.php?act=delete_list_dm';
                    else
                        echo 'index.php?act=dsdm&page=1';
                    ?>" method="POST">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Danh Sách
                <div class="mb-12 float-end">
                    <a href="index.php?act=themdm" class="btn btn-primary btn-sm">Thêm mới</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">Tất cả</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                echo '<form>';
                                foreach ($listdanhmuc as $danhmuc) {
                                    extract($danhmuc);
                                    $suadm = "index.php?act=suadm&id=" . $id;
                                    $xoadm = "index.php?act=xoadm&id=" . $id;
                                    echo '
                                <tr>
                                    <td><input type="checkbox" name="check_del[]" class="checkbox" value="' . $id . '" /></td>
                                    <th scope="row" class="text-center">' . $id . '</th>
                                    <td scope="row">' . $name . '</td>
                                    <td scope="row" class="text-center"><span class="btn btn-success btn-sm cs-default">Hoạt động</span></td>
                                    <td class="text-center">
                                    <a href="' . $suadm . '" class="btn btn-primary">Sửa</a>
                                    <a href="' . $xoadm . '" class="btn btn-danger"
                                        onclick="return confirm(`Bạn có chắc muốn xóa không?`)">Xóa</a>
                                    </td>
                                    </tr>
                                    ';
                                }
                                echo '</form>';
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pag float-end">
                    <nav aria-label="Page navigation example" class="pag">
                        <ul class="pagination">
                            <?php if ($cr_page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?act=dsdm&page=<?= $cr_page - 1 ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_page; $i++) : ?>
                                <li class="page-item <?php echo (($cr_page == $i) ? 'active' : '') ?>">
                                    <a class="page-link" href="index.php?act=dsdm&page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($cr_page < $total_page) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?act=dsdm&page=<?= $cr_page + 1 ?>" aria-label="Next">
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