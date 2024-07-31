<?php
include './include/nav.php';
?>


<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Gender
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Men</a></li>
                        <li><a class="text-decoration-none" href="#">Women</a></li>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Sale
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Sport</a></li>
                        <li><a class="text-decoration-none" href="#">Luxury</a></li>
                    </ul>
                </li>
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Product
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Bag</a></li>
                        <li><a class="text-decoration-none" href="#">Sweather</a></li>
                        <li><a class="text-decoration-none" href="#">Sunglass</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="index.php?act=shop&category_id=0">Tất cả</a>
                        </li>
                        <?php
                        include './dao/product.php';
                        $categories = getCategories();
                        foreach ($categories as $category) {
                            echo '
                                   <li class="list-inline-item">
                                   <a class="h3 text-dark text-decoration-none mr-3"  href="index.php?act=shop&category_id=' . $category['id'] . '">' . $category['name'] . '</a>
                                   </li>
                                        ';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <?php

            // Lấy ID danh mục từ URL
            $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

            // Thiết lập số lượng sản phẩm hiển thị trên mỗi trang
            $products_per_page = 6;

            // Lấy số trang hiện tại từ URL, nếu không có thì mặc định là 1
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Tính toán offset
            $offset = ($current_page - 1) * $products_per_page;

            // Lấy tổng số sản phẩm theo danh mục
            $total_products = getTotalProducts($category_id);

            // Tính toán tổng số trang
            $total_pages = ceil($total_products / $products_per_page);

            // Lấy sản phẩm cho trang hiện tại theo danh mục
            $products = getProductsByPage($offset, $products_per_page, $category_id);
            ?>
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
                    echo '<div class="col-12"><h3>Không tìm thấy kết quả</h3></div>';
                }
                ?>
                <?php


                ?>


                <div class="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        <?php if ($current_page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="index.php?page=<?php echo $current_page - 1; ?>&act=shop">Trước</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
                                <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="index.php?page=<?php echo $i; ?>&act=shop"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages) : ?>
                            <li class="page-item">
                                <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="index.php?page=<?php echo $current_page + 1; ?>&act=shop">Sau</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>



<?php
include './include/footer.php';
?>