<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/custom.css">
    <?php echo wp_site_icon(); ?>
    <title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- header bar -->
    <header class="header">
        <div class="header-top" id="header-top">
            <div class=" header-info d-flex justify-content-evenly">
                <div>
                    <ul class="nav nav-small nav-divided flex-align">
                        <li>
                            <a class="hotline-icon has-svg-icon size-18" href="tel:0962.567.282">0962.567.282 ( Miễn
                                phí, 7h-21h)
                            </a>
                        </li>
                        <li>
                            <a class="address-icon has-svg-icon size-18" href="/p/lien-he.html#map">Xem vị trí Công ty
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="nav nav-small nav-divided flex-align">
                        <li><a href="gioi-thieu">Giới thiệu</a></li>
                        <li><a href="/search/label/shop?max-results=12">Công ty</a></li>
                        <li><a href="/search/label/Máy-đào-Kobelco-mới?max-results=12">Sản phẩm</a>
                        </li>
                        <li><a href="tin-tuc">Tin tức</a></li>
                        <li><a href="/p/lien-he.html#contact-form">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- menu -->

    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container-fluid container">
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/logo_luhamm.png" width="100px"
                    height="50px" alt="..." />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo site_url(); ?>">Trang
                            Chủ</a>
                    </li>
                    <li class="nav-item dropdown dropdown-hover ">
                        <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sản Phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-hover ">
                        <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sản Phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-hover ">
                        <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sản Phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tin-tuc">Tin Tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gioi-thieu">Giới Thiệu</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>