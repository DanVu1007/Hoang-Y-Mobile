		
<?php 
    $inputHidden    = Helper::createInput('','hidden','form[token]','',time(),);
    $inputEditHidden    = Helper::createInput('','hidden','edittoken','',time(),);
    Session::set('olderInput',$this->arrparam);
    
    //FILL INPUT VALUE
    $inputName = '';$inputOrdering ='';$status_show ='';$status_hidden ='';$inputpicture='';$inputicon='';
    if(!empty($this->arrparam['form'])){
        
        $inputName = isset($this->arrparam['form']['name']) ? $this->arrparam['form']['name'] : '';
        $inputicon = isset($this->arrparam['form']['icon']) ? $this->arrparam['form']['icon'] : '';
        $inputOrdering = isset($this->arrparam['form']['ordering']) ? $this->arrparam['form']['ordering'] : '';
        $inputpicture = (isset($this->arrparam['form']['picture']) && !is_array($this->arrparam['form']['picture'])) ? $this->arrparam['form']['picture'] : '';

        $status_show = (isset($this->arrparam['form']['status']) && $this->arrparam['form']['status'] == 1) ? 'selected' : '';
        $status_hidden = (isset($this->arrparam['form']['status']) && $this->arrparam['form']['status'] == 0) ? 'selected' : '';
        
        $inputPictureHidden = Helper::createInput('','hidden','form[picture_hidden]','picture_hidden',$inputpicture);
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

    //IMAGEEEEEEEE
    // <img src="<?php echo PUBLIC_URL.'files/category/KfA0Lyl2.JPG' " width="10%" alt="">
    // exit();
    $picture = '';
    if(!empty($this->arrparam['form']) &&  !is_array($this->arrparam['form']['picture'])){
        $picture    = '<img src="'. PUBLIC_URL.'files/category/'.$this->arrparam['form']['picture'].'" width="10%" alt="">';
    }
    // exit();

?>



    <?php ?>

<!-- <div class="container align-center-box"> -->
    <div class="col-lg-12" style="margin-bottom: 20px">
        <?php 
        $backurl = URL::createURL('admin','category','index');
        $cancelurl = URL::createURL('admin','category','form');
        echo Helper::createButton("Quay lại",'#',$backurl,'fas fa-arrow-left'); 
        $cancelbtn = Helper::createButton("Làm mới",'#',$cancelurl,'fas fa-sync-alt','info');
        ?>
    </div>

    <form class="col-lg-6 " form action="" method="POST" role="form" id="form-category-add" enctype="multipart/form-data">
        <legend class="text-primary">Thêm nhóm</legend>
        
        <div class="form-category">
            <label for="">Tên nhóm</label>
            <input type="text" class="form-control" name="form[name]" value="<?php echo $inputName ?>" id="fullname" placeholder="Tên nhóm">
        </div>
        <div class="form-category">
            <label for="">Thêm icon</label>
            <input type="text" class="form-control" name="form[icon]" value="<?php echo $inputicon ?>" id="icon" placeholder="Thêm icon">
        </div>
        
        <div class="form-category">
            <label for="">Trạng thái nhóm</label>
            <select  id="input" class="form-control" name="form[status]" required="required">
                <option value="default">--Chọn trạng thái--</option>
                <option value="1" <?php echo $status_show ?>>Hiện</option>
                <option value="0"<?php echo $status_hidden ?>>Ẩn</option>
            </select>
        </div>
        
        
        <div class="form-category">
            <label for="">Nhập ordering</label>
            <input type="number" class="form-control" value="<?php echo $inputOrdering ?>" name="form[ordering]" id="" placeholder="Ordering">
        </div>

        <!-- CHỌN ẢNH -->
        <?php echo $picture ;?>

        <div class="form-category">
            <label for="">Chọn ảnh</label>
            <input type="file" class="form-control" value="<?php echo $inputpicture ?>" name="picture" id="picture" >
        </div>
        <!-- CHỌN ẢNH -->

        <?php 
            if(isset($this->arrparam['form']['name'])){
                echo $inputPictureHidden ;
            }
        echo $inputHidden;
        echo $editInput  = (isset($this->arrparam['form']['name']) && isset($this->arrparam['form']['ordering'])) ?  $inputEditHidden : ''?>

        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Gửi</button>
        <?php echo $cancelbtn ?>
    </form>
    
    
 <!-- </div> -->
