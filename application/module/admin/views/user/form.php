		
<?php 
    $inputHidden    = Helper::createInput('','hidden','form[token]','',time(),);
    $inputEditHidden    = Helper::createInput('','hidden','edittoken','',time(),);


    //FILL INPUT VALUE
    $inputName = '';
    $inputEmail ='';
    $inputOrdering ='';
    $inputpassword ='';
    $inputphone ='';
    $inputfullname ='';
    $inputstatus = '';
    $inputgroup_id = '';

        //Lấy dữ liệu từ database
    if(!empty($this)){
        $inputName = isset($this->arrparam['form']['username']) ? $this->arrparam['form']['username'] : '';
        $inputEmail = isset($this->arrparam['form']['email']) ? $this->arrparam['form']['email'] : '';
        $inputOrdering = isset($this->arrparam['form']['ordering']) ? $this->arrparam['form']['ordering'] : '';
        // $inputpassword = isset($this->arrparam['form']['password']) ? $this->arrparam['form']['password'] : '';
        $inputfullname = isset($this->arrparam['form']['fullname']) ? $this->arrparam['form']['fullname'] : '';
        $inputphone = isset($this->arrparam['form']['phone']) ? $this->arrparam['form']['phone'] : '';
        $inputstatus = isset($this->arrparam['form']['status']) ? $this->arrparam['form']['status'] : 'default';
        $inputgroup_id = isset($this->arrparam['form']['group_id']) ? $this->arrparam['form']['group_id'] : 'default';
    }

        //MESSAGE
        
        $message ='';
        if(!empty($this->errors)){
            $message        = array('class'=>'warning','content'=>($this->errors));
        }else if(isset($this->arrparam['form']) && empty($this->errors) && empty($this->arrparam['id'])) {
            $message = array('class'=>'success','content'=>'Thêm nhóm mới thành công!');
        }
        // echo '<pre>';
        // print_r($this->arrParam['form']);
        // echo '</pre>';
        $message        = Helper::cmsCreateMessage($message);
        
        if($message != ''){
            echo $message;
        }
    
        //MESSAGE update thành công sử dụng session
        //SESSION
        $message = Session::get('message');
        Session::delete('message');
        echo $strMessage = Helper::cmsCreateMessage($message);

?>

    <div class="col-lg-12" style="margin-bottom: 20px">
        <?php  // BACK BUTTON
            $backurl = URL::createURL('admin','user','index');
            echo Helper::createButton("Quay lại",'#',$backurl,'fas fa-arrow-left'); 
        ?>
    </div>

    <?php
        // SELECT FILTER GROUP
        // $selectboxGroup = Helper::cmsCreateSelectBox('filter-group', 'form-control',$this->slbGroup,$filter_group);

        //Định hình input
        // createInput($label, $type, $name, $id, $value, $need = false , $class = null, $size = null)
        $usernameInput  = Helper::createInput('Tên đăng nhập','text','form[username]','#',$inputName,true);
        $emailInput     = Helper::createInput('Email','email','form[email]','#',$inputEmail,true);
        $fullnameInput  = Helper::createInput('Tên đầy đủ','text','form[fullname]','#',$inputfullname,);
        $phoneInput  = Helper::createInput('Số điện thoại','text','form[phone]','#',$inputphone,true);
        $passwordInput  = Helper::createInput('Mật khẩu','password','form[password]','#',$inputpassword,true);
        $orderingInput  = Helper::createInput('ordering','number','form[ordering]','#',$inputOrdering);

        $statusSelect   = Helper::cmsSelectInput('Trạng thái nhóm','form[status]','',array('default'=>'-Lựa chọn trạng thái',1=>'Hiện',0=>'Ẩn'),$inputstatus);
        $groupSelect    = Helper::cmsSelectInput('Chọn nhóm','form[group_id]','',$this->slbGroup,$inputgroup_id);
        
        // echo '<pre>';
        // print_r($this->arrparam);
        // echo '</pre>';
    ?>
    <form class="col-lg-6 " form action="" method="POST" role="form" id="form-group-add">
        <legend class="text-primary"><?php echo $this->_title ?></legend>
        <?php 

            //INPUT
            echo 
            $usernameInput.         //USERNAME
            $emailInput.
            $phoneInput.
            $fullnameInput.
            $passwordInput.
            $statusSelect.
            $groupSelect.
            $orderingInput;

            ?>

        <!-- BUTTON SUBMIT -->
        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Gửi</button>

        <!-- REFRESH BUTTON -->
        <?php 
            $cancelurl = URL::createURL('admin','user','form');
            echo $cancelbtn = Helper::createButton("Làm mới",'#',$cancelurl,'fas fa-sync-alt','info');

            //INPUT HIDDEN
            echo $inputHidden;
            echo $inputEditHidden  = (isset($this->arrparam['form']['username']) && isset($this->arrparam['form']['id'])) ?  $inputEditHidden : '';
        ?>
    </form>
    




