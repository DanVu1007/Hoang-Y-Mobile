<?php 
    $message = '';
    switch ($this->arrParam['type']){
        case 'register-success':
            $message = "Tài khoản được tạo thành công";
            $img = "funny_img/dangkythanhcong.jpg";
        break;
        case 'not-permission':
            $message = "Truy cập không được cho phép";
            $img        =   "funny_img/deny_access.png";
        break;
        case 'error-404':
            $message = "Không thể tìm thấy trang!";
            $img        =   "funny_img/error.png";
        break;
    }
?>

<div class="notice-message">
    <?php echo $message ;?>
    <img src="<?php echo PUBLIC_URL_DEFAULT ?>/imgmain/<?php echo $img ?>" alt="">
</div>