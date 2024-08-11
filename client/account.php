<?php 
include './include/nav.php';
?>
<body>
    <div class="container mt-5">
        <h2>Thông Tin Tài Khoản</h2>
        <form method="post" action="index.php?act=updateuser">
            <div class="form-group">
                <label for="username">Tên người dùng:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION['user']['username']);?>" disabled>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($_SESSION['user']['address']); ?>"  >
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_SESSION['user']['phone']); ?>"  >
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>"  >
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật Thông Tin</button>
        </form>
        <br>
       <a href="index.php?act=logout"> <button type="submit" class="btn btn-primary">Đăng xuất</button></a>
    </div>
 <br>
<?php
include './include/footer.php';
?>