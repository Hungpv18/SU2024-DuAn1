<?php

/**
 * Thêm tài khoản
 * @param mixed $tenloai
 * @return void
 */
function insert_taikhoan($email, $name, $password)
{
    $sql = "insert into users(email, name, password) values('$email', '$name', '$password')";
    pdo_execute($sql);
}


/**
 * Kiểm tra thông tin tài khoản
 * @param mixed $id
 * @return array
 */
function check_user($email, $password)
{
    $sql = "select * from users where email='" . $email . "' and mat_khau='" . $password . "'";
    $tk = pdo_query_one($sql);
    return $tk;
}
function check_user_validate($name)
{
    $sql = "select * from users where name ='" . $name . "' ";
    $tk = pdo_query_one($sql);
    return $tk;
}
function check_email_validate($email)
{
    $sql = "select * from users where email ='" . $email . "' ";
    $tk = pdo_query_one($sql);
    return $tk;
}
/**
 * Cập nhật tài khoản
 * @param mixed $id
 * @param mixed $name
 * @param mixed $email
 * @param mixed $phone
 * @param mixed $address
 * @param mixed $password
 * @return void
 */
function capnhat_taikhoan($id, $name, $email, $phone, $address, $password)
{
    try {
        $sql = "update taikhoan set user = '" . $name . "', email ='" . $email . "', sdt = '" . $phone . "', dia_chi = '" . $address . "', mat_khau = '" . $password . "' where id=" . $id;
        pdo_execute($sql);
        return 1;
    } catch (Exception $e) {
        echo $e;
        return 0;
    }
}
function capnhat_taikhoan_kh($id, $email, $phone)
{
    try {
        $sql = "update users set email ='" . $email . "', sdt = '" . $phone . "'where id=" . $id;
        pdo_execute($sql);
        return 1;
    } catch (Exception $e) {
        echo $e;
        return 0;
    }
}
/**
 * Kiểm tra thông tin tài khoản
 * @param mixed $id
 * @return array
 */
function check_email($email)
{
    $sql = "select * from users where email='" . $email . "' ";
    $tk = pdo_query_one($sql);
    return $tk;
}
function check_pass($id)
{
    $sql = "select mat_khau from users where id ='" . $id . "' ";
    $tk = pdo_query_one($sql);
    return $tk;
}

function update_password($email, $password)
{
    $sql = "update users set mat_khau='" . $password . "' where email='" . $email . "' ";
    pdo_execute($sql);
}


/**
 * Hiển thị tất cả tài khoản
 * @return array
 */
function loadall_dskh()
{
    $sql = "SELECT * FROM users WHERE 1";
    $list_dskh = pdo_query($sql);
    return $list_dskh;
}


/**
 * Xóa tài khoản
 * @param mixed $id
 * @return void
 */
function delete_taikhoan($id)
{
    $sql = "delete from taikhoan where id=" . $id;
    pdo_execute($sql);
}


/**
 * Hiển thị 1 tài khoản
 * @param mixed $id
 * @return array
 */
function loadone_khachhang($id)
{
    $sql = "select * from users where id=" . $id;
    $dskh = pdo_query_one($sql);
    return $dskh;
}

function update_dskh($id, $name, $email, $phone, $address)
{
    $sql = "UPDATE khach_hang SET name = ?, email = ?, sdt = ?, dia_chi = ? WHERE id = ?";
    pdo_execute($sql, $name, $email, $phone, $address, $id);
}
function check_only_user($name)
{
    $sql = "select * from taikhoan where user='" . $name . "'";
    $tk = pdo_query_one($sql);
    return $tk;
}


function login_user($email, $password)
{
    // Kiểm tra xem thông tin đăng nhập hợp lệ hay không
    if (!check_user($email, $password)) {
        // Thông tin đăng nhập không hợp lệ
        return false;
    }

    // Đăng nhập người dùng
    $_SESSION["email"] = $email;
    $_SESSION["logged_in"] = true;

    // Chuyển hướng người dùng đến trang chủ
    header("Location: index.php");

    return true;
}

function getdskh_limit($start, $limit)
{
    $sql = "select * from users order by id desc limit $start,$limit";
    $tk = pdo_query($sql);
    return $tk;
}

function get_vai_tro($n)
{
    switch ($n) {
        case '0':
            $vt = 'Quản trị viên';
            break;
        case '2':
            $vt = 'Khách hàng';
            break;

        default:
            $vt = 'Khách hàng';
            break;
    }
    return $vt;
}

function update_vai_tro($id, $vai_tro)
{
    $sql = "UPDATE users SET vai_tro='" . $vai_tro . "' WHERE id=" . $id;
    pdo_execute($sql);
}