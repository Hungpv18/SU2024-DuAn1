<?php

include './include/nav.php';
?>
<div class="container mt-5">
    <h2>Giỏ hàng của bạn</h2>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Hình ảnh</th>
                    <th>Tổng cộng</th>
                    <th></th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo number_format($item['price']); ?> VND</td>
                        <td><?php echo intval($item['quantity']); ?></td>
                        <td><img src="public/img/<?php echo htmlspecialchars($item['image']); ?>" width="100px" height="100px"></td>
                        <td><?php echo number_format($item['price'] * $item['quantity']); ?> VND</td>
                        <td>
                            <a href="index.php?act=remove_from_cart&id=<?php echo $product_id; ?>"
                               class="btn btn-danger"
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Giỏ hàng của bạn trống.</p>
    <?php endif; ?>
</div>



<?php
include './include/footer.php';
?>