<?php 
    $token = Helper::createInput('','hidden','form[token]','token',time());


    $buttonregisterORlogin = '<div class="modal-direction">
                                    <Button id="dangky"class="active">Đăng Ký</Button>
                                    <Button id="dangnhap" >Đăng nhập</Button>
                                </div>';
    $register_active              =    'active';
    $login_active                  =    '';
    $errorMess  ='';
    if(isset($this->action) && $this->action=='login'){
        $buttonregisterORlogin = '<div class="modal-direction">
                                        <Button id="dangky">Đăng Ký</Button>
                                        <Button id="dangnhap"class="active" >Đăng nhập</Button>
                                    </div>';
        $register_active              =    '';
        $login_active                  =    'active';
        $errorMess  = '<div style="color: red; font-size: 18px; font-weight: bold;margin-bottom: 12px;"><i class="fas fa-exclamation-triangle"></i> Email hoặc mật khẩu không đúng</div>';
        
    }
    // exit();
    // echo '<pre>';
    // print_r($this->arrParam);
    // echo '</pre>';
    // echo Session::get('token');
    // exit();

    //GET RESULT
    $valueUserName = isset($this->arrParam['form']['username']) ? $this->arrParam['form']['username'] : '';
    $valueemail = isset($this->arrParam['form']['email']) ? $this->arrParam['form']['email'] : '';
    $valuephone = isset($this->arrParam['form']['phone']) ? $this->arrParam['form']['phone'] : '';
    $valuefullname = isset($this->arrParam['form']['fullname']) ? $this->arrParam['form']['fullname'] : '';

    //GET ERROR VALIDATE
    $errorUsername = (isset($this->errors['username'])) ? str_replace('Username','Tên đăng nhập',$this->errors['username']) : '';
    $errorphone = (isset($this->errors['phone'])) ? str_replace('Phone','Điện thoại',$this->errors['phone']) : '';
    $erroremail = (isset($this->errors['email'])) ? str_replace('Email','Email',$this->errors['email']) : '';
    $errorPassword = (isset($this->errors['password'])) ? str_replace('Password','Mật khẩu',$this->errors['password']) : '';
    
    //SHOW MESSAGE AND DELETE SESSION
    if(!empty(Session::get('message'))) {
        $messageSuccess = '<div class="register_message">'.Session::get('message').'</div>';
        Session::delete('message');
    }else{
        $messageSuccess = '';
    }
?>

<div class="modal-container-show margin-top">
    <div class="left-container">
        <img src="<?php echo PUBLIC_URL_DEFAULT ?>/imgmain/loginimg.png" alt="">
    </div>
    <div class="right-container">
        <!-- <div id="modal-close" class="modal-close"><i class="fas fa-times"></i></div> -->

        <?php echo $buttonregisterORlogin ;?>

        <div class="modal-content <?php echo $login_active ;?>">
            <div class="model-title">Đăng nhập</div class="model-title">

                <form action="<?php echo URL::createURL('default','index','login') ?>" method="POST" id="main_login">
                <?php echo $errorMess ;?>

                <div class="form-input">
                        <label for="fname">Tài khoản:</label>
                        <input type="text" id="fname" name="form[email]">
                    </div>

                    <div class="form-input">
                        <label for="lname">Mật khẩu:</label>
                        <input type="password" id="lname" name="form[password]" >
                    </div>
                    <div class="model-footer">
                        <input id="main_login_submit" type="submit" name="form[login_form]" value="Đăng nhập">
                        <a href="">Bạn quên mật khẩu?</a>
                    </div>

                    <input type="hidden" name="form[token]" value="<?php echo time()?>">
                </form> 
            </div>

        <div class="modal-content <?php echo $register_active ;?>">
            <div class="model-title">Đăng ký</div class="model-title">
            <form action="<?php echo URL::createURL('default','index','register') ?>" method="POST" name="register-form" id="register-form" >

                <!-- SHOW MESSAGE -->
                <?php echo $messageSuccess ;?>
                 
                <div class="form-input">
                    <label for="fname">Tên tài khoản:<span style="color: red;">*</span></label>
                    <input type="text" id="fname" value="<?php echo $valueUserName ?>" name="form[username]">
                    <div class="input-error"><?php echo $errorUsername ?></div>
                </div>

                <div class="form-input">
                    <label for="fname">Họ tên: </label>
                    <input type="text" id="fname" value="<?php echo $valuefullname ?>" name="form[fullname]">
                    <div class="input-error"></div>
                </div>
                
                <div class="form-input">
                    <label for="lname">Email:<span style="color: red;">*</span></label>
                    <input type="email" id="lname" value="<?php echo $valueemail ?>"  name="form[email]" >
                    <p class='input-error'><?php echo $erroremail ?></p>
                </div>
                
                <div class="form-input">
                    <label for="fname">Số điện thoại:<span style="color: red;">*</span></label>
                    <input type="text" id="fname" value="<?php echo $valuephone ?>"  name="form[phone]">
                    <p class='input-error'><?php echo $errorphone ?></p>
                </div>
                
                <div class="form-input">
                    <label for="fname">Mật khẩu:<span style="color: red;">*</span></label>
                    <input type="password" id="fname" name="form[password]">
                    <p class='input-error'><?php echo $errorPassword ?></p>
                </div>
                
                <div class="form-input">
                    <label for="lname">Nhập lại mật khẩu:</label>
                    <input type="password" id="lname"" >
                    <p class='input-error'></p>
                </div>
                <?php echo $token?>
                
                <div class="model-footer">
                    <input type="submit" id="register_submit" name="form[register]" value="Đăng Ký">
                </div>
            </form> 
        </div>
    </div>
</div>