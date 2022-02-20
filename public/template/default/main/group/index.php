<div>
    <?php 
                // echo '<pre>';
                // print_r($_SESSION['loggedIn']);
                // echo '<pre>';
                $dangnhap = '<li class="top-nav-item"><a href="index.php?controller=login&action=index">Đăng nhập</a></li>';
                $mini = 'danbmt';
                if(Session::get('loggedIn')){
                    $mini = '<h1>Đây là h1</h1>';
                }else{
                    $mini = '<li class="top-nav-item"><a href="index.php?controller=logout&action=index">Đăng xuất</a></li>';
                }
                echo Session::get('loggedIn');
                echo $mini;
    ?>
    <h1>Đây là h1</h1>

    
</div>