<?php include_once 'html/header.php' ?>
  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      $linkMain = URL::createURL('admin','index','index');

      $linkGroup = URL::createURL('admin','group','index');
      $linkGroupadd = URL::createURL('admin','group','form');
      
      $linkUser = URL::createURL('admin','user','index');
      $linkUseradd = URL::createURL('admin','user','form');

      $linkCategory = URL::createURL('admin','category','index');
      $linkCategoryadd = URL::createURL('admin','category','form');

      $linkProduct = URL::createURL('admin','product','index');
      $linkProductadd = URL::createURL('admin','product','form');

      $linkCart = URL::createURL('admin','cart','index');
      $linkCartadd = URL::createURL('admin','cart','form');
      ?>
      <ul class="sidebar-menu" data-widget="tree">

        <li>
          <a href="<?php echo  $linkMain  ?>">
            <i class="fa fa-th"></i> <span>Trang chính</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Hot</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="">
            <i style ="margin-right:5px; width: 15px " class="fas fa-users-cog"></i> <span>Quản lý nhóm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo  $linkGroup ?>"><i class="fa fa-circle-o"></i> Hiển thị</a></li>
            <li><a href="<?php echo  $linkGroupadd ?>"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          </ul>
        </li>


        <li class="treeview">
          <a href="">
            <i style ="margin-right:5px; width: 15px " class="fas fa-user"></i>  <span> Quản lý User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo  $linkUser ?>"><i class="fa fa-circle-o"></i> Hiển thị</a></li>
            <li><a href="<?php echo  $linkUseradd ?>"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i style ="margin-right:5px; width: 15px " class="fas fa-box"></i> <span>Danh mục sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo  $linkCategory ?>"><i class="fa fa-circle-o"></i> Hiển thị</a></li>
            <li><a href="<?php echo  $linkCategoryadd ?>"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i style ="margin-right:5px; width: 15px " class="fas fa-archive"></i> <span>Quản lý sản phẩm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo  $linkProduct ?>"><i class="fa fa-circle-o"></i> Hiển thị</a></li>
            <li><a href="<?php echo  $linkProductadd?>"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i style ="margin-right:5px; width: 15px " class="fas fa-clipboard-list"></i> <span>Quản lý đơn hàng</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo  $linkCart ?>"><i class="fa fa-circle-o"></i> Hiển thị</a></li>
            <li><a href="<?php echo  $linkCartadd?>"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          </ul>
        </li>


        
      </ul>
      
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo '<h3>'.$this->_title.'</h3>';?>
        <!-- <small>it all svrts here</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          
        </div>
        <div class="box-body">
          <?php 
            require_once MODULE_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
          ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once 'html/footer.php' ?>