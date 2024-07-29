<?php
include './include/nav.php';
?>

<?php
include './dao/product.php';

// Lấy từ khóa tìm kiếm từ URL
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

// Lấy sản phẩm theo từ khóa tìm kiếm
$products = searchProducts($query);
?>

<div class="container mt-5">
    <h3>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($query); ?>"</h3>
    <div class="row">
        <?php
        if ($products) {
            foreach ($products as $product) {
                echo '
                <div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid" src="public/img/' . $product['image'] . '">
                            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <li><a class="btn btn-success text-white" href="shop-single.html"><i class="far fa-heart"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="index.php?act=shop-single&id=' . $product['id'] . '"><i class="far fa-eye"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="index.php?act=shop-single&id=' . $product['id'] . '" class="h3 text-decoration-none">' . $product['name'] . '</a>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0">$' . $product['price'] . '</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12"><h3>Không tìm thấy sản phẩm nào</h3></div>';
        }
        ?>
    </div>
</div>

<?php
include './include/footer.php';
?>