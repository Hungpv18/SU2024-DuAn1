<?php
include 'pdo.php';

function getProductById($id)
{
    $sql = "SELECT * FROM products WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function getCategories()
{
    $sql = "SELECT * FROM categories";
    return pdo_query($sql);
}
function getProductLimit()
{
    $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 3";
    return pdo_query($sql);
}
function getProductByCategory($id) {
    $sql = "SELECT * FROM categories WHERE id = ?";
    return pdo_query($sql, $id);
}

function getProductsByCategory($category_id) {
    if ($category_id ==0) {
        $sql = "SELECT * FROM products ORDER BY RAND()";
    } else {
        $sql = "SELECT * FROM products WHERE category_id = ? ORDER BY RAND()";
    }
    return pdo_query($sql, $category_id);
}

function searchProducts($keyword) {
    $sql = "SELECT * FROM products WHERE name LIKE ?";
    $params = ["%$keyword%"];
    return pdo_query_search($sql, $params);
}
function getTotalProducts($category_id = null) {
    if ($category_id) {
        $sql = "SELECT COUNT(*) FROM products WHERE category_id = :category_id";
        $params = [':category_id' => $category_id];
    } else {
        $sql = "SELECT COUNT(*) FROM products";
        $params = [];
    }
    $result = pdo_query_total($sql, $params);
    return $result[0]['COUNT(*)'];
}

function getProductsByPage($offset, $limit, $category_id = null) {
    if ($category_id) {
        $sql = "SELECT * FROM products WHERE category_id = :category_id LIMIT :offset, :limit";
        $params = [
            ':category_id' => $category_id,
            ':offset' => $offset,
            ':limit' => $limit
        ];
    } else {
        $sql = "SELECT * FROM products LIMIT :offset, :limit";
        $params = [
            ':offset' => $offset,
            ':limit' => $limit
        ];
    }
    return pdo_query_total($sql, $params);
}