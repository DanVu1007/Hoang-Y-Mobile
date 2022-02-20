<?php 
    $token = Helper::createInput('','hidden','form[token]','token',time());
    // exit();
    //GET RESULT
    $valueUserName = isset($this->arrParam['form']['username']) ? $this->arrParam['form']['username'] : '';
    $valueemail = isset($this->arrParam['form']['email']) ? $this->arrParam['form']['email'] : '';
    $valuephone = isset($this->arrParam['form']['phone']) ? $this->arrParam['form']['phone'] : '';
    $valuefullname = isset($this->arrParam['form']['fullname']) ? $this->arrParam['form']['fullname'] : '';

    // exit();
 
    // exit();
    //GET ERROR VALIDATE
    $errorUsername = (isset($this->errors['username'])) ? str_replace('Username','Tên đăng nhập',$this->errors['username']) : '';
    $errorphone = (isset($this->errors['phone'])) ? str_replace('Phone','Điện thoại',$this->errors['phone']) : '';
    $erroremail = (isset($this->errors['email'])) ? str_replace('Email','Email',$this->errors['email']) : '';
    $errorPassword = (isset($this->errors['password'])) ? str_replace('Password','Mật khẩu',$this->errors['password']) : '';
    
    //SHOW MESSAGE AND DELETE SESSION
    if(!empty(Session::get('message')) && !empty(Session::get('message')['color'])) {
        $messageSuccess = '<div class="register_message">'.Session::get('message')['content'].'</div>';
        Session::delete('message');
    }else if(!empty(Session::get('message')) && empty(Session::get('message')['color']))  {
        $messageSuccess = '<div class="register_message">'.Session::get('message')['content'].'</div>';
        Session::delete('message');
    }else{
        $messageSuccess = '';
    }
?>



<div class="modal-container-show margin-top">
    <div class="left-container">
        <img src="<?php echo PUBLIC_URL_DEFAULT ?>/imgmain/user/user_info.png" alt="">
    </div>
    <div class="right-container">
        <!-- <div id="modal-close" class="modal-close"><i class="fas fa-times"></i></div> -->

        <div class="modal-content active">
            <div class="model-title">Thông tin tài khoản</div class="model-title">

            <!-- HIển thị thông báo trùng nên không gửi update -->

            <form action="<?php echo URL::createURL('default','user','updateProfile') ?>" method="POST" name="register-form" id="register-form" >

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
                
                <!-- <div class="form-input">
                    <label for="lname">Nhập lại mật khẩu:</label>
                    <input type="password" id="lname"" >
                    <p class='input-error'></p>
                </div> -->
                <?php echo $token?>
                <input type="hidden" name="form[id]" value="<?php echo Session::get('user')['info']['id']?>">
                <div class="model-footer">
                    <input type="submit" id="register_submit" name="form[register]" value="Cập nhật tài khoản">
                </div>
            </form> 
        </div>
    </div>
</div>