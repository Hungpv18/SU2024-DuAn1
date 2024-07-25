<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            margin-top: 100px;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center">Đăng nhập</h3>
                <form>
                    <div class="form-group">
                        <label for="email">Địa chỉ Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email của bạn">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu của bạn">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Nhớ tôi</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                </form>
                <div class="text-center mt-3">
                    <a href="#">Quên mật khẩu?</a>
                </div>
                <div class="text-center mt-2">
                    <a href="#">Đăng ký tài khoản mới</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS và các phần phụ thuộc -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>