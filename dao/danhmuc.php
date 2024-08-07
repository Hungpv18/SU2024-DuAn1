<?php
/**
 * Thêm danh mục
 * @param mixed $name
 * @return void
 */
function insert_danhmuc($name)
{
    $sql = "insert into categories(name) values('$name')";
    pdo_execute($sql);
}

/**
 * Xóa danh mục
 * @param mixed $id
 * @return void
 */
function delete_danhmuc($id)
{
    $sql = "UPDATE categories SET status = 0 WHERE id = " . $id;
    pdo_execute($sql);
}

/**
 * Khôi phục danh mục
 * @param mixed $id
 * @return void
 */
function khoi_phuc_danhmuc($id)
{
    $sql = "UPDATE categories SET status = 1 WHERE id = " . $id;
    pdo_execute($sql);
}

/**
 * Hiển thị tất cả danh mục với trang_thai = 1
 * @return array
 */
function loadall_danhmuc()
{

    $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY id DESC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}
/**
 * Hiển thị tất cả danh mục trang_thai = 0
 * @return array
 */
function loadall_danhmuc_luutru()
{

    $sql = "SELECT * FROM categories WHERE trang_thai = 0 ORDER BY id ASC";
    $listdanhmuc = pdo_query($sql);
    return $listdanhmuc;
}

/**
 * Hiển thị 1 danh mục
 * @param mixed $id
 * @return array
 */
function loadone_danhmuc($id)
{
    $sql = "select * from categories where id=" . $id;
    $dm = pdo_query_one($sql);
    return $dm;
}
/**
 * Sửa danh mục
 * @param mixed $id
 * @param mixed $name
 * @return void
 */
function update_danhmuc($id, $name)
{
    $sql = "update categories set name ='" . $name . "' where id=" . $id;
    pdo_execute($sql);
}


function getDanhMuc_limit($start, $limit)
{
    $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY id DESC LIMIT $start,$limit";
    $dm = pdo_query($sql);
    return $dm;
}

function getDanhMuc_luutru_limit($start, $limit)
{
    $sql = "SELECT * FROM categories WHERE status = 0 ORDER BY id DESC LIMIT $start,$limit";
    $dm = pdo_query($sql);
    return $dm;
}

function get_trang_thai($n)
{
    switch ($n) {
        case '0':
            $tt = 'Đã xóa';
            break;
        case '1':
            $tt = 'Hoạt động';
            break;
        default:
            $tt = 'Hoạt động';
            break;
    }
    return $tt;
}


?>