    <!-- BUTTON -->
    <?php
        $linkProduct = URL::createURL('admin','product','index');

        $url_add        = URL::createURL('admin','product','form');
        $btn_add        = Helper::createButton('Thêm mới','#',$url_add,'fas fa-plus-square','info');        //new

        $url_removeall     = URL::createURL('admin','product','removeall');
        $btn_deleteall     = Helper::createButton('Xóa','#',$url_removeall,'fas fa-trash','danger','submit');     //delete all

        $url_save       = URL::createURL('admin','product','save');
        $btn_save       = Helper::createButton('','#',$url_save,'far fa-save','warning');             //save
        
        $url_public     = URL::createURL('admin','product','status',array('type'=> 1));
        $btn_public     = Helper::createButton('Trạng thái: Hiển thị','#',$url_public,'far fa-eye','success','submit');             //public
        
        $url_unpublic   = URL::createURL('admin','product','status',array('type'=> 0));
        $btn_unpublic   = Helper::createButton('Trạng thái: Ẩn','#',$url_unpublic,'fas fa-eye-slash','danger','submit');             //unpublic

        $url_ordering   = URL::createURL('admin','product','ordering');
        $btn_ordering   = Helper::createButton('Cập nhật ordering','#',$url_ordering,'fas fa-archive','primary','submit');             //ordering

        //MESSAGE
        $strBtn='';
        switch ($this->arrParam['action']) {
            case 'index':
                $strBtn = $btn_add.$btn_public.$btn_unpublic.$btn_ordering .$btn_deleteall ;  
                break;
            case 'add':
                $strBtn = $btn_save.$btn_public.$btn_unpublic.$btn_deleteall;
                break;
            case 'edit':
                $strBtn = $btn_save;
                break;
            case 'remove':
                # code...
                break;
            case 'save':
                break;
            
            default:
                # code...
                break;
        }
    ?>

<?php 
    $columnPost = !empty(($this->arrParam['filter_column'])) ? $this->arrParam['filter_column'] : '';
    $orderPost = !empty(($this->arrParam['filter_column_dir'])) ? $this->arrParam['filter_column_dir'] : '';
    $filter = !empty(($this->arrParam['filter-search'])) ? $this->arrParam['filter-search'] : '';
    $filter_state = isset(($this->arrParam['filter-state'])) ? $this->arrParam['filter-state'] : 'default';
    $filter_special = isset(($this->arrParam['filter-special'])) ? $this->arrParam['filter-special'] : 'default';
    $filter_category_id = isset(($this->arrParam['filter-category_id'])) ? $this->arrParam['filter-category_id'] : 'default';
    
    $lblid  = Helper::cmsLinkSort('ID','id',$columnPost,$orderPost);
    $lblstatus  = Helper::cmsLinkSort('Trạng thái','status',$columnPost,$orderPost);
    $lblspecial  = Helper::cmsLinkSort('Đặc biệt','special',$columnPost,$orderPost);
    $lblName  = Helper::cmsLinkSort('Tên sản phẩm','name',$columnPost,$orderPost);
    $lblcategory  = Helper::cmsLinkSort('Phân loại','category_id',$columnPost,$orderPost);
    $lblPicture = Helper::cmsLinkSort('Hình ảnh','picture',$columnPost,$orderPost);
    $lblprice  = Helper::cmsLinkSort('Giá-CHÍNH THỨC','price',$columnPost,$orderPost);
    $lblSale_Off  = Helper::cmsLinkSort('Giá-ẢO','sale_off',$columnPost,$orderPost);
    $lbldescription  = Helper::cmsLinkSort('Mô tả','description',$columnPost,$orderPost);
    $lblcreated  = Helper::cmsLinkSort('Được tạo lúc','created',$columnPost,$orderPost);
    $lblcreated_by  = Helper::cmsLinkSort('Được tạo bởi','created_by',$columnPost,$orderPost);
    $lblmodified  = Helper::cmsLinkSort('Ngày chỉnh sửa','modified',$columnPost,$orderPost);
    $lblmodified_by  = Helper::cmsLinkSort('Chỉnh sửa bởi','modified_by',$columnPost,$orderPost);
    $lblordering  = Helper::cmsLinkSort('Thứ tự','ordering',$columnPost,$orderPost);

    // FILTER
    $arrStatus          = array('default'=>'-Tìm kiếm theo trạng thái-',1=>'Hiển thị',0=>'Ẩn');
    $selectboxStatus = Helper::cmsCreateSelectBox('filter-state', 'form-control',$arrStatus,$filter_state);

    // FILTER SPECIAL 
    $arrSpecial          = array('default'=>'-Tìm kiếm theo độ ưu tiên-',1=>'Ưu tiên',0=>'Không ưu tiên');
    $selectboxSpecial = Helper::cmsCreateSelectBox('filter-special', 'form-control',$arrSpecial,$filter_special);

    //Category
    $selectboxCategory = Helper::cmsCreateSelectBox('filter-category_id', 'form-control',$this->slbCategory,$filter_category_id);

    //SESSION
    $message = Session::get('message');
    Session::delete('message');
    
    $strMessage = Helper::cmsCreateMessage($message);

    
?>



<!-- FORM GỬI QUERY -->

<!-- MESSAGE SESSION -->
<?php echo $strMessage ?>

<form action="#" method="post" name="adminForm" id="adminForm">

    <div class="table-toolbar-menu-right">

        <!-- SEARCH -->
        <div>
            <div class="col-lg-12" style="margin-left: -10px;margin-bottom: 10px" id="filter-bar">
                    <div class="input-user table-toolbar-menu-right">
                        <input type="text" class="form-control" name="filter-search" id="filter-search" placeholder="Tìm kiếm..." value="<?php echo $filter ?>">
                        <span class="input-user-btn">
                            <button class="btn btn-default" name="clear-keyword" type="button">Xóa</button>
                        </span>
                        <span class="input-user-btn">
                            <button class="btn btn-default" name="submit-keyword" type="button">Tìm kiếm</button>
                        </span>
                    </div><!-- /input-user -->
            </div><!-- /.row -->
        </div>
        
        <!-- BUTTON MAIN -->
        <div>
            <?php echo $strBtn ?>
        </div>
    </div>

    <!-- SELECT BOX -->
    <div class="drop-down-filter-search">
        <?php echo $selectboxSpecial.$selectboxStatus.$selectboxCategory ?>
    </div>

    

    <table class="table table-hover">
        <thead>
            <!-- Tiêu đề -->
            <tr>
                <th><input type="checkbox" name="checkall-tongle" value=""></th>
                <th><?php echo $lblid ?></th>
                <th><?php echo $lblstatus ?></th>
                <th><?php echo $lblspecial ?></th>
                <th><?php echo $lblName ?></th>
                <th><a href="">Hình ảnh</a></th>
                <th><?php echo $lblcategory ?></th>
                <th><?php echo $lblprice ?></th>
                <th><?php echo $lblSale_Off ?></th>
                <th><?php echo $lbldescription ?></th>
                <th><?php echo $lblcreated ?></th>
                <th><?php echo $lblcreated_by ?></th>
                <th><?php echo $lblmodified ?></th>
                <th><?php echo $lblmodified_by ?></th>
                <th><?php echo $lblordering ?></th>
                <th></th>
                
                
            </tr>
        </thead>
        <tbody>
            <!-- Nội dung -->
            <?php 
                // echo '<pre>';
                // print_r($this->items);
                // echo '</pre>';

                if(!empty($this->items)){
                    foreach ($this->items as $key => $value) {
                    $url_remove     = URL::createURL('admin','product','remove', array('id'=>$value['id']));
                    $btn_delete     = Helper::createButton('Xóa','#',$url_remove,'fas fa-trash-alt','danger','submit');     //delete each
                
                    $url_edit       = URL::createURL('admin','product','form', array('id'=>$value['id']));
                    $btn_edit       = Helper::createButton('Sửa','#',$url_edit,'fas fa-edit','primary');             //edit

                    $url_status     = URL::createURL('admin','product','ajaxStatus',array('id'=>$value['id'],'status'=> $value['status']));
                    $status         = Helper::statusBtn($value['status'],$url_status ,$value['id']);

                    $url_special     = URL::createURL('admin','product','ajaxSpecial',array('id'=>$value['id'],'special'=> $value['special']));
                    $specical         = Helper::specialBtn($value['special'],$url_special ,$value['id']);
                    

                    $created = Helper::formatDate($value['created']);
                    $modified = Helper::formatDate($value['modified']); 

                    $img        = ($value['picture'] != null) ? $value['picture'] :'default.png';
                    
                    ?>


                    <tr>
                        <td><input type="checkbox" name="cid[]" value="<?php echo $value['id'] ?>"></td>
                        <td><?php echo $value['id'] ?></td>
                        <td><?php echo $status ?></td>
                        <td><?php echo $specical ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td style="width: 10%;"><img src="<?php echo UPLOAD_URL.'product/'.$img  ?>" alt="" width="60%"></td> 
                        <td><?php echo $value['category_name'] ?></td>
                        <td><?php echo $value['price'] ?></td>
                        <td><?php echo $value['sale_off'] ?></td>
                        <td><?php echo substr($value['description'],0,120).'...' ?></td>
                        <td><?php echo $created ?></td>
                        <td><?php echo $value['created_by'] ?></td>
                        <td><?php echo (($modified != '')?$modified:'Chưa chỉnh sửa') ?></td>
                        <td><?php echo $value['modified_by'] ?></td>
                        <td style="width: 10%;"><input type="number" name="order[<?php echo $value['id'] ?>]" value="<?php echo $value['ordering'] ?>" class="" style="width: 50%;"></td>
                        
                        <td style="width: 12%;">
                            <?php echo $btn_edit?>
                            <?php echo $btn_delete?>
                        </td>
                    </tr>
            <?php }}?>
        </tbody>
    </table>

    <div>
        <input type="hidden" name="filter_column" value="">
        <input type="hidden" name="filter_column_dir" value="">
        <input type="hidden" name="filter_page" value="1">
    </div>
</form>

 <div class="align-center-box">
     <?php
        echo( $paginationHTML     = $this->pagination->showPagination(URL::createURL('admin','product','index')));
     ?>
 </div>