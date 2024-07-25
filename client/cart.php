<?php
include './include/nav.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Giỏ hàng của bạn</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sản phẩm 1</td>
                <td>100,000 VND</td>
                <td><input type="number" class="form-control" value="1" min="1"></td>
                <td>100,000 VND</td>
                <td>
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </td>
            </tr>
            <tr>
                <td>Sản phẩm 2</td>
                <td>200,000 VND</td>
                <td><input type="number" class="form-control" value="2" min="1"></td>
                <td>400,000 VND</td>
                <td>
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-6">
            <h4>Tổng cộng: 500,000 VND</h4>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-primary">Cập nhật giỏ hàng</button>
            <button class="btn btn-success">Thanh toán</button>
        </div>
    </div>
</div>
<br>
<?php
include './include/footer.php';
?>