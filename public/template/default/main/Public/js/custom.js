$(document).ready(function(){
        //Tắt bật modal login
        var loginmodal = $('.modal-login')[0];
        $('.top-nav-list #default_login').click(function(){
            loginmodal.classList.add('open')
        })
    
        $('#modal-close').click(function(){
            loginmodal.classList.remove('open')
        })
    
        var dangnhap = $('.modal-content')[0];
        var dangky = $('.modal-content')[1];
        var btndn = $('#dangnhap')[0];
        var btndk = $('#dangky')[0];
    
        //Click vào khoảng không để ẩn đi form
        $('.modal-login').click(function(){
            loginmodal.classList.remove('open')
        })
        /////Click vào khoảng không - nhưng khi vào form ngừng nổi bọt
        $('.modal-container').click(function(event){
            event.stopPropagation();
        })
    
        //Chuyển đổi 2 form đăng ký đăng nhập
        $('#dangnhap').click(function(){
            dangky.classList.remove('active')
            dangnhap.classList.remove('active')
            dangnhap.classList.add('active')
    
            btndk.classList.remove('active')
            btndn.classList.remove('active')
            btndn.classList.add('active')    
        })
        $('#dangky').click(function(){
            dangnhap.classList.remove('active')
            dangky.classList.remove('active')
            dangky.classList.add('active')
    
            btndn.classList.remove('active')
            btndk.classList.remove('active')
            btndk.classList.add('active')   
        })

        //SUBMIT FORM
        $('#login_submit').click(function(){
            $('#login-form').submit();
        })

        $('#register_submit').click(function(){
            $('#register-form').submit();
        })

        $('#main_login_submit').click(function(){
            $('#main_login').submit();
        })

        //Enter to submit
        $('.form-input input').on('keyup', function(e){
            if(e.key === 'Enter' || e.keyCode === 13){
                $('#login-form').submit();
            }
        })
})