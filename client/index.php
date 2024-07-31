<?php
include './include/nav.php';
?>

<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./public/img/banner1.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success">MacBook Pro 14 inch M3 8GB 512GB</h1>
                            <h3 class="h2">Chip Apple M3 Series</h3>
                            <p>
                                MacBook Pro với chip M3, M3 Pro và M3 Max đem đến tốc độ vượt trội, cân được nhiều tác vụ bạn muốn. Được hoàn thiện trên công nghệ 3 nanômét và sở hữu kiến trúc GPU hoàn toàn mới, tương tự chip A17 Pro trên iPhone 15 Pro.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./public/img/banner2.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Thiết kế quen thuộc.</h1>
                            <h3 class="h2">Hiệu năng ấn tượng với M3, M3 Pro và M3 Max</h3>
                            <p>
                                Tháng 1/2023, Apple đã chính thức ra mắt MacBook Pro 14 M3 2023 sử dụng hai phiên bản vi xử lý mới là Apple M3, Apple M3 Pro và Apple M3 Max.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./public/img/banner3.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Có hết các cổng kết nối cần thiết</h1>
                            <h3 class="h2">MacBook Pro có dãy cổng kết nối mạnh mẽ để kết nối với thiết bị ngoại vi tốc độ cao </h3>
                            <p>
                                Kết nối với các màn hình ngoài. Kết nối một màn hình ngoài có độ phân giải cao với M3, lên đến hai màn hình với M3 Pro, hoặc lên đến bốn màn hình với M3 Max
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Danh mục sản phẩm của tháng</h1>
        </div>
    </div>
    <div class="row">
        <?php
        include './dao/product.php';
        $rows = getCategories();
        foreach ($rows as $row) {
            echo '
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="./public/img/' . $row['image'] . '" class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3">' . $row['name'] . '</h5>
            <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>';
        }
        ?>


    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">

        </div>
        <div class="row">
        <?php
    $products = getProductLimit();
    foreach ($products as $product) {
        echo '
        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
                <a href="index.php?act=shop-single&id=' . $product['id'] . '">
                    <img src="./public/img/' . $product['image'] . '" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <ul class="list-unstyled d-flex justify-content-between">
                        <li>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-muted fa fa-star"></i>
                            <i class="text-muted fa fa-star"></i>
                        </li>
                        <li class="text-muted text-right">$' . $product['price'] . '</li>
                    </ul>
                    <a href="index.php?act=shop-single&id=' . $product['id'] . '" class="h2 text-decoration-none text-dark">' . $product['name'] . '</a>
                    <p class="card-text">
                       '.$product['desc_c'].'
                    </p>
                    <p class="text-muted">Reviews (24)</p>
                </div>
            </div>
        </div>';
    }
    ?>

        </div>
    </div>
</section>

<?php
include './include/footer.php';
?>