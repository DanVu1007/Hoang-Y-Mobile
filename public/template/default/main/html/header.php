
<?php
    require_once 'category_index.php'; //$resultCategory
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
                <!-- LIST HERE -->

                <?php foreach ($resultCategory as $key => $value) {
                    $active = (!empty($this->arrParam['category_id']) && $this->arrParam['category_id'] == $value['id']) ? 'active' : '';
                ?>
                    <li class="nav-item <?php echo  $active ;?>">
                        <a href="<?php echo URL::createURL('default','product','list',array('category_id'=>$value['id'])) ?>">
                            <i class="<?php echo  $value['icon'] ;?>"></i>
                            <div class="item__name"><?php echo  $value['name'] ;?></div>
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
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php };?>

            </ul>
        </div>

    </header>
    <div class="grid wide">
