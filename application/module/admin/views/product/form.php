		
<?php 
    // exit();
    $inputHidden    = Helper::createInput('','hidden','form[token]','',time(),);
    $inputEditHidden    = Helper::createInput('','hidden','edittoken','',time(),);


    //FILL INPUT VALUE
    $inputName = '';
    $inputprice ='';
    $inputOrdering ='';
    $inputpassword ='';
    $inputsale_off ='';
    $inputdescription ='';
    $inputstatus = '';
    $inputspecial = '';
    $inputcategory_id = '';
    $inputpicture='';

        //Lấy dữ liệu từ database
    if(!empty($this)){

        $inputName = isset($this->arrparam['form']['name']) ? $this->arrparam['form']['name'] : '';
        $inputName = isset($this->arrparam['form']['name']) ? $this->arrparam['form']['name'] : '';
        $inputprice = isset($this->arrparam['form']['price']) ? $this->arrparam['form']['price'] : '';
        $inputOrdering = isset($this->arrparam['form']['ordering']) ? $this->arrparam['form']['ordering'] : '';
        // $inputpassword = isset($this->arrparam['form']['password']) ? $this->arrparam['form']['password'] : '';

        $inputdescription = isset($this->arrparam['form']['description']) ? $this->arrparam['form']['description'] : '';
        $inputsale_off = isset($this->arrparam['form']['sale_off']) ? $this->arrparam['form']['sale_off'] : '';
        $inputstatus = isset($this->arrparam['form']['status']) ? $this->arrparam['form']['status'] : 'default';
        $inputspecial = isset($this->arrparam['form']['special']) ? $this->arrparam['form']['special'] : 'default';
        $inputcategory_id = isset($this->arrparam['form']['category_id']) ? $this->arrparam['form']['category_id'] : 'default';
        
        $inputpicture = (isset($this->arrparam['form']['picture']) && !is_array($this->arrparam['form']['picture'])) ? $this->arrparam['form']['picture'] : '';
        $inputPictureHidden = Helper::createInput('','hidden','form[picture_hidden]','picture_hidden',$inputpicture);

    }

        //IMGAGE
        $picture = '';
        if(!empty($this->arrparam['form']['picture']) &&  !is_array($this->arrparam['form']['picture'])){
            $picture    = '<img src="'. PUBLIC_URL.'files/product/'.$this->arrparam['form']['picture'].'" width="10%" alt="">';
        }


        //MESSAGE
        $message ='';
        if(!empty($this->errors)){
            $message        = array('class'=>'warning','content'=>($this->errors));
        }else if(isset($this->arrparam['form']) && empty($this->errors) && empty($this->arrparam['id'])) {
            $message = array('class'=>'success','content'=>'Thêm nhóm mới thành công!');
        }
        $message        = Helper::cmsCreateMessage($message);
        
        if($message != ''){
            echo $message;
        }
    
        //MESSAGE update thành công sử dụng session
        $message = Session::get('message');
        Session::delete('message');
        echo $strMessage = Helper::cmsCreateMessage($message);

?>

    <div class="col-lg-12" style="margin-bottom: 20px">
        <?php  // BACK BUTTON
            echo Helper::createButton("Quay lại",'#',URL::createURL('admin','product','index'),'fas fa-arrow-left'); 
        ?>
    </div>

    <?php
        // SELECT FILTER GROUP
        // $selectboxGroup = Helper::cmsCreateSelectBox('filter-group', 'form-control',$this->slbGroup,$filter_group);

        //Định hình input
        // createInput($label, $type, $name, $id, $value, $need = false , $class = null, $size = null)
        $nameInput  = Helper::createInput('Tên sản phẩm','text','form[name]','#',$inputName,true);
        $priceInput     = Helper::createInput('Giá bán-CHÍNH','price','form[price]','#',$inputprice,true);
        $sale_offInput  = Helper::createInput('Giá chưa khuyến mãi-ẢO','text','form[sale_off]','#',$inputsale_off,true);
        $descriptionInput  = '<label for="">Mô tả sản phẩm</label><textarea name="form[description]" id="input" class="form-control" rows="3" style="margin-bottom:15px">'.$inputdescription.'</textarea>';
        
        $imgInput  = Helper::createInput('Thêm hình ảnh','file','picture','#','');
        $orderingInput  = Helper::createInput('ordering','number','form[ordering]','#',$inputOrdering);
        $statusSelect   = Helper::cmsSelectInput('Trạng thái sản phẩm','form[status]','',array('default'=>'-Lựa chọn trạng thái',1=>'Hiện',0=>'Ẩn'),$inputstatus);
        $specialSelect   = Helper::cmsSelectInput('Độ ưu tiên sản phẩm','form[special]','',array('default'=>'-Lựa chọn trạng thái',1=>'Ưu tiên',0=>'Không ưu tiên'),$inputspecial);
        $categorySelect    = Helper::cmsSelectInput('Chọn nhóm sản phẩm','form[category_id]','',$this->slbCategory,$inputcategory_id);
        
        // echo '<pre>';
        // print_r($this->arrparam);
        // echo '</pre>';
    ?>
    <form class="col-lg-6 " form action="" method="POST" role="form" id="form-group-add" enctype="multipart/form-data">
        <legend class="text-primary"><?php echo $this->_title ?></legend>
        <?php 

            //INPUT
            echo 
            $nameInput.         //USERNAME
            $priceInput.
            $sale_offInput;

            //PICTURE
            echo $picture.
            $imgInput.

            $descriptionInput.
            $statusSelect.
            $specialSelect.
            $categorySelect.
            $orderingInput;

            ?>

        <!-- BUTTON SUBMIT -->
        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Gửi</button>

        <!-- REFRESH BUTTON -->
        <?php 

            if(isset($this->arrparam['form']['name'])){
                echo $inputPictureHidden ;
            }
            $cancelurl = URL::createURL('admin','product','form');
            echo $cancelbtn = Helper::createButton("Làm mới",'#',$cancelurl,'fas fa-sync-alt','info');

            //INPUT HIDDEN
            echo $inputHidden;
            echo $inputEditHidden  = (isset($this->arrparam['form']['name']) && isset($this->arrparam['form']['id'])) ?  $inputEditHidden : '';
        ?>
    </form>
    





