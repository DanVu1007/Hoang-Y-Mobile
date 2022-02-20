<div class="modal-container-show">
    <div class="left-container">
        <img src="<?php echo PUBLIC_URL ?>/imgmain/loginimg.png" alt="">
    </div>
    <div class="right-container">
        <!-- <div id="modal-close" class="modal-close"><i class="fas fa-times"></i></div> -->

        <div class="modal-direction">
            <Button id="dangnhap" class="active">Đăng nhập</Button>
            <Button id="dangky">Đăng Ký</Button>
        </div>


        <div class="modal-content active">
            <div class="model-title">Đăng nhập</div class="model-title">
            <form action="index.php?controller=user&action=login" method="POST" name="login-form" id="login-form">
                <div class="form-input">
                    <label for="fname">Tài khoản:</label>
                    <input type="text" id="fname" name="username">
                    <div class="input-error"><?php echo (empty($this->errors['username']) ? '' : $this->errors['username']) ?></div>
                </div>

                <div class="form-input">
                    <label for="lname">Mật khẩu:</label>
                    <input type="password" id="lname" name="password" >
                    <div class="input-error"></div>
                </div>
            </form> 
            
            <div class="model-footer">
                <Button id="login">Đăng nhập</Button>
                <a href="">Bạn quên mật khẩu?</a>
            </div>
        </div>
        <div class="modal-content ">
            <div class="model-title">Đăng ký</div class="model-title">
            <form action="index.php?controller=user&action=login1" method="POST" name="register-form" id="register-form" >
                <div class="form-input">
                    <label for="fname">Họ tên:</label>
                    <input type="text" id="fname" name="username">
                    <div class="input-error"><?php echo (empty($this->errors['username']) ? '' : $this->errors['username']) ?></div>
                </div>
                
                <div class="form-input">
                    <label for="lname">Email:</label>
                    <input type="email" id="lname" name="email" >
                    <p class='input-error'></p>
                </div>
                
                <div class="form-input">
                    <label for="fname">Số điện thoại:</label>
                    <input type="text" id="fname" name="phone">
                    <p class='input-error'></p>
                </div>
                
                <div class="form-input">
                    <label for="fname">Mật khẩu:</label>
                    <input type="password" id="fname" name="password">
                    <p class='input-error'></p>
                </div>
                
                <div class="form-input">
                    <label for="lname">Nhập lại mật khẩu:</label>
                    <input type="password" id="lname" name="re-password" >
                    <p class='input-error'></p>
                </div>
            </form> 
            
            <div class="model-footer">
                <Button id="register">Đăng Ký</Button>
            </div>
        </div>
    </div>
</div>