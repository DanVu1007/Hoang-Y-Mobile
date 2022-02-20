
<?php
    require_once 'category.php';
    $logoutURL      = URL::createURL('default','index','logout');
    $login          = URL::createURL('admin','index','login');
    $userInfo       = URL::createURL('default','user','index');
    $adminControlPanel  =   URL::createURL('admin','index','index');
    $listButton = '';

    $loginButton = '<li class="top-nav-item" id="default_login"><a href="#">Đăng nhập</a></li>';
    $logoutButton = '<li class="top-nav-item"><a href="'.$logoutURL.'">Thoát</a></li>';
    $adminLinkButton = '<li class="top-nav-item"><a href="'.$adminControlPanel.'">Đến trang quản trị</a></li>';
    $registerButton = '<li class="top-nav-item"><a href="'.URL::createURL('default','index','register').'">Đăng ký</a></li>';
    $userButton = '';
    if(!empty(Session::get('user')) && Session::get('user')['login']){
        $userButton = '<li class="top-nav-item"><a href="'.$userInfo.'"><i class="far fa-user"></i> '.Session::get('user')['info']['fullname'].'</a></li>';
        $admin      =  (Session::get('user')['info']['group_acp'] == 1) ? $adminLinkButton : '';
        $listButton =  $logoutButton.$admin.$userButton;
    }else{
        $listButton = $registerButton.$loginButton;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- <?php echo '---BaiMaucuaThayLan/HOANGY-MOBILE/public/template/default/main/public/css/maingrid.css' ?> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo PUBLIC_URL_DEFAULT ?>/css/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_URL_DEFAULT ?>/css/maingrid.css">
    <link rel="stylesheet" href="<?php echo PUBLIC_URL_DEFAULT ?>/css/mainstyle.css">
    <link rel="icon" href="<?php echo PUBLIC_URL_DEFAULT ?>/imgmain/logohoangy.png" type="image/x-icon"/>
    <title><?php echo $title ?></title>
    <script src="<?php echo PUBLIC_URL_DEFAULT ?>/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo PUBLIC_URL_DEFAULT ?>/js/custom.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        
        <div class="top-navigation">
            <ul class="top-nav-list">

                <li class="top-nav-item"><a href="#">Giới thiệu</a></li>
                <li class="top-nav-item"><a href="#">Trung tâm bảo hành</a></li>
                <li class="top-nav-item"><a href="#">Tuyển dụng</a></li>
                <?php echo $listButton ;?>
            </ul>
        </div>
        
        <div class="grid wide heading"> 
            <a href="index.php?controller=index&action=index" class="heading__logo">
                <img src="<?php echo PUBLIC_URL_DEFAULT ?>/imgmain/Hoangymobile.png" alt="">
            </a>

            <div class="heading__search">
                <form action="" class="search">
                    <input type="text" class="input__search" placeholder="Hôm nay bạn cần tìm gì?">
                </form>
                <div class="search__icon">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <a href="#" class="heading__check-order">
                <div class="check-order__icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="check-order__text">
                    Kiểm tra đơn hàng
                </div>
            </a>

            <div class="heading__cart">
                <a href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <div class="cart__quantity">122</div>
            </div>
        </div>

        <div class="grid wide nav">
            <ul class="navigation__list">
                <li class="nav-item">

                    <a href="#">
                        <i class="fas fa-mobile-alt"></i>
                        <div class="item__name">Điện thoại</div>
                   
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-6 ">
                                    <div class="row">
                                        <div class="col l-12 menu3">
                                            <h4 class="" href="#">Hãng sản xuất</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">iPhone</a></li>
                                                <li class="sub-item"><a href="#">SamSung</a></li>
                                                <li class="sub-item"><a href="#">Xiaomi</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-6">
                                    <div class="row">
                                        <div class="col l-6 menu1">
                                            <h4 class="" href="#">Mức giá</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Dưới 1 triệu</a></li>
                                                <li class="sub-item"><a href="#">Từ 2 đến 3 triệu</a></li>
                                                <li class="sub-item"><a href="#">Từ 3 đến 4 triệu</a></li>
                                                <li class="sub-item"><a href="#">Từ 6 đến 8 triệu</a></li>
                                                <li class="sub-item"><a href="#">Từ 15 đến 20 triệu</a></li>
                                                <li class="sub-item"><a href="#">Trên 20 triệu</a></li>
                                            </ul>
                                        </div>
                                        <div class="col l-6 menu1">
                                            <h4 class="" href="#">Quan tâm nhất</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Hôm nay</a></li>
                                                <li class="sub-item"><a href="#">Tuần này</a></li>
                                                <li class="sub-item"><a href="#">Tháng này</a></li>
                                                <li class="sub-item"><a href="#">Năm nay</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="far fa-clock"></i>
                        <div class="item__name">Đồng hồ</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-6 ">
                                    <div class="row">
                                        <div class="col l-12 menu3">
                                            <h4 class="" href="#">Đồng hồ</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Apple Watch</a></li>
                                                <li class="sub-item"><a href="#">Samsung</a></li>
                                                <li class="sub-item"><a href="#">Garmin</a></li>
                                                <li class="sub-item"><a href="#">Tic Watch</a></li>
                                                <li class="sub-item"><a href="#">Amazfit</a></li>
                                                <li class="sub-item"><a href="#">Đồng hồ trẻ em</a></li>
                                                <li class="sub-item"><a href="#">Huawei</a></li>
                                                <li class="sub-item"><a href="#">Masstel</a></li>
                                                <li class="sub-item"><a href="#">OPPO</a></li>
                                                <li class="sub-item"><a href="#">realme</a></li>
                                                <li class="sub-item"><a href="#">Xiaomi</a></li>
                                                <li class="sub-item"><a href="#">Fitbit</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-laptop"></i>
                        <div class="item__name">Laptop</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-6 ">
                                    <div class="row">
                                        <div class="col l-12 menu3">
                                            <h4 class="" href="#">Hãng sản xuất</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Dell</a></li>
                                                <li class="sub-item"><a href="#">Asus</a></li>
                                                <li class="sub-item"><a href="#">HP</a></li>
                                                <li class="sub-item"><a href="#">LG</a></li>
                                                <li class="sub-item"><a href="#">Microsoft</a></li>
                                                <li class="sub-item"><a href="#">Lenovo</a></li>
                                                <li class="sub-item"><a href="#">Acer</a></li>
                                                <li class="sub-item"><a href="#">Alienware</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-tablet-alt"></i>
                        <div class="item__name">Tablet</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-6 ">
                                    <div class="row">
                                        <div class="col l-12 menu3">
                                            <h4 class="" href="#">Hãng sản xuất</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Apple</a></li>
                                                <li class="sub-item"><a href="#">Samsung</a></li>
                                                <li class="sub-item"><a href="#">Xiaomi</a></li>
                                                <li class="sub-item"><a href="#">Huawei</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-headphones-alt"></i>
                        <div class="item__name">Âm thanh</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-3 ">
                                    <div class="row">
                                        <div class="col l-12 menu2">
                                            <h4 class="" href="#">Loa</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Energizer</a></li>
                                                <li class="sub-item"><a href="#">Huawei</a></li>
                                                <li class="sub-item"><a href="#">LG</a></li>
                                                <li class="sub-item"><a href="#">Marshall</a></li>
                                                <li class="sub-item"><a href="#">Tekin</a></li>
                                                <li class="sub-item"><a href="#">JBL</a></li>
                                                <li class="sub-item"><a href="#">Harman Kardon</a></li>
                                                <li class="sub-item"><a href="#">Sony</a></li>
                                                <li class="sub-item"><a href="#">Samsung</a></li>
                                                <li class="sub-item"><a href="#">Apple</a></li>
                                                <li class="sub-item"><a href="#">Divoom</a></li>
                                                <li class="sub-item"><a href="#">Anker</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-8">
                                    <div class="row">
                                        <div class="col l-6 menu3">
                                            <h4 class="" href="#">Tai nghe</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Sony</a></li>
                                                <li class="sub-item"><a href="#">JBL</a></li>
                                                <li class="sub-item"><a href="#">Soundpeats</a></li>
                                                <li class="sub-item"><a href="#">AKG</a></li>
                                                <li class="sub-item"><a href="#">Apple AirPods</a></li>
                                                <li class="sub-item"><a href="#">Energizer</a></li>
                                                <li class="sub-item"><a href="#">Huawei</a></li>
                                                <li class="sub-item"><a href="#">iWalk</a></li>
                                                <li class="sub-item"><a href="#">LG</a></li>
                                                <li class="sub-item"><a href="#">Motorola</a></li>
                                                <li class="sub-item"><a href="#">Nokia</a></li>
                                                <li class="sub-item"><a href="#">OPPO</a></li>
                                                <li class="sub-item"><a href="#">Pisen</a></li>
                                                <li class="sub-item"><a href="#">Plantronics</a></li>
                                                <li class="sub-item"><a href="#">realme</a></li>
                                                <li class="sub-item"><a href="#">Samsung</a></li>
                                                <li class="sub-item"><a href="#">Sennheiser</a></li>
                                                <li class="sub-item"><a href="#">Xiaomi</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-charging-station"></i>
                        <div class="item__name">Phụ kiện</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-12 ">
                                    <div class="row">
                                        <div class="col l-12 menu5">
                                            <!-- <h4 class="" href="#">Hãng sản xuất</h4> -->
                                            <ul class="sub-list sub-list-upper">
                                                <li class="sub-item"><a href="#">XẢ TỒN PHỤ KIỆN - GIÁ SỐC</a></li>
                                                <li class="sub-item"><a href="#">ROBOT HÚT BỤI</a></li>
                                                <li class="sub-item"><a href="#">Dây đeo đồng hồ</a></li>
                                                <li class="sub-item"><a href="#">Thẻ nhớ - USB</a></li>
                                                <li class="sub-item"><a href="#">LOA</a></li>
                                                <li class="sub-item"><a href="#">Phụ kiện apple</a></li>
                                                <li class="sub-item"><a href="#">Máy lọc không khí</a></li>
                                                <li class="sub-item"><a href="#">Miếng dán màn hình</a></li>
                                                <li class="sub-item"><a href="#">Bao da - ốp lưng</a></li>
                                                <li class="sub-item"><a href="#">Bút cảm ứng</a></li>
                                                <li class="sub-item"><a href="#">Sạc dự phòng</a></li>
                                                <li class="sub-item"><a href="#">Tay cầm chống rung</a></li>
                                                <li class="sub-item"><a href="#">sub</a></li>
                                                <li class="sub-item"><a href="#">sub</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-gamepad"></i>
                        <div class="item__name">Đồ chơi công nghệ</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-6 ">
                                    <div class="row">
                                        <div class="col l-12 menu3">
                                            <h4 class="" href="#">Đồ chơi công nghệ</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Quạt để bàn</a></li>
                                                <li class="sub-item"><a href="#">Tay cầm chống rung</a></li>
                                                <li class="sub-item"><a href="#">Camera hành trình</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-laptop-house"></i>
                        <div class="item__name">smart home</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-12 ">
                                    <div class="row">
                                        <div class="col l-12 menu4">
                                            <h4 class="" href="#">Gia dụng thông minh</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Máy lọc không khí</a></li>
                                                <li class="sub-item"><a href="#">Robot hút bụi</a></li>
                                                <li class="sub-item"><a href="#">Phụ kiện gia dụng</a></li>
                                                <li class="sub-item"><a href="#">FPT Play box</a></li>
                                                <li class="sub-item"><a href="#">Cân thông minh</a></li>
                                                <li class="sub-item"><a href="#">Ổ Cắm điện</a></li>
                                                <li class="sub-item"><a href="#">Thiết bị định minh</a></li>
                                                <li class="sub-item"><a href="#">Camera an ninh</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-recycle"></i>
                        <div class="item__name">máy trôi</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-12 ">
                                    <div class="row">
                                        <div class="col l-12 menu3">
                                            <h4 class="" href="#">Hàng cũ giá rẻ</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Điện thoại di động</a></li>
                                                <li class="sub-item"><a href="#">Đồng hồ thông minh</a></li>
                                                <li class="sub-item"><a href="#">Máy tính bảng</a></li>
                                                <li class="sub-item"><a href="#">Laptop</a></li>
                                                <li class="sub-item"><a href="#">Loa</a></li>
                                                <li class="sub-item"><a href="#">Tai nghe</a></li>
                                                <li class="sub-item"><a href="#">Camera</a></li>
                                                <li class="sub-item"><a href="#">Củ sạc</a></li>
                                                <li class="sub-item"><a href="#">Dây cáp</a></li>
                                                <li class="sub-item"><a href="#">Máy lọc không khí</a></li>
                                                <li class="sub-item"><a href="#">Phụ kiện</a></li>
                                                <li class="sub-item"><a href="#">Sạc dự phòng</a></li>
                                                <li class="sub-item"><a href="#">Tay cầm chống rung</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-tools"></i>
                        <div class="item__name">sửa chữa</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-5 ">
                                    <div class="row">
                                        <div class="col l-12 menu2">
                                            <h4 class="" href="#">Android</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Pin</a></li>
                                                <li class="sub-item"><a href="#">Camera</a></li>
                                                <li class="sub-item"><a href="#">Màn hình</a></li>
                                                <li class="sub-item"><a href="#">Lỗi trên main</a></li>
                                                <li class="sub-item"><a href="#">Vỏ và mặt lưng</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l-7">
                                    <div class="row">
                                        <div class="col l-8 menu2">
                                            <h4 class="" href="#">Apple  iphone</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Vỏ kính</a></li>
                                                <li class="sub-item"><a href="#">Camera</a></li>
                                                <li class="sub-item"><a href="#">Các loại cáp</a></li>
                                                <li class="sub-item"><a href="#">Lỗi trên main</a></li>
                                            </ul>
                                        </div>
                                        <div class="col l-4 menu1">
                                            <h4 class="" href="#">apple ipad</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Pin</a></li>
                                                <li class="sub-item"><a href="#">Cảm ứng</a></li>
                                                <li class="sub-item"><a href="#">Màn hình</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-sim-card"></i>
                        <div class="item__name">sim thẻ</div>
                        
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="far fa-newspaper"></i>
                        <div class="item__name">tin tức</div>
                        
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-bolt"></i>
                        <div class="item__name">flash sale</div>
                        
                    </a>
                    <div class="sub-container">
                        <div class="sub grid">
                            <div class="row">
                                <div class="col l-12">
                                    <a href="#"><h4>Flash sale</h4></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col l-12 ">
                                    <div class="row">
                                        <div class="col l-12 menu3">
                                            <h4 class="" href="#">Ưu đãi hot</h4>
                                            <ul class="sub-list">
                                                <li class="sub-item"><a href="#">Khuyến mại iPhone</a></li>
                                                <li class="sub-item"><a href="#">Khuyến mãi JBL, Harman Kardon</a></li>
                                                <li class="sub-item"><a href="#">Khuyến mại LG</a></li>
                                                <li class="sub-item"><a href="#">Khuyến mại Sony</a></li>
                                                <li class="sub-item"><a href="#">Lễ hội mua sắm Xiaomi</a></li>
                                                <li class="sub-item"><a href="#">Sản phẩm độc quyền</a></li>
                                                <li class="sub-item"><a href="#">Top 5 tai nghe Bluetooth</a></li>
                                                <li class="sub-item"><a href="#">Khuyến mại Samsung</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-fire-alt"></i>
                        <div class="item__name">CT khuyến mãi</div>
                        
                    </a>
                </li>
            </ul>
        </div>


    </header>
    <div class="grid wide">