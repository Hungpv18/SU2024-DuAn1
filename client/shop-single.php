<?php
include './include/nav.php';
?>
<?php
include './dao/product.php';
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = getProductById($product_id);
if ($product) {
    echo '
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="public/img/' . $product['image'] . '" alt="Card image cap" id="product-detail">
                    </div>
                    <div class="row">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">' . $product['name'] . '</h1>
                            <p class="h3 py-2">$' . $product['price'] . '</p>
                            <p class="py-2">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <span class="list-inline-item text-dark">4.8 </span>
                            </p>

                            <h6>Mô tả</h6>
                            <p>' . $product['desc_c'] . '</p>                            
                            <form action="" method="GET">
                                <input type="hidden" name="product-title" value="Activewear">
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Số lượng
                                                <input type="hidden" name="product-quantity" id="product-quantity" value="1">
                                            </li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                            <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                            <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Mua</button>
                                    </div>
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocart">Thêm vào giỏ hàng</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>';
} else {
    echo '<div class="container mt-5"><h3>Sản phẩm không tồn tại</h3></div>';
}
?>



<?php
include './include/footer.php';
?>