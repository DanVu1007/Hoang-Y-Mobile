		
<?php 
    $inputHidden    = Helper::createInput('','hidden','form[token]','',time(),);
    $inputEditHidden    = Helper::createInput('','hidden','edittoken','',time(),);

    Session::set('olderInput',$this->arrparam);

    //FILL INPUT VALUE
    $inputName = '';$inputOrdering ='';$status_show ='';$status_hidden ='';$group_acp_show='';$group_acp_hidden ='';
    if(!empty($this->arrparam['form'])){
        $inputName = isset($this->arrparam['form']['name']) ? $this->arrparam['form']['name'] : '';
        $inputOrdering = isset($this->arrparam['form']['ordering']) ? $this->arrparam['form']['ordering'] : '';
        $status_show = (isset($this->arrparam['form']['status']) && $this->arrparam['form']['status'] == 1) ? 'selected' : '';
        $status_hidden = (isset($this->arrparam['form']['status']) && $this->arrparam['form']['status'] == 0) ? 'selected' : '';
        $group_acp_show = (isset($this->arrparam['form']['group_acp']) && $this->arrparam['form']['group_acp'] == 1) ? 'selected' : '';
        $group_acp_hidden = (isset($this->arrparam['form']['group_acp']) && $this->arrparam['form']['group_acp'] == 0) ? 'selected' : '';
    }

    //MESSAGE
    
    $message ='';
    if(!empty($this->errors)){
        $message        = array('class'=>'warning','content'=>($this->errors));
    }else if(isset($this->arrparam['form']) && empty($this->errors) && empty($this->arrparam['id'])) {
        $message = array('class'=>'success','content'=>'Thêm nhóm mới thành công!');
    }
    // echo '<pre>';
    // print_r($this->arrparam);
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



    <?php ?>

<!-- <div class="container align-center-box"> -->
    <div class="col-lg-12" style="margin-bottom: 20px">
        <?php 
        $backurl = URL::createURL('admin','group','index');
        $cancelurl = URL::createURL('admin','group','form');
        echo Helper::createButton("Quay lại",'#',$backurl,'fas fa-arrow-left'); 
        $cancelbtn = Helper::createButton("Làm mới",'#',$cancelurl,'fas fa-sync-alt','info');
        ?>
    </div>

    <form class="col-lg-6 " form action="" method="POST" role="form" id="form-group-add">
        <legend class="text-primary">Thêm nhóm</legend>
        
        <div class="form-group">
            <label for="">Tên nhóm</label>
            <input type="text" class="form-control" name="form[name]" value="<?php echo $inputName ?>" id="fullname" placeholder="Tên nhóm">
        </div>
        
        <div class="form-group">
            <label for="">Trạng thái nhóm</label>
            <select  id="input" class="form-control" name="form[status]" required="required">
                <option value="default">--Chọn trạng thái--</option>
                <option value="1" <?php echo $status_show ?>>Hiện</option>
                <option value="0"<?php echo $status_hidden ?>>Ẩn</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="">Quyền</label>
            <select  id="input" class="form-control" name="form[group_acp]" required="required">
                <option value="default">--Chọn quyền--</option>
                <option value="1"<?php echo $group_acp_show ?>>Được sửa</option>
                <option value="0"<?php echo $group_acp_hidden ?>>Không được sửa</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="">Nhập ordering</label>
            <input type="number" class="form-control" value="<?php echo $inputOrdering ?>" name="form[ordering]" id="" placeholder="Ordering">
        </div>

        <?php echo $inputHidden ?>
        <?php echo $editInput  = (isset($this->arrparam['form']['name']) && isset($this->arrparam['form']['ordering'])) ?  $inputEditHidden : ''?>

        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Gửi</button>
        <?php echo $cancelbtn ?>
    </form>
    
<!-- </div> -->
