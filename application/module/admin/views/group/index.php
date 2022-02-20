<?php
    $linkGroup = URL::createURL('admin','group','index');
    $linkUser = URL::createURL('admin','user','index');

    $url_add        = URL::createURL('admin','group','form');
    $btn_add        = Helper::createButton('Thêm mới','#',$url_add,'fas fa-plus-square','info');        //new

    $url_removeall     = URL::createURL('admin','group','removeall');
    $btn_deleteall     = Helper::createButton('Xóa','#',$url_removeall,'fas fa-trash','danger','submit');     //delete all

    $url_save       = URL::createURL('admin','group','save');
    $btn_save       = Helper::createButton('','#',$url_save,'far fa-save','warning');             //save
    
    $url_public     = URL::createURL('admin','group','status',array('type'=> 1));
    $btn_public     = Helper::createButton('Trạng thái: Hiển thị','#',$url_public,'far fa-eye','success','submit');             //public
    
    $url_unpublic   = URL::createURL('admin','group','status',array('type'=> 0));
    $btn_unpublic   = Helper::createButton('Trạng thái: Ẩn','#',$url_unpublic,'fas fa-eye-slash','danger','submit');             //unpublic

    $url_ordering   = URL::createURL('admin','group','ordering');
    $btn_ordering   = Helper::createButton('Cập nhật ordering','#',$url_ordering,'fas fa-archive','primary','submit');             //ordering

    //MESSAGE
    

    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';
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
  
    // echo '<pre>';
    // print_r($this->arrParam);
    // echo '</pre>';
    $columnPost = !empty(($this->arrParam['filter_column'])) ? $this->arrParam['filter_column'] : '';
    $orderPost = !empty(($this->arrParam['filter_column_dir'])) ? $this->arrParam['filter_column_dir'] : '';
    $filter = !empty(($this->arrParam['filter-search'])) ? $this->arrParam['filter-search'] : '';
    $filter_state = isset(($this->arrParam['filter-state'])) ? $this->arrParam['filter-state'] : 'default';
    $filter_group_acp = isset(($this->arrParam['filter-group_acp'])) ? $this->arrParam['filter-group_acp'] : 'default';

    // $columnPost     =       $this->arrParam['filter_column'];
    // $orderPost      =       $this->arrParam['filter_column_dir'];
    
    $lblName  = Helper::cmsLinkSort('Tên','name',$columnPost,$orderPost);
    $lblid  = Helper::cmsLinkSort('ID','id',$columnPost,$orderPost);
    $lblstatus  = Helper::cmsLinkSort('Trạng thái','status',$columnPost,$orderPost);
    $lblgroup_acp  = Helper::cmsLinkSort('Quyền','group_acp',$columnPost,$orderPost);
    $lblordering  = Helper::cmsLinkSort('Ordering','ordering',$columnPost,$orderPost);
    $lblcreated  = Helper::cmsLinkSort('Được tạo lúc','created',$columnPost,$orderPost);
    $lblcreated_by  = Helper::cmsLinkSort('Được tạo bởi','created_by',$columnPost,$orderPost);
    $lblmodified  = Helper::cmsLinkSort('Chỉnh sửa','modified',$columnPost,$orderPost);
    $lblmodified_by  = Helper::cmsLinkSort('Chỉnh sửa bởi','modified_by',$columnPost,$orderPost);

    // SELECT
    $arrStatus          = array('default'=>'-Tìm kiếm theo trạng thái-',1=>'Hiển thị',0=>'Ẩn');
    $selectboxStatus = Helper::cmsCreateSelectBox('filter-state', 'form-control',$arrStatus,$filter_state);

    //GROUP_ACP
    $arrGroup_acp        = array('default'=>'-Tìm kiếm group ACP-',1=>'Có',0=>'Không');
    $selectboxGroup_acp = Helper::cmsCreateSelectBox('filter-group_acp', 'form-control',$arrGroup_acp,$filter_group_acp);

    //SESSION
    $message = Session::get('message');
    Session::delete('message');
    
    $strMessage = Helper::cmsCreateMessage($message);

    
?>



<!-- FORM GỬI QUERY -->

<!-- MESSAGE SESSION -->

<div class="alert alert-success display-none" id="status-message">
    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
    <i class="fas fa-check-circle"></i> <span class="content">Cập nhật trạng thái thành công cho id: 4</span>
</div>

<?php echo $strMessage ?>

<form action="#" method="post" name="adminForm" id="adminForm">

    <div class="table-toolbar-menu-right">

        <!-- SEARCH -->
        <div>
            <div class="col-lg-12" style="margin-left: -10px;margin-bottom: 10px" id="filter-bar">
                    <div class="input-group">
                        <input type="text" class="form-control" name="filter-search" id="filter-search" placeholder="Tìm kiếm..." value="<?php echo $filter ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="clear-keyword" type="button">Xóa</button>
                        </span>
                        <span class="input-group-btn">
                            <button class="btn btn-default" name="submit-keyword" type="button">Tìm kiếm</button>
                        </span>
                    </div><!-- /input-group -->
            </div><!-- /.row -->
        </div>
        
        <!-- BUTTON MAIN -->
        <div>
            <?php echo $strBtn ?>
        </div>
    </div>

    <!-- SELECT BOX -->
    <div class="drop-down-filter-search">
        <?php echo $selectboxStatus. $selectboxGroup_acp ?>

    </div>

    

    <table class="table table-hover">
        <thead>
            <!-- Tiêu đề -->
            <tr>
                <th><input type="checkbox" name="checkall-tongle" value=""></th>
                <th><?php echo $lblid ?></th>
                <th><?php echo $lblName ?></th>
                <th><?php echo $lblstatus ?></th>
                <th><?php echo $lblgroup_acp ?></th>
                <th><?php echo $lblordering ?></th>
                <th><?php echo $lblcreated ?></th>
                <th><?php echo $lblcreated_by ?></th>
                <th><?php echo $lblmodified ?></th>
                <th><?php echo $lblmodified_by ?></th>
                <th></th>
                
                
            </tr>
        </thead>
        <tbody>
            <!-- Nội dung -->
            <?php 


                if(!empty($this->items)){
                    foreach ($this->items as $key => $value) {
                    $url_remove     = URL::createURL('admin','group','remove', array('id'=>$value['id']));
                    $btn_delete     = Helper::createButton('Xóa','#',$url_remove,'fas fa-trash-alt','danger','submit');     //delete each
                
                    $url_edit       = URL::createURL('admin','group','form', array('id'=>$value['id']));
                    $btn_edit       = Helper::createButton('Sửa','#',$url_edit,'fas fa-edit','primary');             //edit
 
                    $url_status     = URL::createURL('admin','group','ajaxStatus',array('id'=>$value['id'],'status'=> $value['status']));
                    $status         = Helper::statusBtn($value['status'],$url_status ,$value['id']);
                    
                    $url_group_acp  = URL::createURL('admin','group','ajaxACP',array('id'=>$value['id'],'group_acp'=> $value['group_acp']));
                    $group_acp      = Helper::groupACPBtn($value['group_acp'],$url_group_acp ,$value['id']);

 

                    $created = Helper::formatDate($value['created']);
                    $modified = Helper::formatDate($value['modified']); 
                    ?>
                    <tr>
                        <td><input type="checkbox" name="cid[]" value="<?php echo $value['id'] ?>"></td>
                        <td><?php echo $value['id'] ?></td>
                        <td><?php echo $value['name'] ?></td>
                        <td><?php echo $status ?></td>
                        <td><?php echo $group_acp ?></td>
                        <td style="width: 10%;"><input type="number" name="order[<?php echo $value['id'] ?>]" value="<?php echo $value['ordering'] ?>" class="" style="width: 50%;"></td>
                        <td><?php echo $created ?></td>
                        <td><?php echo $value['created_by'] ?></td>
                        <td><?php echo $modified ?></td>
                        <td><?php echo $value['modified_by'] ?></td>
                        
                        <td>
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
        echo( $paginationHTML     = $this->pagination->showPagination(URL::createURL('admin','group','index')));
     ?>
 </div>