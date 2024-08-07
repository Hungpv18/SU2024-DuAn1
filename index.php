<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop eCommerce HTML CSS Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="public/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.ico">

    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/templatemo.css">
    <link rel="stylesheet" href="./public/css/custom.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="./public/css/fontawesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php

    $action = "home";
    if (isset($_GET['act']))
        $action = $_GET['act'];

    switch ($action) {
        case "home":
            include './client/index.php';
            break;
        case "shop":
            include './client/shop.php';
            break;
        case "shop-single";
            include './client/shop-single.php';
            break;
        case "contact";
            include './client/contact.php';
            break;
        case "about";
            include './client/about.php';
            break;
        case "search":
            include './client/search.php';
            break;
        case "cart";
            include './client/cart.php';
            break;
        case "sigin";
            include './client/sigin.php';
            break;
        case "login";
            include './client/login.php';
            break;
    }
    ?>



    <script src="./public/js/jquery-1.11.0.min.js"></script>
    <script src="./public/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/templatemo.js"></script>
    <script src="./public/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>