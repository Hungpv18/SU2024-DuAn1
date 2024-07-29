<?php
/**
 * Thêm sản phẩm
 * @param mixed $tenloai
 * @return void
 */
function insert_sanpham($name, $price, $sale_price, $image, $desc_c, $category_id )
{
    $sql = "insert into mon_an(name ,price ,sale_price ,image ,desc_c ,category_id ) values('$name','$price','$sale_price','$image','$desc_c','$category_id ')";
    pdo_execute($sql);
}

/**
 * Xóa sản phẩm
 * @param mixed $id
 * @return void
 */
function delete_sanpham($id)
{
    $sql = "UPDATE products SET status = 0 WHERE id = " . $id;
    pdo_execute($sql);
}

/**
 * Khôi phục sản phẩm
 * @param mixed $id
 * @return void
 */
function khoi_phuc_sanpham($id)
{
    $sql = "UPDATE products SET status = 1 WHERE id = " . $id;
    pdo_execute($sql);
}

/**
 * Hiển thị tất cả sản phẩm
 * @return array
 */
function loadall_sanpham($keyw = '', $category_id  = 0)
{
    $sql = "SELECT * FROM products WHERE status = 1";

    if ($keyw != "") {
        $sql .= " AND ten LIKE '%" . $keyw . "%'";
    }

    if ($category_id  > 0) {
        $sql .= " AND danh_muc_id = '" . $category_id  . "'";
    }

    $sql .= " ORDER BY id DESC";

    // Thực hiện truy vấn và trả về kết quả
    $listmonan = pdo_query($sql);

    return $listmonan;
}
/**
 * Hiển thị tất cả sản phẩm lưu trữ khi đã xóa
 * @return array
 */
function loadall_sanpham_luutru($keyw = '', $category_id  = 0)
{
    $sql = "SELECT * FROM products WHERE status = 0";

    if ($keyw != "") {
        $sql .= " AND ten LIKE '%" . $keyw . "%'";
    }

    if ($category_id  > 0) {
        $sql .= " AND danh_muc_id = '" . $category_id  . "'";
    }

    $sql .= " ORDER BY id DESC";

    // Thực hiện truy vấn và trả về kết quả
    $listmonan = pdo_query($sql);

    return $listmonan;
}


/**
 * Hiển thị tất cả sản phẩm ra ngoài trang chủ với top 10 lượt xem
 * @return array
 */
function loadall_sanpham_top10()
{
    $sql = "select * from sanpham where 1 order by luotxem desc limit 0,10";
    $listsanpham = pdo_query($sql);
    return $listsanpham;
}
/**
 * Hiển thị tất cả sản phẩm ra ngoài trang chủ
 * @return array
 */
function loadall_sanpham_home()
{
    $sql = "select * from products where 1 and status = 1 order by id desc limit 0,9";
    $listmonan = pdo_query($sql);
    return $listmonan;
}

/**
 * Hiển thị 1 sản phẩm
 * @param mixed $id
 * @return array
 */
function loadone_sanpham($id)
{
    $sql = "select * from products where id=" . $id;
    $sp = pdo_query_one($sql);
    return $sp;
}

/**
 * Load sản phẩm cùng loại
 * @param mixed $id
 * @return array
 */
function load_sanpham_cungloai($id, $products)
{
    $sql = "select * from mon_an where danh_muc_id =" . $products . " and id <>" . $id;
    $sql .= " limit 0,4";
    $listmonan = pdo_query($sql);
    return $listmonan;
}

/**
 * Hiển thị tên danh mục
 * @return array
 */
function load_ten_danhmuc($category_id )
{
    if ($category_id  > 0) {
        $sql = "select * from danh_muc where id=" . $category_id ;
        $dm = pdo_query_one($sql);
        extract($dm);
        return $name;
    } else {
        return "";
    }
}

/**
 * Sửa sản phẩm
 * @param mixed $id
 * @param mixed $tenloai
 * @return void
 */
function update_sanpham($id, $category_id , $name, $price, $sale_price, $desc_c, $image)
{
    if ($image != "") {
        $sql = "update products set ten='" . $name . "', gia='" . $price . "', gia_giam='" . $sale_price . "',hinh='" . $image . "',mo_ta='" . $desc_c . "', danh_muc_id='" . $category_id  . "' where id=" . $id;
    } else {
        $sql = "update products set ten='" . $name . "', gia='" . $price . "', gia_giam='" . $sale_price . "',mo_ta='" . $desc_c . "', danh_muc_id='" . $category_id  . "' where id=" . $id;
    }
    pdo_execute($sql);
}


function getSanpham_limit($start, $limit)
{
    $sql = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC LIMIT $start,$limit";
    $dm = pdo_query($sql);
    return $dm;
}
function getSanpham_luutru_limit($start, $limit)
{
    $sql = "SELECT * FROM products WHERE status = 0 ORDER BY id DESC LIMIT $start,$limit";
    $dm = pdo_query($sql);
    return $dm;
}

function update_luotxem($id)
{
    $one_sp = loadone_sanpham($id);


    if (isset($one_sp)) {
        $luotxem = $one_sp['luotxem'] + 1;
        $sql = "update sanpham set luotxem = '" . $luotxem . "' where id = '" . $id . "'";
    }
    pdo_execute($sql);
}

function count_sanpham_danhmuc($category_id )
{
    $sql = "SELECT COUNT(id) as so_luong FROM products WHERE danh_muc_id = '" . $category_id  . "' GROUP BY danh_muc_id;";
    $count = pdo_query_value($sql);
    return $count;
}

function load_sanpham_by_danhMuc($category_id )
{
    $sql = "SELECT * FROM products WHERE status = 1 AND danh_muc_id = " . $category_id  . " ORDER BY id DESC";
    $listmonan = pdo_query($sql);
    return $listmonan;
}

?>