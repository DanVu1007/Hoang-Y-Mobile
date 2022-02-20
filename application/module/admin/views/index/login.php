<?php 
    $linkACtion = URL::createURL('admin','index','login');

    $emailError = !empty($this->errors['email']) ? $this->errors['email'] : '';
    $passwordError = !empty($this->errors['password']) ? $this->errors['password'] : '';

    $pageURL    = URL::createURL('default','index','index');

    $errorMess  ='';
    if(!empty($this->errors['email']) || !empty($this->errors['password'])){
        $errorMess  = '<div style="color: red; font-size: 18px; font-weight: bold;margin-bottom: 12px;"><i class="fas fa-exclamation-triangle"></i> Email hoặc mật khẩu không đúng</div>';
    }
    // echo '<pre>';
    // print_r($this);
    // echo '</pre>';
    // exit();
?>

<div class="modal-login open">
    <div class="modal-container">
        <div class="left-container">
            <img src="<?php echo PUBLIC_URL_DEFAULT ?>/imgmain/loginimg.png" alt="">
        </div>
        <div class="right-container">
            <!-- <div id="modal-close" class="modal-close"><i class="fas fa-times"></i></div> -->

            <div class="modal-content active">
                <div class="model-title">Đăng nhập</div class="model-title">
                    <form action="<?php $linkACtion ;?>" method="POST" id="main_login">

                    <?php echo $errorMess ;?>

                    <div class="form-input">
                        <label for="fname">Nhập Email:</label>
                        <input type="text" id="fname" name="form[email]">
                    </div>

                    <div class="form-input">
                        <label for="lname">Mật khẩu:</label>
                        <input type="password" id="lname" name="form[password]" >
                    </div>
                    <div class="model-footer">
                        <input id="main_login_submit" type="submit" name="form[login]" value="Đăng nhập">
                        <a href="<?php echo $pageURL ;?>"><i class="fas fa-arrow-left"></i> Quay về trang chủ </a>
                    </div>
    
                    <input type="hidden" name="form[token]" value="<?php echo time() ;?>">
                </form> 
                
            </div>
        </div>
    </div>
</div>